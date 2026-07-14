<style>
    .avatar-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1.2rem; }
    .avatar-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1rem;
        text-align: center;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
        position: relative;
    }
    .avatar-card.active { border-color: #22c55e; box-shadow: 6px 6px 0px #22c55e; }
    .avatar-card.inactive { opacity: 0.55; }
    .avatar-card img {
        width: 100px; height: 100px; border-radius: 50%;
        object-fit: cover; border: 2px solid var(--border-dark);
        margin-bottom: 0.7rem;
    }
    .avatar-status-badge {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.15rem 0.7rem;
        border: 2px solid var(--border-dark);
        margin-bottom: 0.6rem;
    }
    .avatar-status-badge.active { background: #dcfce7; color: #16a34a; }
    .avatar-status-badge.inactive { background: #f1f5f9; color: #64748b; }
    .avatar-card-actions { display: flex; flex-direction: column; gap: 0.4rem; }
</style>

<div class="admin-header-innovative">
    <h2><i class="bi bi-person-badge-fill"></i>Mis Avatares</h2>
    <p>Sube nuevas imágenes, cambia cuál está activa, o desactiva las que ya no quieras usar (nunca se borran).</p>
</div>

<?php if (isset($_GET['error'])): ?>
    <div class="alert-innovative alert-innovative-danger" style="margin-bottom:1.5rem;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<!-- ====== SUBIR NUEVO AVATAR ====== -->
<div class="form-card-innovative" style="max-width:none; margin-bottom: 2rem;">
    <div class="corner-deco">Nuevo</div>
    <h5 style="font-family: var(--font-display); font-weight:800; margin-bottom: 1rem;">
        <i class="bi bi-cloud-upload-fill me-1"></i>Agregar imagen
    </h5>
    <form method="POST" action="<?= APP_URL ?>/avatars/store" enctype="multipart/form-data" class="d-flex gap-2 flex-wrap align-items-end">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
        <div class="flex-grow-1">
            <label class="form-label">Imagen (JPG, PNG, GIF o WEBP, máx. 2MB)</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn-admin-innovative">
            <i class="bi bi-plus-lg me-1"></i>Subir y activar
        </button>
    </form>
</div>

<!-- ====== GALERÍA ====== -->
<?php if (!empty($avatars)): ?>
    <div class="avatar-grid">
        <?php foreach ($avatars as $avatar): ?>
            <div class="avatar-card <?= $avatar->activo ? 'active' : 'inactive' ?>">
                <span class="avatar-status-badge <?= $avatar->activo ? 'active' : 'inactive' ?>">
                    <?= $avatar->activo ? 'Activo' : 'Inactivo' ?>
                </span>
                <br>
                <img src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($avatar->image) ?>" alt="Avatar">

                <div class="avatar-card-actions">
                    <?php if (!$avatar->activo): ?>
                        <a href="<?= APP_URL ?>/avatars/activate/<?= $avatar->id ?>" class="btn-admin-innovative btn-admin-innovative-sm">
                            <i class="bi bi-check-circle me-1"></i>Usar este
                        </a>
                    <?php endif; ?>

                    <!-- Modificar imagen (mismo registro, CRUD "actualizar") -->
                    <form method="POST" action="<?= APP_URL ?>/avatars/update/<?= $avatar->id ?>" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input type="file" name="image" accept="image/*" class="form-control form-control-sm mb-1" style="font-size:0.65rem;" required>
                        <button type="submit" class="btn-admin-innovative-sm btn-admin-innovative btn-admin-innovative-warning w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>Reemplazar
                        </button>
                    </form>

                    <?php if ($avatar->activo): ?>
                        <a href="<?= APP_URL ?>/avatars/deactivate/<?= $avatar->id ?>"
                           class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger"
                           onclick="return confirm('¿Desactivar este avatar? No se borrará, solo dejará de usarse.')">
                            <i class="bi bi-slash-circle me-1"></i>Desactivar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-gray-innovative">Aún no has subido ningún avatar. ¡Sube el primero arriba!</p>
<?php endif; ?>