import {useEffect, useState} from "react";
import {useParams} from "react-router-dom";

import {useAuth} from "../../../hooks/useAuth";

import MovieApiService from "../../../Api/Movie/MovieApiService";

const useMovie = () => {
    const { auth } = useAuth()

    const { id } = useParams()
    const [movie, setMovie] = useState([])

    const fetchMovie = async () => {
        const response = await MovieApiService.fetchMovie(id)

        setMovie(response.movie)
    }

    const getCategoriesAsText = () => {
        let categories = ''

        movie.categories?.map((category, key) => {
            if (movie.categories.length - 1 === key) {
                categories += category?.name + '.'
                return
            }

            categories += category?.name + ', '
        })

        return categories === '' ? 'unknown' : categories
    }

    const checkIsUserAuth = () => {
        return auth?.accessToken !== undefined && auth?.accessToken !== null
    }

    useEffect(() => {
      fetchMovie()
    }, [])

    return {
        movie,
        checkIsUserAuth,
        getCategoriesAsText,
    }
}

export default useMovie