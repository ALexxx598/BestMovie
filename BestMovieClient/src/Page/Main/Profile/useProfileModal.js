import {useState} from "react";
import {useFormik} from "formik";
import * as Yup from "yup";


const MyMovieCollectionModalSchema = Yup.object().shape({
    name: Yup
        .string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('This field is required'),
    surname: Yup
        .string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('This field is required'),
    email: Yup
        .string()
        .email('Invalid email')
        .required('This field is required'),
});

const useProfileModal = () => {
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

    const handleSaveChanges = () => {
        console.log(1)
    }

    return {
        show,
        handleClose,
        handleShow,
        formik
    }
}

export default useProfileModal