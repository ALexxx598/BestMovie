export default class MovieModelsCollection {
    constructor(items) {
        this._items = items;
    }

    get items() {
        return this._items;
    }
}