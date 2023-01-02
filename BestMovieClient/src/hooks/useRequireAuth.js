import {useAuth} from "./useAuth";
import {Outlet, Navigate, useLocation} from "react-router-dom";

const RequireAuth = () => {
    const { auth } = useAuth()
    const location = useLocation()

    const checkIsViewer = () => {

        if (auth.id === undefined) {
            return false;
        }

        return auth.isViewer()
    }

    return (
       checkIsViewer()
            ? <Outlet />
            : <Navigate to="/login" state={{ from: location}} replace/>
    )
}

export default RequireAuth