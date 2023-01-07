export default class MovieFilter {
    constructor(page, perPage, categoryIds) {
        this._page = page;
        this._perPage = perPage;
        this._categoryIds = categoryIds
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

    get categoryIds() {
        return this._categoryIds;
    }

    set categoryIds(value) {
        this._categoryIds = value;
    }
}