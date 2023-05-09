import {useState} from "react";

const useMovieCollectionListRemoveModal = ({...props}) => {
    const [show, setShow] = useState(false)

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const handleRemove = async () => {
        console.log(props)
        await props.handleRemoveCollection(props.collection)
        await props.fetchDefaultCollections()

        handleClose()
    }

    return {
        show,
        handleClose,
        handleShow,
        handleRemove
    }
}
export default useMovieCollectionListRemoveModal