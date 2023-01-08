import {Fragment} from "react";
import "./navBar.css";

const NavBar = () => {
    return (
        <Fragment>
            <nav>
                <div className="nav-options">
                    <h1>BestMovie</h1>
                    <span><a href="movies">Movies</a></span>
                    <span>News</span>
                    <span><a href="movieCollections">Movie Collections</a></span>
                    <span><a href="myMovieCollections">My Movie collections</a></span>
                    <span>About us</span>
                </div>
                <div className="nav-options logInLogOut">
                    <span><a href="login">Log in</a></span>
                    <span><a href="register">Register</a></span>
                </div>
            </nav>
        </Fragment>
    )
}

export default NavBar