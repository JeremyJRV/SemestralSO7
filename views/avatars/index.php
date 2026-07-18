<style>
    /* ============================================
       VARIABLES Y ESTILOS BASE
    ============================================ */
    :root {
        --bg-page: #f0f4fe;
        --bg-card: #ffffff;
        --primary: #3b82f6;
        --primary-dark: #1e3a5f;
        --primary-darker: #0f2136;
        --primary-light: #e8f0fe;
        --primary-lighter: #f5f8ff;
        --text-dark: #1a2634;
        --text-gray: #64748b;
        --text-light: #94a3b8;
        --border-dark: #1a2634;
        --border-light: #e2e8f0;
        --shadow-hard: 6px 6px 0px rgba(26, 38, 52, 0.12);
        --shadow-hard-hover: 8px 8px 0px rgba(26, 38, 52, 0.18);
        --font-display: 'Space Grotesk', sans-serif;
        --font-mono: 'JetBrains Mono', monospace;
        --success: #22c55e;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gold: #fbbf24;
    }

    /* ============================================
       HEADER DE AVATARES
    ============================================ */
    .avatar-header-innovative {
        padding: 2rem;
        background: linear-gradient(135deg, var(--primary-darker) 0%, var(--primary-dark) 100%);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .avatar-header-innovative::before {
        content: '\F4F5';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -30px;
        right: -10px;
        font-size: 10rem;
        opacity: 0.04;
        transform: rotate(15deg);
    }

    .avatar-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: -1px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .avatar-header-innovative h2 i {
        color: var(--gold);
        margin-right: 0.8rem;
        font-size: 2.2rem;
    }

    .avatar-header-innovative p {
        color: rgba(255,255,255,0.6);
        font-family: var(--font-display);
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        font-size: 1.05rem;
    }

    .avatar-header-innovative .avatar-stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1rem;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }

    .avatar-header-innovative .avatar-stats .stat-item {
        background: rgba(255,255,255,0.05);
        border: 2px solid rgba(255,255,255,0.1);
        padding: 0.4rem 1.5rem;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        color: rgba(255,255,255,0.7);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .avatar-header-innovative .avatar-stats .stat-item strong {
        color: white;
        font-size: 1.1rem;
    }

    .avatar-header-innovative .avatar-stats .stat-item .active-dot {
        color: var(--success);
    }

    /* ============================================
       BOTON VOLVER AL PERFIL
    ============================================ */
    .btn-back-profile-innovative {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.08);
        border: 2px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.7);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.85rem;
        margin-top: 1rem;
        position: relative;
        z-index: 1;
    }

    .btn-back-profile-innovative:hover {
        background: rgba(255,255,255,0.15);
        color: white;
        transform: translateX(-4px);
        border-color: rgba(255,255,255,0.3);
    }

    /* ============================================
       FORMULARIO DE SUBIDA - MEJORADO
    ============================================ */
    .upload-area-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 2rem;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .upload-area-innovative::before {
        content: '\F4F5';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -20px;
        right: 10px;
        font-size: 6rem;
        opacity: 0.03;
        transform: rotate(-10deg);
    }

    .upload-area-innovative .upload-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .upload-area-innovative .upload-title i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .upload-area-innovative .upload-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
    }

    .upload-area-innovative .upload-sub .hint {
        font-family: var(--font-mono);
        font-size: 0.75rem;
        color: var(--text-light);
        display: block;
        margin-top: 0.2rem;
    }

    .upload-area-innovative .upload-form {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .upload-area-innovative .upload-form .form-group {
        flex: 1;
        min-width: 200px;
    }

    .upload-area-innovative .upload-form label {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
        display: block;
        margin-bottom: 0.3rem;
    }

    .upload-area-innovative .upload-form input[type="file"] {
        width: 100%;
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: var(--bg-page);
        cursor: pointer;
    }

    .upload-area-innovative .upload-form input[type="file"]:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-upload-innovative {
        background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.6rem 2rem;
        border: 2px solid var(--border-dark);
        box-shadow: 4px 4px 0px var(--border-dark);
        transition: all 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        cursor: pointer;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-upload-innovative:hover {
        transform: translateY(-3px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .btn-upload-innovative:active {
        transform: translateY(2px);
        box-shadow: 2px 2px 0px var(--border-dark);
    }

    /* ============================================
       GALERIA DE AVATARES
    ============================================ */
    .avatar-gallery-innovative {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1.5rem;
        margin-top: 0.5rem;
    }

    .avatar-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1.5rem 1rem 1.2rem;
        text-align: center;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .avatar-card-innovative:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hard-hover);
    }

    /* Avatar activo - destacado */
    .avatar-card-innovative.active {
        border-color: var(--success);
        background: linear-gradient(180deg, #f0fdf4 0%, white 100%);
    }

    .avatar-card-innovative.active::before {
        content: '\F26A';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--success);
        color: white;
        font-size: 0.8rem;
        padding: 0.2rem 0.4rem;
        border: 2px solid var(--border-dark);
        transform: rotate(3deg);
    }

    .avatar-card-innovative.inactive {
        opacity: 0.7;
    }

    .avatar-card-innovative .avatar-status {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.1rem 0.8rem;
        border: 2px solid var(--border-dark);
        margin-bottom: 0.8rem;
    }

    .avatar-card-innovative .avatar-status.active-status {
        background: #dcfce7;
        color: #16a34a;
        border-color: #16a34a;
    }

    .avatar-card-innovative .avatar-status.inactive-status {
        background: #f1f5f9;
        color: #64748b;
        border-color: #64748b;
    }

    .avatar-card-innovative .avatar-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid var(--border-dark);
        object-fit: cover;
        margin: 0 auto 0.8rem;
        background: var(--bg-page);
        box-shadow: 4px 4px 0px var(--border-dark);
        transition: all 0.3s ease;
        display: block;
    }

    .avatar-card-innovative.active .avatar-image {
        border-color: var(--success);
        box-shadow: 6px 6px 0px var(--success);
    }

    .avatar-card-innovative:hover .avatar-image {
        transform: scale(1.05) rotate(-3deg);
    }

    .avatar-card-innovative .avatar-actions {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    /* Botones de accion en tarjetas */
    .btn-avatar-innovative {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.35rem 1rem;
        border: 2px solid var(--border-dark);
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
        width: 100%;
    }

    .btn-avatar-innovative:hover {
        transform: translateY(-2px);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-avatar-innovative:active {
        transform: translateY(1px);
        box-shadow: 2px 2px 0px var(--border-dark);
    }

    .btn-avatar-primary {
        background: var(--primary);
        color: white !important;
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .btn-avatar-primary:hover {
        background: var(--primary);
        color: white !important;
        box-shadow: 5px 5px 0px var(--border-dark);
    }

    .btn-avatar-success {
        background: var(--success);
        color: white !important;
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .btn-avatar-success:hover {
        background: var(--success);
        color: white !important;
        box-shadow: 5px 5px 0px var(--border-dark);
    }

    .btn-avatar-danger {
        background: var(--danger);
        color: white !important;
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .btn-avatar-danger:hover {
        background: var(--danger);
        color: white !important;
        box-shadow: 5px 5px 0px var(--border-dark);
    }

    .btn-avatar-outline {
        background: transparent;
        color: var(--text-gray);
        border-color: var(--border-dark);
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .btn-avatar-outline:hover {
        background: var(--border-dark);
        color: white;
        box-shadow: 5px 5px 0px var(--border-dark);
    }

    /* ============================================
       ESTADO VACIO
    ============================================ */
    .avatar-empty-innovative {
        background: var(--bg-card);
        border: 3px dashed var(--border-dark);
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: var(--shadow-hard);
    }

    .avatar-empty-innovative .empty-icon {
        font-size: 4rem;
        color: var(--text-light);
        display: block;
        margin-bottom: 1rem;
    }

    .avatar-empty-innovative h4 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .avatar-empty-innovative p {
        color: var(--text-gray);
        font-family: var(--font-display);
        margin-bottom: 0;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .avatar-header-innovative h2 {
            font-size: 1.4rem;
        }

        .avatar-header-innovative .avatar-stats {
            gap: 1rem;
        }

        .avatar-header-innovative .avatar-stats .stat-item {
            font-size: 0.6rem;
            padding: 0.3rem 1rem;
        }

        .upload-area-innovative {
            padding: 1.5rem;
        }

        .upload-area-innovative .upload-form {
            flex-direction: column;
            align-items: stretch;
        }

        .upload-area-innovative .upload-form .form-group {
            min-width: auto;
        }

        .btn-upload-innovative {
            width: 100%;
            justify-content: center;
        }

        .avatar-gallery-innovative {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
        }

        .avatar-card-innovative .avatar-image {
            width: 80px;
            height: 80px;
        }

        .btn-back-profile-innovative {
            font-size: 0.75rem;
            padding: 0.4rem 1.2rem;
        }
    }

    @media (max-width: 480px) {
        .avatar-header-innovative h2 {
            font-size: 1.1rem;
        }

        .avatar-header-innovative h2 i {
            font-size: 1.5rem;
        }

        .avatar-gallery-innovative {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }

        .avatar-card-innovative .avatar-image {
            width: 64px;
            height: 64px;
        }

        .avatar-card-innovative {
            padding: 1rem 0.6rem 0.8rem;
        }

        .btn-avatar-innovative {
            font-size: 0.6rem;
            padding: 0.25rem 0.6rem;
        }
    }
</style>

<!-- ============================================
     HTML DE AVATARES
============================================ -->

<!-- HEADER -->
<div class="avatar-header-innovative">
    <h2><i class="bi bi-person-badge-fill"></i>Mis Avatares</h2>
    <p>Administra tus imagenes de perfil. Sube una nueva o elige cual quieres usar.</p>

    <div class="avatar-stats">
        <span class="stat-item"><i class="bi bi-images me-1"></i>Total: <strong><?= count($avatars ?? []) ?></strong></span>
        <?php
            $activeCount = 0;
            foreach ($avatars ?? [] as $a) {
                if ($a->activo) $activeCount++;
            }
        ?>
        <span class="stat-item"><i class="bi bi-check-circle-fill me-1 active-dot"></i>Activos: <strong><?= $activeCount ?></strong></span>
    </div>

    <a href="<?= APP_URL ?>/profile" class="btn-back-profile-innovative">
        <i class="bi bi-arrow-left"></i> Volver a mi perfil
    </a>
</div>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-innovative alert-innovative-danger" style="border-radius:0; border:2px solid #dc2626; background:#fee2e2; color:#dc2626; padding:0.75rem 1rem; font-family: var(--font-display); margin-bottom: 1.5rem;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<!-- FORMULARIO DE SUBIDA -->
<div class="upload-area-innovative">
    <div class="upload-title">
        <i class="bi bi-cloud-upload-fill"></i>Subir nuevo avatar
    </div>
    <p class="upload-sub">
        Sube una imagen y se activara automaticamente como tu foto de perfil.
        <span class="hint">Formatos: JPG, PNG, GIF, WEBP | Tamaño maximo: 2MB</span>
    </p>

    <form method="POST" action="<?= APP_URL ?>/avatars/store" enctype="multipart/form-data" class="upload-form">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="form-group">
            <label for="avatarUpload"><i class="bi bi-image me-1"></i>Seleccionar imagen</label>
            <input type="file" name="image" id="avatarUpload" accept="image/*" required>
        </div>

        <button type="submit" class="btn-upload-innovative">
            <i class="bi bi-plus-lg"></i> Subir y activar
        </button>
    </form>
</div>

<!-- GALERIA DE AVATARES -->
<?php if (!empty($avatars)): ?>
    <div class="avatar-gallery-innovative">
        <?php foreach ($avatars as $avatar): ?>
            <div class="avatar-card-innovative <?= $avatar->activo ? 'active' : 'inactive' ?>">
                <span class="avatar-status <?= $avatar->activo ? 'active-status' : 'inactive-status' ?>">
                    <?= $avatar->activo ? '<i class="bi bi-check-circle-fill me-1"></i>Activo' : '<i class="bi bi-circle me-1"></i>Inactivo' ?>
                </span>

                <img class="avatar-image"
                     src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($avatar->image) ?>"
                     alt="Avatar"
                     onerror="this.src='<?= APP_URL ?>/images/default.png'">

                <div class="avatar-actions">
                    <?php if (!$avatar->activo): ?>
                        <form method="POST" action="<?= APP_URL ?>/avatars/activate/<?= $avatar->id ?>">
                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                            <button type="submit" class="btn-avatar-innovative btn-avatar-success">
                                <i class="bi bi-check-circle"></i> Usar este avatar
                            </button>
                        </form>
                    <?php else: ?>
                        <form method="POST" action="<?= APP_URL ?>/avatars/deactivate/<?= $avatar->id ?>"
                              onsubmit="return confirm('Desactivar este avatar? No se borrara, solo dejara de usarse.')">
                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                            <button type="submit" class="btn-avatar-innovative btn-avatar-danger">
                                <i class="bi bi-slash-circle"></i> Desactivar
                            </button>
                        </form>
                    <?php endif; ?>

                    <!-- Solo eliminar (sin reemplazar) -->
                    <?php if (count($avatars) > 1): ?>
                        <form method="POST" action="<?= APP_URL ?>/avatars/delete/<?= $avatar->id ?>"
                              onsubmit="return confirm('Eliminar este avatar permanentemente?')">
                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                            <button type="submit" class="btn-avatar-innovative btn-avatar-outline">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="avatar-empty-innovative">
        <span class="empty-icon"><i class="bi bi-person-circle"></i></span>
        <h4>No tienes avatares</h4>
        <p>Sube tu primera imagen usando el formulario de arriba</p>
    </div>
<?php endif; ?>