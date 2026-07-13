<?php

/**
 * Copier le code dans register pour la logique avec posts
 * si il y a post dans le form de recherche, changer la func query media (voir
 * medias_model.php)
 */

/**
 * Page library
 */
function media_library()
{
    //Fait en sorte qu'il y a toujours au moins une page
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    $memory = 'memory';
    $search_mem = 'search_mem';
    $type_mem = 'type_mem';
    $genre_mem = 'genre_mem';
    $available_mem = 'available_mem';

    if (
        //Vérifie si une recherche a été lancée
        isset($_POST['search'])
        or isset($_POST['type'])
        or isset($_POST['genre'])
        or isset($POST['available'])
    ) {
        //Retourne à la page 1 si une recherche est lancée
        $page = 1;
        //Gestion de filtre médias
        $search = post('search');
        $type = post('type');
        $genre = post('genre');
        $available = post('available');

        //Garde la recherche en mémoire (pour qu'elle continue d'exister)
        //même si il y a un changement de page
        $_SESSION[$memory] = [
            $search_mem => $search,
            $type_mem => $type,
            $genre_mem => $genre,
            $available_mem => $available
        ];
    }

    //Filtre les médias en utilisant les paramètres de recherche sauvegardés
    if (isset($_SESSION[$memory]) and $_SESSION[$memory] != array()) {
        $all_medias = get_all_filtered_medias(
            $_SESSION[$memory][$type_mem],
            $_SESSION[$memory][$genre_mem],
            $_SESSION[$memory][$search_mem],
            $_SESSION[$memory][$available_mem]
        );
    } else {
        $all_medias = get_all_filtered_medias();
    }

    //Gère le get qui provient lorsque l'on clique sur une des catégories type de la
    //page d'accueil
    if (
        isset($_GET["type"])
        and (!isset($_POST['search']) or !isset($_POST['type']) or !isset($_POST['genre']) or !isset($_POST['available']))
    ) {
        $_SESSION[$memory] = [$search_mem => NULL, $type_mem => NULL, $genre_mem => NULL, $available_mem => NULL];
        switch ($_GET["type"]) {
            case "Livre":
                $_SESSION[$memory][$type_mem] = "livre";
                $all_medias = get_all_filtered_medias($_SESSION[$memory][$type_mem]);
                break;
            case "Film":
                $_SESSION[$memory][$type_mem] = "film";
                $all_medias = get_all_filtered_medias($_SESSION[$memory][$type_mem]);
                break;
            case "Jeu":
                $_SESSION[$memory][$type_mem] = "jeu";
                $all_medias = get_all_filtered_medias($_SESSION[$memory][$type_mem]);
                break;
        }
    }

    //Calcule le nombre de pages maximale selon le nombre de médias affiché
    $max_page = calc_page($all_medias, 20);

    //Aucun média donne une seule page
    if (count($all_medias) === 0) {
        $max_page = 1;
    }

    //Dans un cas où la page excède le nombre de page maximum, retourne à la page 1
    if ($page > $max_page) {
        redirect("media/library?page=1");
    }

    //Récupère la liste de tous les genres
    $genres = get_all_genres();

    $data = [
        'title' => 'Liste des médias',
        // 'message' => 'Bienvenue sur votre profil',
        'medias' => $all_medias,
        'min_page' => 1,
        'max_page' => $max_page,
        'page' => $page,
        'genres' => $genres
    ];

    load_view_with_layout('media/library', $data);
}

function media_mediapage()
{
    if (isset($_GET["media"])) {

        $media_id = $_GET["media"];
        //Récupère les informations du média
        //Retourne "error" si ce média n'existe pas
        $media = get_media_general_info($media_id);
        //Vérifie si le formulaire de validation doit être montré ou caché
        $form_status = form_status();

        if ($media == "error") {
            redirect('media/library');
        } else {
            //Si le média existe, récupère les informations additionelles
            $addition = get_media_additional_info($media_id);
            //Si le formulaire de validation d'emprunt est utilisé
            if (is_post()) {
                if (isset($_POST["yes"])) {
                    //Vérifie si l'utilisateur est connecté
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $borrows = (int) count_borrows($user_id);
                        //Vérifie si l'utilisateur a déjà 3 emprunts
                        if ($borrows == NULL or $borrows == "" or $borrows < 3) {
                            //Vérifie si l'utilisateur a déjà emprunté ce média
                            if (!check_if_borrowed($user_id, $media_id)) {
                                //Ajoute l'emprunt
                                add_borrows($user_id, $media_id);
                                //Récupère la date de retour prévue
                                $due_date = get_due_date($user_id, $media_id);
                                //Retire 1 du nombre de médias disponibles
                                decrease_availability($media_id);
                                set_flash('success', "Emprunt enregistré avec succès. 
                                Date de retour prévue: " . $due_date);
                                redirect('home/profile');
                            } else {
                                set_flash('error', "Vous avez déjà emprunté ce média.");
                                redirect('media/mediapage?media=' . $_GET["media"]);
                            }
                        } else {
                            set_flash('error', "Vous avez déjà atteint la limite de 
                            3 empunts simultanés.");
                            redirect('media/mediapage?media=' . $_GET["media"]);
                        }
                    } else {
                        set_flash('error', "Vous n'êtes pas connecté.");
                        redirect('media/mediapage?media=' . $_GET["media"]);
                    }
                } elseif (isset($_POST["no"])) {
                    redirect('media/mediapage?media=' . $_GET["media"]);
                }
            }
            $data = [
                'media' => $media,
                'addition' => $addition,
                'form_status' => $form_status
            ];

            load_view_with_layout('media/mediapage', $data);
        }
    } else {
        redirect('media/library');
    }
}
