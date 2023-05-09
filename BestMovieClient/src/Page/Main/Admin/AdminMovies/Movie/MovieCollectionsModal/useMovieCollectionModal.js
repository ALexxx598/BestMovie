import {useParams} from "react-router-dom";
import {useEffect, useState} from "react";

import useCollections from "../../../../../../hooks/useCollections";
import MovieApiService from "../../../../../../Api/Movie/MovieApiService";
import {useAuth} from "../../../../../../hooks/useAuth";

const useMovieCollectionModal = () => {
    const { id } = useParams()
    const { auth } = useAuth()

    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const {
        collections,
        setInitialChecked,
        fetchDefaultCollections,
        collectionChecked,
        handleToggle,
        getCollectionIds,
    } = useCollections()

    const fetchCollections = async () => {
        const items = await fetchDefaultCollections()

        setInitialChecked(items, id)
    }

    const handleSaveChanges = async () => {
        try {
            console.log(getCollectionIds())
            await MovieApiService.saveDefaultCollections(getCollectionIds(), id, auth)
        } catch (error) {
            // log
        } finally {
            await handleClose()
        }
    }

    useEffect(() => {
        fetchCollections()
    }, [])

    return {
        collections,
        handleToggle,
        collectionChecked,
        handleSaveChanges,
        show,
        handleShow,
        handleClose,
    }
}

export default useMovieCollectionModal