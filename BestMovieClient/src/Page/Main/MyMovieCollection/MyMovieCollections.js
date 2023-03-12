import NavBar from "../NavBar/NavBar";
import MovieCollectionList from "../MovieCollection/MovieCollectionList";
import MovieList from "../MovieList/MovieList";
import Paginator from "../Paginator/Paginator";
import MyMovieCollectionModal from "./MyMovieCollectionModal/MyMovieCollectionModal";

import useMyMovieCollection from "./useMyMovieCollection";

const MyMovieCollections = () => {
    const moviesCollection = useMyMovieCollection()

    return (
        <div className="background">
            <NavBar myMovieCollectionsHighlighted={true}/>
            <div className="main">
                <div className="listPadding">
                    <MyMovieCollectionModal fetchCollections={moviesCollection.fetchCollections}/>
                    <MovieCollectionList
                        collections={moviesCollection.collections}
                        handleToggle={moviesCollection.handleToggle}
                        checked={moviesCollection.checked}
                    />
                </div>
                <div style={{paddingTop: 25, width: "100%"}}>
                    <MovieList movies={moviesCollection.movies} />
                    <Paginator
                        lastPage={moviesCollection.paginator.lastPage}
                        currentPage={moviesCollection.paginator.currentPage}
                        handleChangePage={moviesCollection.handleChangePage}
                    />
                </div>
            </div>
            <div color="white">footer</div>v>
        </div>
    )
}

export default MyMovieCollections