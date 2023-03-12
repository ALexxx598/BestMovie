export default class RoleModel {
    constructor(id, type) {
        this.id = id
        this.type = type
    }

    get getId()
    {
        return this.id
    }

    get getType()
    {
        return this.type;
    }

    equalViewer()
    {
        return this.getType === 'VIEWER'
    }

    equalAdmin()
    {
        return this.getType === "ADMIN"
    }
}
