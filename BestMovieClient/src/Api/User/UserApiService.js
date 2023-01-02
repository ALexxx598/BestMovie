import UserModel from "./UserModel";
import axios from '../axios'
import RoleModel from "../Role/RoleModel";

export default class UserApiService {
    static REGISTER = 'api/user/';
    static LOGIN = 'api/user/';
    static REFRESH = 'api/user/refresh/';

    static async refreshUser(accessToken) {
        const response = await axios.post(
            this.REFRESH,
            JSON.stringify({
                accessToken,
            })
        )

        return this.makeUser(response)
    }

    static async register(firstName, lastName, email, password) {
        const response = await axios.post(
            this.REGISTER,
            {
                name: firstName,
                surname: lastName,
                email: email,
                password: password,
                password_confirmation: password,
            }
        )

        return this.makeUser(response)
    }

    static async login(email, password) {
        const response = await axios.get(
            this.LOGIN,
            {
                params: {
                    email: email,
                    password: password,
                },
                headers: {
                    'Access-Control-Allow-Origin' : '*',
                    'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
                }
            },
        )

        return this.makeUser(response)
    }

    static makeUser(response) {
        return new UserModel(
            response.data.data.id,
            response.data.data.firstName,
            response.data.data.lastName,
            response.data.data.email,
            response.data.data.password,
            response.data.data.accessToken,
            response.data.data.roles.map((role) => {
                return new RoleModel(
                    role.id,
                    role.type
                )
            })
        )
    }
}