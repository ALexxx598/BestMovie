import AdminNavBar from "./AdminNavBar/AdminNavBar";
import {useAuth} from "../../../hooks/useAuth";
import './admin.css';
import AdminMovies from "./AdminMovies/AdminMovies";

const Admin = () => {
    return (
        <div className="adminBackground">
            <AdminMovies/>
        </div>
    )
}

export default Admin