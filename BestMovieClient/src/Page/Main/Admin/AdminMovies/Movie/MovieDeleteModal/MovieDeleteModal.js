import useMovieDeleteModal from "./useMovieDeleteModal";
import Modal from "react-bootstrap/Modal";
import ButtonClose from "../../../../../../components/Button/ButtonClose";
import './movieRemoveModal.css'
import {Button as ReactButton} from "react-bootstrap";

const MovieDeleteModal = ({...props}) => {
    const {
        show,
        handleClose,
        handleShow,
        handleRemove,
    } = useMovieDeleteModal({...props})

    return (
        <>

            <ReactButton
                type="submit"
                variant="danger"
                className="button"
                onClick={handleShow}
                style={{
                    borderRadius: 5,
                    fontSize: 20,
                    padding: 5,
                    width: 110,
                    height: 70,
                }}
            >
                Видалити
            </ReactButton>

            <Modal
                show={show}
                onHide={handleClose}
                className="modalPosition"
            >
                <Modal.Header closeButton className="mainModalTheme">
                    <Modal.Title>Підтвердження видалення</Modal.Title>
                </Modal.Header>
                <Modal.Body className="mainModalTheme">
                    <div className="modalRemoveButton">
                        <ButtonClose text={"Видалити"} onClick={handleRemove}/>
                    </div>
                </Modal.Body>
            </Modal>
        </>
    )
}

export default MovieDeleteModal