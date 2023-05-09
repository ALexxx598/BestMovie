import {Routes, Route} from "react-router-dom";
import Register from "./Page/Register/Register";
import Login from "./Page/Login/Login";
import Layout from "./Page/Layout/Layout";
import './app.css'
import MyMovieCollections from "./Page/Main/MyMovieCollection/MyMovieCollections";
import RequireAdminRoleAuth from "./hooks/useRequireAdminRoleAuth";
import RequireViewerAuth from "./hooks/useRequireViewerAuth";
import Movies from "./Page/Main/Movies/Movies";
import Movie from "./Page/Main/Movie/Movie";
import {
    ABOUT_US,
    ADMIN,
    ADMIN_MOVIES,
    LOGIN,
    MOVIES,
    MY_MOVIE_COLLECTION,
    REGISTER
} from "./Routes";
import PersistLogin from "./hooks/usePersistLogin";
import AboutUs from "./Page/Main/AboutUs/AboutUs";
import AdminMovies from "./Page/Main/Admin/AdminMovies/AdminMovies";
import Admin from "./Page/Main/Admin/Admin";
import AdminMovie from "./Page/Main/Admin/AdminMovies/Movie/AdminMovie";

function App() {

  return (
      <Routes>
          <Route path="/" element={<Layout/>}>
              <Route path={LOGIN} element={<Login/>} />
              <Route path={REGISTER} element={<Register/>} />

              <Route path={MOVIES} element={<Movies/>} />
              <Route path={MOVIES + ':id'} element={<Movie/>} />

              <Route path={ABOUT_US} element={<AboutUs/>}/>

              <Route element={<PersistLogin/>} >
                  <Route element={<RequireAdminRoleAuth/>} >
                      <Route path={ADMIN} element={<Admin/>} />
                      <Route path={ADMIN_MOVIES} element={<AdminMovies/>} />
                      <Route path={ADMIN_MOVIES + ':id'} element={<AdminMovie />} />
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
