import axios from "../BestMovieAxios";
import MovieModel from "./MovieModel";
import MovieDescription from "./MovieDescription";
import CategoryApiService from "../Category/CategoryApiService";

export default class MovieApiService {
    static LIST = 'api/movie/list';
    static GET_ONE = 'api/movie/';
    static UPDATE_COLLECTIONS = 'api/movie/collections/';
    static UPDATE_DEFAULT_COLLECTIONS = 'api/movie/collections/default/';
    static CREATE = 'api/movie/';
    static REMOVE = 'api/movie/';

    static async create(
        auth,
        name,
        rating,
        slogan,
        screeningDate,
        country,
        actors,
        shortDescription,
        storage_movie_link,
        storage_image_link
    ) {
        const response = await axios.post(
            this.CREATE,
            {
                user_id: auth?.id,
                name: name,
                description: {
                    rating: rating,
                    slogan: slogan,
                    screening_date: screeningDate,
                    country: country,
                    actors: actors,
                    shortDescription: shortDescription,
                },
                storage_movie_link: storage_movie_link,
                storage_image_link: storage_image_link,
            },
            {
                headers: {
                    'Authorization': auth?.accessToken
                }
            }
        )

        return {
            movie: this.makeMovie(response.data.data)
        }
    }

    static async fetchMovies(filter) {
        console.log('fetch movies')
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
            this.GET_ONE + id,
            {
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

    static async saveCollections(collectionIds, movieId, auth) {
        const response = await axios.patch(
            this.UPDATE_COLLECTIONS + movieId,
            {
                "user_id": auth?.id,
                "collection_ids": collectionIds,
            },
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                    'Authorization': auth?.accessToken
                }
            }
        )
    }

    static async saveDefaultCollections(collectionIds, movieId, auth) {
        const response = await axios.patch(
            this.UPDATE_DEFAULT_COLLECTIONS + movieId,
            {
                "user_id": auth?.id,
                "collection_ids": collectionIds,
            },
            {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                    'Authorization': auth?.accessToken
                }
            }
        )
    }

    static async remove(movieId, auth) {
        const response = await axios.delete(
            this.REMOVE + movieId,
            {
                params: {
                    user_id: auth?.id,
                },
                headers: {
                    'Authorization': auth?.accessToken
                }
            },
        )

        return true;
    }

    static makeMovie(movie) {
        return new MovieModel(
            movie.id,
            movie.name,
            this.makeMovieDescription(movie.description),
            movie.storage_image_url,
            movie.storage_movie_url,
            CategoryApiService.mapCategories(movie?.categories)
        );
    }

    static makeMovieDescription(description) {
        return new MovieDescription(
            description.screening_date,
            description.short_description,
            description.rating,
            description.actors,
            description.slogan,
            description.country,
        )
    }
}