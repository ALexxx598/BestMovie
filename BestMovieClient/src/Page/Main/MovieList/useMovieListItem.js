import useNavigate from "../../../hooks/useNavigate";
import {DOMAIN, MOVIES} from "../../../Routes";

const useMovieListItem = () => {
    const navigate = useNavigate()

    const handleOnMovieClick = async (id) => {
        navigate.navigate(DOMAIN + MOVIES + id, false)
    }

    return {
        handleOnMovieClick
    }
}

export default useMovieListItem