import Fab from "@mui/material/Fab";
import Modal from "react-bootstrap/Modal";
import AddIcon from '@mui/icons-material/Add';
import Button from "../../../../../components/Button/Button";
import './movieCategoriesList.css'
import useMovieCategoryAddModal from "./useMovieCategoryAddModal";

const MovieCategoryAddModal = ({...props}) => {
    const {
        show,
        handleClose,
        handleShow,
        formik,
    } = useMovieCategoryAddModal({...props})

    return (
        <>
            <div className="categoriesTab">
                <div className="addCategoryBlock">
                    <div>
                        Categories
                    </div>
                    <div className="categoriesTabButton">
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
                        <Modal.Title>Add category</Modal.Title>
                    </Modal.Header>
                    <Modal.Body className="mainModalTheme">
                        <div>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                onChange={formik.handleChange}
                                value={formik.values.name}
                                className="form-control"
                            />
                            <Button text={"Add"}/>
                        </div>
                    </Modal.Body>
                </form>
            </Modal>
        </>
    )
}
export default MovieCategoryAddModal