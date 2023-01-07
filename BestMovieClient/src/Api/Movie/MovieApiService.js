import axios from "../axios";
import MovieModel from "./MovieModel";
import MovieModelsCollection from "./MovieModelsCollection";

export default class MovieApiService {
    static LIST = 'api/movie/list';

    static async fetchMovies(filter) {

        const response = await axios.get(
            this.LIST,
            {
                params: {
                    page: filter.page,
                    per_page: filter.perPage,
                    category_ids: filter.categoryIds
                },
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            },
        )

        return {
             items: response.data.data.items.map(movie => this.makeMovie(movie)),
             temp: response.data.data.temp
        }
    }

    static makeMovie(movie) {
        return new MovieModel(
            movie.id,
            movie.name,
            movie.description,
            movie.storage_image_url,
            movie.storage_movie_url,
        );
    }
}