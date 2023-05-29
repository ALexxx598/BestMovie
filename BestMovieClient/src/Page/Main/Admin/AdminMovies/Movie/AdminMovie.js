import {Col, Container, Row} from "react-bootstrap";

import useMovie from "./useMovie";
import MoviePlayer from "./Player/MoviePlayer";
import MovieDescription from "./MovieDescription/MovieDescription";
import MovieCollectionModal from "./MovieCollectionsModal/MovieCollectionModal";

import "./movie.css"
import AdminNavBar from "../../AdminNavBar/AdminNavBar";
import MovieDeleteModal from "./MovieDeleteModal/MovieDeleteModal";
import MovieCategoryModal from "./MovieCategoryModal/MovieCategoryModal";

const AdminMovie = () => {
    const { movie, isLoading, checkIsUserAuth, getCategoriesAsText, removeMovie} = useMovie()

    return (
        <div className="movieBackground">
            <AdminNavBar/>
            <Container className="movieContainer">
                <Row>
                    <Col className="movieHeader">
                        <h3>{movie?.name}</h3>
                    </Col>
                    <Col>
                        <Row>
                            <Col md={{offset: 4}}>
                                <MovieCollectionModal
                                    checkIsUserAuth={checkIsUserAuth}
                                    movie={movie}
                                />
                            </Col>
                            <Col>
                                <MovieCategoryModal
                                    checkIsUserAuth={checkIsUserAuth}
                                    movie={movie}
                                />
                            </Col>
                            <Col>
                                <MovieDeleteModal
                                    handleRemove={removeMovie}
                                    movie={movie}
                                />
                            </Col>
                        </Row>
                    </Col>
                </Row>
                <MovieDescription
                    movie={movie}
                    getCategoriesAsText={getCategoriesAsText}
                />
                <MoviePlayer videoUrl={movie?.storageMovieUrl} isLoading={isLoading}/>
            </Container>
        </div>
    )
}

export default AdminMovie