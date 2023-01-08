export default class CollectionFilter {
    constructor(type) {
        this._type = type;
    }

    get type() {
        return this._type;
    }

    set type(value) {
        this._type = value;
    }
}