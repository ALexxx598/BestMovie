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
    const { setAuth, putAuthToLocalStorage } = useAuth();
    const navigate = useNavigate()

    const handleLogin = async (values) => {
        const user = await UserApiService.login(values.email, values.password)

        setAuth(user)
        putAuthToLocalStorage(user)

        navigate.navigate('/movies/', false)
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