import {Col, Row} from "react-bootstrap";
import './movieAddModalDescription.css'

const MovieAddModalDescription = ({...props}) => {
    return (
        <div className="movieModalPreview">
            <Row>
                <Col style={{marginTop: "5%", marginLeft: "5%"}}>
                    <Row>
                        <Col sm={4}>
                            <label htmlFor="moviePoster"> Завнтажити афішу </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="moviePoster"
                                name="moviePoster"
                                type="file"
                                onChange={(event) => {
                                    props.setImage(event.currentTarget.files[0]);
                                }}
                                value={props?.image?.name}
                                className={!props.formik.errors.moviePoster
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.moviePoster
                                    ? <span className="formikError">{props.formik.errors.moviePoster}</span>
                                    : null //TODO refactor
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="movieVideo"> Завантажити фільм </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="movieVideo"
                                name="movieVideo"
                                type="file"
                                onChange={(event) => {
                                    props.setVideo(event.currentTarget.files[0]);
                                }}
                                value={props?.video?.name}
                                className={
                                    !props.formik.errors.movieVideo
                                        ? "form-control"
                                        : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.movieVideo
                                    ? <span className="formikError">{props.formik.errors.movieVideo}</span>
                                    : null //TODO refactor
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="name"> Назва </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.name}
                                className={ !props.formik.errors.name
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.name
                                    ? <span className="formikError">{props.formik.errors.name}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="rating"> Рейтинг </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="rating"
                                name="rating"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.rating}
                                className={ !props.formik.errors.rating
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.rating
                                    ? <span className="formikError">{props.formik.errors.rating}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="slogan"> Слоган </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="slogan"
                                name="slogan"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.slogan}
                                className={ !props.formik.errors.slogan
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.slogan
                                    ? <span className="formikError">{props.formik.errors.slogan}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="screeningDate"> Дата публікації </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="screeningDate"
                                name="screeningDate"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.screeningDate}
                                className={ !props.formik.errors.screeningDate
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.screeningDate
                                    ? <span className="formikError">{props.formik.errors.screeningDate}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="country"> Країна </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="country"
                                name="country"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.country}
                                className={ !props.formik.errors.country
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.country
                                    ? <span className="formikError">{props.formik.errors.country}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}}>
                        <Col sm={4}>
                            <label htmlFor="actors"> Актори </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <input
                                id="actors"
                                name="actors"
                                type="text"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.actors}
                                className={ !props.formik.errors.actors
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.actors
                                    ? <span className="formikError">{props.formik.errors.actors}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                    <Row style={{marginTop: "5%"}} className="shortDescriptionInput">
                        <Col sm={4}>
                            <label htmlFor="shortDescription"> Короткий опис </label>
                        </Col>
                        <Col style={{display: "flex"}}>
                            <textarea
                                id="shortDescription"
                                name="shortDescription"
                                onChange={props.formik.handleChange}
                                value={props.formik.values.shortDescription}
                                className={ !props.formik.errors.shortDescription
                                    ? "form-control"
                                    : "form-control inputBottomBorder"
                                }
                            />
                            {
                                props.formik.errors.shortDescription
                                    ? <span className="formikError">{props.formik.errors.shortDescription}</span>
                                    : null
                            }
                        </Col>
                    </Row>
                </Col>
            </Row>
        </div>
    )
}

export default MovieAddModalDescription