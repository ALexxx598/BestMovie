import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";
import {useState} from "react";

const RequireAdminRoleAuth = () => {
    const { auth } = useAuth()
    const location = useLocation()

    const checkIsAdmin = () => {
        if (auth === null || auth?.id === undefined || auth?.id === null) {
            return false
        }

        return auth?.isAdmin() ?? false
    }

    return (
        <>
            {
                checkIsAdmin()
                    ? <Outlet />
                    : <Navigate to={'/login/'} state={{ from: location}} replace/>
            }
        </>
    )
}

export default RequireAdminRoleAuth