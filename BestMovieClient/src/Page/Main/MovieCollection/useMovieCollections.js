import { useEffect } from "react";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";

import useCollections from "../../../hooks/useCollections";
import useMovies from "../../../hooks/useMovies";

const useMovieCollection = () => {
    const { movies, filter, setFilter, paginator, handleChangePage, getDefaultFilter } = useMovies()

    const { collections, collectionChecked, fetchDefaultCollections, handleToggle, getCollectionIds, collectionChanged } = useCollections();

    const updateFilter = () => {
        const defaultFilter = getDefaultFilter()

        const newFilter = new MovieFilter(
            defaultFilter.page,
            defaultFilter.perPage,
            filter.categoryIds,
            getCollectionIds()
        )

        console.log('update filter')
        setFilter(newFilter)
    }

    useEffect(() => {
        updateFilter()
    }, [collectionChanged])

    useEffect(() => {
        fetchDefaultCollections()
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
    }
}

export default useMovieCollection