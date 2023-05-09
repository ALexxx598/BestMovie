import {Col, Row} from "react-bootstrap";

const MoviePlayer = ({...props}) => {
    return (
        <Row>
            <Col style={{marginTop: 20, marginLeft: 15, marginRight: 15}}>
                {
                    props.isLoading
                        ? <video
                            controls
                            className="reactPlayer"
                        >
                            <source src={props?.videoUrl}/>
                        </video>
                        : null
                }
            </Col>
        </Row>
    )
}

export default MoviePlayer