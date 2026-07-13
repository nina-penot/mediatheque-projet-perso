<style>
    .doc-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .doc-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .doc-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .doc-header .subtitle {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    /* Layout avec sidebar */
    .doc-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2rem;
        align-items: start;
    }

    .doc-nav {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 20px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
    }

    /* Scrollbar personnalisée pour la nav */
    .doc-nav::-webkit-scrollbar {
        width: 6px;
    }

    .doc-nav::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .doc-nav::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }

    .doc-nav::-webkit-scrollbar-thumb:hover {
        background: #5568d3;
    }

    .doc-nav h3 {
        margin-bottom: 1rem;
        color: #333;
        font-size: 1.1rem;
        border-bottom: 2px solid #667eea;
        padding-bottom: 0.5rem;
    }

    .doc-nav-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .doc-nav-list a {
        color: #555;
        text-decoration: none;
        padding: 0.6rem 0.75rem;
        border-radius: 6px;
        transition: all 0.2s;
        display: block;
        font-size: 0.95rem;
        border-left: 3px solid transparent;
    }

    .doc-nav-list a:hover {
        background: #f0f4ff;
        color: #667eea;
        border-left-color: #667eea;
        padding-left: 1rem;
    }

    .doc-content-wrapper {
        min-width: 0;
    }

    /* Sur mobile, retour au layout vertical */
    @media (max-width: 968px) {
        .doc-layout {
            grid-template-columns: 1fr;
        }

        .doc-nav {
            position: relative;
            top: auto;
            max-height: none;
            margin-bottom: 2rem;
        }

        .doc-nav-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.5rem;
        }
    }

    .doc-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .doc-section h2 {
        color: #333;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #667eea;
    }

    .doc-section h3 {
        color: #555;
        font-size: 1.3rem;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .doc-section h4 {
        color: #666;
        font-size: 1.1rem;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .doc-section p {
        line-height: 1.8;
        color: #555;
        margin-bottom: 1rem;
    }

    .doc-section ul, .doc-section ol {
        margin-left: 2rem;
        margin-bottom: 1rem;
        line-height: 1.8;
    }

    .doc-section li {
        margin-bottom: 0.5rem;
        color: #555;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin: 1rem 0;
        border-left: 4px solid;
    }

    .alert-warning {
        background-color: #fef3c7;
        border-color: #f59e0b;
        color: #92400e;
    }

    .alert-danger {
        background-color: #fee2e2;
        border-color: #ef4444;
        color: #991b1b;
    }

    .alert-info {
        background-color: #dbeafe;
        border-color: #3b82f6;
        color: #1e3a8a;
    }

    .alert-success {
        background-color: #d1fae5;
        border-color: #10b981;
        color: #065f46;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .data-table thead {
        background: #667eea;
        color: white;
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .badge-required {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-optional {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 1.5rem 0;
    }

    .feature-card {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
        border: 2px solid #e5e7eb;
        transition: all 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }

    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .feature-card h4 {
        margin: 0.5rem 0;
        color: #333;
    }

    .feature-card p {
        color: #666;
        font-size: 0.9rem;
    }

    code {
        background-color: #f3f4f6;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-family: monospace;
        color: #991b1b;
        font-size: 0.9em;
    }

    .checklist {
        list-style: none;
        margin-left: 0;
    }

    .checklist li:before {
        content: "✓ ";
        color: #10b981;
        font-weight: bold;
        margin-right: 0.5rem;
    }

    .faq-item {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 8px;
    }

    .faq-item h4 {
        color: #667eea;
        margin-top: 0;
    }

    .conclusion {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .conclusion h2, .conclusion p {
        color: white;
    }

    .highlight {
        font-size: 1.2rem;
        text-align: center;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .doc-header h1 {
            font-size: 1.5rem;
        }

        .feature-grid {
            grid-template-columns: 1fr;
        }

        .doc-section {
            padding: 1.5rem;
        }

        .data-table {
            font-size: 0.9rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.75rem;
        }
    }
</style>

<div class="doc-container">
    <!-- Header -->
    <div class="doc-header">
        <h1>📚 Guide d'utilisation du Panel d'Administration</h1>
        <p class="subtitle">Médiathèque TLN - Version 1.0 - Octobre 2025</p>
    </div>

    <!-- Layout avec sidebar -->
    <div class="doc-layout">
        <!-- Navigation sidebar -->
        <div class="doc-nav">
            <h3>Table des matières</h3>
            <ul class="doc-nav-list">
                <li><a href="#introduction">1. Introduction</a></li>
                <li><a href="#schema-bdd" style="padding-left: 20px;">📊 Schéma de la base de données</a></li>
                <li><a href="#connexion">2. Connexion</a></li>
                <li><a href="#tableau-de-bord">3. Tableau de Bord</a></li>
                <li><a href="#utilisateurs">4. Gestion des Utilisateurs</a></li>
                <li><a href="#medias">5. Gestion des Médias</a></li>
                <li><a href="#emprunts">6. Gestion des Emprunts</a></li>
                <li><a href="#messages">7. Messages de Contact</a></li>
                <li><a href="#genres">8. Gestion des Genres</a></li>
                <li><a href="#bonnes-pratiques">9. Bonnes Pratiques</a></li>
                <li><a href="#faq">10. FAQ et Dépannage</a></li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="doc-content-wrapper">
    <!-- Section 1: Introduction -->
    <section id="introduction" class="doc-section">
        <h2>1. Introduction</h2>

        <h3>1.1 À propos de ce guide</h3>
        <p>Ce guide a été conçu pour vous accompagner dans l'utilisation quotidienne du panel d'administration de votre médiathèque. Vous y trouverez toutes les informations nécessaires pour gérer efficacement votre catalogue de médias, vos utilisateurs et vos opérations.</p>

        <h3>1.2 Prérequis</h3>
        <p>Pour utiliser le panel d'administration, vous devez :</p>
        <ul>
            <li>Disposer d'un compte administrateur (créé par le développeur)</li>
            <li>Avoir accès à un navigateur web moderne (Chrome, Firefox, Safari, Edge)</li>
            <li>Être connecté à Internet</li>
        </ul>

        <h3>1.3 Vue d'ensemble des fonctionnalités</h3>
        <div class="feature-grid">
            <div class="feature-card">
                <span class="feature-icon">📊</span>
                <h4>Statistiques</h4>
                <p>Visualisez les données clés de votre médiathèque</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">👥</span>
                <h4>Utilisateurs</h4>
                <p>Gérez les comptes utilisateurs</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">📚</span>
                <h4>Catalogue</h4>
                <p>Ajoutez et modifiez livres, films et jeux</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">📅</span>
                <h4>Emprunts</h4>
                <p>Suivez les emprunts et retards</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">📧</span>
                <h4>Messages</h4>
                <p>Consultez les demandes de contact</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🏷️</span>
                <h4>Genres</h4>
                <p>Enrichissez les catégories</p>
            </div>
        </div>

        <h3 id="schema-bdd">1.4 Architecture de la base de données</h3>
        <p>Voici le schéma de la base de données de votre médiathèque. Ce diagramme vous permet de comprendre comment les différentes tables sont reliées entre elles :</p>
        <div style="text-align: center; margin: 2rem 0;">
            <img src="<?php echo url('assets/images/php_mvc_app_shema_database.png'); ?>" alt="Schéma de la base de données" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        </div>
        <p><strong>Tables principales :</strong></p>
        <ul>
            <li><strong>users</strong> : Gère les comptes utilisateurs et administrateurs</li>
            <li><strong>medias</strong> : Catalogue des livres, films et jeux</li>
            <li><strong>books, movies, games</strong> : Informations spécifiques à chaque type de média</li>
            <li><strong>borrows</strong> : Suivi des emprunts et retours</li>
            <li><strong>contacts</strong> : Messages de contact</li>
            <li><strong>genres</strong> : Catégories de médias</li>
        </ul>
    </section>

    <!-- Section 2: Connexion -->
    <section id="connexion" class="doc-section">
        <h2>2. Connexion au Panel d'Administration</h2>

        <h3>2.1 Accéder à la page de connexion</h3>
        <ol>
            <li>Ouvrez votre navigateur web</li>
            <li>Accédez à l'URL : <code>votre-site.com/auth/login</code></li>
            <li>Vous arrivez sur la page de connexion</li>
        </ol>

        <h3>2.2 Se connecter</h3>
        <ol>
            <li><strong>Email</strong> : Saisissez l'adresse email de votre compte administrateur</li>
            <li><strong>Mot de passe</strong> : Saisissez votre mot de passe</li>
            <li>Cliquez sur le bouton <strong>"Se connecter"</strong></li>
        </ol>
        <div class="alert alert-warning">
            <strong>⚠️ Sécurité :</strong> Après 2 heures d'inactivité, vous serez automatiquement déconnecté pour des raisons de sécurité.
        </div>

        <h3>2.3 Accéder au panel d'administration</h3>
        <p>Une fois connecté avec un compte administrateur, vous pouvez accéder au panel via :</p>
        <ul>
            <li>L'URL : <code>votre-site.com/admin/dashboard</code></li>
            <li>Le menu de navigation (si disponible dans votre interface)</li>
        </ul>
    </section>

    <!-- Section 3: Tableau de Bord -->
    <section id="tableau-de-bord" class="doc-section">
        <h2>3. Tableau de Bord</h2>

        <h3>3.1 Vue d'ensemble</h3>
        <p>Le tableau de bord est la page d'accueil de votre panel d'administration. Il affiche en un coup d'œil les statistiques clés de votre médiathèque.</p>
        <p><strong>URL d'accès :</strong> <code>/admin/dashboard</code></p>

        <h3>3.2 Statistiques affichées</h3>
        <p>Le tableau de bord présente 5 indicateurs principaux :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total Utilisateurs</strong></td>
                    <td>Nombre total d'utilisateurs enregistrés</td>
                </tr>
                <tr>
                    <td><strong>Total Médias</strong></td>
                    <td>Nombre total de médias dans le catalogue</td>
                </tr>
                <tr>
                    <td><strong>Total Livres</strong></td>
                    <td>Nombre de livres disponibles</td>
                </tr>
                <tr>
                    <td><strong>Total Films</strong></td>
                    <td>Nombre de films disponibles</td>
                </tr>
                <tr>
                    <td><strong>Total Jeux</strong></td>
                    <td>Nombre de jeux vidéo disponibles</td>
                </tr>
            </tbody>
        </table>

        <h3>3.3 Graphiques</h3>
        <p>Des graphiques à barres visualisent la répartition de vos médias par type, facilitant l'analyse de votre inventaire.</p>
    </section>

    <!-- Section 4: Utilisateurs -->
    <section id="utilisateurs" class="doc-section">
        <h2>4. Gestion des Utilisateurs</h2>

        <h3>4.1 Accéder à la liste des utilisateurs</h3>
        <p><strong>URL d'accès :</strong> <code>/admin/users</code></p>
        <p>Cette page affiche tous les utilisateurs enregistrés sur votre plateforme.</p>

        <h3>4.2 Informations affichées</h3>
        <p>Pour chaque utilisateur, vous verrez :</p>
        <ul>
            <li><strong>ID</strong> : Identifiant unique</li>
            <li><strong>Nom complet</strong> : Prénom + Nom</li>
            <li><strong>Email</strong> : Adresse email de contact</li>
            <li><strong>Rôle</strong> : Badge "Admin" ou "Utilisateur"</li>
            <li><strong>Date d'inscription</strong> : Date de création du compte</li>
        </ul>

        <h3>4.3 Rechercher un utilisateur</h3>
        <ol>
            <li>Utilisez la barre de recherche en haut de la liste</li>
            <li>Tapez le nom ou l'email de l'utilisateur recherché</li>
            <li>Les résultats se filtrent automatiquement en temps réel</li>
        </ol>

        <h3>4.4 Supprimer un utilisateur</h3>
        <div class="alert alert-danger">
            <strong>⚠️ Attention :</strong> Cette action est irréversible !
        </div>
        <p><strong>Conditions pour supprimer un utilisateur :</strong></p>
        <ul class="checklist">
            <li>L'utilisateur ne doit pas avoir d'emprunts en cours</li>
            <li>Vous ne pouvez pas supprimer votre propre compte</li>
        </ul>
        <p><strong>Procédure :</strong></p>
        <ol>
            <li>Localisez l'utilisateur dans la liste</li>
            <li>Cliquez sur le bouton <strong>"Supprimer"</strong></li>
            <li>Confirmez l'action</li>
            <li>L'utilisateur est supprimé définitivement</li>
        </ol>
        <div class="alert alert-info">
            <strong>💡 Astuce :</strong> Si un message d'erreur indique que l'utilisateur a des emprunts actifs, vous devez d'abord forcer le retour de ses emprunts.
        </div>
    </section>

    <!-- Section 5: Médias -->
    <section id="medias" class="doc-section">
        <h2>5. Gestion des Médias</h2>

        <h3>5.1 Consulter le catalogue</h3>
        <p><strong>URL d'accès :</strong> <code>/admin/medias</code></p>
        <p>Cette page liste tous les médias disponibles dans votre médiathèque.</p>

        <h3>5.2 Informations affichées</h3>
        <p>Pour chaque média, vous verrez :</p>
        <ul>
            <li>Image de couverture</li>
            <li><strong>ID</strong> : Identifiant unique</li>
            <li><strong>Titre</strong> : Nom du média</li>
            <li><strong>Type</strong> : Livre, Film ou Jeu</li>
            <li><strong>Genre</strong> : Catégorie (Action, Science-Fiction, etc.)</li>
            <li><strong>Stock</strong> : Nombre d'exemplaires disponibles</li>
        </ul>

        <h3>5.3 Ajouter un nouveau média</h3>

        <h4>5.3.1 Accéder au formulaire</h4>
        <p><strong>URL d'accès :</strong> <code>/admin/add_media</code></p>

        <h4>5.3.2 Remplir les informations communes</h4>
        <p>Tous les médias nécessitent les champs suivants :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>Description</th>
                    <th>Obligatoire</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Titre</strong></td>
                    <td>Nom du média</td>
                    <td><span class="badge badge-required">Oui</span></td>
                </tr>
                <tr>
                    <td><strong>Type</strong></td>
                    <td>Livre / Film / Jeu</td>
                    <td><span class="badge badge-required">Oui</span></td>
                </tr>
                <tr>
                    <td><strong>Genre</strong></td>
                    <td>Sélectionner dans la liste</td>
                    <td><span class="badge badge-required">Oui</span></td>
                </tr>
                <tr>
                    <td><strong>Stock</strong></td>
                    <td>Nombre d'exemplaires (≥0)</td>
                    <td><span class="badge badge-required">Oui</span></td>
                </tr>
                <tr>
                    <td><strong>Date de publication</strong></td>
                    <td>Date de sortie</td>
                    <td><span class="badge badge-required">Oui</span></td>
                </tr>
                <tr>
                    <td><strong>Image de couverture</strong></td>
                    <td>URL ou fichier uploadé</td>
                    <td><span class="badge badge-optional">Non</span></td>
                </tr>
            </tbody>
        </table>

        <p><strong>Pour l'image de couverture</strong>, vous avez 2 options :</p>
        <ul>
            <li><strong>Option 1</strong> : Saisir une URL (lien vers une image en ligne)</li>
            <li><strong>Option 2</strong> : Uploader un fichier depuis votre ordinateur (JPG, PNG, GIF)</li>
        </ul>

        <h4>5.3.3 Informations spécifiques aux LIVRES</h4>
        <p>Si vous sélectionnez <strong>Type = Livre</strong>, remplissez également :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Auteur</strong></td>
                    <td>Nom de l'auteur</td>
                </tr>
                <tr>
                    <td><strong>ISBN</strong></td>
                    <td>Code ISBN (alphanumérique)</td>
                </tr>
                <tr>
                    <td><strong>Nombre de pages</strong></td>
                    <td>Nombre de pages du livre</td>
                </tr>
                <tr>
                    <td><strong>Année de publication</strong></td>
                    <td>Année de sortie</td>
                </tr>
                <tr>
                    <td><strong>Résumé</strong></td>
                    <td>Description du livre</td>
                </tr>
            </tbody>
        </table>

        <h4>5.3.4 Informations spécifiques aux FILMS</h4>
        <p>Si vous sélectionnez <strong>Type = Film</strong>, remplissez également :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Réalisateur</strong></td>
                    <td>Nom du réalisateur</td>
                </tr>
                <tr>
                    <td><strong>Durée</strong></td>
                    <td>Durée en minutes</td>
                </tr>
                <tr>
                    <td><strong>Année</strong></td>
                    <td>Année de sortie</td>
                </tr>
                <tr>
                    <td><strong>Classification</strong></td>
                    <td>Âge minimum recommandé</td>
                </tr>
                <tr>
                    <td><strong>Synopsis</strong></td>
                    <td>Description du film</td>
                </tr>
            </tbody>
        </table>

        <h4>5.3.5 Informations spécifiques aux JEUX</h4>
        <p>Si vous sélectionnez <strong>Type = Jeu</strong>, remplissez également :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>Description</th>
                    <th>Valeurs possibles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Éditeur</strong></td>
                    <td>Société éditrice</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><strong>Plateforme</strong></td>
                    <td>Console/PC</td>
                    <td>PC, PlayStation, Xbox, Nintendo, Mobile</td>
                </tr>
                <tr>
                    <td><strong>Âge minimum</strong></td>
                    <td>Classification PEGI</td>
                    <td>3, 7, 12, 16, 18</td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td>Présentation du jeu</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><strong>Date de sortie</strong></td>
                    <td>Date de sortie</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>

        <h3>5.4 Modifier un média existant</h3>
        <p>Pour modifier un média, cliquez sur le bouton "Modifier" depuis la liste des médias. Le formulaire de modification est identique au formulaire d'ajout.</p>

        <h3>5.5 Supprimer un média</h3>
        <div class="alert alert-danger">
            <strong>⚠️ Attention :</strong> Cette action est irréversible et supprime également l'image uploadée !
        </div>
    </section>

    <!-- Section 6: Emprunts -->
    <section id="emprunts" class="doc-section">
        <h2>6. Gestion des Emprunts</h2>

        <h3>6.1 Accéder à la gestion des emprunts</h3>
        <p><strong>URL d'accès :</strong> <code>/admin/borrows</code></p>
        <p>Cette section vous permet de suivre tous les emprunts effectués sur votre plateforme.</p>

        <h3>6.2 Statistiques des emprunts</h3>
        <p>En haut de page, vous trouverez 3 indicateurs clés :</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Indicateur</th>
                    <th>Signification</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Total des emprunts</strong></td>
                    <td>Nombre total d'emprunts (tous statuts confondus)</td>
                </tr>
                <tr>
                    <td><strong>Emprunts actifs</strong></td>
                    <td>Emprunts en cours (non retournés)</td>
                </tr>
                <tr>
                    <td><strong>Emprunts en retard</strong></td>
                    <td>Emprunts dont la date de retour est dépassée</td>
                </tr>
            </tbody>
        </table>

        <h3>6.3 Forcer le retour d'un média</h3>
        <p>Si un utilisateur ne retourne pas un média ou en cas de besoin, vous pouvez forcer le retour. Le système enregistre automatiquement la date de retour et met à jour la disponibilité du média.</p>
        <div class="alert alert-info">
            <strong>💡 Utilisation :</strong> Utile pour les retours physiques non enregistrés par l'utilisateur.
        </div>
    </section>

    <!-- Section 7: Messages -->
    <section id="messages" class="doc-section">
        <h2>7. Gestion des Messages de Contact</h2>

        <h3>7.1 Accéder aux messages</h3>
        <p><strong>URL d'accès :</strong> <code>/admin/contacts</code></p>
        <p>Cette section centralise tous les messages envoyés via le formulaire de contact de votre site.</p>

        <h3>7.2 Informations affichées</h3>
        <p>Pour chaque message, vous verrez :</p>
        <ul>
            <li><strong>ID</strong> : Identifiant unique</li>
            <li><strong>Nom</strong> : Nom de l'expéditeur</li>
            <li><strong>Email</strong> : Email de contact</li>
            <li><strong>Message</strong> : Contenu du message</li>
            <li><strong>Date</strong> : Date et heure d'envoi</li>
            <li><strong>Statut</strong> : Lu / Non lu</li>
        </ul>

        <h3>7.3 Marquer un message comme lu</h3>
        <p>Cliquez sur "Marquer comme lu" pour suivre les messages traités. Le compteur se met à jour automatiquement.</p>

        <h3>7.4 Répondre à un message</h3>
        <p>Le système ne dispose pas de fonctionnalité d'envoi d'email intégrée. Pour répondre, utilisez votre client email habituel avec l'adresse affichée.</p>
    </section>

    <!-- Section 8: Genres -->
    <section id="genres" class="doc-section">
        <h2>8. Gestion des Genres</h2>

        <h3>8.1 Accéder à l'ajout de genre</h3>
        <p><strong>URL d'accès :</strong> <code>/admin/add_genre</code></p>
        <p>Cette fonctionnalité vous permet d'enrichir la liste des genres disponibles pour vos médias.</p>

        <h3>8.2 Ajouter un nouveau genre</h3>
        <p><strong>Règles de validation :</strong></p>
        <ul>
            <li>Lettres uniquement (accents acceptés)</li>
            <li>Espaces autorisés</li>
            <li>Tirets (-) autorisés</li>
            <li>Exemples valides : "Science-Fiction", "Bande dessinée", "Aventure"</li>
        </ul>
        <div class="alert alert-info">
            <strong>💡 Conseil :</strong> Ajoutez tous les genres dont vous avez besoin avant de créer vos médias.
        </div>
    </section>

    <!-- Section 9: Bonnes Pratiques -->
    <section id="bonnes-pratiques" class="doc-section">
        <h2>9. Bonnes Pratiques</h2>

        <h3>9.1 Sécurité</h3>
        <ul class="checklist">
            <li>Ne partagez jamais vos identifiants administrateur</li>
            <li>Utilisez un mot de passe fort (min. 8 caractères, majuscules, minuscules, chiffres)</li>
            <li>Déconnectez-vous toujours après utilisation, surtout sur ordinateur partagé</li>
            <li>Vérifiez régulièrement la liste des utilisateurs administrateurs</li>
        </ul>

        <h3>9.2 Gestion du catalogue</h3>
        <ul class="checklist">
            <li>Vérifiez les informations avant d'ajouter un média</li>
            <li>Utilisez des images de qualité et aux bonnes dimensions</li>
            <li>Maintenez le stock à jour pour éviter les emprunts impossibles</li>
            <li>Créez tous les genres nécessaires avant d'ajouter vos médias</li>
        </ul>

        <h3>9.3 Gestion des emprunts</h3>
        <ul class="checklist">
            <li>Consultez quotidiennement les emprunts en retard</li>
            <li>Forcez les retours uniquement après vérification physique</li>
            <li>Contactez les utilisateurs en retard par email</li>
        </ul>
    </section>

    <!-- Section 10: FAQ -->
    <section id="faq" class="doc-section">
        <h2>10. FAQ et Dépannage</h2>

        <div class="faq-item">
            <h4>Q : Je n'arrive pas à supprimer un utilisateur</h4>
            <p><strong>R :</strong> Vérifiez que vous ne tentez pas de supprimer votre propre compte et que l'utilisateur n'a aucun emprunt en cours.</p>
        </div>

        <div class="faq-item">
            <h4>Q : Comment supprimer un genre ?</h4>
            <p><strong>R :</strong> Cette fonctionnalité n'est pas disponible actuellement. Contactez votre développeur pour une suppression manuelle.</p>
        </div>

        <div class="faq-item">
            <h4>Q : L'upload d'image ne fonctionne pas</h4>
            <p><strong>R :</strong> Vérifiez que le fichier est au format JPG, JPEG, PNG ou GIF et que la taille n'est pas excessive (< 5 Mo recommandé).</p>
        </div>

        <div class="faq-item">
            <h4>Q : Comment savoir si un emprunt est en retard ?</h4>
            <p><strong>R :</strong> Consultez le compteur "Emprunts en retard" sur /admin/borrows. Un emprunt est en retard si la date de retour prévue est passée.</p>
        </div>

        <h3>Messages d'erreur courants</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Message d'erreur</th>
                    <th>Cause</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>"Accès refusé"</td>
                    <td>Vous n'êtes pas connecté comme admin</td>
                    <td>Reconnectez-vous avec un compte administrateur</td>
                </tr>
                <tr>
                    <td>"Session expirée"</td>
                    <td>2h d'inactivité écoulées</td>
                    <td>Reconnectez-vous</td>
                </tr>
                <tr>
                    <td>"Genre déjà existant"</td>
                    <td>Le genre existe déjà en base</td>
                    <td>Utilisez le genre existant</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Conclusion -->
    <section class="doc-section conclusion">
        <h2>Conclusion</h2>
        <p>Ce guide couvre toutes les fonctionnalités actuelles du panel d'administration. Pour toute question ou suggestion d'amélioration, n'hésitez pas à contacter votre équipe technique.</p>
        <p class="highlight"><strong>Bon usage de votre médiathèque !</strong></p>
    </section>
        </div><!-- fin doc-content-wrapper -->
    </div><!-- fin doc-layout -->
</div><!-- fin doc-container -->

<script>
    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
