import {Col, Row} from "react-bootstrap";

const MovieDescription = ({...props}) => {

    return (
        <Row>
            <Col sm={4}>
                <img
                    className="containerImg"
                    src={
                        props.movie?.storageImageUrl
                    }
                >
                </img>
            </Col>
            <Col sm={8} className="mainDataCol">
                <Row>
                    <Col xxl={2}>
                        Rating:
                    </Col>
                    <Col>
                        {props.movie?.description?.rating ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Slogan
                    </Col>
                    <Col style={{marginTop: 20}}>
                        {props.movie?.description?.slogan ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Date of screening
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.screeningDate ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Country
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.country ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Categories
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.getCategoriesAsText()}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Actors
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.actors ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Short Description
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.shortDescription ?? 'unknown'}
                    </Col>
                </Row>
            </Col>
        </Row>
    )
}

export default MovieDescription