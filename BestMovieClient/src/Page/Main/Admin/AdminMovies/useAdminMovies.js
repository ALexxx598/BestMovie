
import useCategories from "../../../../hooks/useCategories";
import useCollections from "../../../../hooks/useCollections";
import MovieFilter from "../../../../Api/Movie/Filter/MovieFilter";
import {useEffect} from "react";
import useMovies from "../../../../hooks/useMovies";

const useAdminMovies = () => {
    const {
        movies,
        paginator,
        handleChangePage,
        setFilter,
        getDefaultFilter,
        fetchMovies,
    } = useMovies()

    const {
        categories,
        categoriesChanged,
        categoriesChecked,
        handleCategoriesToggle,
        getCategoryIds,
        fetchCategories,
        handleRemoveCategory,
        handleAddCategory,
    } = useCategories()

    const {
        collections,
        fetchDefaultCollections,
        collectionChecked,
        collectionChanged,
        handleToggle,
        getCollectionIds,
        removeCollection,
        createCollection,
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

    const handleRemoveCollection = async (collection) => {
        await removeCollection(collection)
        await fetchDefaultCollections()
    }

    const handleAddCollection = async (name) => {
        await createCollection(name)
        await fetchDefaultCollections()
    }

    useEffect(() => {
        updateFilter()
    }, [categoriesChanged, collectionChanged])

    useEffect(() => {
        fetchDefaultCollections()
    }, [])

    useEffect(() => {
        fetchCategories()
    }, [])

    return {
        categories,
        categoriesChecked,
        handleCategoriesToggle,
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
        handleRemoveCollection,
        fetchDefaultCollections,
        fetchCategories,
        handleRemoveCategory,
        handleAddCategory,
        handleAddCollection,
        fetchMovies,
    }
}

export default useAdminMovies