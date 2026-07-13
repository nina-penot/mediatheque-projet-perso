<!-- Medias Content -->
<div class="admin-section">
    <div class="section-header">
        <h2>Liste des médias (<span id="media-count"><?php echo count($medias); ?></span>)</h2>
        <a href="<?php echo url('admin/add_media'); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un média
        </a>
        <a href="<?php echo url('admin/add_genre'); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un genre
        </a>
    </div>

    <!-- Search Bar -->
    <div class="admin-search-bar">
        <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text"
                id="search-medias"
                class="search-input"
                placeholder="Rechercher par titre, type, genre...">
            <button class="clear-search" id="clear-search-medias" style="display: none;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="admin-table-container">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Genre</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($medias)): ?>
                    <?php foreach ($medias as $media): ?>
                        <tr>
                            <td><?php echo esc($media['id']); ?></td>
                            <td>
                                <div class="media-thumbnail">
                                    <?php if (!empty($media['picture'])): ?>
                                        <?php
                                        // Si c'est une URL externe, l'utiliser telle quelle, sinon utiliser url()
                                        $image_src = (strpos($media['picture'], 'http://') === 0 || strpos($media['picture'], 'https://') === 0)
                                            ? $media['picture']
                                            : url($media['picture']);
                                        ?>
                                        <img src="<?php echo esc($image_src); ?>" alt="<?php echo esc($media['title']); ?>">
                                    <?php else: ?>
                                        <div class="media-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <strong><?php echo esc($media['title']); ?></strong>
                            </td>
                            <td>
                                <?php
                                $type_icons = [
                                    'film' => 'fa-film',
                                    'livre' => 'fa-book',
                                    'musique' => 'fa-music',
                                    'jeu' => 'fa-gamepad'
                                ];
                                $icon = $type_icons[$media['type']] ?? 'fa-circle';
                                ?>
                                <span class="badge badge-type">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                    <?php echo ucfirst(esc($media['type'])); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-genre">
                                    <?php echo esc($media['genre'] ?? 'N/A'); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($media['stock'] > 0) { ?>
                                    <span class="stock-badge stock-available">
                                        <i class="fas fa-check-circle"></i>
                                        <?php echo esc($media['stock']); ?> en stock
                                    </span>
                                <?php } elseif ($media['stock'] == 0 and $media['visibility'] == false) { ?>
                                    <span class="stock-badge stock-unavailable">
                                        <i class="fas fa-times-circle"></i>
                                        Innaccessible
                                    </span>
                                <?php } else { ?>
                                    <span class="stock-badge stock-unavailable">
                                        <i class="fas fa-times-circle"></i>
                                        Épuisé
                                    </span>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo url('admin/edit_media/' . $media['id']); ?>" class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo url('admin/delete_media/' . $media['id']); ?>"
                                        class="btn-action btn-delete"
                                        title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun média trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    // Search functionality for medias
    const searchInput = document.getElementById('search-medias');
    const clearBtn = document.getElementById('clear-search-medias');
    const table = document.querySelector('.admin-data-table tbody');
    const rows = table.querySelectorAll('tr');
    const mediaCount = document.getElementById('media-count');
    const totalMedias = rows.length;

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        // Show/hide clear button
        clearBtn.style.display = searchTerm ? 'flex' : 'none';

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count
        mediaCount.textContent = visibleCount;
    });

    // Clear search
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });
</script>