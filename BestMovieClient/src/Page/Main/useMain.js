import {useAuth} from "../../hooks/useAuth";
import useNavigate from "../../hooks/useNavigate";

const useMain = () => {
    const auth = useAuth()
    const navigate = useNavigate()

    return {
        auth
    }
}

export default useMain