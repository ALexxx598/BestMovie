import {useAuth} from "../../hooks/useAuth";
import * as Yup from "yup";
import {useFormik} from "formik";
import UserApiService from "../../Api/User/UserApiService";
import useNavigate from "../../hooks/useNavigate";

const LoginSchema = Yup.object().shape({
    email: Yup.string()
        .email('Invalid email')
        .required('This field is required'),
    password: Yup.string()
        .required('This field is required'),
});

export const useLogin = () => {
    const { setAuth } = useAuth();
    const navigate = useNavigate()

    const handleLogin = async (values) => {
        const user = await UserApiService.login(values.email, values.password)
        console.log(user)
        setAuth(user)

        // work after server auth
        navigate.navigate(navigate.from, {replace: true})

        // console.log(values)
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