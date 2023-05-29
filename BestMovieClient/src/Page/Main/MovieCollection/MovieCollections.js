import NavBar from "../NavBar/NavBar";
import useMovieCollection from "./useMovieCollections";
import MovieList from "../MovieList/MovieList";
import "../MovieList/movies.css"
import '../Paginator/paginator.css'
import MovieCollectionList from "./MovieCollectionList";
import Paginator from "../Paginator/Paginator";
import Footer from "../Footer/Footer";

const MovieCollections = () => {
    const {
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
    } = useMovieCollection()

    return (
        <div className="background">
            <NavBar movieCollectionsHighlighted={true}/>
            <div className="main">
                <div className="listPadding">
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

export default MovieCollections