import { Outlet } from 'react-router-dom';
import Header from '../components/Header.jsx';
import Footer from '../components/Footer.jsx';

export default function DefaultLayout() {
    return (
        <>
            <Header appname={"appname"}></Header>
            <Footer appname={"appname"} version={"1.0"}></Footer>
        </>

    )
}