import { useState } from "react";
import { Link, useLocation } from 'react-router-dom';

export default function Header({ appname }) {

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


                    {is_logged_in &&
                        <>
                            <li><a href="<?php echo url('home/profile'); ?>" class="<?php echo ($current_route === 'home/profile') ? 'active' : ''; ?>">Profil</a></li>
                            <li><a href="<?php echo url('auth/logout'); ?>" class="btn-logout-accueil">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a></li>
                        </>
                    }

                    <li><a href="<?php echo url('auth/login'); ?>">Connexion</a></li>
                    <li><a href="<?php echo url('auth/register'); ?>">Inscription</a></li>
                </ul>
            </nav>
        </header>
    )
}