import {useEffect, useState} from "react";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import MoviePaginator from "../../../Api/Movie/Filter/MoviePaginator";
import {useAuth} from "../../../hooks/useAuth";

const useMovies = () => {
    const PAGE = 1
    const PER_PAGE = 8

    const {auth} = useAuth()

    const [movies, setMovies] = useState([]);
    const [filter, setFilter] = useState(new MovieFilter(PAGE, PER_PAGE));
    const [paginator, setPaginator] = useState(new MoviePaginator(PAGE, PER_PAGE))

    const getDefaultFilter = () => {
        return new MovieFilter(PAGE, PER_PAGE)
    }

    const fetchMovies = async () => {
        const response = await MovieApiService.fetchMovies(filter)

        setMovies(response.items)

        setFilter(
            new MovieFilter(
                response.temp.current_page,
                response.temp.per_page,
                filter.categoryIds,
                filter.collectionIds,
            )
        )

        setPaginator(
            new MoviePaginator(
                response.temp.current_page,
                response.temp.per_page,
                response.temp.last_page,
                response.temp.total,
            )
        )
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
        handleChangePage,
        filter,
        setFilter,
        getDefaultFilter
    }
}

export default useMovies