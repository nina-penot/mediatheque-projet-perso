<?php
// Modèle Admin - Gestion des données d'administration

/**
 * Récupère tous les utilisateurs pour l'administration
 * @return array Liste des utilisateurs
 */
function admin_get_all_users()
{
    $query = "SELECT id, firstname, lastname, email, admin, created_at
              FROM users
              ORDER BY created_at DESC";
    return db_select($query);
}

/**
 * Vérifie si un admin peut supprimé un utilisateur basé sur le fait que cet utilisateur 
 * a des emprunts en cours.
 */
function admin_can_delete_user($user_id)
{
    $query = "SELECT borrow.user_id, borrow.user_email, borrow.returned_at 
    FROM borrow WHERE borrow.user_id = ? AND borrow.returned_at IS NULL";
    $user_has_borrow = db_select($query, [$user_id]);
    if (empty($user_has_borrow)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Vérifie si l'utilisateur existe dans la base de données emprunts (borrow)
 */
function admin_is_user_in_borrow($user_id)
{
    $query = "SELECT borrow.user_id, borrow.returned_at FROM borrow WHERE borrow.user_id = ?";
    $user_in_borrow = db_select($query, [$user_id]);
    if (empty($user_in_borrow)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Anonymise un utilisateur
 */
function admin_anonymise_user($user_id)
{
    $query = "UPDATE users 
    SET firstname = 'Utilisateur', 
    lastname = 'Supprimé', 
    email = ?, 
    updated_at = NOW()
    WHERE users.id = ?";

    date_default_timezone_set('Europe/Paris');
    $time = (string) date('dmY') . "-" . date("G:i:s");
    $unique_email = "utilisateur-supprimé-" . $time;

    return db_execute($query, [$unique_email, $user_id]);
}

function admin_is_user_anonymised($user_id)
{
    $query = "SELECT users.email FROM users WHERE users.id = ?";
    $email_arr = db_select_one($query, [$user_id]);
    $email = $email_arr["email"];
    if (!str_contains($email, "@")) {
        return true;
    } else {
        return false;
    }
}


/**
 * Supprimer un utilisateur
 */
function admin_delete_user($user_id)
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Vérifier si l'utilisateur peut être supprimé via le modèle
    if (!admin_can_delete_self($user_id, current_user_id())) {
        set_flash('error', 'Vous ne pouvez pas vous supprimer vous-même.');
        redirect('admin/users');
    }

    // Vérifie si l'utilisateur a des emprunts en cours
    if (!admin_can_delete_user($user_id)) {
        set_flash('error', "Cet utilisateur a des emprunts en cours, vous ne pouvez pas le supprimer.");
        redirect('admin/users');
    }

    //Vérifie si l'utilisateur se trouve dans la base de données d'emprunts
    if (admin_is_user_in_borrow($user_id)) {
        if (admin_is_user_anonymised($user_id)) {
            set_flash('error', "Cet utilisateur est déjà anonymisé/suprrimé.");
            redirect('admin/users');
        } else {
            admin_anonymise_user($user_id);
            set_flash('success', "Utilisateur anonymisé avec succès.");
            redirect('admin/users');
        }
    }

    // Supprimer l'utilisateur
    if (delete_user($user_id)) {
        set_flash('success', 'Utilisateur supprimé avec succès.');
    } else {
        set_flash('error', 'Erreur lors de la suppression de l\'utilisateur.');
    }


    redirect('admin/users');
}

/**
 * Récupère tous les médias pour l'administration
 * @return array Liste des médias avec leurs informations
 */
function admin_get_all_medias()
{
    $query = "SELECT medias.id, medias.title, medias.type, medias.stock, medias.picture, medias.visibility, genres.name AS genre
              FROM medias
              LEFT JOIN genres ON medias.genre_id = genres.id
              ORDER BY medias.id DESC";
    return db_select($query);
}

/**
 * Supprime un média par son ID
 * @param int $media_id ID du média à supprimer
 * @return bool True si la suppression a réussi
 */
function delete_media_by_id($media_id)
{
    $pic_check = "SELECT medias.picture FROM medias WHERE id = ?";
    $image = db_select_one($pic_check, [$media_id]);
    $image = $image['picture'];
    if (str_contains($image, '/uploads/covers/cover')) {
        $image = ltrim($image, $image[0]);
        if (file_exists($image)) {
            unlink($image);
        }
    }
    $query = "DELETE FROM medias WHERE id = ?";
    return db_execute($query, [$media_id]);
}

/**
 * Vérifie si un admin peut supprimé un média basé sur le fait que ce média est emprunté 
 * actuellement.
 */
function admin_can_delete_media($media_id)
{
    $query = "SELECT borrow.media_id, borrow.returned_at 
    FROM borrow WHERE borrow.media_id = ? AND borrow.returned_at IS NULL";
    $media_is_borrowed = db_select($query, [$media_id]);
    if (empty($media_is_borrowed)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Vérifie si le média est dans la table borrow
 */
function admin_media_in_borrow($media_id)
{
    $query = "SELECT borrow.media_id, borrow.returned_at FROM borrow WHERE borrow.media_id = ?";
    $media_in_borrow = db_select($query, [$media_id]);
    if (empty($media_in_borrow)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Vérifie si un média est déjà innaccessible
 */
function admin_is_media_inaccessible($media_id)
{
    $query = "SELECT medias.stock, medias.visibility FROM medias 
    WHERE medias.id = ?";
    $media_info = db_select_one($query, [$media_id]);
    if (
        $media_info["stock"] == 0 and
        ($media_info["visibility"] == false or $media_info["visibility"] == 1)
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Met le stock d'un média à 0 et le rend invisible
 */
function admin_empty_media($media_id)
{
    $query = "UPDATE medias
    SET medias.stock = 0,
    medias.visibility = FALSE
    WHERE medias.id = ?";
    return db_execute($query, [$media_id]);
}

/**
 * Supprimer un média
 */
function admin_delete_media($media_id)
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    //Vérifie si le média est actuellement emprunté
    if (admin_can_delete_media($media_id)) {
        set_flash('error', "Ce média est actuellement emprunté et ne peut pas être
        supprimé.");
        redirect('admin/medias');
    }

    //Vérifie si le média est dans la base de données borrow
    if (admin_media_in_borrow($media_id)) {
        if (admin_is_media_inaccessible($media_id)) {
            set_flash('error', "Ce média est déjà rendu innaccessible.");
            redirect('admin/medias');
        } else {
            admin_empty_media($media_id);
            set_flash('success', "Ce média avait été emprunté dans le passé et a été rendu 
            innaccessible au lieu d'être supprimé.");
            redirect('admin/medias');
        }
    }

    // Supprimer le média via le modèle
    if (delete_media_by_id($media_id)) {
        set_flash('success', 'Média supprimé avec succès.');
    } else {
        set_flash('error', 'Erreur lors de la suppression du média.');
    }

    redirect('admin/medias');
}

/**
 * Vérifie si un utilisateur peut être supprimé
 * @param int $user_id ID de l'utilisateur à supprimer
 * @param int $current_user_id ID de l'utilisateur actuel
 * @return bool True si la suppression est autorisée
 */
function admin_can_delete_self($user_id, $current_user_id)
{
    // Empêcher de se supprimer soi-même
    return $user_id != $current_user_id;
}

/**
 * Compte les médias par type
 * @return array Tableau avec le nombre de médias par type
 */
function admin_count_medias_by_type()
{
    $result = [];

    // Compter les livres
    $query_books = "SELECT COUNT(*) as count FROM medias WHERE type = 'Livre'";
    $books = db_select($query_books);
    $result['total_books'] = $books[0]['count'] ?? 0;

    // Compter les films
    $query_movies = "SELECT COUNT(*) as count FROM medias WHERE type = 'Film'";
    $movies = db_select($query_movies);
    $result['total_movies'] = $movies[0]['count'] ?? 0;

    // Compter les jeux
    $query_games = "SELECT COUNT(*) as count FROM medias WHERE type = 'Jeu'";
    $games = db_select($query_games);
    $result['total_games'] = $games[0]['count'] ?? 0;

    // Compter tous les médias
    $query_total = "SELECT COUNT(*) as count FROM medias";
    $total = db_select($query_total);
    $result['total_medias'] = $total[0]['count'] ?? 0;

    return $result;
}

/**
 * Récupère les statistiques du dashboard admin
 * @return array Tableau avec les statistiques
 */
function admin_get_dashboard_stats()
{
    $stats = [];

    // Compter les utilisateurs
    $stats['total_users'] = count_users();

    // Compter les médias par type
    $medias_count = admin_count_medias_by_type();
    $stats['total_medias'] = $medias_count['total_medias'];
    $stats['total_books'] = $medias_count['total_books'];
    $stats['total_movies'] = $medias_count['total_movies'];
    $stats['total_games'] = $medias_count['total_games'];

    return $stats;
}

/**
 * Récupère un utilisateur par son ID pour l'admin
 * @param int $user_id ID de l'utilisateur
 * @return array|null Les données de l'utilisateur ou null
 */
function admin_get_user_by_id($user_id)
{
    $query = "SELECT id, firstname, lastname, email, admin, created_at
              FROM users
              WHERE id = ?";
    $result = db_select($query, [$user_id]);
    return $result ? $result[0] : null;
}

/**
 * Récupère un média par son ID pour l'admin
 * @param int $media_id ID du média
 * @return array|null Les données du média ou null
 */
function admin_get_media_by_id($media_id)
{
    $query = "SELECT medias.id, medias.title, medias.type, medias.stock, medias.picture,
                     medias.genre_id, genres.name AS genre
              FROM medias
              LEFT JOIN genres ON medias.genre_id = genres.id
              WHERE medias.id = ?";
    $result = db_select($query, [$media_id]);
    return $result ? $result[0] : null;
}

/**
 * Met à jour un utilisateur
 * @param int $user_id ID de l'utilisateur
 * @param array $data Données à mettre à jour
 * @return bool True si la mise à jour a réussi
 */
function admin_update_user($user_id, $data)
{
    $fields = [];
    $params = [];

    if (isset($data['firstname'])) {
        $fields[] = "firstname = ?";
        $params[] = $data['firstname'];
    }
    if (isset($data['lastname'])) {
        $fields[] = "lastname = ?";
        $params[] = $data['lastname'];
    }
    if (isset($data['email'])) {
        $fields[] = "email = ?";
        $params[] = $data['email'];
    }
    if (isset($data['admin'])) {
        $fields[] = "admin = ?";
        $params[] = $data['admin'];
    }

    if (empty($fields)) {
        return false;
    }

    $params[] = $user_id;
    $query = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";

    return db_execute($query, $params);
}

/**
 * Éditer un utilisateur (page d'édition)
 */
function admin_edit_user($user_id)
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    set_flash('warning', 'Fonctionnalité d\'édition en développement.');
    redirect('admin/users');
}

/**
 * Met à jour un média
 * @param int $media_id ID du média
 * @param array $data Données à mettre à jour
 * @return bool True si la mise à jour a réussi
 */
function admin_update_media($media_id, $data)
{
    $fields = [];
    $params = [];

    if (isset($data['title'])) {
        $fields[] = "title = ?";
        $params[] = $data['title'];
    }
    if (isset($data['type'])) {
        $fields[] = "type = ?";
        $params[] = $data['type'];
    }
    if (isset($data['stock'])) {
        $fields[] = "stock = ?";
        $params[] = $data['stock'];
    }
    if (isset($data['genre_id'])) {
        $fields[] = "genre_id = ?";
        $params[] = $data['genre_id'];
    }
    if (isset($data['picture'])) {
        $fields[] = "picture = ?";
        $params[] = $data['picture'];
    }
    if (isset($data['date_publication'])) {
        $fields[] = "date_publication = ?";
        $params[] = $data['date_publication'];
    }

    if (empty($fields)) {
        return false;
    }

    $params[] = $media_id;
    $query = "UPDATE medias SET " . implode(', ', $fields) . " WHERE id = ?";

    return db_execute($query, $params);
}

/**
 * Récupère tous les genres
 * @return array Liste des genres
 */
function admin_get_all_genres()
{
    $query = "SELECT id, name FROM genres ORDER BY name ASC";
    return db_select($query);
}

/**
 * Insère un nouveau média dans la base de données
 * @param array $data Données du média
 * @return int|false ID du média créé ou false
 */
function admin_insert_media($data)
{
    $query = "INSERT INTO medias (title, picture, type, genre_id, created_at, date_publication, stock, availability)
              VALUES (?, ?, ?, ?, NOW(), NOW(), ?, ?)";

    $params = [
        $data['title'],
        $data['picture'] ?? null,
        $data['type'],
        $data['genre_id'],
        //$data['date_publication'],
        $data['stock'],
        $data['availability'] // availability = stock initialement
    ];

    if (db_execute($query, $params)) {
        return db_last_insert_id($query, $params);
    }

    return false;
}

/**
 * Insère un livre dans la base de données
 * @param array $data Données du livre
 * @param int $media_id ID du média associé
 * @return bool True si la création a réussi
 */
function admin_insert_book($data, $media_id)
{
    $query = "INSERT INTO books (author, isbn, number_of_pages, date_of_publication, summary, media_id)
              VALUES (?, ?, ?, ?, ?, ?)";

    $params = [
        $data['author'],
        $data['isbn'],
        $data['number_of_pages'],
        $data['date_of_publication'],
        $data['summary'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Insère un film dans la base de données
 * @param array $data Données du film
 * @param int $media_id ID du média associé
 * @return bool True si la création a réussi
 */
function admin_insert_movie($data, $media_id)
{
    $query = "INSERT INTO movies (realisateur, duration, year, rating, synopsis, media_id)
              VALUES (?, ?, ?, ?, ?, ?)";

    $params = [
        $data['realisateur'],
        $data['duration'],
        $data['year'],
        $data['rating'],
        $data['synopsis'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Insère un jeu dans la base de données
 * @param array $data Données du jeu
 * @param int $media_id ID du média associé
 * @return bool True si la création a réussi
 */
function admin_insert_game($data, $media_id)
{
    $query = "INSERT INTO games (editor, platform, age, description, release_date, media_id)
              VALUES (?, ?, ?, ?, ?, ?)";

    $params = [
        $data['editor'],
        $data['platform'],
        $data['age'],
        $data['description'],
        $data['release_date'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Récupère les détails complets d'un média avec ses informations spécifiques
 * @param int $media_id ID du média
 * @return array|null Les données complètes du média ou null
 */
function admin_get_media_details($media_id)
{
    // Récupérer le média principal
    $media = admin_get_media_by_id($media_id);

    if (!$media) {
        return null;
    }

    // Récupérer les détails spécifiques selon le type
    if ($media['type'] === 'Livre') {
        $query = "SELECT * FROM books WHERE media_id = ?";
        $details = db_select($query, [$media_id]);
        $media['details'] = $details ? $details[0] : null;
    } elseif ($media['type'] === 'Film') {
        $query = "SELECT * FROM movies WHERE media_id = ?";
        $details = db_select($query, [$media_id]);
        $media['details'] = $details ? $details[0] : null;
    } elseif ($media['type'] === 'Jeu') {
        $query = "SELECT * FROM games WHERE media_id = ?";
        $details = db_select($query, [$media_id]);
        $media['details'] = $details ? $details[0] : null;
    }

    return $media;
}

/**
 * Met à jour un livre
 * @param array $data Données du livre
 * @param int $media_id ID du média associé
 * @return bool True si la mise à jour a réussi
 */
function admin_update_book($data, $media_id)
{
    $query = "UPDATE books
              SET author = ?, isbn = ?, number_of_pages = ?,
                  date_of_publication = ?, summary = ?
              WHERE media_id = ?";

    $params = [
        $data['author'],
        $data['isbn'],
        $data['number_of_pages'],
        $data['date_of_publication'],
        $data['summary'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Met à jour un film
 * @param array $data Données du film
 * @param int $media_id ID du média associé
 * @return bool True si la mise à jour a réussi
 */
function admin_update_movie($data, $media_id)
{
    $query = "UPDATE movies
              SET realisateur = ?, duration = ?, year = ?,
                  rating = ?, synopsis = ?
              WHERE media_id = ?";

    $params = [
        $data['realisateur'],
        $data['duration'],
        $data['year'],
        $data['rating'],
        $data['synopsis'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Met à jour un jeu
 * @param array $data Données du jeu
 * @param int $media_id ID du média associé
 * @return bool True si la mise à jour a réussi
 */
function admin_update_game($data, $media_id)
{
    $query = "UPDATE games
              SET editor = ?, platform = ?, age = ?,
                  description = ?, release_date = ?
              WHERE media_id = ?";

    $params = [
        $data['editor'],
        $data['platform'],
        $data['age'],
        $data['description'],
        $data['release_date'],
        $media_id
    ];

    return db_execute($query, $params);
}

/**
 * Récupère tous les emprunts avec les informations des utilisateurs et des médias
 * @return array Liste des emprunts
 */
function admin_get_all_borrows()
{
    $query = "SELECT
                borrow.id,
                borrow.user_id,
                borrow.media_id,
                -- borrow.borrow_duration,
                borrow.due_at,
                borrow.borrow_date,
                borrow.returned_at,
                users.firstname,
                users.lastname,
                users.email,
                medias.title AS media_title,
                medias.type AS media_type,
                medias.picture AS media_picture,
                genres.name AS genre
              FROM borrow
              LEFT JOIN users ON borrow.user_id = users.id
              LEFT JOIN medias ON borrow.media_id = medias.id
              LEFT JOIN genres ON medias.genre_id = genres.id
              ORDER BY borrow.due_at DESC";
    return db_select($query);
}

/**
 * Récupère les emprunts d'un utilisateur spécifique
 * @param int $user_id ID de l'utilisateur
 * @return array Liste des emprunts de l'utilisateur
 */
function admin_get_borrows_by_user($user_id)
{
    $query = "SELECT
                borrow.id,
                borrow.user_id,
                borrow.media_id,
                borrow.borrow_duration,
                borrow.due_at,
                borrow.returned_at,
                medias.title AS media_title,
                medias.type AS media_type,
                medias.picture AS media_picture,
                genres.name AS genre
              FROM borrow
              LEFT JOIN medias ON borrow.media_id = medias.id
              LEFT JOIN genres ON medias.genre_id = genres.id
              WHERE borrow.user_id = ?
              ORDER BY borrow.due_at DESC";
    return db_select($query, [$user_id]);
}

/**
 * Compte le nombre total d'emprunts
 * @return int Nombre total d'emprunts
 */
function admin_count_borrows()
{
    $query = "SELECT COUNT(*) as count FROM borrow";
    $result = db_select($query);
    return $result[0]['count'] ?? 0;
}

/**
 * Compte le nombre d'emprunts actifs (non retournés)
 * @return int Nombre d'emprunts actifs
 */
function admin_count_active_borrows()
{
    $query = "SELECT COUNT(*) as count FROM borrow WHERE returned_at IS NULL";
    $result = db_select($query);
    return $result[0]['count'] ?? 0;
}

/**
 * Compte le nombre d'emprunts en retard
 * @return int Nombre d'emprunts en retard
 */
function admin_count_overdue_borrows()
{
    $query = "SELECT COUNT(*) as count FROM borrow
              WHERE returned_at IS NULL AND due_at < CURDATE()";
    $result = db_select($query);
    return $result[0]['count'] ?? 0;
}

/**
 * Traiter le formulaire d'ajout de média
 */
function admin_create_media()
{
    // Protection admin
    if (!is_admin()) {
        set_flash('error', 'Accès refusé. Vous devez être administrateur.');
        redirect('home');
    }

    // Vérifier que c'est une requête POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('admin/add_media');
    }

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
        if (empty($_POST['year_book'])) {
            $errors[] = 'La date de publication est obligatoire pour un livre.';
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
        redirect('admin/add_media');
    }

    // Gérer l'image (URL ou upload)
    $picture_path = null;

    if (!empty($_POST['image_source'])) {
        if ($_POST['image_source'] === 'url' && !empty($_POST['picture_url'])) {
            // Utiliser l'URL fournie
            if (strlen($_POST['picture_url']) >= 255) {
                set_flash('error', "ERREUR : l'URL est trop long.");
                redirect('admin/add_media');
            } else {
                $picture_path = $_POST['picture_url'];
            }
        } elseif ($_POST['image_source'] === 'file' && isset($_FILES['picture_file']) && $_FILES['picture_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Upload du fichier
            $upload_result = upload_media_cover($_FILES['picture_file']);
            // print_r($upload_result);
            // print_r($_FILES);
            if ($upload_result['success']) {
                $picture_path = $upload_result['path'];
            } else {
                set_flash('error', $upload_result['error']);
                redirect('admin/add_media');
            }
        }
    }

    // Créer le média dans la table medias
    $media_data = [
        'title' => $_POST['title'],
        'picture' => $picture_path,
        'type' => $type,
        'genre_id' => $_POST['genre_id'],
        // 'date_publication' => $_POST['date_publication'],
        'stock' => $_POST['stock'],
        'availability' => 0
    ];

    $media_id = admin_insert_media($media_data);

    if (!$media_id) {
        set_flash('error', 'Erreur lors de la création du média.');
        redirect('admin/add_media');
    }

    // Créer les détails spécifiques selon le type
    $success = false;

    if ($type === 'Livre') {
        $book_data = [
            'author' => $_POST['author'],
            'isbn' => $_POST['isbn'],
            'number_of_pages' => $_POST['number_of_pages'],
            'date_of_publication' => $_POST['year_book'],
            'summary' => $_POST['summary']
        ];
        $success = admin_insert_book($book_data, $media_id);
    } elseif ($type === 'Film') {
        $movie_data = [
            'realisateur' => $_POST['realisateur'],
            'duration' => $_POST['duration'],
            'year' => $_POST['year'],
            'rating' => $_POST['rating'],
            'synopsis' => $_POST['synopsis']
        ];
        $success = admin_insert_movie($movie_data, $media_id);
    } elseif ($type === 'Jeu') {
        $game_data = [
            'editor' => $_POST['editor'],
            'platform' => $_POST['platform'],
            'age' => $_POST['age'],
            'description' => $_POST['description'],
            'release_date' => $_POST['release_date']
        ];
        $success = admin_insert_game($game_data, $media_id);
    }

    if ($success) {
        set_flash('success', 'Média ajouté avec succès !');
        redirect('admin/medias');
    } else {
        set_flash('error', 'Erreur lors de la création des détails du média.');
        redirect('admin/add_media');
    }
}

/**
 * Force le retour d'un média
 */
function force_return($borrow_id)
{
    $query = "SELECT borrow.user_id, borrow.media_id FROM borrow
    WHERE borrow.id = ?";
    $ids = db_select_one($query, [$borrow_id]);

    return_borrow($ids["user_id"], $ids["media_id"]);
    increase_availability($ids["media_id"]);
}

/**
 * Récupère tous les messages de contact
 * @return array Liste des messages de contact
 */
function admin_get_all_contacts()
{
    $query = "SELECT id, name, email, message, created_at, read_at
              FROM contact_message
              ORDER BY created_at DESC";
    return db_select($query);
}

/**
 * Compte le nombre total de messages de contact
 * @return int Nombre total de messages
 */
function admin_count_contacts()
{
    $query = "SELECT COUNT(*) as count FROM contact_message";
    $result = db_select($query);
    return $result[0]['count'] ?? 0;
}

/**
 * Compte le nombre de messages non lus
 * @return int Nombre de messages non lus
 */
function admin_count_unread_contacts()
{
    $query = "SELECT COUNT(*) as count FROM contact_message WHERE read_at IS NULL";
    $result = db_select($query);
    return $result[0]['count'] ?? 0;
}

/**
 * Marque un message comme lu
 * @param int $contact_id ID du message
 * @return bool True si la mise à jour a réussi
 */
function admin_mark_contact_as_read($contact_id)
{
    $query = "UPDATE contact_message SET read_at = NOW() WHERE id = ? AND read_at IS NULL";
    return db_execute($query, [$contact_id]);
}

/**
 * Supprime un message de contact
 * @param int $contact_id ID du message à supprimer
 * @return bool True si la suppression a réussi
 */
function admin_delete_contact($contact_id)
{
    $query = "DELETE FROM contact_message WHERE id = ?";
    return db_execute($query, [$contact_id]);
}

/**
 * Vérifie si un genre existe
 */
function does_genre_exist($genre)
{
    $verify = "SELECT name FROM genres";
    $genres_rough = db_select($verify);
    $all_genres = [];
    foreach ($genres_rough as $g) {
        $all_genres[] = strtolower($g["name"]);
    }
    if (in_array(strtolower($genre), $all_genres)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Ajoute un nouveau genre à la base de donnée "genres"
 */
function admin_insert_genre($genre)
{
    $query = "INSERT INTO genres (name) VALUES (?)";
    return db_execute($query, [$genre]);
}
