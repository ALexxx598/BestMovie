import axios from "../axios";
import CollectionModel from "./CollectionModel";

export default class CollectionApiService {
    static LIST = 'api/collection/list/';

    static async fetchCollections(filter, auth) {
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

    static makeCollection(collection)
    {
        return new CollectionModel(
            collection.id,
            collection.user_id,
            collection.type,
            collection.name,
        )
    }
}