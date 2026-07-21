import { useState } from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import './App.css';
import DefaultLayout from './layouts/DefaultLayout';
import Home from './pages/Home';

function App() {
  return (
    <Routes>
      <Route element={<DefaultLayout />}>
        <Route path='/' element={<Home />}></Route>
      </Route>
    </Routes>
  )
}

export default App
