import UserModel from "./UserModel";
import axios from '../axios'

export default class UserApiService {
    static REGISTER = 'api/register/';

    static async register(name, password)
    {
        const user = await axios.post(this.REGISTER, {
            'name': name,
            'password': password,
        })

        return new UserModel(
            1,
            name,
            password,
            'accessToken'
        )
    }
}