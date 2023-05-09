import {useState} from "react";

const useMovieCategoryListRemoveModal = ({...props}) => {
    const [show, setShow] = useState(false)

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleRemove = async () => {
        console.log(props)
        await props.handleRemoveCategory(props.category)
        await props.fetchCategories()

        handleClose()
    }

    return {
        show,
        handleClose,
        handleShow,
        handleRemove
    }
}

export default useMovieCategoryListRemoveModal