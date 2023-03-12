import {useEffect, useState} from "react";
import CategoryApiService from "../../../Api/Category/CategoryApiService";
import useMovies from "./useMovies";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";

const useCategories = () => {
    const movies = useMovies()

    const [categories, setCategories] = useState([])
    const [checked, setChecked] = useState([1]);

    const fetchCategories = async () => {
        const response = await CategoryApiService.fetchCategories()

        setCategories(response.items)
    }

    const getCategoryIds = (newChecked) => {
        return newChecked
            .map((category) => category.id ?? null)
            .filter(id => id !== null);
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

        const defaultFilter = movies.getDefaultFilter()

        const newFilter = new MovieFilter(
            defaultFilter.page,
            defaultFilter.perPage,
            getCategoryIds(newChecked)
        )

        movies.setFilter(newFilter)
    }

    useEffect(() => {
        fetchCategories()
    }, [])

    return {
        categories,
        checked,
        handleToggle,
        ...movies
    }
}


export default useCategories