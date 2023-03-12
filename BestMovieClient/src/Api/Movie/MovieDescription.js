export default class MovieDescription {
    constructor(screeningDate, shortDescription, rating, actors, slogan, country) {
        this._screeningDate = screeningDate;
        this._shortDescription = shortDescription;
        this._rating = rating;
        this._actors = actors;
        this._slogan = slogan;
        this._country = country;
    }

    get screeningDate() {
        return this._screeningDate;
    }

    set screeningDate(value) {
        this._screeningDate = value;
    }

    get shortDescription() {
        return this._shortDescription;
    }

    set shortDescription(value) {
        this._shortDescription = value;
    }

    get rating() {
        return this._rating;
    }

    set rating(value) {
        this._rating = value;
    }

    get actors() {
        return this._actors;
    }

    set actors(value) {
        this._actors = value;
    }

    get slogan() {
        return this._slogan;
    }

    set slogan(value) {
        this._slogan = value;
    }

    get country() {
        return this._country;
    }

    set country(value) {
        this._country = value;
    }
}
