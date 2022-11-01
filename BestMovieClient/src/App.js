import {Routes, Route} from "react-router-dom";
import Register from "./Page/Register/Register";
import Login from "./Page/Login/Login";
import Main from "./Page/Main/Main";
import Layout from "./Page/Layout/Layout";
import RequireAuth from "./hooks/useRequireAuth";
import './app.css'
import Admin from "./Page/Admin/Admin";

function App() {

  return (
      <Routes>
          <Route path="/" element={<Layout/>}>
              <Route path="login" element={<Login/>} />
              <Route path="register" element={<Register/>} />
              <Route path="main" element={<Main/>} />

              <Route element={<RequireAuth/>}>
                <Route path="admin" element={<Admin/>}/>
              </Route>
          </Route>
      </Routes>
  );
}

export default App;
