import {useState} from "react";
import useNavigate from "../../../../../../hooks/useNavigate";
import {DOMAIN, MOVIES} from "../../../../../../Routes";

const useMovieDeleteModal = ({...props}) => {
    const navigate = useNavigate()

    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleRemove = async () => {

        await props.handleRemove(props.movie.id)
        handleClose()
        navigate.navigate(DOMAIN + MOVIES, true)
    }

    return {
        show,
        handleClose,
        handleShow,
        handleRemove
    }
}

export default useMovieDeleteModal