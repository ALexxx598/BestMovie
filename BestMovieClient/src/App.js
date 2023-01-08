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

function App() {

  return (
      <Routes>
          <Route path="/" element={<Layout/>}>
              <Route path="login" element={<Login/>} />
              <Route path="register" element={<Register/>} />
              <Route path="movies" element={<Movies/>} />
              <Route path="movieCollections" element={<MovieCollections/>} />
              <Route path="movies/:id" element={<Movie/>} />

              <Route element={<RequireAdminRoleAuth/>} >
                <Route path="admin" element={<Admin/>} />
              </Route>

              <Route element={<RequireViewerAuth/>} >
                  <Route path="myMovieCollections" element={<MyMovieCollections/>} />
              </Route>

          </Route>
      </Routes>
  );
}

export default App;
