import {useState} from "react";
import * as Yup from "yup";
import {useFormik} from "formik";
import CollectionApiService from "../../../../Api/Collection/CollectionApiService";
import {useAuth} from "../../../../hooks/useAuth";

const MyMovieCollectionModalSchema = Yup.object().shape({
    name: Yup.string()
        .min(1)
        .max(60)
        .required('This field is required'),
});

const useMyMovieCollectionModal = ({...props}) => {
    const { auth } = useAuth();

    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const formik = useFormik({
        initialValues: {
            'name': '',
        },
        onSubmit: values => {
            handleSaveChanges(values)
        },
        validationSchema: MyMovieCollectionModalSchema
    })

    const handleSaveChanges = async (values) => {
        await CollectionApiService.createCollection(values.name, auth)

        await props.fetchCustomCollections()

        handleClose()
    }

    return {
        formik,
        show,
        handleShow,
        handleClose,
    }
}

export default useMyMovieCollectionModal