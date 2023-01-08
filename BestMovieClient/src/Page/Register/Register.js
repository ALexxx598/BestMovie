import 'bootstrap/dist/css/bootstrap.min.css';
import './register.css'
import '../../components/button.css'
import {Col, Container, Row} from "react-bootstrap";
import {useRegister} from "./useRegister";
import Button from "../../components/Button/Button";

const Register = () => {
    const { formik } = useRegister()

    return (
        <Container>
            <Row>
                <Col xs={12} md={8}><img src={require("../../assets/images/logo.png")}/></Col>
                <Col xs={6} md={4} className="formColumn">
                    <Row className="signIn">
                        <Col md={{ offset: 1 }}>Sign In</Col>
                        <Col md={{ offset: 1 }}><a href="login">Log in</a></Col>
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
                                    className={ !formik.errors.firstName
                                        ? "form-control"
                                        : "form-control inputBottomBorder"
                                    }
                                />
                                {
                                    formik.errors.firstName
                                        ? <span className="formikError">{formik.errors.firstName}</span>
                                        : null
                                }
                            </Col>
                            <Col>
                                <label htmlFor="lastName" className="labelPadding">Last Name</label>
                                <input
                                    id="lastName"
                                    name="lastName"
                                    type="text"
                                    onChange={formik.handleChange}
                                    value={formik.values.lastName}
                                    className={ !formik.errors.lastName
                                        ? "form-control"
                                        : "form-control inputBottomBorder"
                                    }
                                />
                                {
                                    formik.errors.lastName
                                        ? <span className="formikError">{formik.errors.lastName}</span>
                                        : null
                                }
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
                                className={ !formik.errors.email
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                formik.errors.email
                                    ? <span className="formikError">{formik.errors.email}</span>
                                    : null
                            }
                        </Row>
                        <Row className="space3">
                            <label htmlFor="password" className="labelPadding">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                onChange={formik.handleChange}
                                value={formik.values.password}
                                className={ !formik.errors.password ? "form-control" : "form-control inputBottomBorder"}
                            />
                            {
                                formik.errors.password
                                    ? <span className="formikError">{formik.errors.password}</span>
                                    : null
                            }
                        </Row>
                        <Row className="space3">
                            <label htmlFor="passwordConfirmation" className="labelPadding">Password Confirmation</label>
                            <input
                                id="passwordConfirmation"
                                name="passwordConfirmation"
                                type="passwordConfirmation"
                                onChange={formik.handleChange}
                                value={formik.values.passwordConfirmation}
                                className={ !formik.errors.passwordConfirmation
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                formik.errors.passwordConfirmation
                                    ? <span className="formikError">{formik.errors.passwordConfirmation}</span>
                                    : null
                            }
                        </Row>
                        <Button type="submit" variant="success" className="button">Submit</Button>
                    </form>
                </Col>
            </Row>
        </Container>
    );
}

export default Register