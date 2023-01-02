import '../../components/button.css'
import './login.css'
import {Button, Col, Container, Row} from "react-bootstrap";
import {useLogin} from "./useLogin";
import {useLocation} from "react-router-dom";

const Login = () => {
    const { formik } = useLogin()

    return (
        <Container>
            <Row>
                <Col xs={6} md={{ span: 4, offset: 4}} className="containerBack">
                    <Row className="logIn">
                        <Col md={{ offset: 1 }}>Log in</Col>
                        <Col md={{ offset: 1 }}><a href="register">Sign In</a></Col>
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
                            <Button type="submit" variant="success" className="button">Log in!</Button>
                        </Row>
                    </form>
                </Col>
            </Row>
        </Container>
    )
}

export default Login