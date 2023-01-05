import {Fragment} from "react";
import {AiFillPlayCircle} from 'react-icons/ai'
import "./movieItem.css"

const MovieCollectionItem = ({...props}) => {

    const click = () => {
        console.log('click') // TODO add unique movie page MovieItem
    }

    return (
        <Fragment>
            <div id="container" className="movieItemBackground">
                <AiFillPlayCircle color="green" fontSize={40} id="playIcon" onClick={() => click()}/>
                <img
                    src={
                        props.movie.storageImageUrl
                            ? "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                            : "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                    }
                    onClick={() => click()}
                >
                </img>
                <h3>{props.movie.name}</h3>
            </div>
        </Fragment>
    )
}

export default MovieCollectionItem