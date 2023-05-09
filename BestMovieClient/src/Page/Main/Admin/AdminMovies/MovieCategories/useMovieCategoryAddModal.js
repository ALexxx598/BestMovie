import {useState} from "react";
import {useFormik} from "formik";
import * as Yup from "yup";

const CategoryAddSchema = Yup.object().shape({
    name: Yup.string()
        .required('This field is required')
        .max(60)
        .min(3),
});

const useMovieCategoryAddModal = ({...props}) => {
    const [show, setShow] = useState(false)

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleAdd = async (values) => {
        console.log(props)

        await props.handleAddCategory(values.name)
        await props.fetchCategories()

        handleClose()
    }

    const formik = useFormik({
        initialValues: {
            'name': '',
        },
        onSubmit: values => {
            handleAdd(values)
        },
        validationSchema: CategoryAddSchema
    });

    return {
        show,
        handleClose,
        handleShow,
        handleAdd,
        formik,
    }
}

export default useMovieCategoryAddModal