export default class CategoryModel {
    constructor(id, name, movieIds) {
        this._id = id
        this._name = name
        this._movieIds = movieIds
    }

    get id() {
        return this._id
    }

    get name() {
        return this._name
    }

    get movieIds() {
        return this._movieIds
    }
}