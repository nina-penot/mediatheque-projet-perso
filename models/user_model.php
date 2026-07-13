<?php
// Modèle pour les utilisateurs

/**
 * Récupère un utilisateur par son email
 */
function get_user_by_email($email)
{
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    return db_select_one($query, [$email]);
}

/**
 * Récupère un utilisateur par son ID
 */
function get_user_by_id($id)
{
    $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
    return db_select_one($query, [$id]);
}

/**
 * Crée un nouvel utilisateur
 */
function create_user($firstname, $lastname, $email, $password)
{
    $hashed_password = hash_password($password);
    $query = "INSERT INTO users (firstname, lastname, email, password, created_at) VALUES (?, ?, ?, ?, NOW())";

    if (db_execute($query, [$firstname, $lastname, $email, $hashed_password])) {
        return db_last_insert_id();
    }

    return false;
}

/**
 * Met à jour un utilisateur
 */

function update_user($id, $firstname, $lastname, $email)
{
    $firstname = allstr_upper_case($firstname);
    $lastname = allstr_upper_case($lastname);
    $_SESSION['user_name'] = $firstname . " " . $lastname;
    $_SESSION['user_email'] = $email;
    $query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, updated_at = NOW() WHERE id = ?";
    return db_execute($query, [$firstname, $lastname, $email, $id]);
}

//function update_user($id, $name, $email)
//{
//$query = "UPDATE users SET name = ?, email = ?, updated_at = NOW() WHERE id = ?";
//return db_execute($query, [$name, $email, $id]);
//}

/**
 * Met à jour le mot de passe d'un utilisateur, en vérifiant l'ancien.
 * Cette fonction est utilisée par le contrôleur de profil.
 * * @param int $user_id ID de l'utilisateur
 * @param string $current_password Mot de passe actuel non haché
 * @param string $new_password Nouveau mot de passe non haché
 * @return bool True si la mise à jour a réussi, False sinon (mauvais mot de passe actuel ou erreur BDD)
 */
function update_user_password_secured($user_id, $current_password, $new_password)
{
    //  Récupère l'utilisateur pour accéder au hash actuel

    $user = get_user_by_id($user_id);

    if (!$user) {
        return false;
    }

    // Vérifie si le mot de passe actuel correspond au hash stocké

    if (!verify_password($current_password, $user['password'])) {
        return false; // Échec de l'authentification
    }

    // Hache le nouveau mot de passe

    $hashed_password = hash_password($new_password);

    // Met à jour dans la base de données
    $query = "UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?";
    return db_execute($query, [$hashed_password, $user_id]);
}


/**
 * Supprime un utilisateur
 */
function delete_user($id)
{
    $query = "DELETE FROM users WHERE id = ?";
    return db_execute($query, [$id]);
}

/**
 * Récupère tous les utilisateurs
 */
function get_all_users($limit = null, $offset = 0)
{
    $query = "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC";

    if ($limit !== null) {
        $query .= " LIMIT $offset, $limit";
    }

    return db_select($query);
}

/**
 * Compte le nombre total d'utilisateurs
 */
