import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";

const RequireAdminRoleAuth = () => {
    const { auth } = useAuth()
    const location = useLocation()

    const checkIsAdmin = () => {
        console.log(auth)

        if (auth.id === undefined) {
            return false;
        }

        return auth.isAdmin();
    }

    return (
        checkIsAdmin()
            ? <Outlet />
            : <Navigate to="/login" state={{ from: location}} replace/>
    )
}

export default RequireAdminRoleAuth