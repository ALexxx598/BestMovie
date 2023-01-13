import {Row, Button as ReactButton} from "react-bootstrap";


const ButtonClose = ({...props}) => {

    return (
        <Row className="space3">
            <ReactButton type="submit" variant="danger" className="button" onClick={props?.onClick}>
                {props?.text ?? "Submit"}
            </ReactButton>
        </Row>
    )
}

export default ButtonClose