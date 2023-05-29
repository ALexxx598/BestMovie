import {useState} from "react";

const useCategoriesCheckedList = () => {
    const [categoriesChecked, setCategoriesChecked] = useState([1]);
    const [categoriesChanged, setCategoriesChanged] = useState([1]);

     const setInitialChecked = (categories, id) => {
         const newChecked = [1]

         categories.forEach(
             (category) => {
                 category.movieIds.filter(
                     (categoryMovieId) => {
                         if (parseInt(categoryMovieId) === parseInt(id)) {
                             newChecked.push(category)
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