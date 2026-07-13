<!-- Main Content -->

<!-- Contacts Statistics -->
<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $total_contacts; ?></h3>
            <p>Messages au total</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-envelope-open"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $unread_contacts; ?></h3>
            <p>Messages non lus</p>
        </div>
    </div>
</div>

<!-- Contacts Content -->
<div class="admin-section">
    <div class="section-header">
        <h2>Liste des messages de contact (<span id="contact-count"><?php echo count($contacts); ?></span>)</h2>
    </div>

    <!-- Search Bar -->
    <div class="admin-search-bar">
        <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text"
                id="search-contacts"
                class="search-input"
                placeholder="Rechercher par nom, email, message...">
            <button class="clear-search" id="clear-search-contacts" style="display: none;">
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
                    <th>Message</th>
                    <th>Date de création</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contacts)): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <tr class="<?php echo $contact['read_at'] === null ? 'unread-message' : ''; ?>">
                            <td><?php echo esc($contact['id']); ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?php e(strtoupper(substr($contact['name'], 0, 1))); ?>
                                    </div>
                                    <span><?php echo esc($contact['name']); ?></span>
                                </div>
                            </td>
                            <td><?php echo esc($contact['email']); ?></td>
                            <td>
                                <div class="message-preview" title="<?php echo esc($contact['message']); ?>">
                                    <?php
                                    $message = esc($contact['message']);
                                    echo strlen($message) > 100 ? substr($message, 0, 100) . '...' : $message;
                                    ?>
                                </div>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></td>
                            <td>
                                <?php if ($contact['read_at'] === null): ?>
                                    <span class="badge badge-warning">
                                        <i class="fas fa-envelope"></i> Non lu
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-success">
                                        <i class="fas fa-envelope-open"></i> Lu
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <?php if ($contact['read_at'] === null): ?>
                                        <form method="POST" style="display: inline;">
                                            <button type="submit"
                                                name="mark_as_read"
                                                value="<?php echo $contact['id']; ?>"
                                                class="btn-action btn-edit"
                                                title="Marquer comme lu">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <button class="btn-action btn-info"
                                        title="Voir le message complet"
                                        onclick="showMessageModal('<?php echo esc($contact['name']); ?>', '<?php echo esc($contact['email']); ?>', '<?php echo esc($contact['message']); ?>', '<?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="mailto:<?php echo esc($contact['email']); ?>?subject=<?php echo urlencode('Re: Votre message de contact'); ?>&body=<?php echo urlencode('Bonjour ' . $contact['name'] . ',

'); ?>"
                                        class="btn-action btn-reply"
                                        title="Répondre par email">
                                        <i class="fas fa-reply"></i>
                                    </a>
                                    <form method="POST" style="display: inline;">
                                        <button type="submit"
                                            name="delete"
                                            value="<?php echo $contact['id']; ?>"
                                            class="btn-action btn-delete"
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun message de contact trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour afficher le message complet -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeMessageModal()">&times;</span>
        <h2>Message de contact</h2>
        <div class="modal-body">
            <p><strong>Nom :</strong> <span id="modal-name"></span></p>
            <p><strong>Email :</strong> <span id="modal-email"></span></p>
            <p><strong>Date :</strong> <span id="modal-date"></span></p>
            <hr>
            <p><strong>Message :</strong></p>
            <div id="modal-message" style="white-space: pre-wrap; background: #f5f5f5; padding: 15px; border-radius: 5px; margin-top: 10px;"></div>
        </div>
    </div>
</div>

<style>
    .unread-message {
        background-color: #f0f8ff;
        font-weight: 500;
    }

    .message-preview {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-reply {
        background-color: #007bff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-reply:hover {
        background-color: #0056b3;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #000;
    }

    .modal-body {
        margin-top: 20px;
    }

    .modal-body p {
        margin: 10px 0;
    }

    .modal-body hr {
        margin: 15px 0;
        border: none;
        border-top: 1px solid #ddd;
    }
</style>

<script>
    // Search functionality for contacts
    const searchInput = document.getElementById('search-contacts');
    const clearBtn = document.getElementById('clear-search-contacts');
    const table = document.querySelector('.admin-data-table tbody');
    const rows = table.querySelectorAll('tr');
    const contactCount = document.getElementById('contact-count');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        // Show/hide clear button
        clearBtn.style.display = searchTerm ? 'flex' : 'none';

        rows.forEach(row => {
            // Skip if it's the "no data" row
            if (row.cells.length === 1) return;

            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count
        contactCount.textContent = visibleCount;
    });

    // Clear search
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });

    // Modal functions
    function showMessageModal(name, email, message, date) {
        document.getElementById('modal-name').textContent = name;
        document.getElementById('modal-email').textContent = email;
        document.getElementById('modal-date').textContent = date;
        document.getElementById('modal-message').textContent = message;
        document.getElementById('messageModal').style.display = 'block';
    }

    function closeMessageModal() {
        document.getElementById('messageModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('messageModal');
        if (event.target === modal) {
            closeMessageModal();
        }
    }
</script>