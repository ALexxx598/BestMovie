import axios from "../axios";
import CategoryModel from "./CategoryModel";

export default class CategoryApiService {
    static LIST = 'api/category/list/'

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

    static mapCategories(categories) {
        return categories?.map(category => this.makeCategory(category))
    }

    static makeCategory(category) {
        return new CategoryModel(
            category.id,
            category.name
        )
    }
}