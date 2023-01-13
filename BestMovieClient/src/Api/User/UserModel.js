export default class UserModel {
    constructor(id, firstName, lastName, email, accessToken, roles) {
        this.id = id
        this.firstName = firstName
        this.lastName = lastName
        this.email = email
        this.accessToken = accessToken
        this.roles = roles
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

    get getRoles()
    {
        return this.roles
    }

    isViewer()
    {
        return this
            .getRoles
            .filter(roleModel => roleModel.equalViewer())
            .length > 0;
    }

    isAdmin()
    {
        return this
            .getRoles
            .filter(roleModel => roleModel.equalAdmin())
            .length > 0;
    }
}
