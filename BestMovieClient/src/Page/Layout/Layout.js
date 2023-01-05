import { Outlet } from "react-router-dom"
import '../../app.css'

const Layout = () => {
    return (
        <main className="backgroundContainer">
            <Outlet className="backgroundContainer"/>
        </main>
    )
}

export default Layout