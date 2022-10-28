export default class UserModel {
    constructor(id, name, password, accessToken) {
        this.id = id
        this.name = name
        this.password = password
        this.accessToken = accessToken
    }

    get getId()
    {
        return this.id
    }

    get getName()
    {
        return this.name
    }

    get getPassword()
    {
        return this.password
    }

    get getAccessToken()
    {
        return this.accessToken
    }
}
