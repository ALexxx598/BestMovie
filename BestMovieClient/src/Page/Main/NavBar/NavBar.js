import {Fragment} from "react";
import "./navBar.css";
import {ABOUT_US, DOMAIN, LOGIN, MOVIES, MY_MOVIE_COLLECTION} from "../../../Routes";
import {useAuth} from "../../../hooks/useAuth";
import useLogOut from "../../LogOut/useLogOut";
import ProfileModal from "../Profile/ProfileModal";

const NavBar = ({...props}) => {
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
                                <a href={DOMAIN + MOVIES}>Movies</a>
                              </span>
                            : <span>
                                <a href={DOMAIN + MOVIES}>Movies</a>
                              </span>
                    }
                    <span>News</span>
                    {
                        props?.myMovieCollectionsHighlighted
                            ? <span className="navSpanGold">
                               <a href={DOMAIN + MY_MOVIE_COLLECTION}>My Movie collections</a>
                              </span>
                            : <span>
                               <a href={DOMAIN + MY_MOVIE_COLLECTION}>My Movie collections</a>
                              </span>
                    }
                    {
                        props?.aboutUs
                            ? <span className="navSpanGold">
                                <a href={DOMAIN + ABOUT_US}> About us </a>
                              </span>
                            : <span>
                                <a href={DOMAIN + ABOUT_US}> About us </a>
                              </span>
                    }
                </div>
                <div className="nav-options logInLogOut">
                    <span>
                        {
                            auth?.id !== null
                                ? <a onClick={logOut} href={DOMAIN + MOVIES}>Log out</a>
                                : <a href={DOMAIN + LOGIN}>Log in</a>
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

export default NavBar