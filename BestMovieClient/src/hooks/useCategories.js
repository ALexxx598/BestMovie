import useCategoriesCheckedList from "./useCategoriesCheckedList";
import {useEffect, useState} from "react";
import CategoryApiService from "../Api/Category/CategoryApiService";
import {useAuth} from "./useAuth";

const useCategories = () => {
    const {auth} = useAuth()

    const {
        categoriesChecked,
        categoriesChanged,
        setInitialChecked,
        handleCategoriesToggle
    } = useCategoriesCheckedList()

    const [ categories, setCategories ] = useState([])

    const fetchCategories = async () => {
        const { items } = await CategoryApiService.fetchCategories()

        setCategories(items)

        return items
    }

    const getCategoryIds = (newChecked) => {
        return newChecked
            .map((category) => category.id ?? null)
            .filter(id => id !== null);
    }

    const handleRemoveCategory = async (category) => {
        await CategoryApiService.remove(auth, category.id)
        await fetchCategories()
    }

    const handleAddCategory = async (name) => {
        await CategoryApiService.create(auth, name)
        await fetchCategories()
    }

    return {
        categories,
        categoriesChanged,
        categoriesChecked,
        setInitialChecked,
        handleCategoriesToggle,
        getCategoryIds,
        fetchCategories,
        handleRemoveCategory,
        handleAddCategory,
    }
}

export default useCategories