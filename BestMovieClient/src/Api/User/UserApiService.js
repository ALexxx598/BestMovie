import UserModel from "./UserModel";
import axios from '../BestMovieAxios'
import RoleModel from "../Role/RoleModel";

export default class UserApiService {
    static REGISTER = 'api/user/';
    static PRE_REGISTER = 'api/user/pre-registration/';
    static LOGIN = 'api/user/';
    static REFRESH = 'api/user/refresh/';

    static async refreshUser(id, accessToken) {
        const response = await axios.get(
            this.REFRESH,
            {
                params: {
                    'user_id': id
                },
                headers: {
                    'Authorization': accessToken
                },
            },
        )

        return this.makeUser(response)
    }

    static async register(firstName, lastName, email, password, emailConfirmationCode) {
        const response = await axios.post(
            this.REGISTER,
            {
                name: firstName,
                surname: lastName,
                email: email,
                password: password,
                password_confirmation: password,
                email_confirmation_code: emailConfirmationCode
            }
        )

        return this.makeUser(response)
    }

    static async preRegister(firstName, lastName, email, password) {
        const response = await axios.post(
            this.PRE_REGISTER,
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
            response.data.data.name,
            response.data.data.surname,
            response.data.data.email,
            response.data.data.access_token,
            response.data.data.roles.map((role) => {
                return new RoleModel(
                    null,
                    role
                )
            })
        );
    }
}