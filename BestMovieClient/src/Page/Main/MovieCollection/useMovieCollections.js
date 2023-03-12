import {useEffect, useState} from "react";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import MovieFilter from "../../../Api/Movie/Filter/MovieFilter";
import MoviePaginator from "../../../Api/Movie/Filter/MoviePaginator";
import useMovies from "../Movies/useMovies";
import CollectionApiService from "../../../Api/Collection/CollectionApiService";
import CollectionFilter from "../../../Api/Collection/Filter/CollectionFilter";
import {CUSTOM, DEFAULT} from "../../../Api/Collection/Filter/CollectionType";
import {useAuth} from "../../../hooks/useAuth";

const useMovieCollection = () => {
    const movies = useMovies()

    const {auth, findLocalStorageAuth} = useAuth()

    const [collections, setCollections] = useState([])

    const [filter, setFilter] = useState(new CollectionFilter(DEFAULT))
    const [checked, setChecked] = useState([1]);

    const fetchCollections = async () => {
        const response = await CollectionApiService.fetchCollections(filter)

        // console.log(auth)
        // findLocalStorageAuth()
        // console.log(response.items)

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

    useEffect(() => {
        fetchCollections()
    }, [])

    return {
        collections,
        handleToggle,
        checked,
        ...movies,
    }
}

export default useMovieCollection