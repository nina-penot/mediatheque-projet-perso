import { useState } from "react";
import { Link, useLocation } from 'react-router-dom';

export default function Header({ appname }) {

    //A remplacer avec le hook auth
    const [is_logged_in, setIsLoggedIn] = useState(false);
    const [is_admin, setIsAdmin] = useState(false);
    const location = useLocation();

    return (
        <header class="header">
            <nav class="navbar">
                <div class="nav-brand">
                    <Link to={"/"}>{appname}</Link>
                </div>
                <ul class="nav-menu">
                    <li><Link to={"/"} className={location == "" || location == "home" || location == "home/index" && "active"}>Accueil</Link></li>
                    <li><Link to={"home/about"} className={location == "home/about" && active}>À propos</Link></li>
                    <li><Link to={"media/library"} className={location == "media/library" && "active"}>Medias</Link></li>
                    <li><Link to={"home/contact"} className={location == "home/contact" && "active"}>Contact</Link></li>

                    {is_logged_in && is_admin &&
                        <li><Link to={"admin/dashboard"} className="btn-admin">⚙️ Administration</Link></li>
                    }


                    {is_logged_in ?
                        <>
                            <li><Link to={"home/profile"} className={location == "home/profile" && "active"}>Profil</Link></li>
                            <li><Link to={"auth/logout"} className="btn-logout-accueil"><i class="fas fa-sign-out-alt"></i> Déconnexion</Link></li>
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