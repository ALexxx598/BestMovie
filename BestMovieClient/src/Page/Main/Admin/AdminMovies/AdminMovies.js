import AdminNavBar from "../AdminNavBar/AdminNavBar";
import Paginator from "../../Paginator/Paginator";
import "../../MovieList/movies.css"
import '../../Paginator/paginator.css'
import MovieAddModal from "./MovieCollectionModal/MovieAddModal";
import { Row } from "react-bootstrap";
import useAdminMovies from "./useAdminMovies";
import "./adminMovies.css"
import MovieCollectionList from "./MovieCollections/MovieCollectionList";
import MovieCategoryList from "./MovieCategories/MovieCategoryList";
import MovieCategoryAddModal from "./MovieCategories/MovieCategoryAddModal";
import MovieCollectionAddModal from "./MovieCollections/MovieCollectionAddModal";
import MovieList from "./MovieList/MovieList";
import AdminFooter from "../Footer/AdminFooter";

const AdminMovies = () => {
    const {
        categories,
        categoriesChecked,
        handleCategoriesToggle,
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
        handleRemoveCollection,
        fetchDefaultCollections,
        handleRemoveCategory,
        fetchCategories,
        handleAddCategory,
        handleAddCollection,
        fetchMovies,
    } = useAdminMovies()

    return (
        <div className="background">
            <AdminNavBar allMoviesHighlighted={true}/>
            <div className="main">

                <div className="listPadding">
                    <Row>
                        <MovieAddModal
                            fetchMovies={fetchMovies}
                        />
                    </Row>
                    <MovieCategoryAddModal
                        handleAddCategory={handleAddCategory}
                        fetchCategories={fetchCategories}
                    />
                    <MovieCategoryList
                        categories={categories}
                        handleCategoriesToggle={handleCategoriesToggle}
                        categoriesChecked={categoriesChecked}
                        fetchCategories={fetchCategories}
                        handleRemoveCategory={handleRemoveCategory}
                    />

                    <MovieCollectionAddModal
                        fetchDefaultCollections={fetchDefaultCollections}
                        handleAddCollection={handleAddCollection}
                    />
                    <MovieCollectionList
                        collections={collections}
                        handleToggle={handleToggle}
                        collectionChecked={collectionChecked}
                        handleRemoveCollection={handleRemoveCollection}
                        fetchDefaultCollections={fetchDefaultCollections}
                    />
                </div>
                <div style={{paddingTop: 25, width: "100%"}}>
                    <MovieList movies={movies} />
                    <Paginator
                        lastPage={paginator.lastPage}
                        currentPage={paginator.currentPage}
                        handleChangePage={handleChangePage}
                    />
                </div>
            </div>
            <AdminFooter/>
        </div>
    )
}

export default AdminMovies