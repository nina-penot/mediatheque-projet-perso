<!-- Borrows Content -->

<!-- Statistiques des emprunts -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <i class="fas fa-book-reader"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $total_borrows; ?></h3>
            <p>Total emprunts</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $active_borrows; ?></h3>
            <p>Emprunts actifs</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $overdue_borrows; ?></h3>
            <p>En retard</p>
        </div>
    </div>
</div>

<div class="admin-section">
    <div class="section-header">
        <h2>Liste des emprunts (<span id="borrow-count"><?php echo count($borrows); ?></span>)</h2>
    </div>

    <!-- Search Bar -->
    <div class="admin-search-bar">
        <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text"
                id="search-borrows"
                class="search-input"
                placeholder="Rechercher par utilisateur, média, statut...">
            <button class="clear-search" id="clear-search-borrows" style="display: none;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <br>
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">
                <i class="fas fa-list"></i> Tous
            </button>
            <button class="filter-btn" data-filter="active">
                <i class="fas fa-clock"></i> Actifs
            </button>
            <button class="filter-btn" data-filter="returned">
                <i class="fas fa-check-circle"></i> Retournés
            </button>
            <button class="filter-btn" data-filter="overdue">
                <i class="fas fa-exclamation-triangle"></i> En retard
            </button>
            <button class="filter-btn filter-btn-severe" data-filter="severe">
                <i class="fas fa-exclamation-circle"></i> Retard sévère (+14j)
            </button>
        </div>
    </div>

    <div class="admin-table-container">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Utilisateur</th>
                    <th>Média</th>
                    <th>Type</th>
                    <th>Emprunté le</th>
                    <th>Date limite</th>
                    <!-- <th>Durée</th> -->
                    <th>Statut</th>
                    <th>Retourné le</th>
                    <th>Forcer le rendu</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($borrows)): ?>
                    <?php foreach ($borrows as $borrow): ?>
                        <?php
                        $is_overdue = !$borrow['returned_at'] && strtotime($borrow['due_at']) < time();
                        $is_returned = !empty($borrow['returned_at']);
                        $status_class = $is_returned ? 'returned' : ($is_overdue ? 'overdue' : 'active');

                        // Calculer les jours de retard
                        $days_overdue = 0;
                        $severe_delay = false;
                        if ($is_overdue) {
                            $due_date = new DateTime($borrow['due_at']);
                            $today = new DateTime();
                            $interval = $today->diff($due_date);
                            $days_overdue = $interval->days;
                            $severe_delay = $days_overdue > 14;
                        }
                        ?>
                        <tr data-status="<?php echo $status_class; ?>" <?php echo $severe_delay ? 'data-severe="true"' : ''; ?>>
                            <!-- <td><?php //echo esc($borrow['id']); 
                                        ?></td> -->
                            <td>
                                <div class="user-info">
                                    <!-- Optionel: avatar profil utilisateur -->
                                    <!-- <div class="user-avatar <?php echo $severe_delay ? 'severe-delay-avatar' : ''; ?>">
                                        <?php //echo strtoupper(substr($borrow['firstname'], 0, 1)); 
                                        ?>
                                        <?php //if ($severe_delay): 
                                        ?>
                                            <div class="alert-badge">
                                                <i class="fas fa-exclamation"></i>
                                            </div>
                                        <?php //endif; 
                                        ?>
                                    </div> -->
                                    <div>
                                        <strong><?php echo esc($borrow['firstname'] . ' ' . $borrow['lastname']); ?></strong>
                                        <?php if ($severe_delay): ?>
                                            <span class="severe-delay-indicator">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Retard de <?php echo $days_overdue; ?> jours !
                                            </span>
                                        <?php endif; ?>
                                        <br>
                                        <small style="color: #6c757d;"><?php echo esc($borrow['email']); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div class="media-thumbnail" style="width: 50px; height: 50px;">
                                        <?php if (!empty($borrow['media_picture'])): ?>
                                            <?php
                                            $image_src = (strpos($borrow['media_picture'], 'http://') === 0 || strpos($borrow['media_picture'], 'https://') === 0)
                                                ? $borrow['media_picture']
                                                : url($borrow['media_picture']);
                                            ?>
                                            <img src="<?php echo esc($image_src); ?>" alt="<?php echo esc($borrow['media_title']); ?>">
                                        <?php else: ?>
                                            <div class="media-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <strong><?php echo esc($borrow['media_title']); ?></strong>
                                        <?php if (!empty($borrow['genre'])): ?>
                                            <br>
                                            <small style="color: #6c757d;"><?php echo esc($borrow['genre']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php
                                $type_icons = [
                                    'Film' => 'fa-film',
                                    'Livre' => 'fa-book',
                                    'Jeu' => 'fa-gamepad'
                                ];
                                $icon = $type_icons[$borrow['media_type']] ?? 'fa-circle';
                                ?>
                                <span class="badge badge-type">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                    <?php echo esc($borrow['media_type']); ?>
                                </span>
                            </td>
                            <td style="font-size: 0.8rem;">
                                <?php
                                $due_date = new DateTime($borrow['borrow_date']);
                                echo $due_date->format('d/m/Y');
                                ?>
                            </td>
                            <td style="font-size: 0.8rem;">
                                <?php
                                $due_date = new DateTime($borrow['due_at']);
                                echo $due_date->format('d/m/Y');
                                ?>
                            </td>
                            <!-- <td>
                                <span class="badge" style="background: #e9ecef; color: #495057;">
                                    <i class="fas fa-calendar-day"></i>
                                    <?php //echo esc($borrow['borrow_duration']); 
                                    ?> jours
                                </span>
                            </td> -->
                            <td>
                                <?php if ($is_returned): ?>
                                    <span class="status-badge status-returned">
                                        <i class="fas fa-check-circle"></i> Retourné
                                    </span>
                                <?php elseif ($is_overdue): ?>
                                    <?php if ($severe_delay): ?>
                                        <span class="status-badge status-severe-overdue">
                                            <i class="fas fa-exclamation-circle"></i> Retard sévère
                                            <small style="display: block; font-size: 0.7rem; margin-top: 2px;">
                                                <?php echo $days_overdue; ?> jours
                                            </small>
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge status-overdue">
                                            <i class="fas fa-exclamation-triangle"></i> En retard
                                            <small style="display: block; font-size: 0.7rem; margin-top: 2px;">
                                                <?php echo $days_overdue; ?> jours
                                            </small>
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="status-badge status-active">
                                        <i class="fas fa-clock"></i> En cours
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 0.8rem;">
                                <?php if ($borrow['returned_at']): ?>
                                    <?php
                                    $returned_date = new DateTime($borrow['returned_at']);
                                    echo $returned_date->format('d/m/Y');
                                    ?>
                                <?php else: ?>
                                    <span style="color: #6c757d;">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($is_returned) { ?>
                                    <div style="color: #6c757d; text-align: center;"> - </div>
                                <?php } else { ?>
                                    <form method="post">
                                        <button class="btn-force-return <?php echo $severe_delay ? 'btn-urgent' : ''; ?>"
                                            type="submit"
                                            name="return"
                                            value="<?= $borrow['id'] ?>"
                                            title="Forcer le retour de ce média">
                                            <i class="fas fa-undo-alt"></i>
                                        </button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun emprunt trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-info h3 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
    }

    .stat-info p {
        margin: 0.25rem 0 0 0;
        color: #718096;
        font-size: 0.9rem;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
        margin-left: 1rem;
    }

    .filter-btn {
        padding: 0.6rem 1.2rem;
        border: 2px solid #e2e8f0;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        color: #4a5568;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-btn:hover {
        border-color: #667eea;
        color: #667eea;
        background: #f7fafc;
    }

    .filter-btn.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .filter-btn-severe {
        border-color: #dc2626;
        color: #dc2626;
    }

    .filter-btn-severe:hover {
        border-color: #dc2626;
        color: #dc2626;
        background: #fee2e2;
    }

    .filter-btn-severe.active {
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        color: white;
        border-color: #dc2626;
        animation: pulseSevereBtn 2s ease-in-out infinite;
    }

    @keyframes pulseSevereBtn {

        0%,
        100% {
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        }

        50% {
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.6);
        }
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-active {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-returned {
        background: #dcfce7;
        color: #166534;
    }

    .status-overdue {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-severe-overdue {
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        color: white;
        animation: blinkSevere 2s ease-in-out infinite;
        box-shadow: 0 2px 10px rgba(220, 38, 38, 0.4);
        font-weight: 700;
    }

    @keyframes blinkSevere {

        0%,
        100% {
            opacity: 1;
            box-shadow: 0 2px 10px rgba(220, 38, 38, 0.4);
        }

        50% {
            opacity: 0.8;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.7);
        }
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
        position: relative;
    }

    /* Alerte pour retard sévère (> 14 jours) */
    .severe-delay-avatar {
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        animation: pulseAlert 2s ease-in-out infinite;
        box-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
    }

    @keyframes pulseAlert {

        0%,
        100% {
            box-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
            transform: scale(1);
        }

        50% {
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.9);
            transform: scale(1.05);
        }
    }

    .alert-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: #fbbf24;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        color: #991b1b;
        border: 2px solid white;
        animation: blinkAlert 1s ease-in-out infinite;
    }

    @keyframes blinkAlert {

        0%,
        100% {
            opacity: 1;
            background: #fbbf24;
        }

        50% {
            opacity: 0.3;
            background: #fef3c7;
        }
    }

    .severe-delay-indicator {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-left: 10px;
        animation: pulseText 2s ease-in-out infinite;
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
    }

    @keyframes pulseText {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .severe-delay-indicator i {
        animation: shake 0.5s ease-in-out infinite;
    }

    @keyframes shake {

        0%,
        100% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(-10deg);
        }

        75% {
            transform: rotate(10deg);
        }
    }

    /* Bouton Forcer le retour */
    .btn-force-return {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
        white-space: nowrap;
    }

    .btn-force-return:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-force-return:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }

    .btn-force-return i {
        font-size: 0.9rem;
    }

    /* Bouton urgent pour les retards sévères */
    .btn-force-return.btn-urgent {
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
        animation: pulseUrgentBtn 2s ease-in-out infinite;
    }

    .btn-force-return.btn-urgent:hover {
        background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.6);
        animation: none;
    }

    @keyframes pulseUrgentBtn {

        0%,
        100% {
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
        }

        50% {
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.7);
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .btn-force-return span {
            display: none;
        }

        .btn-force-return {
            padding: 0.6rem;
            width: 36px;
            height: 36px;
            justify-content: center;
        }
    }
</style>

<script>
    // Search functionality for borrows
    const searchInput = document.getElementById('search-borrows');
    const clearBtn = document.getElementById('clear-search-borrows');
    const table = document.querySelector('.admin-data-table tbody');
    const rows = table.querySelectorAll('tr');
    const borrowCount = document.getElementById('borrow-count');
    const filterButtons = document.querySelectorAll('.filter-btn');
    let currentFilter = 'all';

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        // Show/hide clear button
        clearBtn.style.display = searchTerm ? 'flex' : 'none';

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const status = row.getAttribute('data-status');
            const isSevere = row.getAttribute('data-severe') === 'true';

            // Apply search filter
            const matchesSearch = text.includes(searchTerm);

            // Apply status filter
            let matchesStatus = true;
            if (currentFilter !== 'all') {
                if (currentFilter === 'severe') {
                    matchesStatus = isSevere;
                } else {
                    matchesStatus = status === currentFilter;
                }
            }

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count
        borrowCount.textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterRows);

    // Clear search
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterRows();
        searchInput.focus();
    });

    // Filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Update current filter
            currentFilter = this.getAttribute('data-filter');

            // Apply filters
            filterRows();
        });
    });
</script>