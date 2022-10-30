import {useRef, useState, useEffect, useContext} from "react";
import UserApiService from "../../Api/User/UserApiService";
import {useFormik} from 'formik'
import * as Yup from 'yup';
import 'bootstrap/dist/css/bootstrap.min.css';
import './register.css'
import '../../components/button.css'
import {Button, Col, Container, Row} from "react-bootstrap";
import AuthContext from "../../context/AuthProvider";

const Register = () => {
    const {setAuth} = useContext(AuthContext)

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

    const handleSignUp = async (values) => {
        // sign in + set auth
        const user = UserApiService.register(values.firstName, values.lastName, values.email, values.password)
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
        onSubmit: values => {
            handleSignUp(values);
        },
        validationSchema: signupSchema
    })

    return (
        <Container>
            <Row>
                <Col xs={12} md={8}>Logo</Col>
                <Col xs={6} md={4} className="formColumn">
                    <Row className="signIn">
                        <Col md={{ offset: 1 }}>Sign In</Col>
                        <Col md={{ offset: 1 }}><a href="#">Log in</a></Col>
                    </Row>
                    <form onSubmit={formik.handleSubmit} >
                        <Row>
                            <Col>
                                <label htmlFor="firstName" className="labelPadding">First Name</label>
                                <input
                                    id="firstName"
                                    name="firstName"
                                    type="text"
                                    onChange={formik.handleChange}
                                    value={formik.values.firstName}
                                    className="form-control"
                                />
                            </Col>
                            <Col>
                                <label htmlFor="lastName" className="labelPadding">Last Name</label>
                                <input
                                    id="lastName"
                                    name="lastName"
                                    type="text"
                                    onChange={formik.handleChange}
                                    value={formik.values.lastName}
                                    className="form-control"
                                />
                            </Col>
                        </Row>
                        <Row className="space3">
                            <label htmlFor="email" className="labelPadding">Email Address</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                onChange={formik.handleChange}
                                value={formik.values.email}
                                className="form-control"
                            />
                        </Row>
                        <Row className="space3">
                            <label htmlFor="password" className="labelPadding">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                onChange={formik.handleChange}
                                value={formik.values.password}
                                className="form-control"
                            />
                        </Row>
                        <Row className="space3">
                            <label htmlFor="passwordConfirmation" className="labelPadding">Password Confirmation</label>
                            <input
                                id="passwordConfirmation"
                                name="passwordConfirmation"
                                type="passwordConfirmation"
                                onChange={formik.handleChange}
                                value={formik.values.passwordConfirmation}
                                className="form-control"
                            />
                        </Row>
                        <Row className="space3">
                            <Button type="submit" className="button">Submit</Button>
                        </Row>
                    </form>
                </Col>
            </Row>
        </Container>
    );
}

export default Register