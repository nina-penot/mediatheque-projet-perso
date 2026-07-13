<!-- Hero Section -->
<div class="mediatheque-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <h1 class="hero-title">Bienvenue à la Médiathèque</h1>
        <p class="hero-subtitle">Explorez notre collection de livres, films et jeux vidéo</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="<?php echo url('media/library'); ?>" class="btn btn-hero-primary">
                    <i class="fas fa-search"></i> Découvrir la collection
                </a>
                <a href="<?php echo url('auth/register'); ?>" class="btn btn-hero-secondary">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </a>
            </div>
        <?php else: ?>
            <div class="welcome-user-message">
                <i class="fas fa-user-circle"></i>
                <span>Bon retour parmi nous, <strong><?php e($_SESSION['user_name']); ?></strong> !</span>
            </div>
            <div class="hero-buttons">
                <a href="<?php echo url('media/library'); ?>" class="btn btn-hero-primary">
                    <i class="fas fa-search"></i> Parcourir les médias
                </a>
                <a href="<?php echo url('home/profile'); ?>" class="btn btn-hero-secondary">
                    <i class="fas fa-user"></i> Mon profil
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Overdue Books Alert -->
<?php if (!empty($overdue_borrows) && is_logged_in()): ?>
<div class="overdue-alert-container">
    <div class="overdue-alert">
        <div class="alert-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="alert-content">
            <h3 class="alert-title">
                <i class="fas fa-clock"></i>
                <?php echo count($overdue_borrows) === 1 ? 'Vous avez un emprunt en retard' : 'Vous avez ' . count($overdue_borrows) . ' emprunts en retard'; ?>
            </h3>
            <p class="alert-description">Merci de retourner les médias suivants dès que possible :</p>
            <div class="overdue-items">
                <?php foreach ($overdue_borrows as $borrow): ?>
                    <div class="overdue-item">
                        <div class="overdue-item-icon">
                            <?php if ($borrow['type'] === 'Livre'): ?>
                                <i class="fas fa-book"></i>
                            <?php elseif ($borrow['type'] === 'Film'): ?>
                                <i class="fas fa-film"></i>
                            <?php else: ?>
                                <i class="fas fa-gamepad"></i>
                            <?php endif; ?>
                        </div>
                        <div class="overdue-item-info">
                            <span class="overdue-item-title"><?php e($borrow['media']); ?></span>
                            <span class="overdue-item-delay">
                                En retard de <strong><?php echo $borrow['days_overdue']; ?> jour<?php echo $borrow['days_overdue'] > 1 ? 's' : ''; ?></strong>
                                (à retourner le <?php echo date('d/m/Y', strtotime($borrow['due_at'])); ?>)
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="<?php echo url('home/profile'); ?>" class="btn-alert-action">
                <i class="fas fa-user"></i> Voir mon profil
            </a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Categories Section -->
<section class="mediatheque-categories">
    <div class="container">
        <h2 class="section-title">
            <i class="fas fa-th-large"></i>
            Nos Collections
        </h2>
        <p class="section-subtitle">Découvrez notre sélection de médias variés pour tous les goûts</p>

        <div class="categories-grid">
            <a href="<?php echo url('media/library?type=Livre'); ?>" class="category-card category-books">
                <div class="category-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Livres</h3>
                <p>Romans, essais, BD et plus encore</p>
                <div class="category-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

            <a href="<?php echo url('media/library?type=Film'); ?>" class="category-card category-movies">
                <div class="category-icon">
                    <i class="fas fa-film"></i>
                </div>
                <h3>Films</h3>
                <p>Cinéma, documentaires, séries</p>
                <div class="category-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>

            <a href="<?php echo url('media/library?type=Jeu'); ?>" class="category-card category-games">
                <div class="category-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3>Jeux vidéo</h3>
                <p>Consoles, PC, jeux de société</p>
                <div class="category-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="mediatheque-features">
    <div class="container">
        <h2 class="section-title">
            <i class="fas fa-star"></i>
            Pourquoi choisir notre médiathèque ?
        </h2>

        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon feature-icon-blue">
                    <i class="fas fa-infinity"></i>
                </div>
                <h3>Collection illimitée</h3>
                <p>Accédez à des milliers de titres dans tous les genres</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon feature-icon-purple">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Disponible 24/7</h3>
                <p>Réservez et gérez vos emprunts à tout moment</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon feature-icon-green">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <h3>Nouveautés régulières</h3>
                <p>Notre collection est mise à jour en permanence</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon feature-icon-orange">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3>Service personnalisé</h3>
                <p>Recommandations basées sur vos préférences</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="mediatheque-cta">
    <div class="cta-content">
        <h2>Prêt à commencer votre aventure ?</h2>
        <p>Rejoignez notre communauté de passionnés de culture</p>
        <?php if (!is_logged_in()): ?>
            <a href="<?php echo url('auth/register'); ?>" class="btn btn-cta">
                <i class="fas fa-rocket"></i> Créer mon compte gratuitement
            </a>
        <?php else: ?>
            <a href="<?php echo url('media/library'); ?>" class="btn btn-cta">
                <i class="fas fa-compass"></i> Explorer la bibliothèque
            </a>
        <?php endif; ?>
    </div>
</section>

