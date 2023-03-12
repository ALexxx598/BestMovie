import {Col, Row} from "react-bootstrap";
import Button from "../../../../components/Button/Button";
import {useEffect, useState} from "react";
import Modal from 'react-bootstrap/Modal';
import MovieCollectionList from "../../MovieCollection/MovieCollectionList";
import useMovieCollectionModal from "./useMovieCollectionModal";

import './movieModal.css'
import ButtonClose from "../../../../components/Button/ButtonClose";
import MovieModalDescription from "./MovieModalDescription";

const MovieCollectionModal = ({...props}) => {
    const {
        collections,
        handleToggle,
        checked,
        handleSaveChanges,
        show,
        handleShow,
        handleClose,
    } = useMovieCollectionModal()

    return (
        <>
            {
                props.checkIsUserAuth()
                    ?   <Col>
                        <Row>
                            <Col md={{offset: 8}}>
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
                                    text="Add to collection"
                                />
                            </Col>
                        </Row>
                    </Col>
                    : null
            }

            <Modal
                show={show}
                onHide={handleClose}
                className="modal-lg movieModal"
            >
                <Modal.Header closeButton className="mainMovieModalBackground">
                    <Modal.Title>Choose collections</Modal.Title>
                </Modal.Header>
                <Modal.Body className="mainMovieModalBackground">
                    <div className="movieModalBody">
                        <div>
                            <MovieCollectionList
                                collections={collections}
                                handleToggle={handleToggle}
                                checked={checked}
                                height="100%"
                            />
                        </div>
                        <MovieModalDescription movie={props.movie}/>
                    </div>
                </Modal.Body>
                <Modal.Footer className="mainMovieModalBackground">
                    <Button onClick={handleSaveChanges} text="Save changes"/>
                    <ButtonClose onClick={handleClose} text="Close"/>
                </Modal.Footer>
            </Modal>
        </>
    );
}

export default MovieCollectionModal