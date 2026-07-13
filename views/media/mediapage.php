<div class="mediapage-header">
    <div class="mediapage-float">
        <div class="mediapage-title" style="color: #3B82F6;"><?php e($media["title"]); ?></div>
        <a class="mediapage-button" href="<?= url('media/library'); ?>">Retour à la librairie</a>
    </div>
</div>

<div style="clear: both;"></div>

<div class="media-details-layout">

    <div class="media-image-container">
        <img class="media-image" src="<?= assign_image($media["picture"]); ?>" alt="<?= $media["title"] ?>">
    </div>

    <?php

    $type_icons = [
        'film' => 'fa-film',
        'livre' => 'fa-book',
        'jeu' => 'fa-gamepad'
    ];

    $media_type_slug = strtolower($media["type"]);
    $icon_class = $type_icons[$media_type_slug] ?? 'fa-circle';
    ?>

    <div class="media-info">

        <div><strong>Type : </strong><i class="fa-solid <?= $icon_class; ?>" aria-hidden="true"></i><?= $media["type"] ?></div>
        <div><strong>Genre : </strong><?= $media["genre"] ?></div>

        <?php if ($addition == "error") { ?>
            <div>Pas d'informations disponibles pour ce média!</div>
        <?php } else { ?>
            <?php if (is_type_book($media["id"])) { ?>
                <div><strong>Sommaire : </strong><?= $addition["summary"] ?></div>
                <div><strong>Auteur : </strong><?= $addition["author"] ?></div>
                <div><strong>ISBN : </strong><?= $addition["isbn"] ?></div>
                <div><strong>Pages : </strong><?= $addition["number_of_pages"] ?></div>
                <div><strong>Date de publication : </strong><?= $addition["date_of_publication"] ?></div>
            <?php } ?>

            <?php if (is_type_movie($media["id"])) { ?>
                <div><strong>Synopsis : </strong><?= $addition["synopsis"] ?></div>
                <div><strong>Réalisateur : </strong><?= $addition["realisateur"] ?></div>
                <div><strong>Durée du film : </strong><?= $addition["duration"] ?> minutes</div>
                <div><strong>Classification : </strong><?= $addition["rating"] ?></div>
                <div><strong>Date de sortie : </strong><?= $addition["year"] ?></div>
            <?php } ?>

            <?php if (is_type_game($media["id"])) { ?>
                <div><strong>Description : </strong><?= $addition["description"] ?></div>
                <div><strong>Editeur : </strong><?= $addition["editor"] ?></div>
                <div><strong>Plateforme : </strong><?= $addition["platform"] ?></div>
                <div><strong>Limite d'âge : </strong><?= $addition["age"] ?></div>
                <div><strong>Date de sortie : </strong><?= $addition["release_date"] ?></div>
            <?php } ?>

        <?php } ?>

        <?php if (is_available($media["stock"], $media["availability"])) { ?>
            <div><strong>Disponibilité : </strong><?= $media["stock"] - $media["availability"] ?> / <?= $media["stock"] ?></div>
            <div class="media-actions">
                <a class="mediapage-button" href="<?= url('media/mediapage?media=' . $media["id"] . "&c=1" . "#confirm"); ?>">Emprunter</a>
            </div>

            <form style="display: <?= $form_status ?>;" method="post" id="confirm">
                <div><strong>Êtes-vous sûr de vouloir emprunter ce média ?</strong></div>
                <button class="mediapage-button" type="submit" name="yes">Oui</button>
                <button class="mediapage-button" type="submit" name="no">Non</button>
            </form>
        <?php } else { ?>
            <div><strong>Ce média n'est plus disponible.</strong></div>
        <?php } ?>
    </div>
</div>