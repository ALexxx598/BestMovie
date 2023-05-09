import MovieListItem from "./MovieListItem";
import "./movies.css"

const MovieList = ({...props}) => {

    return (
        <div className='movies-container'>
            {
                props.movies.map((movie) => {
                    return (
                        <MovieListItem id={movie.id} movie={movie}/>
                    )
                })
            }
        </div>
    );
}

export default MovieList