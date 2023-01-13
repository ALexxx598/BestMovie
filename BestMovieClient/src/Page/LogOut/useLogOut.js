import {AUTH_ACCESS_TOKEN_KEY, AUTH_USER_ID_KEY} from "../../context/LocalStorageKeys";
import useNavigate from "../../hooks/useNavigate";
import {useAuth} from "../../hooks/useAuth";
import {DOMAIN, MOVIES} from "../../Routes";

const useLogOut = () => {
    const { setAuth } = useAuth()
    const navigate = useNavigate();

    const logOut = () => {
        localStorage.removeItem(AUTH_ACCESS_TOKEN_KEY)
        localStorage.removeItem(AUTH_USER_ID_KEY)

        setAuth(null)
        // navigate.navigate(DOMAIN + MOVIES, {replace: true})
    }

    return {
        logOut
    }
}

export default useLogOut