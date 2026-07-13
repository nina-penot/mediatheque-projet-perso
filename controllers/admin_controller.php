<?php
// Contrôleur admin

/**
 * Page d'accueil admin - Dashboard
 */
function admin_dashboard()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Récupérer les statistiques via le modèle
    $stats = admin_get_dashboard_stats();

    $data = [
        'title' => 'Dashboard Administration',
        'total_users' => $stats['total_users'],
        'total_medias' => $stats['total_medias'],
        'total_books' => $stats['total_books'],
        'total_movies' => $stats['total_movies'],
        'total_games' => $stats['total_games']
    ];

    load_view_with_layout('admin/dashboard', $data, 'layoutadmin');
}

/**
 * Page de gestion des utilisateurs
 */
function admin_users()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Récupérer tous les utilisateurs via le modèle
    $users = admin_get_all_users();

    $data = [
        'title' => 'Gestion des utilisateurs',
        'users' => $users
    ];

    load_view_with_layout('admin/users', $data, 'layoutadmin');
}

/**
 * Page de gestion des médias
 */
function admin_medias()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Récupérer tous les médias via le modèle
    $medias = admin_get_all_medias();

    $data = [
        'title' => 'Gestion des médias',
        'medias' => $medias
    ];

    load_view_with_layout('admin/medias', $data, 'layoutadmin');
}

/**
 * Éditer un média (page d'édition)
 */
function admin_edit_media($media_id)
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Récupérer les détails complets du média
    $media = admin_get_media_details($media_id);

    if (!$media) {
        set_flash('error', 'Média introuvable.');
        redirect('admin/medias');
    }

    // Récupérer les genres pour le formulaire
    $genres = admin_get_all_genres();

    $data = [
        'title' => 'Éditer un média',
        'media' => $media,
        'genres' => $genres
    ];

    load_view_with_layout('admin/edit_media', $data, 'layoutadmin');
}

/**
 * Afficher le formulaire d'ajout de média
 */
function admin_add_media()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Récupérer les genres pour le formulaire
    $genres = admin_get_all_genres();

    $data = [
        'title' => 'Ajouter un média',
        'genres' => $genres
    ];

    load_view_with_layout('admin/add_media', $data, 'layoutadmin');
}

/**
 * Page de gestion des emprunts
 */
function admin_borrows()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    if (is_post()) {
        if (isset($_POST["return"])) {
            $borrow_id = $_POST["return"];
            force_return($borrow_id);
            redirect('admin/borrows');
        }
    }

    // Récupérer tous les emprunts via le modèle
    $borrows = admin_get_all_borrows();

    // Récupérer les statistiques des emprunts
    $total_borrows = admin_count_borrows();
    $active_borrows = admin_count_active_borrows();
    $overdue_borrows = admin_count_overdue_borrows();

    $data = [
        'title' => 'Gestion des emprunts',
        'borrows' => $borrows,
        'total_borrows' => $total_borrows,
        'active_borrows' => $active_borrows,
        'overdue_borrows' => $overdue_borrows
    ];

    load_view_with_layout('admin/borrows', $data, 'layoutadmin');
}

/**
 * Traiter le formulaire de mise à jour de média
 */
