import {Col, Row} from "react-bootstrap";
import {ABOUT_US, DOMAIN, MOVIES, MY_MOVIE_COLLECTION} from "../../../Routes";
import './footer.css'

const Footer = () => {
    return (
        <Row className="mainTheme">
            <Row className="position">
                <Col className="pages">
                    <Col style={{fontSize: "24px"}}>
                        Сторінки
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        <a href={DOMAIN + MOVIES}>Фільми</a>
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        <a href={DOMAIN + MY_MOVIE_COLLECTION}>Мої коллекції фільмів</a>
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        <a href={DOMAIN + ABOUT_US}> Про нас </a>
                    </Col>
                </Col>
                <Col className="pages">
                    <Col style={{fontSize: "24px"}}>
                        Контакти
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        Телефон: +380964833585
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        Ім'я: Олексій
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        Прівище: Спесивцев
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        Група: КНТ-119
                    </Col>
                    <Col style={{marginTop: "1%", fontSize: "18px"}}>
                        Рік: 2023
                    </Col>
                </Col>
            </Row>
        </Row>
    )
}

export default Footer