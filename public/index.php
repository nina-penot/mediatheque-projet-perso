<?php

/**
 * Point d'entrée principal de l'application PHP MVC
 * 
 * Ce fichier initialise l'application et lance le système de routing
 */

// Démarrer la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Charger la configuration
require_once '../config/database.php';

// Charger les fichiers core
require_once CORE_PATH . '/database.php';
require_once CORE_PATH . '/router.php';
require_once CORE_PATH . '/view.php';

// Charger les fichiers utilitaires
require_once INCLUDE_PATH . '/helpers.php';

// Charger les modèles
require_once MODEL_PATH . '/user_model.php';
require_once MODEL_PATH . '/medias_model.php';
require_once MODEL_PATH . '/admin_model.php';

// Activer l'affichage des erreurs en développement
// À désactiver en production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gestion du timeout de session (2 heures d'inactivité = 7200 secondes)
if (isset($_SESSION['activity']) && (time() - $_SESSION['activity'] > 7200)) {
    // Dernière activité il y a plus de 2 heures
    set_flash('info', 'Votre session a expiré pour des raisons de sécurité. Veuillez vous reconnecter.');
    logout();
    exit;
}
// Mettre à jour le timestamp de dernière activité
//$_SESSION['activity'] = time();

// Lancer le système de routing
dispatch();