function count_users()
{
    $query = "SELECT COUNT(*) as total FROM users";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

/**
 * Vérifie si un email existe déjà
 */
function email_exists($email, $exclude_id = null)
{
    $query = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $params = [$email];

    if ($exclude_id) {
        $query .= " AND id != ?";
        $params[] = $exclude_id;
    }

    $result = db_select_one($query, $params);
    return $result['count'] > 0;
}

/**
 * Récupère les données de base d'un utilisateur pour son profil.
 * Similaire à get_user_by_id, mais sélectionne uniquement les champs pour l'affichage public.
 * @param int $user_id ID de l'utilisateur
 * @return array|null Les données de l'utilisateur (firstname, lastname, email, admin) ou null
 */
function get_user_profile($user_id)
{
    // Note: get_user_by_id() fonctionne car elle fait SELECT *, mais cette version est plus propre.
    $query = "SELECT id, firstname, lastname, email, admin AS is_admin
              FROM users
              WHERE id = ? LIMIT 1";
    $result = db_select_one($query, [$user_id]);

    return $result;
}

/**
 * Récupère la liste des prêts en cours de l'utilisateur.
 * @param int $user_id ID de l'utilisateur
 * @return array Liste des prêts (titre du média, date d'emprunt, date de retour prévue)
 */
function get_user_current_borrows($user_id)
{
    // La table 'loans' est à créer.
    $query = "SELECT medias.id, medias.title AS media, medias.type, medias.picture, borrow.borrow_date, borrow.due_at
              FROM borrow
              JOIN medias ON borrow.media_id = medias.id
              WHERE borrow.user_id = ? 
              AND borrow.returned_at IS NULL
              ORDER BY borrow.due_at ASC";

    return db_select($query, [$user_id]); // Utilisation de db_select pour plusieurs résultats
}

/**
 * Récupère l'historique de tous les emprunts d'un utilisateur
 */
function get_user_borrow_history($user_id)
{
    $query = "SELECT medias.title AS media, medias.type, borrow.borrow_date, borrow.returned_at
              FROM borrow
              JOIN medias ON borrow.media_id = medias.id
              WHERE borrow.user_id = ?
              AND borrow.returned_at IS NOT NULL
              ORDER BY borrow.due_at ASC";

    return db_select($query, [$user_id]);
}

/**
 * Récupère les emprunts en retard d'un utilisateur
 * @param int $user_id ID de l'utilisateur
 * @return array Liste des emprunts en retard avec les détails du média
 */
function get_user_overdue_borrows($user_id)
{
    $query = "SELECT medias.id, medias.title AS media, medias.type, medias.picture,
                     borrow.borrow_date, borrow.due_at,
                     DATEDIFF(CURDATE(), borrow.due_at) AS days_overdue
              FROM borrow
              JOIN medias ON borrow.media_id = medias.id
              WHERE borrow.user_id = ?
              AND borrow.returned_at IS NULL
              AND borrow.due_at < CURDATE()
              ORDER BY borrow.due_at ASC";

    return db_select($query, [$user_id]);
}

/**
 * Permet de rendre un média
 */
function return_borrow($user_id, $media_id)
{
    $query = "UPDATE borrow
    SET borrow.returned_at = NOW()
    WHERE borrow.user_id = ? AND borrow.media_id = ?";

    return db_execute($query, [$user_id, $media_id]);
}

/**
 * Diminue la colonne "availability" du média pour augmenter le stock disponible
 */
function increase_availability($media_id)
{
    $query = "UPDATE medias SET medias.availability = medias.availability - 1
    WHERE medias.id = ?";
    db_execute($query, [$media_id]);
}


/**
 * Gère la soumission du formulaire de mise à jour des informations personnelles (nom, prénom, email).
 */
function profile_update_info_action($user_id)
{
    // Récupération sécurisée des données du formulaire
    $lastname = post('lastname'); // post() est supposée nettoyer les données
    $firstname = post('firstname');
    $email = post('email');

    // Récupération des données utilisateur actuelles pour l'ancienne adresse e-mail
    $current_user = get_user_profile($user_id);

    $errors = [];

    // --- 1. Validation ---
    if (empty($lastname) || strlen($lastname) < 2) {
        $errors[] = "Le nom doit contenir au moins 2 caractères.";
    }
    if (empty($firstname) || strlen($firstname) < 2) {
        $errors[] = "Le prénom doit contenir au moins 2 caractères.";
    }
    // Validation du format d'email (rudimentaire, à renforcer)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    }

    // --- 2. Vérification de l'unicité de l'email ---
    // Si l'email a changé, vérifiez qu'il n'est pas déjà utilisé par un AUTRE utilisateur
    if ($current_user && $email !== $current_user['email']) {
        if (email_exists($email, $user_id)) {
            $errors[] = "Cette adresse email est déjà utilisée par un autre compte.";
        }
    }

    // --- 3. Traitement final ---
    if (!empty($errors)) {
        // Enregistre les erreurs et redirige vers le profil
        set_flash('error', implode('<br>', $errors));
    } else {
        // Appelle la fonction du Modèle pour la mise à jour
        if (update_user($user_id, $firstname, $lastname, $email)) {
            // Optionnel : Mettre à jour la session (si vous stockez le nom/prénom en session)
            // update_session_info($firstname, $lastname, $email); 
            if (!empty($email)) {
                $_SESSION['user_email'] = $email;
            }
            set_flash('success', 'Vos informations personnelles ont été mises à jour avec succès. ✅');
        } else {
            set_flash('error', "Une erreur est survenue lors de la mise à jour de la base de données.");
        }
    }

    redirect('home/profile');
}




/**
 *Changement de mot de passe 
 */
function profile_change_password_action($user_id)
{
    $current_password = post('current_password');
    $new_password     = post('new_password');
    $confirm_password = post('confirm_password');



    if ($new_password !== $confirm_password) {
        set_flash('error', 'Les nouveaux mots de passe ne correspondent pas.');
    } elseif (/* ... autres validations ... */false) {
        // ...
    } else {
        // vérification de l'ancien mot de passe et la mise à jour
        if (update_user_password_secured($user_id, $current_password, $new_password)) {
            set_flash('success', 'Votre mot de passe a été mis à jour avec succès.');
        } else {
            set_flash('error', 'Mot de passe actuel incorrect ou erreur de mise à jour.');
        }
    }

    redirect('home/profile');
}

/**
 * Sauvegarde les message de contact dans la base de données contact_message
 */
function save_contact_message($name, $email, $message)
{
    $query = "INSERT INTO contact_message (name, email, message, created_at)
    VALUES (?, ?, ?, NOW() )";
    db_execute($query, [$name, $email, $message]);
}
