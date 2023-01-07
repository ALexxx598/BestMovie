import {useState} from "react";
import NavBar from "../NavBar/NavBar";
import Stack from "@mui/material/Stack";
import Pagination from "@mui/material/Pagination";
import useMovies from "./useMovies";
import MovieCollectionItem from "../MovieCollectionItem/MovieCollectionItem";
import useCategories from "./useCategories";
import CategoryList from "../Categories/CategoryList";
import "./movies.css";


import List from "@mui/material/List";
import ListItemButton from '@mui/material/ListItemButton';
import ListItemText from '@mui/material/ListItemText';
import Checkbox from '@mui/material/Checkbox';
import {ListItem} from "@mui/material";

const Movies = () => {
    const moviesCollection = useMovies()

    return (
        <div className="background">
            <NavBar/>
            <h2 className="header">All Movies</h2>
            <div className="main">
                <div className="listPadding">
                    <CategoryList
                        categories={moviesCollection.categories.categories}
                        handleToggle={moviesCollection.categories.handleToggle}
                        checked={moviesCollection.categories.checked}
                    />
                </div>
                <div>
                    <div className='movies-container'>
                        {
                            moviesCollection.movies.map((movie) => {
                                return (
                                    <MovieCollectionItem id={movie.id} movie={movie}/>
                                )
                            })
                        }
                    </div>
                    <Pagination
                        count={moviesCollection.paginator.lastPage}
                        // page={moviesCollection.paginator.currentPage}
                        onChange={ (_, num) => moviesCollection.handleChangePage(num)}
                        color="primary"
                        className="paginatorBackground paginator"
                    />
                </div>
            </div>
            <div>footer</div>
        </div>
    )
}

export default Movies