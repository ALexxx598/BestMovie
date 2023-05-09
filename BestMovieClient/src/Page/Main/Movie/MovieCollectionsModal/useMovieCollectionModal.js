import {useParams} from "react-router-dom";
import {useEffect, useState} from "react";

import {useAuth} from "../../../../hooks/useAuth";

import MovieApiService from "../../../../Api/Movie/MovieApiService";
import useCollections from "../../../../hooks/useCollections";

const useMovieCollectionModal = () => {
    const { id } = useParams()
    const { auth } = useAuth()

    const [show, setShow] = useState(false);

    const handleClose = async () => {
        setShow(false);
    }
    const handleShow = () => setShow(true);

    const {
        collections,
        setInitialChecked,
        fetchCustomCollections,
        collectionChecked,
        handleToggle,
        getCollectionIds,
    } = useCollections()

    const fetchCollections = async () => {
        const items = await fetchCustomCollections()

        setInitialChecked(items, id)
    }

    const handleSaveChanges = async () => {
        try {
            await MovieApiService.saveCollections(getCollectionIds(), id, auth)
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