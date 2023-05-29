import {useEffect, useState} from "react";
import MovieFilter from "../Api/Movie/Filter/MovieFilter";
import MoviePaginator from "../Api/Movie/Filter/MoviePaginator";
import MovieApiService from "../Api/Movie/MovieApiService";

const useMovies = () => {
    const PAGE = 1
    const PER_PAGE = 10

    const [movies, setMovies] = useState([]);
    const [filter, setFilter] = useState(new MovieFilter(PAGE, PER_PAGE));
    const [paginator, setPaginator] = useState(new MoviePaginator(PAGE, PER_PAGE))

    const getDefaultFilter = () => {
        return new MovieFilter(PAGE, PER_PAGE)
    }

    const fetchMovies = async () => {
        const response = await MovieApiService.fetchMovies(filter)

        setMovies(response.items)

        setPaginator(
            new MoviePaginator(
                response.temp.current_page,
                response.temp.per_page,
                response.temp.last_page,
                response.temp.total,
            )
        )

        console.log(response.items)
    }

    const handleChangePage = (page) => {
        setFilter(new MovieFilter(page, filter.perPage, filter.categoryIds))
    }

    useEffect(() => {
        fetchMovies()
    },[ filter.page, filter.perPage, filter.categoryIds, filter.collectionIds ])

    return {
        movies,
        paginator,
        fetchMovies,
        handleChangePage,
        filter,
        setFilter,
        getDefaultFilter
    }
}

export default useMovies