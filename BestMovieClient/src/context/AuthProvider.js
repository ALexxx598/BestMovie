import {createContext, useEffect, useState} from "react";
import UserModel from "../Api/User/UserModel";
import UserApiService from "../Api/User/UserApiService";
import {AUTH_ACCESS_TOKEN_KEY, AUTH_USER_ID_KEY} from "./LocalStorageKeys";

const AuthContext = createContext({});

export const AuthProvider = ({ children }) => {
    const [auth, setAuth] = useState(new UserModel(
        localStorage.getItem(AUTH_USER_ID_KEY),
        null,
        null,
        null,
        localStorage.getItem(AUTH_ACCESS_TOKEN_KEY),
    ));

    const putAuthToLocalStorage = (user) => {
        localStorage.setItem('auth.userId', user?.id)
        localStorage.setItem('auth.accessToken', user?.accessToken)
    }

    return (
        <AuthContext.Provider value={{
            auth,
            setAuth,
            putAuthToLocalStorage,
        }}>
            {children}
        </AuthContext.Provider>
    )
}

export default AuthContext