function admin_process_update()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Vérifier que c'est une requête POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('admin/medias');
    }

    // Récupérer l'ID du média
    if (empty($_POST['media_id'])) {
        set_flash('error', 'ID du média manquant.');
        redirect('admin/medias');
    }

    $media_id = $_POST['media_id'];

    // Valider les champs communs
    $errors = [];

    if (empty($_POST['title'])) {
        $errors[] = 'Le titre est obligatoire.';
    }
    if (empty($_POST['type'])) {
        $errors[] = 'Le type est obligatoire.';
    }
    if (empty($_POST['genre_id'])) {
        $errors[] = 'Le genre est obligatoire.';
    }
    // if (empty($_POST['date_publication'])) {
    //     $errors[] = 'La date de publication est obligatoire.';
    // }
    if (!isset($_POST['stock']) || $_POST['stock'] < 0) {
        $errors[] = 'Le stock doit être un nombre positif.';
    }

    // Valider les champs spécifiques selon le type
    $type = $_POST['type'];

    if ($type === 'Livre') {
        if (empty($_POST['author'])) {
            $errors[] = 'L\'auteur est obligatoire pour un livre.';
        }
        if (empty($_POST['isbn'])) {
            $errors[] = 'L\'ISBN est obligatoire pour un livre.';
        }
        if (empty($_POST['number_of_pages']) || $_POST['number_of_pages'] <= 0) {
            $errors[] = 'Le nombre de pages doit être positif.';
        }
        if (empty($_POST['summary'])) {
            $errors[] = 'Le résumé est obligatoire pour un livre.';
        }
    } elseif ($type === 'Film') {
        if (empty($_POST['realisateur'])) {
            $errors[] = 'Le réalisateur est obligatoire pour un film.';
        }
        if (empty($_POST['duration']) || $_POST['duration'] <= 0) {
            $errors[] = 'La durée doit être positive.';
        }
        if (empty($_POST['year'])) {
            $errors[] = 'L\'année est obligatoire pour un film.';
        }
        if (empty($_POST['rating'])) {
            $errors[] = 'La classification est obligatoire pour un film.';
        }
        if (empty($_POST['synopsis'])) {
            $errors[] = 'Le synopsis est obligatoire pour un film.';
        }
    } elseif ($type === 'Jeu') {
        if (empty($_POST['editor'])) {
            $errors[] = 'L\'éditeur est obligatoire pour un jeu.';
        }
        if (empty($_POST['platform'])) {
            $errors[] = 'La plateforme est obligatoire pour un jeu.';
        }
        if (empty($_POST['age'])) {
            $errors[] = 'L\'âge minimum est obligatoire pour un jeu.';
        }
        if (empty($_POST['description'])) {
            $errors[] = 'La description est obligatoire pour un jeu.';
        }
        if (empty($_POST['release_date'])) {
            $errors[] = 'La date de sortie est obligatoire pour un jeu.';
        }
    }

    // S'il y a des erreurs, retourner au formulaire
    if (!empty($errors)) {
        set_flash('error', implode('<br>', $errors));
        redirect('admin/edit_media/' . $media_id);
    }

    // Gérer l'image (conserver, URL ou upload)
    $picture_path = $_POST['current_picture'] ?? null;

    if (!empty($_POST['image_source'])) {
        if ($_POST['image_source'] === 'url' && !empty($_POST['picture_url'])) {
            // Utiliser la nouvelle URL
            if (strlen($_POST['picture_url']) >= 255) {
                set_flash('error', "ERREUR : l'URL est trop long.");
                redirect('admin/add_media');
            } else {
                $picture_path = $_POST['picture_url'];
            }
        } elseif ($_POST['image_source'] === 'file' && isset($_FILES['picture_file']) && $_FILES['picture_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Upload du nouveau fichier
            $upload_result = upload_media_cover($_FILES['picture_file']);
            if ($upload_result['success']) {
                $picture_path = $upload_result['path'];
            } else {
                set_flash('error', $upload_result['error']);
                redirect('admin/edit_media/' . $media_id);
            }
        }
        // Si image_source === 'keep', on garde $picture_path tel quel (valeur de current_picture)
    }

    // Mettre à jour le média dans la table medias
    $media_data = [
        'title' => $_POST['title'],
        'picture' => $picture_path,
        'type' => $type,
        'genre_id' => $_POST['genre_id'],
        'date_publication' => $_POST['date_publication'],
        'stock' => $_POST['stock'],
    ];

    if (!admin_update_media($media_id, $media_data)) {
        set_flash('error', 'Erreur lors de la mise à jour du média.');
        redirect('admin/edit_media/' . $media_id);
    }

    // Mettre à jour les détails spécifiques selon le type
    $success = false;

    if ($type === 'Livre') {
        $book_data = [
            'author' => $_POST['author'],
            'isbn' => $_POST['isbn'],
            'number_of_pages' => $_POST['number_of_pages'],
            'date_of_publication' => $_POST['year_book'],
            'summary' => $_POST['summary']
        ];
        $success = admin_update_book($book_data, $media_id);
    } elseif ($type === 'Film') {
        $movie_data = [
            'realisateur' => $_POST['realisateur'],
            'duration' => $_POST['duration'],
            'year' => $_POST['year'],
            'rating' => $_POST['rating'],
            'synopsis' => $_POST['synopsis']
        ];
        $success = admin_update_movie($movie_data, $media_id);
    } elseif ($type === 'Jeu') {
        $game_data = [
            'editor' => $_POST['editor'],
            'platform' => $_POST['platform'],
            'age' => $_POST['age'],
            'description' => $_POST['description'],
            'release_date' => $_POST['release_date']
        ];
        $success = admin_update_game($game_data, $media_id);
    }

    if ($success) {
        set_flash('success', 'Média mis à jour avec succès !');
        redirect('admin/medias');
    } else {
        set_flash('error', 'Erreur lors de la mise à jour des détails du média.');
        redirect('admin/edit_media/' . $media_id);
    }
}

