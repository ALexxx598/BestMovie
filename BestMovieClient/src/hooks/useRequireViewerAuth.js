import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";

const RequireViewerAuth = () => {
    const { auth } = useAuth()
    const location = useLocation()

    const checkIsViewer = () => {
        console.log(auth)

        if (auth.id === undefined) {
            return false;
        }

        return auth.isViewer();
    }

    return (
        checkIsViewer()
            ? <Outlet />
            : <Navigate to="/login" state={{ from: location}} replace/>
    )
}

export default RequireViewerAuth