import {useAuth} from "../../../../hooks/useAuth";
import useLogOut from "../../../LogOut/useLogOut";
import {Fragment} from "react";
import {
    ABOUT_US,
    ADMIN_MOVIES,
    DOMAIN,
    LOGIN,
    MOVIES,
} from "../../../../Routes";
import ProfileModal from "../../Profile/ProfileModal";

const AdminNavBar = ({...props}) => {
    const { auth } = useAuth()
    const { logOut } = useLogOut()

    return (
        <Fragment>
            <nav>
                <div className="nav-options">
                    <h1>BestMovie</h1>
                    {
                        props?.allMoviesHighlighted
                            ? <span className="navSpanGold">
                                <a href={DOMAIN + ADMIN_MOVIES}>
                                    Фільми
                                </a>
                              </span>
                            : <span>
                                <a href={DOMAIN + ADMIN_MOVIES}>
                                    Фільми
                                </a>
                              </span>
                    }
                    <span>
                        <a href={DOMAIN + ABOUT_US}> Документація </a>
                    </span>
                </div>
                <div className="nav-options logInLogOut">
                    <span>
                        {
                            auth?.id !== null
                                ? <a onClick={logOut} href={DOMAIN + MOVIES}>Вийти</a>
                                : <a href={DOMAIN + LOGIN}>Увійти</a>
                        }
                    </span>
                    <span>
                        {
                            auth?.id !== null
                                ? <ProfileModal/>
                                : null
                        }
                    </span>
                </div>
            </nav>
        </Fragment>
    )
}

export default AdminNavBar