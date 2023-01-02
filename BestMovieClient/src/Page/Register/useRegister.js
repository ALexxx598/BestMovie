import * as Yup from "yup";
import UserApiService from "../../Api/User/UserApiService";
import {useAuth} from "../../hooks/useAuth";
import {useFormik} from "formik";
import useNavigate from "../../hooks/useNavigate";
import data from "bootstrap/js/src/dom/data";

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

    const handleSignUp = async (values, {validateForm}) => {
        const errors = await validateForm(values)
        if (Object.keys(errors).length) {
            return
        }

        const user = await UserApiService.register(values.firstName, values.lastName, values.email, values.password)
        console.log(1)
        setAuth(user)

        navigate(from, {replace: true})

        // console.log(JSON.stringify(values))
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

    const fff = formik.getFieldMeta

    return {
        formik,
    }
}