<!-- Form Content -->
<div class="admin-content">
    <div class="admin-section">
        <div class="section-header">
            <h2>Ajouter un nouveau média</h2>
            <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="form-container">
            <form method="POST" action="<?php echo url('admin/create_media'); ?>" class="admin-form" enctype="multipart/form-data">
                <!-- Champs communs -->
                <div class="form-section active" id="common-fields">
                    <h3><i class="fas fa-info-circle"></i> Informations générales</h3>

                    <div class="form-group">
                        <label for="type">Type de média *</label>
                        <select name="type" id="type" required>
                            <option value="">-- Sélectionnez un type --</option>
                            <option value="Livre">Livre</option>
                            <option value="Film">Film</option>
                            <option value="Jeu">Jeu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Titre *</label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div class="form-group">
                        <label for="genre_id">Genre *</label>
                        <select name="genre_id" id="genre_id" required>
                            <option value="">-- Sélectionnez un genre --</option>
                            <?php foreach ($genres as $genre): ?>
                                <option value="<?php echo esc($genre['id']); ?>">
                                    <?php echo esc($genre['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image-cover">Image de couverture</label>
                        <div class="image-upload-group">
                            <div class="radio-group">
                                <label>
                                    <input type="radio" name="image_source" value="url" checked>
                                    URL externe
                                </label>
                                <label>
                                    <input type="radio" name="image_source" value="file">
                                    Upload fichier
                                </label>
                            </div>

                            <div id="url-input" class="image-source-input">
                                <label for="picture_url">URL de l'image</label>
                                <input type="url" name="picture_url" id="picture_url" placeholder="https://..." maxlength="255">
                            </div>

                            <div id="file-input" class="image-source-input" style="display: none;">
                                <label for="picture_file">Fichier image (JPG, PNG, GIF - Max 2MB)</label>
                                <input type="file" name="picture_file" id="picture_file" accept="image/jpeg,image/png,image/gif">
                            </div>
                        </div>
                    </div>

                    <!--<div class="form-group">
                                <label for="date_publication">Date de publication *</label>
                                <input type="date" name="date_publication" id="date_publication" required>
                            </div>-->

                    <div class="form-group">
                        <label for="stock">Stock *</label>
                        <input type="number" name="stock" id="stock" min="1" value="1" required>
                    </div>
                </div>

                <!-- Champs spécifiques aux livres -->
                <div class="form-section" id="book-fields">
                    <h3><i class="fas fa-book"></i> Informations du livre</h3>

                    <div class="form-group">
                        <label for="author">Auteur *</label>
                        <input type="text" name="author" id="author">
                    </div>

                    <div class="form-group">
                        <label for="isbn">ISBN *</label>
                        <div class="isbn-input-wrapper">
                            <input type="text" name="isbn" id="isbn" placeholder="9782070368228" maxlength="13">
                            <i class="fas fa-barcode isbn-scanner-icon"></i>
                        </div>
                        <div class="scanner-hint">
                            <i class="fas fa-info-circle"></i>
                            <span>Vous pouvez utiliser un lecteur de code-barres pour scanner l'ISBN</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="number_of_pages">Nombre de pages *</label>
                        <input type="number" name="number_of_pages" id="number_of_pages" min="1">
                    </div>

                    <div class="form-group">
                        <label for="year_book">Année *</label>
                        <input type="number" name="year_book" id="year_book" min="1900" max="2100">
                    </div>

                    <div class="form-group">
                        <label for="summary">Résumé *</label>
                        <textarea name="summary" id="summary" rows="5"></textarea>
                    </div>
                </div>

                <!-- Champs spécifiques aux films -->
                <div class="form-section" id="movie-fields">
                    <h3><i class="fas fa-film"></i> Informations du film</h3>

                    <div class="form-group">
                        <label for="realisateur">Réalisateur *</label>
                        <input type="text" name="realisateur" id="realisateur">
                    </div>

                    <div class="form-group">
                        <label for="duration">Durée (minutes) *</label>
                        <input type="number" name="duration" id="duration" min="1">
                    </div>

                    <div class="form-group">
                        <label for="year">Année *</label>
                        <input type="number" name="year" id="year" min="1900" max="2100">
                    </div>

                    <div class="form-group">
                        <label for="rating">Classification *</label>
                        <select name="rating" id="rating">
                            <option value="">-- Sélectionnez --</option>
                            <option value="Tout public">Tout public</option>
                            <option value="Moins de 12 ans">Moins de 12 ans</option>
                            <option value="Moins de 16 ans">Moins de 16 ans</option>
                            <option value="Moins de 18 ans">Moins de 18 ans</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Synopsis *</label>
                        <textarea name="synopsis" id="synopsis" rows="5"></textarea>
                    </div>
                </div>

                <!-- Champs spécifiques aux jeux -->
                <div class="form-section" id="game-fields">
                    <h3><i class="fas fa-gamepad"></i> Informations du jeu</h3>

                    <div class="form-group">
                        <label for="editor">Éditeur *</label>
                        <input type="text" name="editor" id="editor">
                    </div>

                    <div class="form-group">
                        <label for="platform">Plateforme *</label>
                        <select name="platform" id="platform">
                            <option value="">-- Sélectionnez --</option>
                            <option value="PC">PC</option>
                            <option value="PlayStation">PlayStation</option>
                            <option value="Xbox">Xbox</option>
                            <option value="Nintendo">Nintendo</option>
                            <option value="Mobile">Mobile</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="age">Âge minimum *</label>
                        <select name="age" id="age">
                            <option value="">-- Sélectionnez --</option>
                            <option value="3">3+</option>
                            <option value="7">7+</option>
                            <option value="12">12+</option>
                            <option value="16">16+</option>
                            <option value="18">18+</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="release_date">Date de sortie *</label>
                        <input type="date" name="release_date" id="release_date">
                    </div>

                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea name="description" id="description" rows="5"></textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Créer le média
                    </button>
                    <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Gestion dynamique des champs selon le type
    const typeSelect = document.getElementById('type');
    const bookFields = document.getElementById('book-fields');
    const movieFields = document.getElementById('movie-fields');
    const gameFields = document.getElementById('game-fields');

    typeSelect.addEventListener('change', function() {
        // Cacher tous les champs spécifiques
        bookFields.classList.remove('active');
        movieFields.classList.remove('active');
        gameFields.classList.remove('active');

        // Désactiver les champs required pour éviter les erreurs de validation
        bookFields.querySelectorAll('input, textarea, select').forEach(field => {
            field.removeAttribute('required');
        });
        movieFields.querySelectorAll('input, textarea, select').forEach(field => {
            field.removeAttribute('required');
        });
        gameFields.querySelectorAll('input, textarea, select').forEach(field => {
            field.removeAttribute('required');
        });

        // Afficher les champs correspondants au type sélectionné
        if (this.value === 'Livre') {
            bookFields.classList.add('active');
            bookFields.querySelectorAll('input, textarea').forEach(field => {
                field.setAttribute('required', 'required');
            });
        } else if (this.value === 'Film') {
            movieFields.classList.add('active');
            movieFields.querySelectorAll('input, textarea, select').forEach(field => {
                field.setAttribute('required', 'required');
            });
        } else if (this.value === 'Jeu') {
            gameFields.classList.add('active');
            gameFields.querySelectorAll('input, textarea, select').forEach(field => {
                field.setAttribute('required', 'required');
            });
        }
    });

    // Gestion du basculement entre URL et fichier
    const imageSourceRadios = document.querySelectorAll('input[name="image_source"]');
    const urlInput = document.getElementById('url-input');
    const fileInput = document.getElementById('file-input');

    imageSourceRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'url') {
                urlInput.style.display = 'block';
                fileInput.style.display = 'none';
                document.getElementById('picture_file').value = '';
            } else {
                urlInput.style.display = 'none';
                fileInput.style.display = 'block';
                document.getElementById('picture_url').value = '';
            }
        });
    });
</script>