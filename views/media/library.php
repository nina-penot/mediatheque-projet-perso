<?php

/**
 * Page de bibliothèque de médias
 *
 * Fonctionnalités:
 * - Barre de recherche avec filtres (type et genre)
 * - Affichage en grille des médias (livres, films, jeux)
 * - Pagination (20 éléments par page)
 * - Navigation entre les pages
 */

?>

<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
        <p style="color: var(--secondary-color); margin-top: 0.5rem;">Découvrez notre collection de médias</p>
    </div>
</div>

<div class="main-content">
    <div class="container">
        <!-- Section de recherche -->
        <div class="search-section">
            <form action="" method="post" class="search-form">
                <!-- <input type="hidden" name="csrf_token" value="<?php //echo csrf_token(); 
                                                                    ?>"> -->

                <div class="search-row">
                    <div class="form-group">
                        <label for="search">Recherche</label>
                        <input type="text"
                            name="search"
                            id="search"
                            placeholder="Titre, auteur, description...">
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type">
                            <option value="">Tous les types</option>
                            <option value="livre">📚 Livre</option>
                            <option value="film">🎬 Film</option>
                            <option value="jeu">🎮 Jeu Vidéo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="genre" id="genre">
                            <option value="">Tous les genres</option>
                            <?php foreach ($genres as $genre) { ?>
                                <option value="<?= $genre["name"] ?>"><?= $genre["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Disponibilité</label>
                        <select name="available" id="available">
                            <option value="">Tous</option>
                            <option value="available">✅ Disponible</option>
                            <option value="unavailable">❌ Non Disponible</option>
                        </select>
                    </div>

                    <div class="search-button-group">
                        <button type="submit" class="btn btn-primary" style="margin-top: 1.85rem;">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Grille de médias -->
        <?php $my_medias = media_per_page($page, 20, $medias); ?>

        <?php if (count($my_medias) == 0): ?>
            <div class="no-results">
                <svg width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
                <p>Aucun média ne correspond à votre recherche.</p>
            </div>
        <?php else: ?>
            <div class="media-grid">
                <?php foreach ($my_medias as $media): ?>
                    <a href="<?php echo url("media/mediapage"), "?media=", $media["id"]; ?>" class="media-card">
                        <div class="media-card-inner">
                            <!-- RECTO : Image et titre -->
                            <div class="media-card-front">
                                <div class="media-image">
                                    <img src="<?= assign_image($media['picture']); ?>" alt="<?php e($media['title']); ?>">
                                </div>
                                <div class="media-front-overlay">
                                    <h3 class="media-title"><?php e($media['title']); ?></h3>
                                    <div class="flip-hint">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                        Voir détails
                                    </div>
                                </div>
                            </div>

                            <!-- VERSO : Détails complets -->
                            <div class="media-card-back">
                                <div class="media-content">
                                    <h3 class="media-title"><?php e($media['title']); ?></h3>

                                    <div class="media-meta">
                                        <div class="media-type">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z" />
                                            </svg>
                                            <span><?php
                                                    e($media['type']);
                                                    ?></span>
                                        </div>

                                        <div class="media-genre">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                            </svg>
                                            <span><?php e($media['genre']); ?></span>
                                        </div>
                                    </div>

                                    <!-- Informations supplémentaires selon le type -->
                                    <?php if (!empty($media['isbn'])): ?>
                                        <p style="font-size: 0.85rem; color: var(--secondary-color); margin-bottom: 0.75rem;">
                                            <strong>ISBN:</strong> <?php e($media['isbn']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($media['book_summary'])): ?>
                                        <p style="font-size: 0.875rem; color: var(--text-color); margin-bottom: 1rem; line-height: 1.5;">
                                            <?php e($media['book_summary']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($media['game_description'])): ?>
                                        <p style="font-size: 0.875rem; color: var(--text-color); margin-bottom: 1rem; line-height: 1.5;">
                                            <?php e($media['game_description']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($media['movie_synopsis'])): ?>
                                        <p style="font-size: 0.875rem; color: var(--text-color); margin-bottom: 1rem; line-height: 1.5;">
                                            <?php e($media['movie_synopsis']); ?>
                                        </p>
                                    <?php endif; ?>

                                    <!-- Statut de disponibilité -->
                                    <?php if (is_available($media["stock"], $media["availability"])) { ?>
                                        <div class="media-status available">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                            </svg>
                                            Disponible: <?= $media["stock"] - $media["availability"]; ?>/<?= $media["stock"]; ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="media-status unavailable">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                                            </svg>
                                            Indisponible
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Section de pagination -->
        <div class="pagination-section">
            <div class="pagination-form">

                <?php if ($page > 1) { ?>
                    <a class="btn btn-secondary pagination-btn" href="?page=<?= $page - 1; ?>">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                        Prev
                    </a>
                <?php } else { ?>
                    <div></div>
                <?php } ?>

                <?php if ($max_page > 1) { ?>
                    <div class="pagination-block">
                        <div class="page-jump">
                            <form action="" method="get">
                                <input name="page" type="number" min="1" max="<?= $max_page ?>" value="1" aria-label="Numéro de page">
                                <button class="btn btn-primary" type="submit">ENVOYER</button>
                            </form>
                        </div>

                        <div class="pagination-info">
                            <div class="page-counter"> <?= $page ?>/<?= $max_page ?> </div>
                        </div>

                        <div>
                            <a class="btn btn-primary" href="?page=<?= $max_page; ?>">Fin</a>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($page < $max_page) { ?>
                    <a class="btn btn-secondary pagination-btn" href="?page=<?= $page + 1; ?>">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        Next
                    </a>
                <?php } ?>

            </div>
        </div>

    </div>
</div>