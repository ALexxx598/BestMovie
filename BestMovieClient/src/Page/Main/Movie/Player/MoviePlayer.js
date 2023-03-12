import {Col, Row} from "react-bootstrap";
import ReactPlayer from "react-player";

const MoviePlayer = () => {
    return (
        <Row>
            <Col style={{marginTop: 20, marginLeft: 15, marginRight: 15}}>
                <ReactPlayer
                    width="100%"
                    height={600}
                    url="https://www.youtube.com/watch?v=_A-O22Eezac&t=9557s"
                    controls={true}
                    className='react-player'
                />
            </Col>
        </Row>
    )
}

export default MoviePlayer