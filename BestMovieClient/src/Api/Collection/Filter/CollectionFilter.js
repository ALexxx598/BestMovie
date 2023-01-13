export default class CollectionFilter {
    constructor(type, movieId) {
        this._type = type;
        this._movieId = movieId
    }

    get type() {
        return this._type;
    }

    get movieId() {
        return this._movieId;
    }
}