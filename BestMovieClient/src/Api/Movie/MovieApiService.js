import axios from "../axios";
import MovieModel from "./MovieModel";

export default class MovieApiService {
    static LIST = 'api/movie/list';
    static GET_ONE = 'api/movie/';

    static async fetchMovies(filter) {

        const response = await axios.get(
            this.LIST,
            {
                params: {
                    page: filter.page,
                    per_page: filter.perPage,
                    category_ids: filter.categoryIds,
                    collection_ids: filter.collectionIds,
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

    static async fetchMovie(id) {

        const response = await axios.get(
            this.GET_ONE + '?id=' + id + '/',
            {
                // params: {
                //     id: id
                // },
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            },
        )

        return {
            movie: this.makeMovie(response.data.data)
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