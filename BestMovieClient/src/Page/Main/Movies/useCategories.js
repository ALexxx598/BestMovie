import {useEffect, useState} from "react";
import CategoryApiService from "../../../Api/Category/CategoryApiService";

const useCategories = () => {
    const [categories, setCategories] = useState([])
    const [checked, setChecked] = useState([1]);

    const fetchCategories = async () => {
        const response = await CategoryApiService.fetchCategories()

        setCategories(response.items)
    }

    const handleToggle = (category) => () => {
        const currentIndex = checked.indexOf(category);
        const newChecked = [...checked];

        if (currentIndex === -1) {
            newChecked.push(category);
        } else {
            newChecked.splice(currentIndex, 1);
        }

        setChecked(newChecked);
    }

    useEffect(() => {
        fetchCategories()
    }, [])

    return {
        categories,
        checked,
        handleToggle,
    }
}


export default useCategories