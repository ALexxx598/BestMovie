import {useAuth} from "./useAuth";
import {Navigate, Outlet, useLocation} from "react-router-dom";
import {useEffect, useState} from "react";
import useNavigate from "./useNavigate";
import {DOMAIN, LOGIN, MOVIES} from "../Routes";
import UserApiService from "../Api/User/UserApiService";

const RequireViewerAuth = () => {
    const { auth } = useAuth()
    const location = useLocation()

    const checkIsViewer = () => {
        if (auth === null || auth?.id === undefined || auth?.id === null) {
            return false
        }

        return auth?.isViewer() ?? false
    }

    return (
       <>
           {
               checkIsViewer()
                   ? <Outlet />
                   : <Navigate to={'/login/'} state={{ from: location}} replace/>
           }
       </>
    )
}

export default RequireViewerAuth