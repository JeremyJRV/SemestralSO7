<style>
    .form-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        transition: all 0.2s ease;
    }

    .form-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .form-card-innovative .corner-deco {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--primary);
        color: white;
        padding: 0.2rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid var(--border-dark);
        transform: rotate(3deg);
    }

    .form-card-innovative .form-label {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
    }

    .form-card-innovative .form-control {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-size: 0.95rem;
        transition: all 0.15s ease;
    }

    .form-card-innovative .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .form-card-innovative .form-control[type="file"] {
        padding: 0.4rem 0.6rem;
        font-family: var(--font-display);
    }

    .form-card-innovative textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .form-card-innovative .checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0.5rem;
        padding: 0.8rem 0;
        max-height: 260px;
        overflow-y: auto;
    }

    .form-card-innovative .checkbox-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.3rem 0.6rem;
        border: 2px solid var(--border-light);
        transition: all 0.15s ease;
        font-family: var(--font-display);
        font-size: 0.8rem;
        cursor: pointer;
    }

    .form-card-innovative .checkbox-item:hover {
        border-color: var(--border-dark);
        background: var(--primary-lighter);
    }

    .form-card-innovative .checkbox-item input[type="checkbox"] {
        appearance: none;
        width: 18px;
        height: 18px;
        min-width: 18px;
        border: 3px solid var(--border-dark);
        background: var(--bg-card);
        cursor: pointer;
        transition: all 0.15s ease;
        position: relative;
    }

    .form-card-innovative .checkbox-item input[type="checkbox"]:checked {
        background: var(--primary);
        border-color: var(--border-dark);
    }

    .form-card-innovative .checkbox-item input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.5rem;
        font-weight: 700;
    }

    .form-card-innovative .image-preview {
        margin-top: 0.5rem;
        padding: 0.5rem;
        border: 2px solid var(--border-dark);
        background: var(--bg-page);
        display: inline-block;
    }

    .form-card-innovative .image-preview img {
        max-width: 100px;
        max-height: 100px;
        object-fit: contain;
    }

    .btn-form-submit-innovative {
        background: var(--success);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px var(--border-dark);
        width: 100%;
    }

    .btn-form-submit-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .btn-form-cancel-innovative {
        background: transparent;
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        width: 100%;
    }

    .btn-form-cancel-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--danger);
    }

    .alert-innovative {
        border-radius: 0;
        border: 2px solid var(--border-dark);
        font-size: 0.9rem;
        padding: 0.75rem 1rem;
        font-family: var(--font-display);
    }

    .alert-innovative-danger {
        background: #fee2e2;
        color: #dc2626;
        border-color: #dc2626;
    }

    .alert-innovative-warning {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .text-hint {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--text-light);
        margin-top: 0.3rem;
        letter-spacing: 0.3px;
    }

    .admin-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .admin-header-innovative::before {
        content: '⚙';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1.2rem;
    }

    .admin-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .admin-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .admin-header-innovative .admin-badge {
        display: inline-block;
        background: var(--primary-darker);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 1rem;
        border: 2px solid var(--border-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    @media (max-width: 768px) {
        .form-card-innovative { padding: 1.5rem; }
        .form-card-innovative .checkbox-group {
            grid-template-columns: 1fr;
        }
        .admin-header-innovative { padding: 1rem 1.2rem; }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-trophy"></i><?= isset($prize) ? 'Editar Premio' : 'Nuevo Premio' ?></h2>
            <p><?= isset($prize) ? 'Modifica los datos del premio' : 'Crea un nuevo premio para los jugadores' ?></p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="form-card-innovative">
    <span class="corner-deco">✦ <?= isset($prize) ? 'editar' : 'nuevo' ?></span>

    <?php if (isset($error)): ?>
        <div class="alert alert-innovative alert-innovative-danger">
            <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" action="<?= isset($prize) ? APP_URL . "/admin/prizes/update/{$prize->id}" : APP_URL . '/admin/prizes/store' ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-tag me-1"></i>Nombre del Premio</label>
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($prize->name ?? '') ?>" placeholder="Ej. Medalla PHP Básico">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-card-text me-1"></i>Descripción</label>
            <textarea name="description" class="form-control" placeholder="Ej. Otorgado por completar el nivel Básico de PHP con al menos 80% de aciertos."><?= htmlspecialchars($prize->description ?? '') ?></textarea>
            <div class="text-hint">Se le mostrará al jugador para que sepa por qué ganó este premio</div>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-coin me-1"></i>Valor en Puntos</label>
            <input type="number" name="points_value" class="form-control" required value="<?= $prize->points_value ?? 0 ?>" placeholder="100">
            <div class="text-hint">Cantidad de puntos que otorga al jugador</div>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-image me-1"></i>Imagen del Premio</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <?php if (isset($prize) && $prize->image && $prize->image !== 'default.png'): ?>
                <div class="image-preview">
                    <img src="<?= APP_URL ?>/images/prizes/<?= $prize->image ?>" alt="<?= htmlspecialchars($prize->name) ?>">
                </div>
                <div class="text-hint">Dejar en blanco para mantener la imagen actual</div>
            <?php endif; ?>
            <div class="text-hint">Formatos: JPG, PNG, GIF, WEBP (máx. 2MB)</div>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="bi bi-collection me-1"></i>Asignar a Tema y Nivel</label>
            <div class="checkbox-group">
                <?php foreach ($themeLevels as $tl): ?>
                    <label class="checkbox-item">
                        <input type="checkbox" name="theme_levels[]" value="<?= $tl->id ?>"
                            <?= (isset($prizeThemeLevelIds) && in_array($tl->id, $prizeThemeLevelIds)) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($tl->theme_name ?? 'Tema') ?> - <?= htmlspecialchars($tl->level_name ?? 'Nivel') ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="text-hint">El premio se otorgará al completar estos tema-nivel específicos con 80% o más</div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn-form-submit-innovative">
                <i class="bi <?= isset($prize) ? 'bi-check2-circle' : 'bi-plus-circle' ?> me-2"></i>
                <?= isset($prize) ? 'Actualizar Premio' : 'Crear Premio' ?>
            </button>
            <a href="<?= APP_URL ?>/admin/prizes" class="btn-form-cancel-innovative">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>