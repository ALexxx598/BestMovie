import useMovies from "../Movies/useMovies";
import {useEffect, useState} from "react";
import CollectionFilter from "../../../Api/Collection/Filter/CollectionFilter";
import {CUSTOM, DEFAULT} from "../../../Api/Collection/Filter/CollectionType";
import CollectionApiService from "../../../Api/Collection/CollectionApiService";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import {useAuth} from "../../../hooks/useAuth";

const useMyMovieCollection = () => {
    const { auth } = useAuth()

    const movies = useMovies()

    const [collections, setCollections] = useState([])

    const [filter, setFilter] = useState(new CollectionFilter(CUSTOM))
    const [checked, setChecked] = useState([1]);

    const fetchCollections = async () => {
        const response = await CollectionApiService.fetchCollections(filter, auth)

        setCollections(response.items)
    }

    const getCollectionIds = (newChecked) => {
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
            movies.filter.categoryIds,
            getCollectionIds(newChecked)
        )

        movies.setFilter(newFilter)
    }

    const handleAddCollection = () => {

    }

    useEffect(() => {
        fetchCollections()
    }, [])

    return {
        collections,
        handleToggle,
        checked,
        ...movies,
        fetchCollections,
    }
}

export default useMyMovieCollection