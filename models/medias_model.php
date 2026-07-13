<?php

//use function PHPSTORM_META\type;

/**
 * Récupère la liste de tous les médias sans précision en rapport avec leur type
 */
function get_all_medias()
{
    $query = "SELECT medias.title, medias.type, medias.stock, genres.name AS 'genre' FROM medias LEFT JOIN genres ON medias.genre_id = genres.id;";
    return db_select($query);
}

/**
 * Retourne le nom de la table selon le type de média
 */
function get_media_type_table($media_id)
{
    $query = "SELECT medias.type from medias where medias.id ='" . $media_id . "'";
    $arraytype = db_select_one($query);
    if ($arraytype == "" or $arraytype == NULL) {
        return "error";
    } else {
        $type = strtolower($arraytype["type"]);
        $type_to_table = ["jeu" => "games", "livre" => "books", "film" => "movies"];
        return $type_to_table[$type];
    }
}

/**
 * Vérifie si le média est un livre
 */
function is_type_book($media_id)
{
    $type = get_media_type_table($media_id);
    if ($type == "books") {
        return true;
    } else {
        return false;
    }
}

/**
 * Vérifie si le média est un film
 */
function is_type_movie($media_id)
{
    $type = get_media_type_table($media_id);
    if ($type == "movies") {
        return true;
    } else {
        return false;
    }
}

/**
 * Vérifie si le média est un jeu vidéo
 */
function is_type_game($media_id)
{
    $type = get_media_type_table($media_id);
    if ($type == "games") {
        return true;
    } else {
        return false;
    }
}

// function get_media_general_info($media_id)
// {
//     $type_table = get_media_type_table($media_id);
//     if ($type_table == "error") {
//         return "error";
//     } else {
//         $descr_get = [
//             "games" => "games.description as 'descr'",
//             "movies" => "movies.synopsis as 'descr'",
//             "books" => "books.summary as 'descr'"
//         ];
//         $join = "LEFT JOIN " . $type_table . " on medias.id = " . $type_table . ".media_id";
//         $query = "SELECT medias.id, medias.title, medias.type, medias.availability, medias.stock, medias.picture, 
//     genres.name AS 'genre', " . $descr_get[$type_table] . " FROM medias 
//     LEFT JOIN genres ON medias.genre_id = genres.id " . $join . " WHERE medias.id = '" . $media_id . "';";
//         $info = db_select_one($query);
//         return $info;
//     }
// }

/**
 * Récupère toutes les infos d'un média
 */
function get_media_general_info($media_id)
{
    $query = "SELECT medias.id, medias.title, medias.picture, medias.type, medias.date_publication,
     medias.stock, medias.availability, 
     genres.name as 'genre' from medias 
    LEFT JOIN genres ON medias.genre_id = genres.id WHERE medias.id = " . $media_id;
    $media = db_select_one($query);
    if ($media == "" or $media == NULL) {
        return "error";
    } else {
        return $media;
    }
}

/**
 * Récupère les infos supplémentaires d'un média selon son type
 */
function get_media_additional_info($id)
{
    $type = get_media_type_table($id);
    $query = "SELECT * from " . $type . " WHERE media_id = " . $id;
    $addinfo = db_select_one($query);
    if ($addinfo == "" or $addinfo == NULL) {
        return "error";
    } else {
        return $addinfo;
    }
}

/**
 * Récupère la liste des média et peut appliquer des filtres de recherche
 * 
 * Donne des valeurs NULL par défaut si aucun paramètre n'est précisé
 * 
 * Adapte la query selon les paramètres rentrés
 * 
 */
function get_all_filtered_medias($has_type = NULL, $has_genre = NULL, $has_search = NULL, $has_avai = NULL)
{
    $query = "SELECT medias.id, 
    medias.title, 
    medias.type, 
    medias.availability, 
    medias.stock, medias.picture, genres.name AS 'genre', 
    movies.synopsis as 'movie_synopsis', books.summary as 'book_summary', 
    games.description as 'game_description' 
    FROM medias LEFT JOIN genres ON medias.genre_id = genres.id 
    LEFT JOIN movies on medias.id = movies.media_id 
    LEFT JOIN books on medias.id = books.media_id 
    LEFT JOIN games on medias.id = games.media_id 
    WHERE medias.visibility = TRUE";
    $types = "AND medias.type = '$has_type' ";
    $genres = "AND genres.name =  '$has_genre' ";
    $search = "AND medias.title LIKE '%$has_search%'";
    $avai_true = "AND medias.availability != medias.stock";
    $avai_false = "AND medias.availability = medias.stock";
    $modifiers = [];
    $new_query = $query;

    //Vérifie les conditions qui existent et les ajoute dans les modifiers
    if ($has_type != NULL or $has_type != "") {
        $new_query = $new_query . " " . $types;
        $modifiers[] = $has_type;
    }

    if ($has_genre != NULL or $has_genre != "") {
        $new_query = $new_query . " " . $genres;
        $modifiers[] = $has_genre;
    }

    if ($has_search != NULL or $has_search != "") {
        $new_query = $new_query . " " . $search;
        $modifiers[] = $has_search;
    }

    if ($has_avai != NULL or $has_avai != "") {
        if ($has_avai == "available") {
            $new_query = $new_query . " " . $avai_true;
            $modifiers[] = $avai_true;
        } elseif ($has_avai == "unavailable") {
            $new_query = $new_query . " " . $avai_false;
            $modifiers[] = $avai_false;
        }
    }

    //Si il n'y pas de modifiers, utilise la query pour tous les médias
    //Si il y en a, utilise la nouvelle query formée avec les filtres
    if ($modifiers = []) {
        return db_select($query);
    } else {
        return db_select($new_query);
    }
}

