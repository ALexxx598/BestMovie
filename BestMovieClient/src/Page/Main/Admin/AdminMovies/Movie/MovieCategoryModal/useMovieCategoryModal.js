import {useParams} from "react-router-dom";
import {useEffect, useState} from "react";

import useCollections from "../../../../../../hooks/useCollections";
import MovieApiService from "../../../../../../Api/Movie/MovieApiService";
import {useAuth} from "../../../../../../hooks/useAuth";
import useCategories from "../../../../../../hooks/useCategories";

const useMovieCategoryModal = () => {
    const { id } = useParams()
    const { auth } = useAuth()

    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const {
        categories,
        categoriesChecked,
        setInitialChecked,
        handleCategoriesToggle,
        getCategoryIds,
        fetchCategories,
    } = useCategories()

    const fetchMovieCategories = async () => {
        const items = await fetchCategories()

        setInitialChecked(items, id)
    }

    const handleSaveChanges = async () => {
        console.log('lol')

        try {
            console.log(getCategoryIds(categoriesChecked))
            await MovieApiService.saveCategories(getCategoryIds(categoriesChecked), id, auth)
        } catch (error) {
            // log
        } finally {
            await handleClose()
        }
    }

    useEffect(() => {
        fetchMovieCategories()
    }, [])

    return {
        categories,
        handleCategoriesToggle,
        categoriesChecked,
        handleSaveChanges,
        show,
        handleShow,
        handleClose,
    }
}

export default useMovieCategoryModal