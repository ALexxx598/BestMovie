import { initializeApp } from "firebase/app";

const firebaseConfig = {
    apiKey: "AIzaSyC0uiTZWI3pTAmtX0r2MNyL-txRQ3U1vck",
    authDomain: "bestmovie-ed755.firebaseapp.com",
    projectId: "bestmovie-ed755",
    storageBucket: "bestmovie-ed755.appspot.com",
    messagingSenderId: "192977526492",
    appId: "1:192977526492:web:d82004794067b03037de19"
};

const firebaseApp = initializeApp(firebaseConfig);

export default firebaseApp
