import {useParams} from "react-router-dom";
import {useEffect, useState} from "react";

import {useAuth} from "../../../../hooks/useAuth";

import CollectionApiService from "../../../../Api/Collection/CollectionApiService";
import CollectionFilter from "../../../../Api/Collection/Filter/CollectionFilter";

import { CUSTOM } from "../../../../Api/Collection/Filter/CollectionType";
import MovieApiService from "../../../../Api/Movie/MovieApiService";

const useMovieCollectionModal = () => {
    const { auth } = useAuth()

    const { id } = useParams()

    const [show, setShow] = useState(false);

    const handleClose = async () => {
        setShow(false);
        await fetchCollections()
    }
    const handleShow = () => setShow(true);

    const [collections, setCollections] = useState([])

    const [filter, setFilter] = useState(new CollectionFilter(CUSTOM))
    const [checked, setChecked] = useState([1]);

    const fetchCollections = async () => {
        let { items } = await CollectionApiService.fetchCollections(filter, auth)

        setCollections(items)

        setInitialChecked(items)
    }

    const setInitialChecked = (collections) => {
        const newChecked = [...checked]

        collections.forEach(
            (collection) => {
                collection.movieIds.filter(
                    (collectionMovieId) => {
                        if (parseInt(collectionMovieId) === parseInt(id)) {
                            newChecked.push(collection)
                        }
                    }
                )
            }
        )

        setChecked(newChecked)
    }

    const handleToggle = (collection) => () => {
        const currentIndex = checked.indexOf(collection)
        const newChecked = [...checked]

        if (currentIndex === -1) {
            newChecked.push(collection)
        } else {
            newChecked.splice(currentIndex, 1);
        }

        setChecked(newChecked)
    }

    const getCollectionIds = () => {
        return checked
            .map((category) => category.id ?? null)
            .filter(id => id !== null);
    }

    const handleSaveChanges = async () => {
        try {
            await MovieApiService.saveCollections(getCollectionIds(), id, auth)
        } catch (error) {
            // log
        } finally {
            handleClose()
        }
    }

    useEffect(() => {
        fetchCollections()
    }, [])

    return {
        collections,
        handleToggle,
        checked,
        handleSaveChanges,
        show,
        handleShow,
        handleClose,
    }
}

export default useMovieCollectionModal