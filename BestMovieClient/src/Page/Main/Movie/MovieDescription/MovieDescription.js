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
                        Рейтинг:
                    </Col>
                    <Col>
                        {props.movie?.description?.rating ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Слоган:
                    </Col>
                    <Col style={{marginTop: 20}}>
                        {props.movie?.description?.slogan ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Дата публікації:
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.screeningDate ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Країна:
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.country ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Категорії:
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.getCategoriesAsText()}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Актори:
                    </Col>
                    <Col className="spaceBetweenCol">
                        {props.movie?.description?.actors ?? 'unknown'}
                    </Col>
                </Row>
                <Row>
                    <Col xxl={2} className="spaceBetweenCol">
                        Короткий опис:
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