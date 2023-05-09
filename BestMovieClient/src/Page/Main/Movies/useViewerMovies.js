import useMovies from "../../../hooks/useMovies";
import useCategories from "../../../hooks/useCategories";
import useCollections from "../../../hooks/useCollections";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import {useEffect} from "react";

const useViewerMovies = () => {
    const {
        movies,
        paginator,
        handleChangePage,
        setFilter,
        getDefaultFilter
    } = useMovies()

    const {
        categories,
        categoriesChanged,
        categoriesChecked,
        handleCategoriesToggle,
        getCategoryIds,
        fetchCategories,
    } = useCategories()

    const {
        collections,
        fetchDefaultCollections,
        collectionChecked,
        collectionChanged,
        handleToggle,
        getCollectionIds,
    } = useCollections()


    const updateFilter = () => {
        const defaultFilter = getDefaultFilter()

        const newFilter = new MovieFilter(
            defaultFilter.page,
            defaultFilter.perPage,
            getCategoryIds(categoriesChecked),
            getCollectionIds(collectionChecked),
        )

        setFilter(newFilter)
    }

    useEffect(() => {
        updateFilter()
    }, [categoriesChanged, collectionChanged])

    useEffect(() => {
        fetchDefaultCollections()
        fetchCategories()
    }, [])

    return {
        categories,
        handleCategoriesToggle,
        categoriesChecked,
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
    }
}

export default useViewerMovies