import NavBar from "../NavBar/NavBar";
import useMovieCollection from "./useMovieCollections";
import MovieList from "../MovieList/MovieList";
import "../MovieList/movies.css"
import '../Paginator/paginator.css'
import MovieCollectionList from "./MovieCollectionList";
import Paginator from "../Paginator/Paginator";

const MovieCollections = () => {
    const moviesCollection = useMovieCollection()

    return (
        <div className="background">
            <NavBar/>
            <h2 className="header">MovieCollections</h2>
            <div className="main">
                <div className="listPadding">
                    <MovieCollectionList
                        collections={moviesCollection.collections}
                        handleToggle={moviesCollection.handleToggle}
                        checked={moviesCollection.checked}
                    />
                </div>
                <div>
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

export default MovieCollections