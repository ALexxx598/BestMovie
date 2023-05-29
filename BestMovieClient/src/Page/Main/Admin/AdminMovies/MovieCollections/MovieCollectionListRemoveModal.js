import Modal from "react-bootstrap/Modal";
import DeleteIcon from '@mui/icons-material/Delete';
import ButtonClose from "../../../../../components/Button/ButtonClose";
import useMovieCollectionListRemoveModal from "./useMovieCollectionListRemoveModal";
import {red} from "@mui/material/colors";
import {IconButton} from "@mui/material";
import './movieCollectionList.css'

const MovieCollectionListRemoveModal = ({...props}) => {
    const {
        show,
        handleClose,
        handleShow,
        handleRemove
    } = useMovieCollectionListRemoveModal({...props})

    return  (
        <>
            <IconButton edge="end" aria-label="comments" onClick={handleShow}>
                <DeleteIcon sx={{color: red[500]}}/>
            </IconButton>

            <Modal
                show={show}
                onHide={handleClose}
                className="modalPosition"
            >
                <Modal.Header closeButton className="mainModalTheme">
                    <Modal.Title>Remove confirmation</Modal.Title>
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

export default MovieCollectionListRemoveModal