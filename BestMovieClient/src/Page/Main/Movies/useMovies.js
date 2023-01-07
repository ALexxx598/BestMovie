import {useEffect, useState} from "react";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import MoviePaginator from "../../../Api/Movie/Filter/MoviePaginator";
import useCategories from "./useCategories";

const useMovies = () => {
    const PAGE = 1
    const PER_PAGE = 8

    const [movies, setMovies] = useState([]);
    const [filter, setFilter] = useState(new MovieFilter(PAGE, PER_PAGE));
    const [paginator, setPaginator] = useState(new MoviePaginator(PAGE, PER_PAGE))

    const categories = useCategories()

    const getCategoryIds = () => {
        return categories.checked
            .map((category) => category.id ?? null)
            .filter(id => id !== null);
    }

    const fetchMovies = async () => {
        const newFilter = new MovieFilter(
            filter.page,
            filter.perPage,
            getCategoryIds()
        )

        const response = await MovieApiService.fetchMovies(newFilter)

        setMovies(response.items)

        setFilter(
            new MovieFilter(
                response.temp.current_page,
                response.temp.per_page,
                getCategoryIds()
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
    },[ filter.page, filter.perPage, categories.checked ])

    return {
        movies,
        paginator,
        handleChangePage,
        categories,
    }
}

export default useMovies