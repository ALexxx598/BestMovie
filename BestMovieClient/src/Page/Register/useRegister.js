import * as Yup from "yup";
import UserApiService from "../../Api/User/UserApiService";
import {useAuth} from "../../hooks/useAuth";
import {useFormik} from "formik";

const signupSchema = Yup.object().shape({
    firstName: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('Required'),
    lastName: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('Required'),
    email: Yup.string()
        .email('Invalid email')
        .required('Required'),
    password: Yup.string()
        .required('Required'),
    passwordConfirmation: Yup.string()
        .required()
        .oneOf([Yup.ref("password"), null], "Passwords must match")
});

export const useRegister = () => {
    const {setAuth} = useAuth()

    const handleSignUp = async (values) => {
        // sign in + set auth
        const user = await UserApiService.register(values.firstName, values.lastName, values.email, values.password)
        setAuth(user)

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
        formik
    }
}