import AdminNavBar from "../AdminNavBar/AdminNavBar";
import Paginator from "../../Paginator/Paginator";
import "../../MovieList/movies.css"
import '../../Paginator/paginator.css'
import MovieAddModal from "./MovieCollectionModal/MovieAddModal";
import { Row } from "react-bootstrap";
import useAdminMovies from "./useAdminMovies";
import "./adminMovies.css"
import Button from "../../../../components/Button/Button";
import MovieCollectionList from "./MovieCollections/MovieCollectionList";
import MovieCategoryList from "./MovieCategories/MovieCategoryList";
import AddIcon from '@mui/icons-material/Add';
import Fab from '@mui/material/Fab';
import {green} from "@mui/material/colors";
import MovieCategoryAddModal from "./MovieCategories/MovieCategoryAddModal";
import MovieCollectionAddModal from "./MovieCollections/MovieCollectionAddModal";
import MovieList from "./MovieList/MovieList";

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
        handleAddCollection
    } = useAdminMovies()

    return (
        <div className="background">
            <AdminNavBar allMoviesHighlighted={true}/>
            <Row>
                <MovieAddModal/>
            </Row>
            <div className="main">
                <div className="listPadding">
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
            <div>footer</div>
        </div>
    )
}

export default AdminMovies