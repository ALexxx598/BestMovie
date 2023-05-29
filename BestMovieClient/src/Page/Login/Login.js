import '../../components/button.css'
import './login.css'
import {Button, Col, Container, Row} from "react-bootstrap";
import {useLogin} from "./useLogin";
import {DOMAIN, REGISTER} from "../../Routes";
import NavBar from "../Main/NavBar/NavBar";

const Login = () => {
    const { formik } = useLogin()

    return (
        <div className="loginBackground">
            <NavBar/>
            <Container>
                <Row>
                    <Col xs={6} md={{ span: 4, offset: 4}} className="containerBack">
                        <Row className="logIn">
                            <Col>Увійти</Col>
                            <Col><a href={DOMAIN + REGISTER}>Зареєстурватися</a></Col>
                        </Row>
                        <form onSubmit={formik.handleSubmit} >
                            <Row className="space3">
                                <label htmlFor="email" className="labelPadding">Адрес електронної пошти</label>
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
                                <label htmlFor="password" className="labelPadding">Пароль</label>
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
                                <Button type="submit" variant="success" className="button">Увійти!</Button>
                            </Row>
                        </form>
                    </Col>
                </Row>
            </Container>
        </div>

    )
}

export default Login