import * as Yup from "yup";
import UserApiService from "../../Api/User/UserApiService";
import {useAuth} from "../../hooks/useAuth";
import {useFormik} from "formik";
import useNavigate from "../../hooks/useNavigate";

const signupSchema = Yup.object().shape({
    firstName: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('This field is required'),
    lastName: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('This field is required'),
    email: Yup.string()
        .email('Invalid email')
        .required('This field is required'),
    password: Yup.string()
        .required('This field is required'),
    passwordConfirmation: Yup.string()
        .required()
        .oneOf([Yup.ref("password"), null], "Passwords must match")
});

export const useRegister = () => {
    const {setAuth} = useAuth()
    const {navigate, from} = useNavigate();

    const handleSignUp = async (values) => {
        const user = await UserApiService.register(values.firstName, values.lastName, values.email, values.password)
        setAuth(user)

        navigate(from, {replace: true})

        console.log(JSON.stringify(values))
    }

    const formik = useFormik({
        initialValues: {
            'firstName': '',
            'lastName': '',
            'email': '',
            'password': '',
            'passwordConfirmation': '',
        },
        onSubmit: handleSignUp,
        validationSchema: signupSchema
    })

    return {
        formik,
    }
}