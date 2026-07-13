<!-- Main Content -->


<!-- Users Content -->

<div class="admin-section">
    <div class="section-header">
        <h2>Liste des utilisateurs (<span id="user-count"><?php echo count($users); ?></span>)</h2>
    </div>

    <!-- Search Bar -->
    <div class="admin-search-bar">
        <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text"
                id="search-users"
                class="search-input"
                placeholder="Rechercher par nom, email...">
            <button class="clear-search" id="clear-search-users" style="display: none;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="admin-table-container">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo esc($user['id']); ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?php echo strtoupper(substr($user['firstname'], 0, 1)); ?>
                                    </div>
                                    <span><?php echo esc($user['firstname'] . ' ' . $user['lastname']); ?></span>
                                </div>
                            </td>
                            <td><?php echo esc($user['email']); ?></td>
                            <td>
                                <?php if ($user['admin'] == 1): ?>
                                    <span class="badge badge-admin-role">
                                        <i class="fas fa-crown"></i> Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-user-role">
                                        <i class="fas fa-user"></i> Utilisateur
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo url('admin/edit_user/' . $user['id']); ?>" class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php if ($user['id'] != current_user_id()): ?>
                                        <a href="<?php echo url('admin/delete_user/' . $user['id']); ?>"
                                            class="btn-action btn-delete"
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="btn-action btn-disabled" title="Vous ne pouvez pas vous supprimer">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    // Search functionality for users
    const searchInput = document.getElementById('search-users');
    const clearBtn = document.getElementById('clear-search-users');
    const table = document.querySelector('.admin-data-table tbody');
    const rows = table.querySelectorAll('tr');
    const userCount = document.getElementById('user-count');
    const totalUsers = rows.length;

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
        userCount.textContent = visibleCount;
    });

    // Clear search
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });
</script>