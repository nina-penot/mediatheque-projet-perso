<?php
// Fonctions utilitaires

/**
 * Sécurise l'affichage d'une chaîne de caractères (protection XSS)
 */
function escape($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8'); /*ajout de ?? ''*/
}

/**
 * Affiche une chaîne sécurisée (échappée)
 */
function e($string)
{
    echo escape($string);
}

/**
 * Retourne une chaîne sécurisée sans l'afficher
 */
function esc($string)
{
    return escape($string);
}

/**
 * Génère une URL absolue
 */
function url($path = '')
{
    $base_url = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base_url . '/' . $path;
}

/**
 * Redirection HTTP
 */
function redirect($path = '')
{
    $url = url($path);
    header("Location: $url");
    exit;
}

/**
 * Génère un token CSRF
 */
function csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie un token CSRF
 */
function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Définit un message flash
 */
function set_flash($type, $message)
{
    $_SESSION['flash_messages'][$type][] = $message;
}

/**
 * Récupère et supprime les messages flash
 */
function get_flash_messages($type = null)
{
    if (!isset($_SESSION['flash_messages'])) {
        return [];
    }

    if ($type) {
        $messages = $_SESSION['flash_messages'][$type] ?? [];
        unset($_SESSION['flash_messages'][$type]);
        return $messages;
    }

    $messages = $_SESSION['flash_messages'];
    unset($_SESSION['flash_messages']);
    return $messages;
}

/**
 * Vérifie s'il y a des messages flash
 */
function has_flash_messages($type = null)
{
    if (!isset($_SESSION['flash_messages'])) {
        return false;
    }

    if ($type) {
        return !empty($_SESSION['flash_messages'][$type]);
    }

    return !empty($_SESSION['flash_messages']);
}

/**
 * Nettoie une chaîne de caractères
 */
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Vérifie si un prénom ou un nom n'a que des lettres, espaces ou tirets
 */
