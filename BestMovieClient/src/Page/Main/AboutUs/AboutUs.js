import NavBar from "../NavBar/NavBar";
import {Col, Row} from "react-bootstrap";

import './aboutUs.css'
import Footer from "../Footer/Footer";

const AboutUs = () => {
    return (
        <div style={{backgroundColor: "#0c1e25", width: "100%", position: "absolute", height: "100%"}}>
            <NavBar aboutUs={true}/>
            <div>
                <Row>
                    <Col xs={6} md={{ span: 8, offset: 2}} className="aboutUs">
                        <p>Цей проект розробив студент 4 курсу НУ "ЗП" - Спесивцев Олексій Костянтинович, група КНТ-119.</p>
                        <p>Best Movie - це сервіс з перегляду фільмів, трейлерів, новин кіноіндустрії.</p>
                        <p>У сервісі BestMovie існує три ролі - звичайний користувач, зареєстрований користувач і адмісністратор.</p>
                        <p>Окремо слід виділити зареєстрованного користувача, він має можливість сортувати фільми</p>
                        <p>по власним коллекціям. Колекції може сторювати як звичайний користувача так і адміністратор,</p>
                        <p>але вони мають різні типи і в залежності від типу дозволи на редагування</p>
                    </Col>
                </Row>
            </div>
        </div>
    )
}

export default AboutUs