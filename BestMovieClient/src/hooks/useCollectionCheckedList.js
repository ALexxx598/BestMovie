import {useState} from "react";

const useCollectionCheckedList = () => {
    const [collectionChecked, setCollectionChecked] = useState([1]);

    const [collectionChanged, setCollectionChanged] = useState([1]);

    const setInitialChecked = (collections, id) => {
        const newChecked = [1]

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

        setCollectionChecked(newChecked)
    }

    const handleToggle = (collection) => () => {
        const currentIndex = collectionChecked.indexOf(collection)
        const newChecked = [...collectionChecked]

        if (currentIndex === -1) {
            newChecked.push(collection)
        } else {
            newChecked.splice(currentIndex, 1);
        }

        setCollectionChanged(newChecked)
        setCollectionChecked(newChecked)
    }

    return {
        setInitialChecked,
        collectionChecked,
        collectionChanged,
        setCollectionChecked,
        handleToggle,
    }
}

export default useCollectionCheckedList