import {useState} from "react";
import {useFormik} from "formik";
import * as Yup from "yup";

const CollectionAddSchema = Yup.object().shape({
    name: Yup.string()
        .required('This field is required')
        .max(40)
        .min(3),
});


const useMovieCollectionAddModal = ({...props}) => {
    const [show, setShow] = useState(false)

    const handleClose = () => setShow(false);

    const handleShow = async () => {
        setShow(true);
    }

    const handleAdd = async (values) => {
        await props.handleAddCollection(values.name)
        await props.fetchDefaultCollections()

        handleClose()
    }

    const formik = useFormik({
        initialValues: {
            'name': '',
        },
        onSubmit: values => {
            handleAdd(values)
        },
        validationSchema: CollectionAddSchema
    });

    return {
        show,
        handleClose,
        handleShow,
        formik,
    }
}

export default useMovieCollectionAddModal