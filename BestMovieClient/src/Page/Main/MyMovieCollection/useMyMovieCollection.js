
import { useEffect } from "react";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import useCollections from "../../../hooks/useCollections";
import useMovies from "../../../hooks/useMovies";

const useMyMovieCollection = () => {
    const { movies, filter, setFilter, paginator, handleChangePage, getDefaultFilter } = useMovies()

    const {
        collections,
        collectionChecked,
        fetchCustomCollections,
        handleToggle,
        getCollectionIds,
        collectionChanged
    } = useCollections();

    const updateFilter = () => {
        const defaultFilter = getDefaultFilter()

        const newFilter = new MovieFilter(
            defaultFilter.page,
            defaultFilter.perPage,
            filter.categoryIds,
            getCollectionIds()
        )

        setFilter(newFilter)
    }

    useEffect(() => {
        updateFilter()
    }, [collectionChanged])

    useEffect(() => {
        fetchCustomCollections()
    }, [])

    return {
        collections,
        handleToggle,
        collectionChecked,
        movies,
        filter,
        setFilter,
        paginator,
        handleChangePage,
        getDefaultFilter,
        fetchCustomCollections,
    }
}

export default useMyMovieCollection