import {Row, Button as ReactButton} from "react-bootstrap";


const Button = ({...props}) => {

    return (
        <Row className="space3">
            <ReactButton type="submit" variant="success" className="button">Submit</ReactButton>
        </Row>
    )
}

export default Button