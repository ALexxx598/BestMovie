import UserModel from "./UserModel";
import axios from '../axios'
import RoleModel from "../Role/RoleModel";

export default class UserApiService {
    static REGISTER = 'api/user/register/';
    static LOGIN = 'api/user/login/';
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
            JSON.stringify({
                firstName,
                lastName,
                email,
                password,
            })
        )

        return this.makeUser(response)
    }

    static async login(email, password) {
        const response = await axios.post(
            this.LOGIN,
            JSON.stringify({
                'email': email,
                'password': password,
            })
        )

        return this.makeUser(response)
    }

    static makeUser(response) {
        return new UserModel(
            response.data.id,
            response.data.firstName,
            response.data.lastName,
            response.data.email,
            response.data.password,
            response.data.accessToken,
            response.data.roles.map((role) => {
                return new RoleModel(
                    role.id,
                    role.type
                )
            })
        )
    }
}