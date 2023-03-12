export default class MovieModel {
    constructor(id, name, description, storageImageUrl, storageMovieUrl, categories) {
        this._id = id;
        this._name = name;
        this._description = description;
        this._categories = categories;
        this._storageImageUrl = storageImageUrl;
        this._storageMovieUrl = storageMovieUrl;
    }

    get id() {
        return this._id;
    }

    get name() {
        return this._name;
    }

    get description() {
        return this._description;
    }

    get storageImageUrl() {
        return this._storageImageUrl;
    }

    get storageMovieUrl() {
        return this._storageMovieUrl;
    }

    get categories() {
        return this._categories;
    }
}