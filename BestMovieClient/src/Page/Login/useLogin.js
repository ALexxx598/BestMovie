import {useAuth} from "../../hooks/useAuth";
import * as Yup from "yup";
import {useFormik} from "formik";

const LoginSchema = Yup.object().shape({
    email: Yup.string()
        .email('Invalid email')
        .required('Required'),
    password: Yup.string()
        .required('Required'),
});

export const useLogin = () => {
    const { setAuth } = useAuth();

    const handleLogin = async (values) => {
        // setAuth
        console.log(values)
    }

    const formik = useFormik({
        initialValues: {
            'email': '',
            'password': '',
        },
        onSubmit: values => {
            handleLogin(values)
        },
        validationSchema: LoginSchema
    })

    return {
        formik
    }
}