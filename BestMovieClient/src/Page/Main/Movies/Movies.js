import NavBar from "../NavBar/NavBar";
import Pagination from "@mui/material/Pagination";
import MovieListItem from "../MovieList/MovieListItem";
import useCategories from "./useCategories";
import CategoryList from "../Categories/CategoryList";
import "./movies.css";
import MovieList from "../MovieList/MovieList";
import Paginator from "../Paginator/Paginator";

const Movies = () => {
    const moviesCollection = useCategories()

    return (
        <div className="background">
            <NavBar allMoviesHighlighted={true}/>
            {/*<h2 className="header">All Movies</h2>*/}
            <div className="main">
                <div className="listPadding">
                    <CategoryList
                        categories={moviesCollection.categories}
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
            <div>footer</div>
        </div>
    )
}

export default Movies