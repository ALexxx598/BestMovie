import {Routes, Route} from "react-router-dom";
import Register from "./Page/Register/Register";
import Login from "./Page/Login/Login";
import Layout from "./Page/Layout/Layout";
import './app.css'
import Admin from "./Page/Admin/Admin";
import MovieCollections from "./Page/Main/MovieCollection/MovieCollections";
import MyMovieCollections from "./Page/Main/MyMovieCollection/MyMovieCollections";
import RequireAdminRoleAuth from "./hooks/useRequireAdminRoleAuth";
import RequireViewerAuth from "./hooks/useRequireViewerAuth";
import Movies from "./Page/Main/Movies/Movies";
import Movie from "./Page/Main/Movie/Movie";
import {ABOUT_US, LOGIN, MOVIE_COLLECTIONS, MOVIES, MY_MOVIE_COLLECTION, REGISTER} from "./Routes";
import PersistLogin from "./hooks/usePersistLogin";
import AboutUs from "./Page/Main/AboutUs/AboutUs";

function App() {

  return (
      <Routes>
          <Route path="/" element={<Layout/>}>
              <Route path={LOGIN} element={<Login/>} />
              <Route path={REGISTER} element={<Register/>} />

              <Route path={MOVIES} element={<Movies/>} />
              <Route path={MOVIE_COLLECTIONS} element={<MovieCollections/>} />
              <Route path={MOVIES + ':id'} element={<Movie/>} />

              <Route path={ABOUT_US} element={<AboutUs/>}/>

              <Route element={<PersistLogin/>} >
                  <Route element={<RequireAdminRoleAuth/>} >
                      <Route path="admin" element={<Admin/>} />
                  </Route>

                  <Route element={<RequireViewerAuth/>} >
                      <Route path={MY_MOVIE_COLLECTION} element={<MyMovieCollections/>} />
                  </Route>
              </Route>
          </Route>
      </Routes>
  );
}

export default App;
