import {Col, Row} from "react-bootstrap";
import Button from "../../../../../components/Button/Button";
import Modal from "react-bootstrap/Modal";
import MovieCollectionList from "../../../MovieCollection/MovieCollectionList";
import MovieAddModalDescription from "./MovieAddModalDescription";
import ButtonClose from "../../../../../components/Button/ButtonClose";
import useMovieAddModal from "./useMovieAddModal"
import './movieModal.css'

const MovieAddModal = ({...props}) => {
    const {
        collections,
        handleToggle,
        collectionChecked,
        show,
        handleShow,
        handleClose,
        formik,
        setImage,
        setVideo,
    } = useMovieAddModal()

    return (
        <>
            <Col md={2} style={{paddingLeft:"52px", paddingTop: "1%"}}>
                <Button
                    type="submit"
                    variant="success"
                    style={{
                        borderRadius: 10,
                        backgroundColor: "#29603b",
                        color: "white",
                        border: "#29603b",
                        fontSize: 20,
                        padding: 5
                    }}
                    onClick={handleShow}
                    text="add movie"
                />
            </Col>

            <Modal
                show={show}
                onHide={handleClose}
                className="modal-lg movieModal"
            >
                <form onSubmit={formik.handleSubmit} >
                    <Modal.Header closeButton className="mainMovieModalBackground">
                        <Modal.Title>Movie information</Modal.Title>
                    </Modal.Header>
                    <Modal.Body className="mainMovieModalBackground">
                        <div className="movieModalBody">
                            <div>
                                <MovieCollectionList
                                    collections={collections}
                                    handleToggle={handleToggle}
                                    collectionChecked={collectionChecked}
                                    height="100%"
                                />
                            </div>
                            <MovieAddModalDescription
                                movie={props.movie}
                                formik={formik}
                                setImage={setImage}
                                setVideo={setVideo}
                            />
                        </div>
                    </Modal.Body>
                    <Modal.Footer className="mainMovieModalBackground">
                        <Button onSubmit={formik.handleSubmit} text={"Save changes"}/>
                        <ButtonClose onClick={handleClose} text="Close"/>
                    </Modal.Footer>
                </form>
            </Modal>
        </>
    )
}

export default MovieAddModal