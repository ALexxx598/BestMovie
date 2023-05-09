import {Col, Container, Row} from "react-bootstrap";

import NavBar from "../NavBar/NavBar";
import useMovie from "./useMovie";
import MoviePlayer from "./Player/MoviePlayer";
import MovieDescription from "./MovieDescription/MovieDescription";
import MovieCollectionModal from "./MovieCollectionsModal/MovieCollectionModal";

import "./movie.css"

const Movie = () => {
    const { movie, isLoading, checkIsUserAuth, getCategoriesAsText} = useMovie()

    return (
        <div className="movieBackground">
            <NavBar/>
            <Container className="movieContainer">
                <Row>
                    <Col className="movieHeader">
                        <h3>{movie?.name}</h3>
                    </Col>
                    <MovieCollectionModal
                        checkIsUserAuth={checkIsUserAuth}
                        movie={movie}
                    />
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

export default Movie