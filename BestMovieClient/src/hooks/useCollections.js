import {useState} from "react";
import CollectionApiService from "../Api/Collection/CollectionApiService";
import CollectionFilter from "../Api/Collection/Filter/CollectionFilter";
import {CUSTOM, DEFAULT} from "../Api/Collection/Filter/CollectionType";
import useCollectionCheckedList from "./useCollectionCheckedList";
import {useAuth} from "./useAuth";

const useCollections = () => {
    const { auth } = useAuth()

    const {
        setInitialChecked,
        collectionChecked,
        setCollectionChecked,
        handleToggle,
        collectionChanged
    } = useCollectionCheckedList()

    const [collections, setCollections] = useState([])

    const fetchDefaultCollections = async () => {
        const { items } = await CollectionApiService.fetchDefaultCollections()

        setCollections(items)

        const newChecked = [...collectionChecked]
        setCollectionChecked(newChecked)

        return items
    }

    const fetchCustomCollections = async () => {
        const { items } = await CollectionApiService.fetchCollections(new CollectionFilter(CUSTOM), auth)

        setCollections(items)

        const newChecked = [...collectionChecked]
        setCollectionChecked(newChecked)

        return items
    }

    const getCollectionIds = () => {
        let ids = []

        collectionChecked.forEach(category => {
            if ((category.id ?? null ) !== null) {
                ids.push(category.id)
            }
        })

        return ids
    }

    const removeCollection = async (collection) => {
        console.log('remove collection')
        await CollectionApiService.remove(auth, collection.id)
    }

    const createCollection = async (name) => {
        await CollectionApiService.createCollection(name, auth)
    }

    return {
        collections,
        setInitialChecked,
        fetchDefaultCollections,
        fetchCustomCollections,
        collectionChecked,
        collectionChanged,
        handleToggle,
        getCollectionIds,
        removeCollection,
        createCollection,
    }
}

export default useCollections