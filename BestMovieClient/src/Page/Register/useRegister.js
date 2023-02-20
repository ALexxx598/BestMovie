import * as Yup from "yup";
import UserApiService from "../../Api/User/UserApiService";
import {useAuth} from "../../hooks/useAuth";
import {useFormik} from "formik";
import useNavigate from "../../hooks/useNavigate";
import data from "bootstrap/js/src/dom/data";
import {useState} from "react";
import {DOMAIN, MOVIES} from "../../Routes";

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
        .oneOf([Yup.ref("password"), null], "Passwords must match"),
    registerCode: Yup.string()
});

export const useRegister = () => {
    const {setAuth} = useAuth()
    const navigate = useNavigate()
    const [preRegister, setPreRegister] = useState(false);

    const handleSignUp = async (values, {validateForm}) => {
        const errors = await validateForm(values)

        if (Object.keys(errors).length) {
            console.log("error")
            return
        }

        if (preRegister === false) {
            setPreRegister(true)
            await UserApiService.preRegister(values.firstName, values.lastName, values.email, values.password)

            return
        }

        const user = await UserApiService.register(
            values.firstName,
            values.lastName,
            values.email,
            values.password,
            values.registerCode
        )
        setAuth(user)

        navigate.navigate('/movies/', false)
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
        preRegister
    }
}