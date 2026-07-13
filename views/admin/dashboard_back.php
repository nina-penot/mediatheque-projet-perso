<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc($title); ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <i class="fas fa-cog"></i>
            <h2>Admin Panel</h2>
        </div>
        <nav class="admin-nav">
            <a href="<?php echo url('admin'); ?>" class="admin-nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo url('admin/users'); ?>" class="admin-nav-item">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="<?php echo url('admin/medias'); ?>" class="admin-nav-item">
                <i class="fas fa-photo-video"></i>
                <span>Médias</span>
            </a>
            <a href="<?php echo url('admin/borrows'); ?>" class="admin-nav-item">
                <i class="fas fa-book-reader"></i>
                <span>Emprunts</span>
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
            <h1><?php echo esc($title); ?></h1>
            <div class="admin-user">
                <span>Bienvenue, <?php echo esc($_SESSION['user_name']); ?></span>
                <a href="<?php echo url('auth/logout'); ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="admin-content">
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card stat-users">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Utilisateurs</h3>
                        <p class="stat-number"><?php echo esc($total_users); ?></p>
                    </div>
                </div>

                <div class="stat-card stat-medias">
                    <div class="stat-icon">
                        <i class="fas fa-photo-video"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Médias</h3>
                        <p class="stat-number"><?php echo esc($total_medias); ?></p>
                    </div>
                </div>

                <div class="stat-card stat-books">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Livres</h3>
                        <p class="stat-number"><?php echo esc($total_books); ?></p>
                    </div>
                </div>

                <div class="stat-card stat-movies">
                    <div class="stat-icon">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Films</h3>
                        <p class="stat-number"><?php echo esc($total_movies); ?></p>
                    </div>
                </div>

                <div class="stat-card stat-games">
                    <div class="stat-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Jeux vidéos</h3>
                        <p class="stat-number"><?php echo esc($total_games); ?></p>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="admin-section">
                <h2><i class="fas fa-chart-bar"></i> Statistiques visuelles</h2>

                <?php
                // Calculer le maximum pour les pourcentages
                $max_value = max($total_users, $total_medias, $total_books, $total_movies, $total_games, 1);

                // Calculer les pourcentages
                $percent_users = ($total_users / $max_value) * 100;
                $percent_medias = ($total_medias / $max_value) * 100;
                $percent_books = ($total_books / $max_value) * 100;
                $percent_movies = ($total_movies / $max_value) * 100;
                $percent_games = ($total_games / $max_value) * 100;
                ?>

                <div class="charts-container">
                    <!-- Graphique Utilisateurs -->
                    <div class="chart-item">
                        <div class="chart-header">
                            <span class="chart-label">
                                <i class="fas fa-users"></i> Utilisateurs
                            </span>
                            <span class="chart-value"><?php echo esc($total_users); ?></span>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-fill chart-bar-users" style="width: <?php echo $percent_users; ?>%;"></div>
                        </div>
                    </div>

                    <!-- Graphique Médias totaux -->
                    <div class="chart-item">
                        <div class="chart-header">
                            <span class="chart-label">
                                <i class="fas fa-photo-video"></i> Médias (total)
                            </span>
                            <span class="chart-value"><?php echo esc($total_medias); ?></span>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-fill chart-bar-medias" style="width: <?php echo $percent_medias; ?>%;"></div>
                        </div>
                    </div>

                    <!-- Graphique Livres -->
                    <div class="chart-item">
                        <div class="chart-header">
                            <span class="chart-label">
                                <i class="fas fa-book"></i> Livres
                            </span>
                            <span class="chart-value"><?php echo esc($total_books); ?></span>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-fill chart-bar-books" style="width: <?php echo $percent_books; ?>%;"></div>
                        </div>
                    </div>

                    <!-- Graphique Films -->
                    <div class="chart-item">
                        <div class="chart-header">
                            <span class="chart-label">
                                <i class="fas fa-film"></i> Films
                            </span>
                            <span class="chart-value"><?php echo esc($total_movies); ?></span>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-fill chart-bar-movies" style="width: <?php echo $percent_movies; ?>%;"></div>
                        </div>
                    </div>

                    <!-- Graphique Jeux -->
                    <div class="chart-item">
                        <div class="chart-header">
                            <span class="chart-label">
                                <i class="fas fa-gamepad"></i> Jeux vidéo
                            </span>
                            <span class="chart-value"><?php echo esc($total_games); ?></span>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-fill chart-bar-games" style="width: <?php echo $percent_games; ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-section">
                <h2>Actions rapides</h2>
                <div class="quick-actions">
                    <a href="<?php echo url('admin/users'); ?>" class="action-card">
                        <i class="fas fa-user-plus"></i>
                        <span>Gérer les utilisateurs</span>
                    </a>
                    <a href="<?php echo url('admin/medias'); ?>" class="action-card">
                        <i class="fas fa-film"></i>
                        <span>Gérer les médias</span>
                    </a>
                    <a href="<?php echo url('media/library'); ?>" class="action-card">
                        <i class="fas fa-eye"></i>
                        <span>Voir la bibliothèque</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styles pour les graphiques */
        .charts-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-item {
            margin-bottom: 20px;
        }

        .chart-item:last-child {
            margin-bottom: 0;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .chart-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .chart-label i {
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        .chart-value {
            font-weight: bold;
            font-size: 16px;
            color: #555;
        }

        .chart-bar {
            background-color: #e9ecef;
            height: 30px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .chart-bar-fill {
            height: 100%;
            transition: width 0.8s ease;
            border-radius: 15px;
            position: relative;
        }

        /* Couleurs des barres */
        .chart-bar-users {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .chart-bar-medias {
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
        }

        .chart-bar-books {
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        }

        .chart-bar-movies {
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
        }

        .chart-bar-games {
            background: linear-gradient(90deg, #fa709a 0%, #fee140 100%);
        }

        /* Animation au chargement */
        @keyframes fillBar {
            from {
                width: 0;
            }
        }

        .chart-bar-fill {
            animation: fillBar 1.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .charts-container {
                padding: 15px;
            }

            .chart-label {
                font-size: 12px;
            }

            .chart-value {
                font-size: 14px;
            }

            .chart-bar {
                height: 25px;
            }
        }
    </style>
</body>

</html>