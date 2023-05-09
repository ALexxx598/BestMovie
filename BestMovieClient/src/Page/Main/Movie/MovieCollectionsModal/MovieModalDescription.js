import {Col, Row} from "react-bootstrap";

const MovieModalDescription = ({...props}) => {
    return (
        <div className="movieModalPreview">
            <Row>
                <Col>
                    <img
                        className="movieModalContainerImg"
                        src={
                            props.movie?.storageImageUrl
                        }
                    >
                    </img>
                </Col>
                <Col>
                    <Row>
                        <Col>
                            Name:
                        </Col>
                        <Col>
                            {props?.movie?.name ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col className="spaceBetweenCol">
                            Rating:
                        </Col>
                        <Col style={{marginTop: 20}}>
                            {props.movie?.description?.rating ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col className="spaceBetweenCol">
                            Slogan
                        </Col>
                        <Col style={{marginTop: 20}}>
                            {props.movie?.description?.slogan ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col className="spaceBetweenCol">
                            Date of screening
                        </Col>
                        <Col className="spaceBetweenCol">
                            {props.movie?.description?.screeningDate ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col className="spaceBetweenCol">
                            Country
                        </Col>
                        <Col className="spaceBetweenCol">
                            {props.movie?.description?.country ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col className="spaceBetweenCol">
                            Actors
                        </Col>
                        <Col className="spaceBetweenCol">
                            {props.movie?.description?.actors ?? 'unknown'}
                        </Col>
                    </Row>
                </Col>
            </Row>
        </div>
    )
}

export default MovieModalDescription