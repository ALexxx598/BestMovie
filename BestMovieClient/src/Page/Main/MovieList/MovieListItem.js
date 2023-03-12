import {Fragment} from "react";
import {AiFillPlayCircle} from 'react-icons/ai'
import "./movieItem.css"
import useNavigate from "../../../hooks/useNavigate";
import useMovieListItem from "./useMovieListItem";
import {DOMAIN, MOVIES} from "../../../Routes";

const MovieListItem = ({...props}) => {
    const {handleOnMovieClick} = useMovieListItem()

    return (
        <Fragment>
            <div id="container" className="movieItemBackground">
                <a href={DOMAIN + MOVIES + props.movie.id}>
                    <AiFillPlayCircle
                        color="green"
                        fontSize={40}
                        id="playIcon"
                    />
                </a>
                <a href={DOMAIN + MOVIES + props.movie.id}>
                    <img
                        src={
                            props.movie.storageImageUrl
                                ? "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                                : "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                        }
                    >
                    </img>
                </a>
                <h3>{props.movie.name}</h3>
            </div>
        </Fragment>
    )
}

export default MovieListItem