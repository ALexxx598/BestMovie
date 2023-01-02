export default class UserModel {
    constructor(id, firstName, lastName, email, password, accessToken) {
        this.id = id
        this.firstName = firstName
        this.lastName = lastName
        this.email = email
        this.password = password
        this.accessToken = accessToken
    }

    get getId()
    {
        return this.id
    }

    get getFirstName()
    {
        return this.firstName
    }

    get getLastName()
    {
        return this.lastName
    }

    get getEmail()
    {
        return this.email
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
