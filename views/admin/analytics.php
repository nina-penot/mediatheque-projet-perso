<style>
    .analytics-container {
        padding: 0;
    }

    .analytics-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .analytics-header h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .analytics-header .icon {
        font-size: 2.5rem;
    }

    .analytics-header p {
        opacity: 0.95;
        font-size: 1.05rem;
        margin-top: 0.5rem;
    }

    .analytics-info {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
    }

    .analytics-info h3 {
        color: #333;
        margin-bottom: 0.75rem;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .analytics-info p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    .dashboard-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .dashboard-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-card-header h2 {
        font-size: 1.3rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .dashboard-card-header .badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    .dashboard-card-body {
        padding: 0;
        position: relative;
        background: #f8f9fa;
    }

    .grafana-embed {
        width: 100%;
        height: 800px;
        border: none;
        display: block;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
        z-index: 10;
    }

    .loading-spinner {
        border: 4px solid #f3f4f6;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .dashboard-actions {
        padding: 1rem 1.5rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-fullscreen {
        background: #667eea;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-fullscreen:hover {
        background: #5568d3;
        transform: translateX(3px);
    }

    .dashboard-info {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .info-item i {
        color: #667eea;
    }

    .quick-links {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .quick-links h3 {
        color: #333;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .quick-links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .quick-link-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 1.25rem;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 0.75rem;
    }

    .quick-link-card:hover {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .quick-link-card i {
        font-size: 2rem;
        color: #667eea;
    }

    .quick-link-card:hover i {
        color: white;
    }

    .quick-link-card span {
        font-weight: 600;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .analytics-header h1 {
            font-size: 1.5rem;
        }

        .grafana-embed {
            height: 500px;
        }

        .dashboard-card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .dashboard-actions {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .dashboard-info {
            justify-content: space-between;
            width: 100%;
        }

        .btn-fullscreen {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="analytics-container">
    <!-- Header -->
    <div class="analytics-header">
        <h1>
            <span class="icon">📊</span>
            Tableaux de Bord et Graphiques
        </h1>
        <p>Visualisez en temps réel les performances et statistiques complètes de votre médiathèque</p>
    </div>

    <!-- Info Banner détaillée -->
    <div class="analytics-info">
        <h3><i class="fas fa-info-circle"></i> Vue d'ensemble des statistiques</h3>
        <p style="margin-bottom: 1rem;">
            Cette section vous permet de visualiser <strong>toutes les statistiques</strong> de votre médiathèque grâce à des graphiques interactifs et en temps réel.
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem;">
            <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 3px solid #667eea;">
                <strong style="color: #667eea; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <i class="fas fa-chart-line"></i> Activité utilisateurs
                </strong>
                <small style="color: #666;">Connexions, inscriptions, emprunts actifs</small>
            </div>
            <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 3px solid #10b981;">
                <strong style="color: #10b981; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <i class="fas fa-books"></i> Catalogue médias
                </strong>
                <small style="color: #666;">Stock, emprunts, retards, popularité</small>
            </div>
            <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; border-left: 3px solid #f59e0b;">
                <strong style="color: #f59e0b; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <i class="fas fa-database"></i> Performance système
                </strong>
                <small style="color: #666;">Base de données, serveur, charge</small>
            </div>
        </div>
    </div>

    <!-- Dashboard principal -->
    <div class="dashboard-grid">
        <!-- Dashboard Grafana -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2>
                    <i class="fas fa-chart-bar"></i>
                    Statistiques Application
                </h2>
                <span class="badge">
                    <i class="fas fa-sync-alt"></i> Grafana
                </span>
            </div>
            <div class="dashboard-card-body" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center; padding: 3rem;">
                    <div style="font-size: 5rem; color: #667eea; margin-bottom: 1.5rem;">
                        <i class="fas fa-chart-area"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.5rem;">
                        Dashboard Grafana
                    </h3>
                    <p style="color: #666; margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                        Visualisez les statistiques détaillées de votre médiathèque : utilisateurs actifs, médias empruntés, tendances d'utilisation, et bien plus encore.
                    </p>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                        <small style="color: #666; line-height: 1.5;">
                            <i class="fas fa-info-circle" style="color: #667eea;"></i>
                            Pour des raisons de sécurité, le dashboard s'ouvre dans un nouvel onglet.
                        </small>
                    </div>
                    <a href="http://192.168.10.139:3000/d/ad7vxsg/dashoard-php-mvc-app?orgId=1&from=now-5m&to=now&timezone=browser" target="_blank" class="btn-fullscreen" style="display: inline-flex; font-size: 1.1rem; padding: 1rem 2rem;">
                        <i class="fas fa-external-link-alt"></i>
                        Ouvrir le Dashboard Grafana
                    </a>
                </div>
            </div>
            <div class="dashboard-actions">
                <div class="dashboard-info">
                    <div class="info-item">
                        <i class="fas fa-users"></i>
                        <span>Utilisateurs</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-book"></i>
                        <span>Médias & Emprunts</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Tendances</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monitoring Base de Données -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2>
                    <i class="fas fa-database"></i>
                    Monitoring Base de Données
                </h2>
                <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">
                    <i class="fas fa-heartbeat"></i> Netdata
                </span>
            </div>
            <div class="dashboard-card-body" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div style="text-align: center; padding: 3rem;">
                    <div style="font-size: 5rem; color: #10b981; margin-bottom: 1.5rem;">
                        <i class="fas fa-server"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.5rem;">
                        Surveillance Système
                    </h3>
                    <p style="color: #666; margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                        Surveillez en temps réel la charge de votre base de données, l'utilisation du CPU, de la RAM, et toutes les métriques système importantes.
                    </p>
                    <div style="background: #f0fdf4; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto; border: 1px solid #d1fae5;">
                        <small style="color: #065f46; line-height: 1.5; display: block; margin-bottom: 0.5rem;">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i>
                            <strong>Métriques disponibles :</strong>
                        </small>
                        <small style="color: #065f46; line-height: 1.5;">
                            • Charge MySQL/MariaDB<br>
                            • CPU & Mémoire<br>
                            • Requêtes par seconde<br>
                            • Performance disque
                        </small>
                    </div>
                    <a href="http://192.168.10.139:19999" target="_blank" class="btn-fullscreen" style="display: inline-flex; font-size: 1.1rem; padding: 1rem 2rem; background: #10b981;">
                        <i class="fas fa-external-link-alt"></i>
                        Ouvrir Netdata Monitoring
                    </a>
                </div>
            </div>
            <div class="dashboard-actions">
                <div class="dashboard-info">
                    <div class="info-item">
                        <i class="fas fa-database"></i>
                        <span>MySQL/MariaDB</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-microchip"></i>
                        <span>CPU & RAM</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-hdd"></i>
                        <span>Disque</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liens rapides -->
    <div class="quick-links">
        <h3>Accès rapides</h3>
        <div class="quick-links-grid">
            <a href="http://192.168.10.139:3000/d/ad7vxsg/dashoard-php-mvc-app?orgId=1&from=now-5m&to=now&timezone=browser" target="_blank" class="quick-link-card">
                <i class="fas fa-chart-area"></i>
                <span>Dashboard Grafana</span>
            </a>
            <a href="http://192.168.10.139:19999" target="_blank" class="quick-link-card">
                <i class="fas fa-server"></i>
                <span>Monitoring Netdata</span>
            </a>
            <a href="http://192.168.10.139:3000" target="_blank" class="quick-link-card">
                <i class="fas fa-cog"></i>
                <span>Administration Grafana</span>
            </a>
            <a href="<?php echo url('admin/dashboard'); ?>" class="quick-link-card">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard Simple</span>
            </a>
        </div>
    </div>
</div>
