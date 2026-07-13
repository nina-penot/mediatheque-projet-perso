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

<!-- CSS pour Grafana -->
<style>
    .grafana-section {
        margin-top: 40px;
    }

    .grafana-container {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 40px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .grafana-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(102, 126, 234, 0.4);
    }

    .grafana-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.1;
        background:
                radial-gradient(circle at 20% 50%, rgba(255,255,255,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.2) 0%, transparent 50%);
    }

    .grafana-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .grafana-text h2 {
        font-size: 32px;
        color: white;
        margin-bottom: 12px;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .grafana-text p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .grafana-icon {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: white;
        backdrop-filter: blur(10px);
        flex-shrink: 0;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.95);
        color: #667eea;
        padding: 14px 32px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .cta-button:hover {
        background: white;
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .cta-button i {
        font-size: 18px;
    }

    .info-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .badge {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .badge i {
        font-size: 12px;
    }

    .grafana-embed-section {
        margin-top: 40px;
    }

    .grafana-embed-section h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .grafana-embed-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e0e0e0;
    }

    .grafana-embed-container iframe {
        display: block;
    }

    .embed-info {
        margin-top: 15px;
        font-size: 14px;
        color: #666;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        background: #f5f5f5;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .embed-info i {
        color: #667eea;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .grafana-content {
            flex-direction: column;
            text-align: center;
        }

        .grafana-text h2 {
            font-size: 24px;
        }

        .grafana-container {
            padding: 30px;
        }

        .grafana-icon {
            width: 100px;
            height: 100px;
            font-size: 50px;
        }

        .grafana-embed-container {
            height: 400px;
        }

        .grafana-embed-section h2 {
            font-size: 20px;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .grafana-container {
        animation: slideIn 0.6s ease-out;
    }
</style>