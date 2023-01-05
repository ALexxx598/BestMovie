export default class MovieFilter {
    constructor(page, perPage) {
        this._page = page;
        this._perPage = perPage;
    }

    get page() {
        return this._page;
    }

    set page(value) {
        this._page = value;
    }

    get perPage() {
        return this._perPage;
    }

    set perPage(value) {
        this._perPage = value;
    }
}