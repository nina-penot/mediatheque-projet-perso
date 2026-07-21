import { useState } from "react";
import { Link, useLocation } from 'react-router-dom';

export default function Header({ appname }) {

    //A remplacer avec le hook auth
    const [is_logged_in, setIsLoggedIn] = useState(false);
    const [is_admin, setIsAdmin] = useState(false);
    const location = useLocation();

    console.log("location = ", location);

    return (
        <header className="header">
            <nav className="navbar">
                <div className="nav-brand">
                    <Link to={"/"}>{appname}</Link>
                </div>
                <ul className="nav-menu">
                    <li><Link to={"/"} className={location.pathname == "/" || location.pathname == "home" || location.pathname == "home/index" ? "active" : ""}>Accueil</Link></li>
                    <li><Link to={"home/about"} className={location.pathname == "home/about" ? "active" : ""}>À propos</Link></li>
                    <li><Link to={"media/library"} className={location.pathname == "media/library" ? "active" : ""}>Medias</Link></li>
                    <li><Link to={"home/contact"} className={location.pathname == "home/contact" ? "active" : ""}>Contact</Link></li>

                    {is_logged_in && is_admin &&
                        <li><Link to={"admin/dashboard"} className="btn-admin">⚙️ Administration</Link></li>
                    }


                    {is_logged_in ?
                        <>
                            <li><Link to={"home/profile"} className={location.pathname == "home/profile" ? "active" : ""}>Profil</Link></li>
                            <li><Link to={"auth/logout"} className="btn-logout-accueil"><i className="fas fa-sign-out-alt"></i> Déconnexion</Link></li>
                        </>
                        :
                        <>
                            <li><Link to={"auth/login"}>Connexion</Link></li>
                            <li><Link to={"auth/register"}>Inscription</Link></li>
                        </>
                    }


                </ul>
            </nav>
        </header>
    )
}