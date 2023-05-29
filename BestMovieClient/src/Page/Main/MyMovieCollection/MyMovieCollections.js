import NavBar from "../NavBar/NavBar";
import MovieCollectionList from "../MovieCollection/MovieCollectionList";
import MovieList from "../MovieList/MovieList";
import {Col, Row} from "react-bootstrap";
import Paginator from "../Paginator/Paginator";
import MyMovieCollectionModal from "./MyMovieCollectionModal/MyMovieCollectionModal";

import useMyMovieCollection from "./useMyMovieCollection";
import {ABOUT_US, DOMAIN, MOVIES, MY_MOVIE_COLLECTION} from "../../../Routes";
import Footer from "../Footer/Footer";

const MyMovieCollections = () => {
    const {
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
        fetchCustomCollections,
    } = useMyMovieCollection()

    return (
        <div className="background">
            <NavBar myMovieCollectionsHighlighted={true}/>
            <div className="main">
                <div className="listPadding">
                    <MyMovieCollectionModal fetchCustomCollections={fetchCustomCollections}/>
                    <MovieCollectionList
                        collections={collections}
                        handleToggle={handleToggle}
                        collectionChecked={collectionChecked}
                    />
                </div>
                <div style={{paddingTop: 25, width: "100%"}}>
                    <MovieList movies={movies} />
                    <Paginator
                        lastPage={paginator.lastPage}
                        currentPage={paginator.currentPage}
                        handleChangePage={handleChangePage}
                    />
                </div>
            </div>
            <Footer/>
        </div>
    )
}

export default MyMovieCollections