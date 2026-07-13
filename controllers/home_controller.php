<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index()
{
    $data = [
        'title' => 'Accueil',
        'message' => 'Bienvenue sur votre application PHP MVC !',
        'features' => [
            'Architecture MVC claire',
            'Système de routing simple',
            'Templating HTML/CSS',
            'Gestion de base de données',
            'Sécurité intégrée'
        ],
        'overdue_borrows' => []
    ];

    // Si l'utilisateur est connecté, récupérer ses emprunts en retard
    if (is_logged_in()) {
        $user_id = current_user_id();
        $data['overdue_borrows'] = get_user_overdue_borrows($user_id);
    }

    load_view_with_layout('home/index', $data);
}

/**
 * Page à propos
 */
function home_about()
{
    $data = [
        'title' => 'À propos',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
    ];

    load_view_with_layout('home/about', $data);
}

/**
 * Page contact
 */
function home_contact()
{
    $data = [
        'title' => 'Contact'
    ];

    if (is_post()) {
        $name = clean_input(post('name'));
        $email = clean_input(post('email'));
        $message = clean_input(post('message'));

        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
        } else {
            // Ici vous pourriez envoyer l'email ou sauvegarder en base
            save_contact_message($name, $email, $message);
            set_flash('success', 'Votre message a été envoyé avec succès !');
            redirect('home/contact');
        }
    }

    load_view_with_layout('home/contact', $data);
}

function home_profile()
{
    // Protection : L'utilisateur doit être connecté.
    if (!is_logged_in()) {
        set_flash('error', 'Veuillez vous connecter pour accéder à votre profil.');
        redirect('auth/login');
    }

    $user_id = current_user_id();

    if (is_post()) {
        // --- Traitement des actions POST ---

        // Gérer les actions soumises via le champ caché 'action' (mot de passe ou info profil)
        if (isset($_POST['action'])) {

            // Traitement du changement de mot de passe 
            if ($_POST['action'] === 'change_password') {
                profile_change_password_action($user_id);

                // NOUVEAU : Traitement de la mise à jour des informations personnelles (Nom, Prénom, Email)
            } elseif ($_POST['action'] === 'update_info') {
                profile_update_info_action($user_id);
            }
        }
        // 2. Traitement du retour d'emprunt 
        elseif (isset($_POST["return"])) {
            return_borrow($user_id, $_POST["return"]);
            increase_availability($_POST["return"]);
            redirect('home/profile');
        }
    }

    // Récupération des données via le Modèle (après le POST pour avoir les données mises à jour)
    $user_data = get_user_profile($user_id);
    //récupération des emprunts
    $borrow = get_user_current_borrows($user_id);
    $history = get_user_borrow_history($user_id);
    //Pagination
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $max_page = calc_page($history, 10);
    if (count($history) === 0) {
        $max_page = 1;
    }

    if ($page > $max_page) {
        redirect("media/profile?page=1");
    }

    $data = [
        'title' => 'Profil',
        'user' => $user_data,
        'borrow' => $borrow,
        'history' => $history,
        'max_page' => $max_page,
        'page' => $page
    ];

    // 4. Chargement de la vue
    load_view_with_layout('home/profile', $data);
}
