import { useState } from "react"

export default function Header({ appname }) {

    const [is_logged_in, setIsLoggedIn] = useState(false);
    const [is_admin, setIsAdmin] = useState(false);

    return (
        <header class="header">
            <nav class="navbar">
                <div class="nav-brand">
                    <a href="<?php echo url(); ?>">{appname}</a>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo url(); ?>" class="<?php echo ($current_route === '' || $current_route === 'home' || $current_route === 'home/index') ? 'active' : ''; ?>">Accueil</a></li>
                    <li><a href="<?php echo url('home/about'); ?>" class="<?php echo ($current_route === 'home/about') ? 'active' : ''; ?>">À propos</a></li>
                    <li><a href="<?php echo url('media/library'); ?>" class="<?php echo (strpos($current_route, 'media') === 0) ? 'active' : ''; ?>">Medias</a></li>
                    <li><a href="<?php echo url('home/contact'); ?>" class="<?php echo ($current_route === 'home/contact') ? 'active' : ''; ?>">Contact</a></li>

                    {is_logged_in && is_admin &&
                        <li><a href="<?php echo url('admin/dashboard'); ?>" class="btn-admin">⚙️ Administration</a></li>
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
                    <!-- <li><a href="//*<?php echo url('auth/forgot-password2'); ?>*//">Mot de passe oublié fatima et morad</a></li> -->
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
    )
}