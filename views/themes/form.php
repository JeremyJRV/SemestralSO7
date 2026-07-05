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

    .form-card-innovative textarea.form-control {
        resize: vertical;
        min-height: 100px;
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
        .admin-header-innovative { padding: 1rem 1.2rem; }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-tag"></i><?= isset($theme) ? 'Editar Tema' : 'Nuevo Tema' ?></h2>
            <p><?= isset($theme) ? 'Modifica los datos del tema' : 'Crea un nuevo tema para las trivias' ?></p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="form-card-innovative">
    <span class="corner-deco">✦ <?= isset($theme) ? 'editar' : 'nuevo' ?></span>

    <?php if (isset($error)): ?>
        <div class="alert alert-innovative alert-innovative-danger">
            <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= isset($theme) ? APP_URL . "/admin/themes/update/{$theme->id}" : APP_URL . '/admin/themes/store' ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-tag me-1"></i>Nombre del Tema</label>
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($theme->name ?? '') ?>" placeholder="Ej. JavaScript Avanzado">
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="bi bi-card-text me-1"></i>Descripción</label>
            <textarea name="description" class="form-control" placeholder="Describe el tema..."><?= htmlspecialchars($theme->description ?? '') ?></textarea>
            <div class="text-hint">Opcional - Una breve descripción del tema</div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn-form-submit-innovative">
                <i class="bi <?= isset($theme) ? 'bi-check2-circle' : 'bi-plus-circle' ?> me-2"></i>
                <?= isset($theme) ? 'Actualizar Tema' : 'Crear Tema' ?>
            </button>
            <a href="<?= APP_URL ?>/admin/themes" class="btn-form-cancel-innovative">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>