import axios from "../BestMovieAxios";
import CategoryModel from "./CategoryModel";

export default class CategoryApiService {
    static LIST = 'api/category/list/'
    static CREATE = 'api/category/'
    static REMOVE = 'api/category/'

    static async fetchCategories () {
        const response = await axios.get(
            this.LIST,
            {
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            },
        )

        return {
            items: this.mapCategories(response.data.data.items),
            temp: response.data.data.temp
        }
    }

    static async create(auth, name) {
        const response = await axios.post(
            this.CREATE,
            {
                user_id: auth?.id,
                name: name,
            },
            {
                headers: {
                    'Authorization': auth?.accessToken
                }
            }
        )

        return {
            movie: this.makeCategory(response.data.data)
        }
    }

    static async remove(auth, categoryId) {
        const response = await axios.delete(
            this.REMOVE + categoryId,
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

    static mapCategories(categories) {
        return categories?.map(category => this.makeCategory(category))
    }

    static makeCategory(category) {
        return new CategoryModel(
            category.id,
            category.name,
            category?.movie_ids,
        )
    }
}