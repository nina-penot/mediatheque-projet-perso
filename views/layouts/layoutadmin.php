<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc($title); ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/css/style_admin.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <i class="fas fa-cog"></i>
            <h2>Admin Panel</h2>
        </div>
        <?php
        // Récupérer l'URL actuelle pour déterminer la page active
        $current_url = $_SERVER['REQUEST_URI'];
        $current_page = '';

        // Extraire la page actuelle de l'URL
        if (strpos($current_url, '/admin/dashboard') !== false) {
            $current_page = 'dashboard';
        } elseif (strpos($current_url, '/admin/users') !== false) {
            $current_page = 'users';
        } elseif (strpos($current_url, '/admin/medias') !== false || strpos($current_url, '/admin/add_media') !== false || strpos($current_url, '/admin/edit_media') !== false) {
            $current_page = 'medias';
        } elseif (strpos($current_url, '/admin/borrows') !== false) {
            $current_page = 'borrows';
        } elseif (strpos($current_url, '/admin/contacts') !== false) {
            $current_page = 'contacts';
        } elseif (strpos($current_url, '/admin/analytics') !== false) {
            $current_page = 'analytics';
        } elseif (strpos($current_url, '/admin/documentation') !== false) {
            $current_page = 'documentation';
        }
        ?>
        <nav class="admin-nav">
            <a href="<?php echo url('admin/dashboard'); ?>" class="admin-nav-item <?php echo $current_page === 'dashboard' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo url('admin/users'); ?>" class="admin-nav-item <?php echo $current_page === 'users' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="<?php echo url('admin/medias'); ?>" class="admin-nav-item <?php echo $current_page === 'medias' ? 'active' : ''; ?>">
                <i class="fas fa-photo-video"></i>
                <span>Médias</span>
            </a>
            <a href="<?php echo url('admin/borrows'); ?>" class="admin-nav-item <?php echo $current_page === 'borrows' ? 'active' : ''; ?>">
                <i class="fas fa-book-reader"></i>
                <span>Emprunts</span>
            </a>
            <a href="<?php echo url('admin/contacts'); ?>" class="admin-nav-item <?php echo $current_page === 'contacts' ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i>
                <span>Messages de contact</span>
            </a>
            <a href="<?php echo url('admin/analytics'); ?>" class="admin-nav-item <?php echo $current_page === 'analytics' ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i>
                <span>Graphiques</span>
            </a>
            <a href="<?php echo url('admin/documentation'); ?>" class="admin-nav-item <?php echo $current_page === 'documentation' ? 'active' : ''; ?>">
                <i class="fas fa-book"></i>
                <span>Documentation</span>
            </a>
            <a href="<?php echo url('home'); ?>" class="admin-nav-item">
                <i class="fas fa-home"></i>
                <span>Retour au site</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <header class="admin-header">
            <div class="admin-header-left">
                <button id="sidebarToggle" class="sidebar-toggle-btn" title="Cacher/Afficher le menu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1><?php echo esc($title); ?></h1>
            </div>
            <div class="admin-user">
                <span>Bienvenue, <?php echo esc($_SESSION['user_name']); ?></span>
                <a href="<?php echo url('auth/logout'); ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            <?php flash_messages(); ?>
            <?php echo $content ?? ''; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.admin-sidebar');
            const adminMain = document.querySelector('.admin-main');
            const body = document.body;

            // Récupérer l'état de la sidebar depuis localStorage
            const sidebarState = localStorage.getItem('sidebarCollapsed');
            if (sidebarState === 'true') {
                body.classList.add('sidebar-collapsed');
            }

            toggleBtn.addEventListener('click', function() {
                body.classList.toggle('sidebar-collapsed');

                // Sauvegarder l'état dans localStorage
                const isCollapsed = body.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });
        });
    </script>
</body>

</html>