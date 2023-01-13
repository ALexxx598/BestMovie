import {Col, Row} from "react-bootstrap";

const MovieModalDescription = ({...props}) => {
    return (
        <div className="movieModalPreview">
            <Row>
                <Col className="movieModalPreviewHeader">
                    <h3>{props?.movie?.name}</h3>
                </Col>
            </Row>
            <Row>
                <Col>
                    <img
                        className="movieModalContainerImg"
                        src={
                            "https://m.media-amazon.com/images/M/MV5BOGE4NzU1YTAtNzA3Mi00ZTA2LTg2YmYtMDJmMThiMjlkYjg2XkEyXkFqcGdeQXVyNTgzMDMzMTg@._V1_.jpg"
                        }
                    >
                    </img>
                </Col>
                <Col>
                    <Row>
                        <Col>
                            Rating:
                        </Col>
                        <Col>
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