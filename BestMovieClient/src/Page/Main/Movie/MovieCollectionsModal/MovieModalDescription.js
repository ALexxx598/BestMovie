import {Col, Row} from "react-bootstrap";

const MovieModalDescription = ({...props}) => {
    return (
        <div className="movieModalPreview">
            <Row>
                <Col xs={6} md={4}>
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
                        <Col xs={6} md={4}>
                            Рейтинг:
                        </Col>
                        <Col>
                            {props.movie?.description?.rating ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col xs={6} md={4} className="spaceBetweenCol">
                            Слоган:
                        </Col>
                        <Col style={{marginTop: 20}}>
                            {props.movie?.description?.slogan ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col xs={6} md={4} className="spaceBetweenCol">
                            Дата публікації:
                        </Col>
                        <Col className="spaceBetweenCol">
                            {props.movie?.description?.screeningDate ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col xs={6} md={4} className="spaceBetweenCol">
                            Країна:
                        </Col>
                        <Col className="spaceBetweenCol">
                            {props.movie?.description?.country ?? 'unknown'}
                        </Col>
                    </Row>
                    <Row>
                        <Col xs={6} md={4} className="spaceBetweenCol">
                            Актори:
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