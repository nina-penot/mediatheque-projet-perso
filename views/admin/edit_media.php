<!-- Form Content -->
<div class="admin-section">
    <div class="section-header">
        <h2>Éditer le média : <?php echo esc($media['title']); ?></h2>
        <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="form-container">
        <form method="POST" action="<?php echo url('admin/process_update'); ?>" class="admin-form" enctype="multipart/form-data">
            <input type="hidden" name="media_id" value="<?php echo esc($media['id']); ?>">
            <input type="hidden" name="current_picture" value="<?php echo esc($media['picture'] ?? ''); ?>">
            <!-- Champs communs -->
            <div class="form-section active" id="common-fields">
                <h3><i class="fas fa-info-circle"></i> Informations générales</h3>

                <div class="form-group">
                    <label for="type">Type de média *</label>
                    <input type="text" name="type" id="type" value="<?php echo esc($media['type']); ?>" readonly class="readonly-field" required>
                    <small>Le type ne peut pas être modifié après la création</small>
                </div>

                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input type="text" name="title" id="title" value="<?php echo esc($media['title']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="genre_id">Genre *</label>
                    <select name="genre_id" id="genre_id" required>
                        <option value="">-- Sélectionnez un genre --</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo esc($genre['id']); ?>" <?php echo ($genre['id'] == $media['genre_id']) ? 'selected' : ''; ?>>
                                <?php echo esc($genre['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image de couverture</label>

                    <?php if (!empty($media['picture'])): ?>
                        <div class="current-image-preview" style="margin-bottom: 15px;">
                            <p style="margin-bottom: 5px;"><strong>Image actuelle :</strong></p>
                            <?php
                            // Si c'est une URL externe, l'utiliser telle quelle, sinon utiliser url()
                            $image_src = (strpos($media['picture'], 'http://') === 0 || strpos($media['picture'], 'https://') === 0)
                                ? $media['picture']
                                : url($media['picture']);
                            ?>
                            <img src="<?php echo esc($image_src); ?>" alt="<?php echo esc($media['title']); ?>" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>
                    <?php endif; ?>

                    <div class="image-upload-group">
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="image_source" value="keep" checked>
                                Conserver l'image actuelle
                            </label>
                            <label>
                                <input type="radio" name="image_source" value="url">
                                URL externe
                            </label>
                            <label>
                                <input type="radio" name="image_source" value="file">
                                Upload fichier
                            </label>
                        </div>

                        <div id="url-input" class="image-source-input" style="display: none;">
                            <label for="picture_url">URL de l'image</label>
                            <input type="url" name="picture_url" id="picture_url" placeholder="https://..." maxlength="255">
                        </div>

                        <div id="file-input" class="image-source-input" style="display: none;">
                            <label for="picture_file">Fichier image (JPG, PNG, GIF - Max 2MB)</label>
                            <input type="file" name="picture_file" id="picture_file" accept="image/jpeg,image/png,image/gif">
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="date_publication">Date de publication *</label>
                    <input type="date" name="date_publication" id="date_publication" value="<?php //echo esc($media['date_publication']); 
                                                                                            ?>" required>
                </div> -->

                <div class="form-group">
                    <label for="stock">Stock *</label>
                    <input type="number" name="stock" id="stock" min="0" value="<?php echo esc($media['stock']); ?>" required>
                </div>
            </div>

            <!-- Champs spécifiques aux livres -->
            <div class="form-section <?php echo ($media['type'] === 'Livre') ? 'active' : ''; ?>" id="book-fields">
                <h3><i class="fas fa-book"></i> Informations du livre</h3>

                <div class="form-group">
                    <label for="author">Auteur *</label>
                    <input type="text" name="author" id="author" value="<?php echo esc($media['details']['author'] ?? ''); ?>" <?php echo ($media['type'] === 'Livre') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN *</label>
                    <div class="isbn-input-wrapper">
                        <input type="text" name="isbn" id="isbn" maxlength="13" value="<?php echo esc($media['details']['isbn'] ?? ''); ?>" placeholder="9782070368228" <?php echo ($media['type'] === 'Livre') ? 'required' : ''; ?>>
                        <i class="fas fa-barcode isbn-scanner-icon"></i>
                    </div>
                    <div class="scanner-hint">
                        <i class="fas fa-info-circle"></i>
                        <span>Vous pouvez utiliser un lecteur de code-barres pour scanner l'ISBN</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="year_book">Date de publication *</label>
                    <input input type="number" name="year_book" id="year_book" min="1900" max="2100" value="<?php echo esc($media['details']['date_of_publication']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="number_of_pages">Nombre de pages *</label>
                    <input type="number" name="number_of_pages" id="number_of_pages" min="1" value="<?php echo esc($media['details']['number_of_pages'] ?? ''); ?>" <?php echo ($media['type'] === 'Livre') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="summary">Résumé *</label>
                    <textarea name="summary" id="summary" rows="5" <?php echo ($media['type'] === 'Livre') ? 'required' : ''; ?>><?php echo esc($media['details']['summary'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- Champs spécifiques aux films -->
            <div class="form-section <?php echo ($media['type'] === 'Film') ? 'active' : ''; ?>" id="movie-fields">
                <h3><i class="fas fa-film"></i> Informations du film</h3>

                <div class="form-group">
                    <label for="realisateur">Réalisateur *</label>
                    <input type="text" name="realisateur" id="realisateur" value="<?php echo esc($media['details']['realisateur'] ?? ''); ?>" <?php echo ($media['type'] === 'Film') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="duration">Durée (minutes) *</label>
                    <input type="number" name="duration" id="duration" min="1" value="<?php echo esc($media['details']['duration'] ?? ''); ?>" <?php echo ($media['type'] === 'Film') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="year">Année *</label>
                    <input type="number" name="year" id="year" min="1900" max="2100" value="<?php echo esc($media['details']['year'] ?? ''); ?>" <?php echo ($media['type'] === 'Film') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="rating">Classification *</label>
                    <select name="rating" id="rating" <?php echo ($media['type'] === 'Film') ? 'required' : ''; ?>>
                        <option value="">-- Sélectionnez --</option>
                        <option value="Tout public" <?php echo (isset($media['details']['rating']) && $media['details']['rating'] === 'Tout public') ? 'selected' : ''; ?>>Tout public</option>
                        <option value="Moins de 12 ans" <?php echo (isset($media['details']['rating']) && $media['details']['rating'] === 'Moins de 12 ans') ? 'selected' : ''; ?>>Moins de 12 ans</option>
                        <option value="Moins de 16 ans" <?php echo (isset($media['details']['rating']) && $media['details']['rating'] === 'Moins de 16 ans') ? 'selected' : ''; ?>>Moins de 16 ans</option>
                        <option value="Moins de 18 ans" <?php echo (isset($media['details']['rating']) && $media['details']['rating'] === 'Moins de 18 ans') ? 'selected' : ''; ?>>Moins de 18 ans</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="synopsis">Synopsis *</label>
                    <textarea name="synopsis" id="synopsis" rows="5" <?php echo ($media['type'] === 'Film') ? 'required' : ''; ?>><?php echo esc($media['details']['synopsis'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- Champs spécifiques aux jeux -->
            <div class="form-section <?php echo ($media['type'] === 'Jeu') ? 'active' : ''; ?>" id="game-fields">
                <h3><i class="fas fa-gamepad"></i> Informations du jeu</h3>

                <div class="form-group">
                    <label for="editor">Éditeur *</label>
                    <input type="text" name="editor" id="editor" value="<?php echo esc($media['details']['editor'] ?? ''); ?>" <?php echo ($media['type'] === 'Jeu') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="platform">Plateforme *</label>
                    <select name="platform" id="platform" <?php echo ($media['type'] === 'Jeu') ? 'required' : ''; ?>>
                        <option value="">-- Sélectionnez --</option>
                        <option value="PC" <?php echo (isset($media['details']['platform']) && $media['details']['platform'] === 'PC') ? 'selected' : ''; ?>>PC</option>
                        <option value="PlayStation" <?php echo (isset($media['details']['platform']) && $media['details']['platform'] === 'PlayStation') ? 'selected' : ''; ?>>PlayStation</option>
                        <option value="Xbox" <?php echo (isset($media['details']['platform']) && $media['details']['platform'] === 'Xbox') ? 'selected' : ''; ?>>Xbox</option>
                        <option value="Nintendo" <?php echo (isset($media['details']['platform']) && $media['details']['platform'] === 'Nintendo') ? 'selected' : ''; ?>>Nintendo</option>
                        <option value="Mobile" <?php echo (isset($media['details']['platform']) && $media['details']['platform'] === 'Mobile') ? 'selected' : ''; ?>>Mobile</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Âge minimum *</label>
                    <select name="age" id="age" <?php echo ($media['type'] === 'Jeu') ? 'required' : ''; ?>>
                        <option value="">-- Sélectionnez --</option>
                        <option value="3" <?php echo (isset($media['details']['age']) && $media['details']['age'] === '3') ? 'selected' : ''; ?>>3+</option>
                        <option value="7" <?php echo (isset($media['details']['age']) && $media['details']['age'] === '7') ? 'selected' : ''; ?>>7+</option>
                        <option value="12" <?php echo (isset($media['details']['age']) && $media['details']['age'] === '12') ? 'selected' : ''; ?>>12+</option>
                        <option value="16" <?php echo (isset($media['details']['age']) && $media['details']['age'] === '16') ? 'selected' : ''; ?>>16+</option>
                        <option value="18" <?php echo (isset($media['details']['age']) && $media['details']['age'] === '18') ? 'selected' : ''; ?>>18+</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="release_date">Date de sortie *</label>
                    <input type="date" name="release_date" id="release_date" value="<?php echo esc($media['details']['release_date'] ?? ''); ?>" <?php echo ($media['type'] === 'Jeu') ? 'required' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea name="description" id="description" rows="5" <?php echo ($media['type'] === 'Jeu') ? 'required' : ''; ?>><?php echo esc($media['details']['description'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- Boutons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour le média
                </button>
                <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>


<script>
    // Gestion du basculement entre les options d'image
    const imageSourceRadios = document.querySelectorAll('input[name="image_source"]');
    const urlInput = document.getElementById('url-input');
    const fileInput = document.getElementById('file-input');

    imageSourceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'keep') {
                urlInput.style.display = 'none';
                fileInput.style.display = 'none';
                document.getElementById('picture_url').value = '';
                document.getElementById('picture_file').value = '';
            } else if (this.value === 'url') {
                urlInput.style.display = 'block';
                fileInput.style.display = 'none';
                document.getElementById('picture_file').value = '';
            } else if (this.value === 'file') {
                urlInput.style.display = 'none';
                fileInput.style.display = 'block';
                document.getElementById('picture_url').value = '';
            }
        });
    });
</script>