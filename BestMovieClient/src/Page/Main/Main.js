import {Fragment} from "react";
import "../Main/NavBar/navBar.css";
import useMain from "./useMain";
import NavBar from "./NavBar/NavBar";

const Main = () => {
    const mainHook = useMain()

    return (
        <div>
           <NavBar/>
        </div>
    )
}

export default Main