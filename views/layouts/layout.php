<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" 0>
</head>

<body>
    <?php
    // Détection de la page active
    $current_path = $_SERVER['REQUEST_URI'];
    $base_path = parse_url(url(), PHP_URL_PATH);
    $current_route = str_replace($base_path, '', $current_path);
    $current_route = trim($current_route, '/');
    $current_route = explode('?', $current_route)[0]; // Retirer les paramètres GET
    ?>
    <header class="header">
        <nav class="navbar">
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo url(); ?>" class="<?php echo ($current_route === '' || $current_route === 'home' || $current_route === 'home/index') ? 'active' : ''; ?>">Accueil</a></li>
                <li><a href="<?php echo url('home/about'); ?>" class="<?php echo ($current_route === 'home/about') ? 'active' : ''; ?>">À propos</a></li>
                <li><a href="<?php echo url('media/library'); ?>" class="<?php echo (strpos($current_route, 'media') === 0) ? 'active' : ''; ?>">Medias</a></li>
                <li><a href="<?php echo url('home/contact'); ?>" class="<?php echo ($current_route === 'home/contact') ? 'active' : ''; ?>">Contact</a></li>
                <?php if (is_logged_in() && is_admin()): ?>
                    <li><a href="<?php echo url('admin/dashboard'); ?>" class="btn-admin">⚙️ Administration</a></li>
                <?php endif; ?>
                <?php if (is_logged_in()): ?>
                    <li><a href="<?php echo url('home/profile'); ?>" class="<?php echo ($current_route === 'home/profile') ? 'active' : ''; ?>">Profil</a></li>
                    <li><a href="<?php echo url('auth/logout'); ?>" class="btn-logout-accueil">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a></li>
                <?php else: ?>
                    <li><a href="<?php echo url('auth/login'); ?>">Connexion</a></li>
                    <li><a href="<?php echo url('auth/register'); ?>">Inscription</a></li>
                    <!-- <li><a href="//*<?php echo url('auth/forgot-password2'); ?>*//">Mot de passe oublié fatima et morad</a></li> -->
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Tous droits réservés.</p>
            <p>Version <?php echo APP_VERSION; ?></p>
        </div>
    </footer>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>

</html>