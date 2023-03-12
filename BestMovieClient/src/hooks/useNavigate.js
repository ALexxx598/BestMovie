import {useLocation, useNavigate as useReactNavigate} from "react-router-dom";

const useNavigate = () => {
    const navigate = useReactNavigate();
    const location = useLocation()
    const from = location.state?.from?.pathname

    return {
        navigate,
        from,
    }
}

export default useNavigate