import {useEffect, useState} from "react";
import MovieApiService from "../../../Api/Movie/MovieApiService";
import {useParams} from "react-router-dom";

const useMovie = () => {
    const { id } = useParams()
    const [movie, setMovie] = useState([])

    const fetchMovie = async () => {
        const movie = await MovieApiService.fetchMovie(id)

        setMovie(movie)
    }

    useEffect(() => {
      fetchMovie()
    }, [])

    return (
        movie
    )
}

export default useMovie