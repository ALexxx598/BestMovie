import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";
import {useState} from "react";

const RequireAdminRoleAuth = () => {
    const { auth, fetchUser } = useAuth()

    const [isLoading, setIsLoading] = useState(true)
    const location = useLocation()

    const checkIsAdmin = async () => {
        try {
            const user = await fetchUser()

            if (user?.id === undefined) {
                setIsLoading(false)
                return false;
            }

            setIsLoading(false)
            return user.isAdmin();
        } catch (error) {
            setIsLoading(false)
            return false
        }

    }

    return (
        checkIsAdmin() && !isLoading
            ? <Outlet />
            : <Navigate to="/login" state={{ from: location}} replace/>
    )
}

export default RequireAdminRoleAuth