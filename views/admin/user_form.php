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

    .form-card-innovative .form-select {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-weight: 500;
        transition: all 0.15s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231a2634' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px;
    }

    .form-card-innovative .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .form-card-innovative textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .form-card-innovative .text-hint {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--text-light);
        margin-top: 0.3rem;
        letter-spacing: 0.3px;
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

    @media (max-width: 768px) {
        .form-card-innovative { padding: 1.5rem; }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-person-badge"></i><?= isset($user) ? 'Editar Usuario' : 'Nuevo Usuario' ?></h2>
            <p><?= isset($user) ? 'Modifica los datos del usuario' : 'Crea un nuevo usuario en el sistema' ?></p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="form-card-innovative">
    <span class="corner-deco">✦ <?= isset($user) ? 'editar' : 'nuevo' ?></span>

    <?php if (isset($error)): ?>
        <div class="alert alert-innovative alert-innovative-danger">
            <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <?php if (isset($errors)): ?>
        <?php foreach ($errors as $field => $msgs): ?>
            <?php foreach ($msgs as $msg): ?>
                <div class="alert alert-innovative alert-innovative-warning">
                    <i class="bi bi-exclamation-circle me-1"></i><?= htmlspecialchars($msg) ?>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="POST" action="<?= isset($user) ? APP_URL . "/admin/users/update/{$user->id}" : APP_URL . '/admin/users/store' ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-person me-1"></i>Nombre de usuario</label>
            <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user->username ?? '') ?>" placeholder="Ej. juan123">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-envelope me-1"></i>Email</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user->email ?? '') ?>" placeholder="usuario@email.com">
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-lock me-1"></i>Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="<?= isset($user) ? 'Dejar en blanco para no cambiar' : '••••••••' ?>">
            <?php if (isset($user)): ?>
                <div class="text-hint"><i class="bi bi-info-circle me-1"></i>Dejar en blanco para mantener la contraseña actual</div>
            <?php else: ?>
                <div class="text-hint">8-12 caracteres, mayúsculas, minúsculas y números.</div>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label class="form-label"><i class="bi bi-tag me-1"></i>Rol</label>
            <select name="role" class="form-select" required>
                <option value="player" <?= (isset($user) && $user->role == 'player') ? 'selected' : '' ?>>Jugador</option>
                <option value="armador" <?= (isset($user) && $user->role == 'armador') ? 'selected' : '' ?>>Armador</option>
                <option value="admin" <?= (isset($user) && $user->role == 'admin') ? 'selected' : '' ?>>Administrador</option>
            </select>
            <div class="text-hint">
                <i class="bi bi-info-circle me-1"></i>
                <strong>Jugador:</strong> Solo juega • 
                <strong>Armador:</strong> Crea preguntas y temas • 
                <strong>Admin:</strong> Control total
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn-form-submit-innovative">
                <i class="bi <?= isset($user) ? 'bi-check2-circle' : 'bi-person-plus' ?> me-2"></i>
                <?= isset($user) ? 'Actualizar Usuario' : 'Crear Usuario' ?>
            </button>
            <a href="<?= APP_URL ?>/admin/users" class="btn-form-cancel-innovative">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>