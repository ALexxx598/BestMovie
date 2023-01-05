import {useEffect, useState} from "react";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import MoviePaginator from "../../../Api/Movie/Filter/MoviePaginator";

const useMovies = () => {
    const PAGE = 1
    const PER_PAGE = 10

    const [movies, setMovies] = useState([]);
    const [filter, setFilter] = useState(new MovieFilter(PAGE, PER_PAGE));
    const [paginator, setPaginator] = useState(new MoviePaginator(PAGE, PER_PAGE))

    const fetchMovies = async () => {
        const response = await MovieApiService.fetchMovies(filter)

        setMovies(response.items)

        setFilter(
            new MovieFilter(
                response.temp.current_page,
                response.temp.per_page,
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
        setFilter(new MovieFilter(page, filter.perPage))
    }

    useEffect(() => {
        fetchMovies()
    },[ filter.page, filter.perPage ])

    return {
        movies,
        paginator,
        handleChangePage
    }
}

export default useMovies