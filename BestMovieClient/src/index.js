import React from 'react';
import { createRoot } from 'react-dom/client';
import {BrowserRouter, Routes, Route} from 'react-router-dom'
import './index.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import App from './App';
import {AuthProvider} from "./context/AuthProvider";
import { StyledEngineProvider } from '@mui/material/styles';

const container = document.getElementById('root');
const root = createRoot(container);

root.render(
    <React.StrictMode>
        <BrowserRouter>
            <AuthProvider>
                <StyledEngineProvider injectFirst>
                    <Routes>
                        <Route path="/*" element={<App />} />
                    </Routes>
                </StyledEngineProvider>
            </AuthProvider>
        </BrowserRouter>
    </React.StrictMode>
);

