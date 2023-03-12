import Pagination from "@mui/material/Pagination";

const Paginator = ({...props}) => {

    return (
        <Pagination
            count={props.lastPage}
            page={props.currentPage}
            onChange={(_, num) => props.handleChangePage(num)}
            color="primary"
            className="paginatorBackground paginator"
        />
    );
}

export default Paginator