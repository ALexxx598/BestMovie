import {Fragment} from "react";
import {AiFillPlayCircle} from 'react-icons/ai'
import "./movieItem.css"

import {ADMIN_MOVIES, DOMAIN} from "../../../../../Routes";

const MovieListItem = ({...props}) => {
    return (
        <Fragment>
            <div id="container" className="movieItemBackground">
                <a href={DOMAIN + ADMIN_MOVIES + props.movie.id}>
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