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
            items: response.data.data.items.map(category => this.makeCategory(category)),
            temp: response.data.data.temp
        }
    }

    static makeCategory(category) {
        return new CategoryModel(
            category.id,
            category.name
        )
    }
}