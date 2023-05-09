import axios from "../BestMovieAxios";
import CollectionModel from "./CollectionModel";

export default class CollectionApiService {
    static CREATE = 'api/collection/'
    static LIST = 'api/collection/list/';
    static LIST_OF_DEFAULTS = 'api/collection/list/defaults/';
    static REMOVE = 'api/collection/'

    static async createCollection(name, auth) {
        const response = await axios.post(
            this.CREATE,
            {
                "user_id": auth?.id,
                "name": name,
            },
            {
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                    'Authorization': auth?.accessToken
                }
            }
        )

        return response.data.data.status
    }

    static async fetchCollections(filter, auth) {
        console.log('fetch')

        const response = await axios.get(
            this.LIST,
            {
                params: {
                    type: filter.type,
                    user_id: auth?.id
                },
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                    'Authorization': auth?.accessToken
                }
            },
        )

        return {
            items: response.data.data.items.map(collection => this.makeCollection(collection)),
            temp: response.data.data.temp
        }
    }

    static async fetchDefaultCollections() {
        const response = await axios.get(
            this.LIST_OF_DEFAULTS,
            {
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            },
        )

        return {
            items: response.data.data.items.map(collection => this.makeCollection(collection)),
            temp: response.data.data.temp
        }
    }

    static async remove(auth, collectionId) {
        const response = await axios.delete(
            this.REMOVE + collectionId,
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

    static makeCollection(collection)
    {
        return new CollectionModel(
            collection.id,
            collection.user_id,
            collection.type,
            collection.name,
            collection.movie_ids
        )
    }
}