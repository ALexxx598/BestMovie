import useNavigate from "../../../hooks/useNavigate";

const useMovieListItem = () => {
    const navigate = useNavigate()

    const handleOnMovieClick = async (id) => {
        navigate.navigate('' + id, true)
    }

    return {
        handleOnMovieClick
    }
}

export default useMovieListItem