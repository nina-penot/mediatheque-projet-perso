<div class="page-header">
    <div class="container">
        <h1 style="color: #3B82F6;"><?php e($title); ?></h1>
    </div>
</div>

<section class="content page-profile">
    <div class="container">

        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>

        <div class="content-grid">

            <div class="content-main">

                <?php if (isset($user) && is_array($user)): ?>

                    <div class="profile-narrow-content">

                        <h2 style="color: #3B82F6;">Vos informations personnelles</h2>
                        <div class="user-info-details">
                            <p><strong>Nom :</strong> <?php e($user['lastname']); ?></p>
                            <p><strong>Prénom :</strong> <?php e($user['firstname']); ?></p>
                            <p><strong>Email :</strong> <?php e($user['email']); ?></p>
                            <p><strong>Statut :</strong> <?= $user['is_admin'] ? 'Administrateur' : 'Utilisateur'; ?></p>
                        </div>
                        <br><br>
                        <h3 style="color: #3B82F6;">Modifier vos informations</h3>
                        <form method="POST" class="profile-info-form">
                            <input type="hidden" name="action" value="update_info">

                            <div class="form-group">
                                <label for="lastname">Nom :</label>
                                <input type="text" id="lastname" name="lastname" required
                                    value="<?php e($user['lastname']); ?>"
                                    placeholder="Votre nom (lettre, - ou espace)">
                            </div>

                            <div class="form-group">
                                <label for="firstname">Prénom :</label>
                                <input type="text" id="firstname" name="firstname" required
                                    value="<?php e($user['firstname']); ?>"
                                    placeholder="Votre prénom (lettre, - ou espace)">
                            </div>

                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" id="email" name="email" required
                                    value="<?php e($user['email']); ?>"
                                    placeholder="Votre adresse email">
                            </div>

                            <button type="submit" class="btn btn-primary">Mettre à jour les informations</button>
                        </form>
                        <br><br>
                        <h3 style="color: #3B82F6;">Pour changer votre mot de passe</h3>
                        <form method="POST" class="password-form">
                            <input type="hidden" name="action" value="change_password">

                            <div class="form-group">
                                <label for="current_password">Mot de passe actuel :</label>
                                <input type="password" id="current_password" name="current_password" required
                                    placeholder="Votre mot de passe actuel">
                            </div>

                            <div class="form-group">
                                <label for="new_password">Nouveau mot de passe :</label>
                                <input type="password" id="new_password" name="new_password" required
                                    placeholder="8 caractères avec Maj, min et chiffre">
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                                <input type="password" id="confirm_password" name="confirm_password" required
                                    placeholder="Confirmez votre mot de passe">
                            </div>

                            <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                        </form>

                    </div>
                <?php else: ?>
                    <p class="alert alert-danger">⚠️ Impossible de charger les données utilisateur. Veuillez vous reconnecter.</p>
                <?php endif; ?>
            </div>

            <div class="content-aside loans-container">
                <h2 style="color: #3B82F6;">Vos Emprunts Actuels</h2>

                <?php

                $type_icons = [
                    'Film' => 'fa-film',
                    'Livre' => 'fa-book',
                    'Jeu' => 'fa-gamepad'
                ];
                // ---------------------------------------------------
                ?>

                <div class="loan-list">
                    <?php for ($num = 0; $num < 3; $num++) { ?>
                        <?php if (!empty($borrow[$num])) {
                            $icon_class = $type_icons[$borrow[$num]['type']] ?? 'fa-circle';

                            // ---  CALCUL DU RETARD ---
                            $date_due = new DateTime($borrow[$num]['due_at']);
                            $today = new DateTime();
                            $is_late = $today->setTime(0, 0) > $date_due->setTime(0, 0);

                            if ($is_late) {
                                $interval = $date_due->setTime(0, 0)->diff($today->setTime(0, 0))->days;
                                // Le retard est le nombre de jours entre la date d'échéance et aujourd'hui
                                $delay_days = (int) $interval;
                            } else {
                                $delay_days = 0;
                            }
                            // -----------------------------------------
                        ?>
                            <div class="loan-card">
                                <div class="loan-image-wrapper">
                                    <img src="<?= assign_image($borrow[$num]['picture']); ?>"
                                        alt="<?php e($borrow[$num]['media']); ?>"
                                        class="loan-thumbnail">
                                </div>
                                <div class="loan-details">
                                    <p>
                                        <strong>Type :</strong>
                                        <i class="fa-solid <?= $icon_class; ?>" aria-hidden="true"></i>
                                        <?php e($borrow[$num]['type']); ?>
                                    </p>
                                    <p>
                                        <strong>Emprunté le :</strong>
                                        <span class="date-loaned"><?php e(format_date($borrow[$num]['borrow_date'], 'd/m/Y')); ?></span>
                                    </p>
                                    <p>
                                        <strong>À rendre pour le :</strong>
                                        <span class="date-due"><?php e(format_date($borrow[$num]['due_at'], 'd/m/Y')); ?></span>
                                    </p>

                                    <?php
                                    // --- AFFICHAGE DU STATUT DE RETARD/ÉCHÉANCE ---
                                    if ($is_late) {
                                        $text_style = 'color: #ef464eff; font-weight: bold;';
                                        $text = "🔴 Retard de $delay_days jour" . ($delay_days > 1 ? 's' : '');
                                    } else {
                                        // Calculer les jours restants si non en retard
                                        $days_remaining = $today->setTime(0, 0)->diff($date_due->setTime(0, 0))->days;
                                        $text_style = 'color: #1c29c2ff;';
                                        $text = "⏳ Reste $days_remaining jour" . ($days_remaining > 1 ? 's' : '');

                                        if ($days_remaining <= 3 && $days_remaining > 0) {
                                            $text_style = 'color: #1c29c2ff; font-weight: bold;';
                                            $text = "⚠️ À rendre dans $days_remaining jour" . ($days_remaining > 1 ? 's' : '');
                                        } elseif ($days_remaining == 0) {
                                            $text_style = 'color: #ecb11cff; font-weight: bold;';
                                            $text = "🚨 À rendre AUJOURD'HUI !";
                                        }
                                    }
                                    ?>
                                    <p style="<?= $text_style; ?>"><?= $text; ?></p>
                                    <?php // ----------------------------------------- 
                                    ?>
                                </div>
                                <form method="post" style="margin-left: 20%;">
                                    <button class="mediapage-button" type="submit" name="return" value="<?= $borrow[$num]['id'] ?>">Rendre ce média</button>
                                </form>
                            </div>
                        <?php } else { ?>

                            <div class="loan-card loan-card-empty">

                                <div class="loan-card-empty-content">
                                    <i class="fa-solid fa-box-open"></i>
                                    <p>Emplacement libre</p>
                                </div>

                                <a href="<?php echo url('media/library'); ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i> Emprunter
                                </a>
                            </div>

                        <?php } ?>
                    <?php } ?>

                </div>
                <div class="loans-history-container">
                    <?php $my_history = media_per_page($page, 10, $history); ?>
                    <?php if (empty($my_history)) { ?>
                        <p style="color: #6b7280; padding: 10px;">Aucun historique d'emprunt disponible pour le moment.</p>
                    <?php } else { ?>
                        <h2 class="history-title">Historique des Emprunts</h2>

                        <div class="history-table-wrapper">
                            <table class="history-table">
                                <thead>
                                    <tr class="history-header-row">
                                        <th class="history-th media-col">Média</th>
                                        <th class="history-th type-col">Type</th>
                                        <th class="history-th loaned-col">Emprunté le</th>
                                        <th class="history-th returned-col">Retourné le</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($my_history as $media) { ?>
                                        <tr class="history-data-row">
                                            <td class="history-td media-data"><?= $media['media']; ?></td>
                                            <td class="history-td"><?= $media['type']; ?></td>
                                            <td class="history-td"><?= $media['borrow_date'] ?></td>
                                            <td class="history-td returned-date-data"><?= $media['returned_at'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    <?php } ?>
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
        </div>
    </div>
</section>