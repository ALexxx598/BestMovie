import AdminNavBar from "./AdminNavBar/AdminNavBar";
import {useAuth} from "../../../hooks/useAuth";
import './admin.css';

const Admin = () => {
    return (
        <div className="adminBackground">
            <AdminNavBar/>
        </div>
    )
}

export default Admin