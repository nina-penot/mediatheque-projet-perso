<!-- Form Content -->
<div class="admin-content">
    <div class="admin-section">
        <div class="section-header">
            <h2>Ajouter un nouveau genre</h2>
            <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        <div class="form-container">
            <form method="POST" class="admin-form" enctype="multipart/form-data">
                <!-- Input genre -->
                <div class="form-section active" id="common-fields">
                    <h3><i class="fas fa-info-circle"></i> Informations générales</h3>

                    <div class="form-group">
                        <label for="genre">Nom du genre</label>
                        <input type="text" name="genre" id="genre" required>
                    </div>

                    <!-- Boutons -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Ajouter le genre
                        </button>
                        <a href="<?php echo url('admin/medias'); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>