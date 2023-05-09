import {useState} from "react";

const useCategoriesCheckedList = () => {
    const [categoriesChecked, setCategoriesChecked] = useState([1]);
    const [categoriesChanged, setCategoriesChanged] = useState([1]);

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

         setCategoriesChecked(newChecked)
     }

    const handleCategoriesToggle = (category) => () => {
        const currentIndex = categoriesChecked.indexOf(category)
        const newChecked = [...categoriesChecked]

        if (currentIndex === -1) {
            newChecked.push(category)
        } else {
            newChecked.splice(currentIndex, 1);
        }

        setCategoriesChanged(newChecked)
        setCategoriesChecked(newChecked)
    }

    return {
        categoriesChecked,
        categoriesChanged,
        setCategoriesChecked,
        setInitialChecked,
        handleCategoriesToggle,
    }
}

export default useCategoriesCheckedList