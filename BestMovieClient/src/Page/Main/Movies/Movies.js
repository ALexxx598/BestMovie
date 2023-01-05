import NavBar from "../NavBar/NavBar";
import Stack from "@mui/material/Stack";
import Pagination from "@mui/material/Pagination";
import useMovies from "./useMovies";
import "./movies.css";
import MovieCollectionItem from "../MovieCollectionItem/MovieCollectionItem";

const Movies = () => {
    const moviesCollection = useMovies()

    return (
        <div className="background">
            <NavBar/>
            <h2 className="header">All Movies</h2>
            <div className='movies-container'>
                {
                    moviesCollection.movies.map((movie) => {
                        return (
                            <MovieCollectionItem id={movie.id} movie={movie}/>
                        )
                    })
                }
            </div>
            <Stack className="paginatorBackground">
                <Pagination
                    count={moviesCollection.paginator.lastPage}
                    // page={moviesCollection.paginator.currentPage}
                    onChange={ (_, num) => moviesCollection.handleChangePage(num)}
                    color="primary"
                    className="paginatorBackground paginator"
                />
            </Stack>
            <div color="white">footer</div>v>
        </div>
    )
}

export default Movies