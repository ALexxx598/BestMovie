import NavBar from "../NavBar/NavBar";
import CategoryList from "../Categories/CategoryList";
import "./movies.css";
import MovieList from "../MovieList/MovieList";
import Paginator from "../Paginator/Paginator";
import MovieCollectionList from "../MovieCollection/MovieCollectionList";
import useViewerMovies from "./useViewerMovies";
import Footer from "../Footer/Footer";

const Movies = () => {
    const {
        categories,
        handleCategoriesToggle,
        categoriesChecked,
        collections,
        handleToggle,
        collectionChecked,
        movies,
        paginator,
        handleChangePage,
    } = useViewerMovies()

    return (
        <div className="background">
            <NavBar allMoviesHighlighted={true}/>
            <div className="main">
                <div className="listPadding">
                    <div className="categoryHeader">
                        {/*Categories*/}
                        Категорії
                    </div>
                    <CategoryList
                        categories={categories}
                        handleCategoriesToggle={handleCategoriesToggle}
                        categoriesChecked={categoriesChecked}
                    />
                    <div className="collectionHeader">
                        {/*Collections*/}
                        Колекції
                    </div>
                    <MovieCollectionList
                        collections={collections}
                        handleToggle={handleToggle}
                        collectionChecked={collectionChecked}
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
            <Footer/>
        </div>
    )
}

export default Movies