function is_name_correct($name)
{
    if (preg_match("/^[a-zA-Z\p{L}\s\- ]+$/u", $name)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Rend le premier élément d'un string en majuscule (est utilisé dans allstr_upper_case)
 */
function str_upper_case($name)
{
    $accents = array(
        'à' => 'À',
        'á' => 'Á',
        'â' => 'Â',
        'ã' => 'Ã',
        'ä' => 'Ä',
        'å' => 'Å',
        'æ' => 'Æ',
        'ç' => 'Ç',
        'è' => 'È',
        'é' => 'É',
        'ê' => 'Ê',
        'ë' => 'Ë',
        'ì' => 'Ì',
        'í' => 'Í',
        'î' => 'Î',
        'ï' => 'Ï',
        'ñ' => 'Ñ',
        'ò' => 'Ò',
        'ó' => 'Ó',
        'ô' => 'Ô',
        'õ' => 'Õ',
        'ö' => 'Ö',
        'œ' => 'Œ',
        'ù' => 'Ù',
        'ú' => 'Ú',
        'û' => 'Û',
        'ü' => 'Ü',
        'ý' => 'Ý',
        'ÿ' => 'Ÿ'
    );
    $name[0] = strtoupper($name[0]);

    $letter = $name[0] . $name[1];
    $newstr = "";

    if (array_key_exists($letter, $accents)) {
        $letter = $accents[$letter];
        for ($num = 2; isset($name[$num]); $num++) {
            $newstr = $newstr . $name[$num];
        }
        $name = $letter . $newstr;
    }

    return $name;
}

/**
 * Transforme un nom ou un prénom pour mettre la 1ère lettre en majuscule, fonctionne aussi
 * avec des nom/prénoms composés
 */
function allstr_upper_case($name)
{
    $separators = [" ", "-"];
    $test = preg_split('/([- ]+)/', $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $myname = "";

    for ($num = 0; isset($test[$num]); $num++) {
        if (!in_array($test[$num], $separators)) {
            $test[$num] = str_upper_case($test[$num]);
            $myname = $myname . $test[$num];
        } else {
            $myname = $myname . $test[$num];
        }
    }

    return $myname;
}

/**
 * Valide une adresse email
 */
function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Génère un mot de passe sécurisé
 */
function generate_password($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

/**
 * Hache un mot de passe
 */
function hash_password($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Vérifie si un mot de passe a une majuscule, une minuscule et un chiffre
 */
function has_maj_min_num($password)
{
    if (preg_match('/[a-z]/', $password) and preg_match('/[A-Z]/', $password) and preg_match('/[0-9]/', $password)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Vérifie un mot de passe
 */
function verify_password($password, $hash)
{
    return password_verify($password, $hash);
}

/**
 * Formate une date
 */
function format_date($date, $format = 'd/m/Y H:i')
{
    return date($format, strtotime($date));
}

/**
 * Vérifie si une requête est en POST
 */
function is_post()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Vérifie si une requête est en GET
 */
function is_get()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Retourne la valeur d'un paramètre POST
 */
function post($key, $default = null)
{
    return $_POST[$key] ?? $default;
}

/**
 * Retourne la valeur d'un paramètre GET
 */
function get($key, $default = null)
{
    return $_GET[$key] ?? $default;
}

/**
 * Vérifie si un utilisateur est connecté
 */
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

/**
 * Retourne l'ID de l'utilisateur connecté
 */
function current_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

/**
 * Déconnecte l'utilisateur
 */
function logout()
{
    session_destroy();
    redirect('auth/login');
}

/**
 * Formate un nombre
 */
function format_number($number, $decimals = 2)
{
    return number_format($number, $decimals, ',', ' ');
}

/**
 * Génère un slug à partir d'une chaîne
 */
function generate_slug($string)
{
    // Caractères spéciaux français vers ASCII
    $accents = [
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ü' => 'u',
        'ý' => 'y',
        'ÿ' => 'y',
        'ñ' => 'n',
        'ç' => 'c',
        'œ' => 'oe',
        'æ' => 'ae'
    ];

    // Convertir en minuscules et remplacer les accents
    $string = strtolower($string);
    $string = strtr($string, $accents);

    // Remplacer les apostrophes par des tirets avant de tout supprimer
    $string = str_replace(['\'', '`', chr(8217)], '-', $string);

    // Supprimer tout sauf lettres, chiffres, espaces et tirets
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);

    // Remplacer espaces et tirets multiples par un seul tiret
    $string = preg_replace('/[\s-]+/', '-', $string);

    // Supprimer les tirets en début et fin
    return trim($string, '-');
}

function is_admin(): bool
{
    return isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1;
}

/**
 * Upload une image de couverture de média
 * @param array $file Le fichier depuis $_FILES
 * @return array Résultat avec 'success' (bool), 'path' (string) ou 'error' (string)
 */
function upload_media_cover($file)
{
    // Vérifier l'extension
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $max_size = 2 * 1024 * 1024; // 2MB

    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    //Récupère la taille de l'image
    $px_size = getimagesize($file['tmp_name']);

    $result = ['success' => false];
    //RECODE -------
    if (
        //Vérifie si le fichier existe
        !isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE
        //Véerifie si il y a une erreur d'upload
        or $file['error'] !== UPLOAD_ERR_OK
        //Vérifie si le fichier est plus lourd que 2MB
        or $file['size'] > $max_size
        //Vérifie que le ficher ait une extension correcte
        or !in_array($file_extension, $allowed_extensions)
        //Vérifie que le mime du fichier soit correct
        or !in_array($mime_type, $allowed_mimes)
        //Vérifie si le fichier est plus petit que 100px de large ou de hauteur
        or $px_size[0] < 100 or $px_size[1] < 100
    ) {
        //$test = ["file" => $file, "result" => $result, "finfo" => $finfoagain, "px" => $px_size];
        $result['error'] = "Erreur lors de l'upload de l'image. Vérifiez le format et la taille";
        return $result;
    } else {
        // Générer un nom de fichier unique

        $unique_name = uniqid('cover_', true) . '.' . $file_extension;
        $upload_dir = PUBLIC_PATH . '/uploads/covers/';
        $upload_path = $upload_dir . $unique_name;

        // Déplacer le fichier

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Retourner le chemin relatif depuis public
            $result['success'] = true;
            $result['path'] = '/uploads/covers/' . $unique_name;
            return $result;
        } else {
            $result['error'] = 'Impossible de sauvegarder le fichier.';
            return $result;
        }
    }
    //-------
    // Vérifier qu'un fichier a été uploadé
    // if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
    //     $result['error'] = 'Aucun fichier fourni.';
    //     return $result;
    // }

    // Vérifier les erreurs d'upload
    // if ($file['error'] !== UPLOAD_ERR_OK) {
    //     $result['error'] = 'Erreur lors de l\'upload du fichier.';
    //     return $result;
    // }

    // Vérifier la taille (2MB max = 2097152 bytes)
    // if ($file['size'] > $max_size) {
    //     $result['error'] = 'Le fichier dépasse la taille maximum de 2 MB.';
    //     return $result;
    // }

    // if (!in_array($file_extension, $allowed_extensions)) {
    //     $result['error'] = 'Format non autorisé. Utilisez JPG, PNG ou GIF uniquement.';
    //     return $result;
    // }

    // Vérifier le type MIME
    // if (!in_array($mime_type, $allowed_mimes)) {
    //     $result['error'] = 'Type de fichier non autorisé.';
    //     return $result;
    // }

    // if ($px_size[0] < 100 or $px_size[1] < 100) {
    //     $result['error'] = 'Image trop petite.';
    //     return $result;
    // }
}
