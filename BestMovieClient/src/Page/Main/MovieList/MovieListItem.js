import {Fragment} from "react";
import "./movieItem.css"
import {DOMAIN, MOVIES} from "../../../Routes";
import firebaseApp from "../../../Firebase/Firebase";

const MovieListItem = ({...props}) => {

    return (
        <Fragment>
            <div id="container" className="movieItemBackground">
                <a href={DOMAIN + MOVIES + props.movie.id}>
                    <img
                        src={
                            props.movie.storageImageUrl
                                ? props.movie.storageImageUrl
                                : "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                        }
                    >
                    </img>
                </a>
                <h3 className="movieName">{props.movie.name}</h3>
            </div>
        </Fragment>
    )
}

export default MovieListItem