/**
 * Page de gestion des messages de contact
 */
function admin_contacts()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Gestion des actions POST (marquer comme lu, supprimer)
    if (is_post()) {
        if (isset($_POST['mark_as_read'])) {
            $contact_id = $_POST['mark_as_read'];
            if (admin_mark_contact_as_read($contact_id)) {
                set_flash('success', 'Message marqué comme lu.');
            } else {
                set_flash('error', 'Erreur lors de la mise à jour du message.');
            }
            redirect('admin/contacts');
        }

        if (isset($_POST['delete'])) {
            $contact_id = $_POST['delete'];
            if (admin_delete_contact($contact_id)) {
                set_flash('success', 'Message supprimé avec succès.');
            } else {
                set_flash('error', 'Erreur lors de la suppression du message.');
            }
            redirect('admin/contacts');
        }
    }

    // Récupérer tous les messages de contact
    $contacts = admin_get_all_contacts();

    // Récupérer les statistiques
    $total_contacts = admin_count_contacts();
    $unread_contacts = admin_count_unread_contacts();

    $data = [
        'title' => 'Gestion des messages de contact',
        'contacts' => $contacts,
        'total_contacts' => $total_contacts,
        'unread_contacts' => $unread_contacts
    ];

    load_view_with_layout('admin/contacts', $data, 'layoutadmin');
}

function admin_add_genre()
{
    if (isset($_POST["genre"])) {
        if (!empty($_POST["genre"])) {
            if (is_name_correct($_POST["genre"])) {
                $format_genre = str_upper_case($_POST["genre"]);
                if (does_genre_exist($format_genre)) {
                    set_flash('error', "Ce genre existe déjà.");
                    redirect('admin/add_genre');
                } else {
                    admin_insert_genre($format_genre);
                    set_flash('success', "Genre ajouté.");
                    redirect('admin/add_genre');
                }
            } else {
                set_flash('error', "Ce genre contient des caractères incorrectes (veuillez
                n'utiliser que des lettres, tirets ou espaces).");
            }
        } else {
            set_flash('error', "Vous n'avez pas inséré de genre.");
            redirect('admin/add_genre');
        }
    }
    $data = [
        'title' => 'Ajout de genre'
    ];
    load_view_with_layout('admin/add_genre', $data, 'layoutadmin');
}

/**
 * Page de documentation administrateur
 */
function admin_documentation()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    $data = [
        'title' => 'Documentation Administrateur'
    ];

    load_view_with_layout('admin/documentation', $data, 'layoutadmin');
}

/**
 * Page des graphiques et analytics (Grafana)
 */
function admin_analytics()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    $data = [
        'title' => 'Tableaux de Bord et Graphiques'
    ];

    load_view_with_layout('admin/analytics', $data, 'layoutadmin');
}

/**
 * Synchroniser la base de données vers le Raspberry Pi
 */
function admin_sync_database()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Vérifier que c'est une requête POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('admin/dashboard');
    }

    // Chemin vers le script
    $script_path = __DIR__ . '/../utils/db-sync.sh';

    // Vérifier que le script existe
    if (!file_exists($script_path)) {
        set_flash('error', 'Le script de synchronisation est introuvable.');
        redirect('admin/dashboard');
    }

    // Vérifier que le script est exécutable
    if (!is_executable($script_path)) {
        // Essayer de le rendre exécutable
        chmod($script_path, 0755);
    }

    // Exécuter le script et capturer la sortie
    $output = [];
    $return_code = 0;
    exec("bash $script_path 2>&1", $output, $return_code);

    // Vérifier le résultat
    if ($return_code === 0) {
        set_flash('success', 'Synchronisation réussie ! La base de données a été sauvegardée sur le Raspberry Pi.');
    } else {
        $error_message = implode("\n", $output);
        set_flash('error', 'Erreur lors de la synchronisation : ' . htmlspecialchars($error_message));
    }

    redirect('admin/dashboard');
}
