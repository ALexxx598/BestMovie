export default class CollectionModel {
    constructor(id, userId, type, name, movieIds) {
        this._id = id;
        this._userId = userId;
        this._type = type;
        this._name = name;
        this._movieIds = movieIds
    }

    get id() {
        return this._id;
    }

    set id(value) {
        this._id = value;
    }

    get userId() {
        return this._userId;
    }

    set userId(value) {
        this._userId = value;
    }

    get type() {
        return this._type;
    }

    set type(value) {
        this._type = value;
    }

    get name() {
        return this._name;
    }

    set name(value) {
        this._name = value;
    }

    get movieIds() {
        return this._movieIds;
    }

    set movieIds(value) {
        this._movieIds = value;
    }
}