import {useRef, useState, useEffect} from "react";
import {faCheck, faTimes, faInfoCircle} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import UserApiService from "./Api/UserApi/UserApiService";

const USER_REGEX = /^[a-zA-Z][a-zA-Z0-9-_]{3,23}$/;
const PASSWORD_REGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]])(?=.*[!@#$%]]).{8,24}$/;

const Register = () => {
    const userRef = useRef()
    const errRef = useRef()

    const [user, setUser] = useState('')
    const [validName, setValidName] = useState(false)
    const [userFocus, setUserFocus] = useState(false)

    const [password, setPassword] = useState('')
    const [validPassword, setValidPassword] = useState(false)
    const [passwordFocus, setPasswordFocus] = useState(false)

    const [matchPassword, setMatchPassword] = useState('')
    const [validMatch, setValidMatch] = useState(false)
    const [matchFocus, setMatchFocus] = useState(false)

    const [errMsg, setErrMsg] = useState('')
    const [success, setSuccess] = useState(false)

    useEffect(() => {
        userRef.current.focus();
    }, [])

    useEffect(() => {
        const result = USER_REGEX.test(user);
        console.log('name:' + result)
        setValidName(result)
    }, [user])

    useEffect(() => {
        const result = PASSWORD_REGEX.test(password);
        // const result = true
        setValidPassword(result)
        console.log('password:' + result)

        const match = password === matchPassword
        console.log('match:' + match)
        setValidMatch(match)

    }, [password, matchPassword])

    // useEffect(() => {
    //     setErrMsg('')
    // }, [user, password, matchPassword])

    const handleSubmit = async (e) => {
        e.preventDefault()

        if (!USER_REGEX.test(user) && !PASSWORD_REGEX.test(password)) {
            setErrMsg("Invalid Entity");
            return;
        }

        const response = UserApiService.register(user, password)

        setSuccess(true)
    }

    return (
        <>
        {
            success
            ? (<section>
                <h1>Success</h1>
                <p>
                    <a href="#">Sign in</a>
                </p>
            </section>)
            : (<section>
                <p
                    ref = {errRef}
                    className = {
                        errMsg ? "errmsg" : "offscreen"
                    }
                    aria-live = "assertive"
                >
                    {errMsg}
                </p>
                <h1>Register</h1>
                <form onSubmit={handleSubmit}>
                    <label htmlFor="username">
                        UserName:
                        {/*<span className={validName ? "valid" : "hide"}>*/}
                        {/*    <FontAwesomeIcon icon={faCheck} />*/}
                        {/*</span>*/}
                        {/*<span className={validName || !user ? "hide" : "invalid"}>*/}
                        {/*    <FontAwesomeIcon icon={faTimes} />*/}
                        {/*</span>*/}
                    </label>
                    <input
                        type="text"
                        id="username"
                        ref={userRef}
                        autoComplete="off"
                        onChange={(e) => setUser(e.target.value)}
                        required
                        aria-invalid={!validName}
                        aria-describedby="uidnote"
                        onFocus={() => setUserFocus(true)}
                        onBlur={() => setUserFocus(false)}
                    />
                    {/*<p*/}
                    {/*    id="uidnote"*/}
                    {/*    className={userFocus && user && !validName ? "instructions" : "offscreen"}*/}
                    {/*>*/}
                    {/*    <FontAwesomeIcon icon={faInfoCircle} />*/}
                    {/*    4 to  24 characters. <br/>*/}
                    {/*    Must begin with letter. <br/>*/}
                    {/*    Letters, numbers, underscores, hyphens allowed.*/}
                    {/*</p>*/}

                    <label htmlFor="password">
                        Password:
                        {/*<span className={validPassword ? "valid" : "hide"}>*/}
                        {/*    <FontAwesomeIcon icon={faCheck} />*/}
                        {/*</span>*/}
                        {/*<span className={validPassword || !password ? "hide" : "invalid"}>*/}
                        {/*    <FontAwesomeIcon icon={faTimes} />*/}
                        {/*</span>*/}
                    </label>
                    <input
                        type="password"
                        id="password"
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        aria-invalid={!validPassword}
                        aria-describedby="pwdnote"
                        onFocus={() => setPasswordFocus(true)}
                        onBlur={() => setPasswordFocus(false)}
                    />
                    {
                        !validPassword ? (
                            <p id="pwdnote">
                                <FontAwesomeIcon icon={faInfoCircle} />
                                4 to  24 characters. <br/>
                                Must begin with letter. <br/>
                                Letters, numbers, underscores, hyphens allowed.
                            </p>
                        ) : null
                    }

                    <label htmlFor="confirmation_password">
                        Confirmation password:
                        {/*<span className={validMatch && matchPassword ? "valid" : "hide"}>*/}
                        {/*    <FontAwesomeIcon icon={faCheck} />*/}
                        {/*</span>*/}
                        {/*<span className={validMatch || !matchPassword ? "hide" : "invalid"}>*/}
                        {/*    <FontAwesomeIcon icon={faTimes} />*/}
                        {/*</span>*/}
                    </label>
                    <input
                        type="password"
                        id="confirmation_password"
                        onChange={(e) => setMatchPassword(e.target.value)}
                        required
                        aria-invalid={!validMatch}
                        aria-describedby="confirmnote"
                        onFocus={() => setPasswordFocus(true)}
                        onBlur={() => setPasswordFocus(false)}
                    />
                    <p
                        id="confirmnote"
                        className={matchFocus && !validMatch ? "instructions" : "offscreen"}
                    >
                        <FontAwesomeIcon icon={faInfoCircle} />
                        {/*must match*/}
                    </p>

                    <button disabled={!validName || !validPassword || !validMatch}>
                    {/*<button>*/}
                        Sign up
                    </button>
                </form>
                <p>
                <span className="line">
                    <a href="#">Sign in</a>
                </span>
                </p>
            </section>)

        }
        </>
    )
}

export default Register