export default class MoviePaginator {
    constructor(currentPage, perPage, lastPage, totalPages) {
        this._currentPage = currentPage;
        this._perPage = perPage;
        this._lastPage = lastPage;
        this._totalPages = totalPages;
    }

    get currentPage() {
        return this._currentPage;
    }

    set currentPage(value) {
        this._currentPage = value;
    }

    get perPage() {
        return this._perPage;
    }

    set perPage(value) {
        this._perPage = value;
    }

    get lastPage() {
        return this._lastPage;
    }

    set lastPage(value) {
        this._lastPage = value;
    }

    get totalPages() {
        return this._totalPages;
    }

    set totalPages(value) {
        this._totalPages = value;
    }
}