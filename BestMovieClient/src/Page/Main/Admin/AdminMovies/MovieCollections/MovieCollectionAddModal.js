import Fab from "@mui/material/Fab";
import Modal from "react-bootstrap/Modal";
import Button from "../../../../../components/Button/Button";
import useMovieCollectionAddModal from "./useMovieCollectionAddModal";
import AddIcon from '@mui/icons-material/Add';
import './movieCollectionList.css'
import {Col, Row} from "react-bootstrap";

const MovieCollectionAddModal = ({...props}) => {
    const {
        show,
        handleClose,
        handleShow,
        formik,
    } = useMovieCollectionAddModal({...props})

    return (
        <>
            <div className="collectionsTab" >
                <div className="addCollectionBlock">
                    <div>
                        Колекції
                    </div>
                    <div className="collectionsTabButton">
                        <Fab aria-label="add">
                            <AddIcon text={"Add"} onClick={handleShow}/>
                        </Fab>
                    </div>
                </div>
            </div>


            <Modal
                show={show}
                onHide={handleClose}
                className="modalPosition"
            >
                <form onSubmit={formik.handleSubmit}>
                    <Modal.Header closeButton className="mainModalTheme">
                        <Modal.Title>Додати колекцію</Modal.Title>
                    </Modal.Header>
                    <Modal.Body className="mainModalTheme">
                        <div>
                            <Row className="categoryModalBody">
                                <Col xs={3}>Назва колекції:</Col>
                                <Col>
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        onChange={formik.handleChange}
                                        value={formik.values.name}
                                        className="form-control"
                                    />
                                </Col>
                            </Row>
                            <Button text={"Додати"}/>
                        </div>
                    </Modal.Body>
                </form>
            </Modal>
        </>
    )
}

export default MovieCollectionAddModal