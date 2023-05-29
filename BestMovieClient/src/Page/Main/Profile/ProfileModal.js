import Button from "../../../components/Button/Button";
import useProfileModal from "./useProfileModal";
import Modal from "react-bootstrap/Modal";
import {Col, Row} from "react-bootstrap";
import ButtonClose from "../../../components/Button/ButtonClose";

import './profile.css'

const ProfileModal = () => {
    const {
        show,
        handleClose,
        handleShow,
        formik,
    } = useProfileModal()

    return (
        <div className="profileImage">
            <img src="https://i.stack.imgur.com/34AD2.jpg" onClick={handleShow} />
            <Modal
                show={show}
                onHide={handleClose}
                className="profileModal"
            >
                <form onSubmit={formik.handleSubmit} >
                    <Modal.Header closeButton className="profileBackground">
                        <Modal.Title>Profile</Modal.Title>
                    </Modal.Header>
                    <Modal.Body className="profileBackground">
                        <div className="profileBody">
                            <Row className="dataRow" style={{marginTop: "0%"}}>
                                <Col className="dataCol">
                                    Name:
                                </Col>
                                <Col>
                                    <input
                                        id="name"
                                        name="name"
                                        type="name"
                                        onChange={formik.handleChange}
                                        value={formik.values.name}
                                        className="form-control"
                                    />
                                </Col>
                            </Row>
                            <Row className="dataRow">
                                <Col className="dataCol">
                                    Surname:
                                </Col>
                                <Col>
                                    <input
                                        id="surname"
                                        name="surname"
                                        type="surname"
                                        onChange={formik.handleChange}
                                        value={formik.values.surname}
                                        className="form-control"
                                    />
                                </Col>
                            </Row>
                            <Row className="dataRow">
                                <Col className="dataCol">
                                    Email:
                                </Col>
                                <Col>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        onChange={formik.handleChange}
                                        value={formik.values.email}
                                        className="form-control"
                                    />
                                </Col>
                            </Row>
                        </div>
                    </Modal.Body>
                    <Modal.Footer className="profileBackground">
                        <Button onClick={handleClose} text="Save changes"/>
                        <ButtonClose onClick={handleClose} text="Close"/>
                    </Modal.Footer>
                </form>
            </Modal>
        </div>
    )
}

export default ProfileModal