/**
 * Retourne une liste entière de tous les genres
 */
function get_all_genres()
{
    $query = "SELECT genres.name FROM `genres`";
    return db_select($query);
}

/**
 * Assigne une image par défaut si il n'y a pas d'image
 */
function assign_image($img_url)
{
    if ($img_url == NULL or $img_url == "") {
        $new_data = url('assets/images/default_image.svg');
    } elseif (str_contains($img_url, '/uploads/covers/cover')) {
        $img_url = ltrim($img_url, $img_url[0]);
        if (!file_exists($img_url)) {
            $new_data = url('assets/images/default_image.svg');
        } else {
            $new_data = url($img_url);
        }
    } else {
        $new_data = $img_url;
    }

    return $new_data;
}

/**
 * Renseigne si un média est disponible
 */
function is_available($stock, $availability)
{
    if ($availability < $stock) {
        return true;
    } else {
        return false;
    }

    if ($stock == 0) {
        return false;
    }
}

/**
 * Calcule à partir de quel élément de l'array la page doit commencer
 */
function calc_start($page, $amount)
{
    $num = ($page - 1) * $amount;
    return $num;
}

/**
 * Calcule le dernier élément de l'array à afficher
 */
function calc_end($page, $amount)
{
    $num = $amount * $page - 1;
    return $num;
}

/**
 * Calcule le nombre de pages totales automatiquement
 */
function calc_page($table, $amount)
{
    $length = count($table);
    $pages = $length / $amount;
    return ceil($pages);
}

/**
 * Affiche une certain nombre d'éléments par page
 */
function media_per_page($page, $elem_per_page, $media_table)
{
    if ($page == 0) {
        $page = 1;
    }
    $my_medias = [];
    for ($num = calc_start($page, $elem_per_page); $num <= calc_end($page, $elem_per_page) and isset($media_table[$num]); $num++) {
        $my_medias[] = $media_table[$num];
    }

    return $my_medias;
}

/**
 * Retourne les infos d'un média sélectionné
 */
function get_selected_media($title)
{
    $query = "";
}

/**
 * Contrôle le status du formulaire validation d'emprunt
 * Cache le formulaire de validation d'emprunt si il manque le GET "c"
 */
function form_status()
{
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if (str_contains($url, "&c=1")) {
        return 'block';
    } else {
        return 'none';
    }
}

/**
 * Compte le nombre d'emprunts d'un utilisateur
 */
function count_borrows($user_id)
{
    $query = "SELECT COUNT(user_id) as 'amount' FROM borrow 
    WHERE user_id = ? AND borrow.returned_at IS NULL";
    $arr = db_select_one($query, [$user_id]);
    $count = $arr["amount"];
    return $count;
}

/**
 * Vérifie si l'utilisateur a déjà emprunté ce média
 */
function check_if_borrowed($user_id, $media_id)
{
    $query = "SELECT borrow.user_id, borrow.media_id FROM borrow 
    WHERE borrow.user_id = ? AND borrow.returned_at IS NULL";
    $big_array = db_select($query, [$user_id]);
    $result = ['user_id' => $user_id];
    foreach ($big_array as $small_array) {
        foreach ($small_array as $key => $value) {
            if ($key == 'media_id') {
                $result['medias'][] = $value;
            }
        }
    }

    if (empty($result['medias'])) {
        return false;
    } else {
        if (in_array($media_id, $result['medias'])) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Ajoute un emprunt dans la base de données
 */
function add_borrows($user_id, $media_id)
{
    $get_media_info = "SELECT medias.title, medias.genre_id, medias.type
    FROM medias
    WHERE medias.id = ?";
    $media_info = db_select_one($get_media_info, [$media_id]);
    $get_user_info = "SELECT users.firstname, users.lastname, users.email
    FROM users
    WHERE users.id = ?";
    $user_info = db_select_one($get_user_info, [$user_id]);
    $query = "INSERT INTO borrow (borrow.user_id, borrow.media_id, borrow.borrow_date, borrow.due_at,
    borrow.media_title, borrow.media_genre, borrow.media_type,
    borrow.user_firstname, borrow.user_lastname, borrow.user_email)
    VALUES (?, ?, NOW(), NOW() + INTERVAL 14 DAY, ?, ?, ?, ?, ?, ?)";
    $params = [
        $user_id,
        $media_id,
        $media_info['title'],
        $media_info['genre_id'],
        $media_info['type'],
        $user_info['firstname'],
        $user_info['lastname'],
        $user_info['email']
    ];
    return db_execute($query, $params);
}

/**
 * Retourne la date de retour prévue
 */
function get_due_date($user_id, $media_id)
{
    $query = "SELECT borrow.due_at FROM borrow WHERE borrow.user_id = ? AND borrow.media_id = ?";
    $date = db_select_one($query, [$user_id, $media_id]);
    return $date["due_at"];
}

/**
 * Augmente la colonne "availability" du média pour diminuer le stock disponible
 */
function decrease_availability($media_id)
{
    $query = "UPDATE medias SET medias.availability = medias.availability + 1
    WHERE medias.id = ?";
    db_execute($query, [$media_id]);
}
