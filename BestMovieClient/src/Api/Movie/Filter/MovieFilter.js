export default class MovieFilter {
    constructor(page, perPage, categoryIds, collectionIds) {
        this._page = page;
        this._perPage = perPage;
        this._categoryIds = categoryIds
        this._collectionIds = collectionIds
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

    set setCategoryIds(value) {
        this._categoryIds = value;
    }

    get collectionIds() {
        return this._collectionIds;
    }

    set collectionIds(value) {
        this._collectionIds = value;
    }
}