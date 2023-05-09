import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";
import {useEffect, useState} from "react";
import useNavigate from "./useNavigate";
import {DOMAIN, LOGIN, MOVIES} from "../Routes";
import UserApiService from "../Api/User/UserApiService";

const PersistLogin = () => {
    const { auth, setAuth } = useAuth()

    const [user, setUser] = useState(null)
    const [isLoading, setIsLoading] = useState(true)

    const fetchUser = async () => {
        try {
            console.log(auth?.id)
            console.log(auth?.accessToken)

            const user = await UserApiService.refreshUser(
                auth?.id,
                auth?.accessToken
            )

            setAuth(user)

            user?.accessToken !== null
                ? setIsLoading(false)
                : setIsLoading(true);
        } catch (error) {
            console.error(error)
            setIsLoading(false)
        }
    }

    useEffect(() => {
        fetchUser()
    }, [])

    return (
        <>
            {
                isLoading
                    ? <p>...</p>
                    : <Outlet />
            }
        </>
    )
}

export default PersistLogin