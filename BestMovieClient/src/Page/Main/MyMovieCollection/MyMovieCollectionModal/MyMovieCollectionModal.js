import Button from "../../../../components/Button/Button";
import Modal from "react-bootstrap/Modal";
import ButtonClose from "../../../../components/Button/ButtonClose";
import useMyMovieCollectionModal from "./useMyMovieCollectionModal";

import './myMovieModal.css'
import {Col, Row} from "react-bootstrap";

const MyMovieCollectionModal = ({...props}) => {
    const {
        formik,
        show,
        handleShow,
        handleClose,
    } = useMyMovieCollectionModal(props)

    return (
        <>
            <Button text="Додати колекцію" onClick={handleShow}/>

            <Modal
                show={show}
                onHide={handleClose}
                className="myMovieCollectionModal"
            >
                <form onSubmit={formik.handleSubmit} >
                    <Modal.Header closeButton className="mainMyMovieCollectionModalBackground">
                        <Modal.Title>Додати колекцію</Modal.Title>
                    </Modal.Header>
                    <Modal.Body className="mainMyMovieCollectionModalBackground">
                        <div className="myMovieCollectionModalBody">
                            <Row>
                                <Col className="myMovieCollectionName">Назва колекції:</Col>
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
                        </div>
                    </Modal.Body>
                    <Modal.Footer className="mainMyMovieCollectionModalBackground">
                        <Button onClick={handleClose} text="Зберегти зміни"/>
                        <ButtonClose onClick={handleClose} text="Скасувати"/>
                    </Modal.Footer>
                </form>
            </Modal>
        </>
    )
}

export default MyMovieCollectionModal