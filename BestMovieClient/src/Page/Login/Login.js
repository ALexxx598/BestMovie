import {useFormik} from "formik";
import * as Yup from "yup";
import '../../components/button.css'
import './login.css'
import {Button, Col, Container, Row} from "react-bootstrap";
import {useContext} from "react";
import AuthContext from "../../context/AuthProvider";

const Login = () => {
    const { setAuth } = useContext(AuthContext);

    const LoginSchema = Yup.object().shape({
        email: Yup.string()
            .email('Invalid email')
            .required('Required'),
        password: Yup.string()
            .required('Required'),
    });

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

    return (
        <Container>
            <Row>
                <Col xs={6} md={{ span: 4, offset: 4}} className="containerBack">
                    <Row className="signIn">
                        <Col md={{ offset: 1 }}>Log in</Col>
                        <Col md={{ offset: 1 }}><a href="#">Sign In</a></Col>
                    </Row>
                    <form onSubmit={formik.handleSubmit} >
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
                            <Button type="submit" className="button">Log in!</Button>
                        </Row>
                    </form>
                </Col>
            </Row>
        </Container>
    )
}

export default Login