<style>
/* Hero Section */
.mediatheque-hero {
    position: relative;
    background:
        linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%),
        url('data:image/svg+xml,<svg width="1200" height="600" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="books" x="0" y="0" width="200" height="200" patternUnits="userSpaceOnUse"><rect x="20" y="30" width="30" height="40" fill="rgba(255,255,255,0.03)" rx="2"/><rect x="55" y="25" width="35" height="45" fill="rgba(255,255,255,0.04)" rx="2"/><rect x="95" y="28" width="32" height="42" fill="rgba(255,255,255,0.035)" rx="2"/><rect x="132" y="32" width="28" height="38" fill="rgba(255,255,255,0.045)" rx="2"/><circle cx="40" cy="120" r="15" fill="rgba(255,255,255,0.025)"/><rect x="70" y="105" width="40" height="30" fill="rgba(255,255,255,0.03)" rx="3"/><path d="M 130 110 L 145 105 L 160 110 L 160 135 L 145 140 L 130 135 Z" fill="rgba(255,255,255,0.035)"/></pattern></defs><rect width="1200" height="600" fill="url(%23books)"/></svg>');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 4rem 2rem;
    overflow: hidden;
}

.mediatheque-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(250, 112, 154, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(67, 233, 123, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(79, 172, 254, 0.15) 0%, transparent 50%);
    animation: moveGradient 15s ease infinite;
}

@keyframes moveGradient {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -30px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 50% 50%, transparent 0%, rgba(0,0,0,0.3) 100%);
    backdrop-filter: blur(0px);
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
}

.hero-icon {
    font-size: 4rem;
    color: white;
    margin-bottom: 1.5rem;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.95);
    margin-bottom: 2rem;
    font-weight: 300;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: white;
    color: #667eea;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

.btn-hero-secondary {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: 2px solid white;
    backdrop-filter: blur(10px);
}

.btn-hero-secondary:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.welcome-user-message {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
    color: white;
    font-size: 1.1rem;
    border: 2px solid rgba(255,255,255,0.3);
}

.welcome-user-message i {
    font-size: 1.5rem;
}

/* Overdue Alert Section */
.overdue-alert-container {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    padding: 2rem 1rem;
    box-shadow: 0 4px 20px rgba(255, 107, 107, 0.3);
}

.overdue-alert {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    display: flex;
    gap: 2rem;
    animation: slideDown 0.5s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-icon {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    animation: pulse-warning 2s ease infinite;
}

@keyframes pulse-warning {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 15px rgba(255, 107, 107, 0);
    }
}

.alert-content {
    flex: 1;
}

.alert-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-title i {
    color: #ff6b6b;
}

.alert-description {
    color: #6c757d;
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

.overdue-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.overdue-item {
    background: #f8f9fa;
    border-left: 4px solid #ff6b6b;
    padding: 1rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
}

.overdue-item:hover {
    background: #fff5f5;
    transform: translateX(5px);
    box-shadow: 0 2px 10px rgba(255, 107, 107, 0.15);
}

.overdue-item-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.overdue-item-info {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.overdue-item-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.05rem;
}

.overdue-item-delay {
    color: #ff6b6b;
    font-size: 0.9rem;
}

.btn-alert-action {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    color: white;
    padding: 0.9rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
}

.btn-alert-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
}

/* Responsive for overdue alert */
@media (max-width: 768px) {
    .overdue-alert {
        flex-direction: column;
        padding: 1.5rem;
    }

    .alert-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
        margin: 0 auto;
    }

    .alert-title {
        font-size: 1.2rem;
        justify-content: center;
        text-align: center;
    }

    .alert-description {
        text-align: center;
    }

    .btn-alert-action {
        width: 100%;
        justify-content: center;
    }
}

/* Categories Section */
.mediatheque-categories {
    padding: 5rem 2rem;
    background: #f8f9fa;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
    color: #2c3e50;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.section-subtitle {
    text-align: center;
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 3rem;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.category-card {
    background: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    transition: height 0.3s ease;
}

.category-books::before {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.category-movies::before {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.category-games::before {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.category-card:hover::before {
    height: 100%;
    opacity: 0.05;
}

.category-icon {
    font-size: 4rem;
    margin-bottom: 1.5rem;
}

.category-books .category-icon {
    color: #00f2fe;
}

.category-movies .category-icon {
    color: #43e97b;
}

.category-games .category-icon {
    color: #fa709a;
}

.category-card h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.category-card p {
    color: #6c757d;
    margin-bottom: 1rem;
}

.category-arrow {
    font-size: 1.5rem;
    color: #667eea;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.category-card:hover .category-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* Features Section */
.mediatheque-features {
    padding: 5rem 2rem;
    background: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.feature-item {
    text-align: center;
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin: 0 auto 1.5rem;
    transition: transform 0.3s ease;
}

.feature-item:hover .feature-icon {
    transform: scale(1.1) rotate(5deg);
}

.feature-icon-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.feature-icon-purple {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.feature-icon-green {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.feature-icon-orange {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.feature-item h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2c3e50;
}

.feature-item p {
    color: #6c757d;
    line-height: 1.6;
}

/* Call to Action */
.mediatheque-cta {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 5rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.mediatheque-cta::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 15s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.cta-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
    margin: 0 auto;
}

.cta-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.cta-content p {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 2rem;
}

.btn-cta {
    background: white;
    color: #667eea;
    padding: 1.2rem 3rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .categories-grid {
        grid-template-columns: 1fr;
    }

    .cta-content h2 {
        font-size: 1.8rem;
    }
}
</style>