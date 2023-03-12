import { Outlet } from "react-router-dom"
import '../../app.css'

const Layout = () => {
    return (
        <main>
            <Outlet/>
        </main>
    )
}

export default Layout