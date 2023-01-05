import NavBar from "../NavBar/NavBar";
import useMovieCollection from "./useMovieCollections";
import MovieCollectionItem from "../MovieCollectionItem/MovieCollectionItem";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import {Fragment} from "react";
import "./movies.css"
import Pagination from '@mui/material/Pagination';
import Stack from '@mui/material/Stack';
import './Paginator/paginator.css'

const MovieCollections = () => {
    const moviesCollection = useMovieCollection()

    return (
        <div className="background">
            <NavBar/>
            <h2 className="header">MovieCollections</h2>
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

export default MovieCollections