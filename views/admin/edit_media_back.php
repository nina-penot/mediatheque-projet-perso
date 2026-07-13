<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc($title); ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        /* Styles améliorés pour le formulaire */
        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }

        .admin-form h3 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-form h3 i {
            color: #3498db;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            color: #7f8c8d;
            font-size: 13px;
            font-style: italic;
        }

        /* Style pour le groupe d'upload d'image */
        .image-upload-group {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }

        .current-image-preview img {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 15px;
            background: white;
            border-radius: 6px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .radio-group label:hover {
            border-color: #3498db;
            background: #f0f8ff;
        }

        .radio-group input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-group input[type="radio"]:checked+label,
        .radio-group label:has(input[type="radio"]:checked) {
            border-color: #3498db;
            background: #e3f2fd;
            color: #1976d2;
            font-weight: 600;
        }

        .image-source-input {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style pour le champ ISBN avec indication scanner */
        .isbn-input-wrapper {
            position: relative;
        }

        .isbn-input-wrapper input {
            padding-right: 45px;
        }

        .isbn-scanner-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #3498db;
            font-size: 20px;
            pointer-events: none;
        }

        .scanner-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 5px;
            color: #7f8c8d;
            font-size: 13px;
            font-style: italic;
        }

        .scanner-hint i {
            color: #3498db;
        }

        /* Boutons d'action */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        /* Indicateur de champ requis */
        .form-group label::after {
            content: " *";
            color: #e74c3c;
            font-weight: bold;
        }

        .form-group label[for="picture_url"]::after,
        .form-group label[for="picture_file"]::after {
            content: "";
        }

        /* Style pour les sections */
        .form-section {
            margin-top: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #3498db;
        }

        .form-section.active {
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Upload de fichier stylisé */
        input[type="file"] {
            padding: 10px;
            background: white;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background: #2980b9;
        }

        /* Champs en lecture seule */
        .readonly-field {
            background-color: #f5f5f5;
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .radio-group {
                flex-direction: column;
                gap: 10px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <i class="fas fa-cog"></i>
            <h2>Admin Panel</h2>
        </div>
        <nav class="admin-nav">
            <a href="<?php echo url('admin'); ?>" class="admin-nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?php echo url('admin/users'); ?>" class="admin-nav-item">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="<?php echo url('admin/medias'); ?>" class="admin-nav-item active">
                <i class="fas fa-photo-video"></i>
                <span>Médias</span>
            </a>
            <a href="<?php echo url('admin/borrows'); ?>" class="admin-nav-item">
                <i class="fas fa-book-reader"></i>
                <span>Emprunts</span>
            </a>
            <a href="<?php echo url('home'); ?>" class="admin-nav-item">
                <i class="fas fa-home"></i>
                <span>Retour au site</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <header class="admin-header">
            <h1><?php echo esc($title); ?></h1>
            <div class="admin-user">
                <span>Bienvenue, <?php echo esc($_SESSION['user_name']); ?></span>
                <a href="<?php echo url('auth/logout'); ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </header>

        <!-- Form Content -->
        <div class="admin-content">
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

                            <div class="form-group">
                                <label for="date_publication">Date de publication *</label>
                                <input type="date" name="date_publication" id="date_publication" value="<?php echo esc($media['date_publication']); ?>" required>
                            </div>

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
                                    <input type="text" name="isbn" id="isbn" value="<?php echo esc($media['details']['isbn'] ?? ''); ?>" placeholder="9782070368228" <?php echo ($media['type'] === 'Livre') ? 'required' : ''; ?>>
                                    <i class="fas fa-barcode isbn-scanner-icon"></i>
                                </div>
                                <div class="scanner-hint">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Vous pouvez utiliser un lecteur de code-barres pour scanner l'ISBN</span>
                                </div>
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
</body>

</html>