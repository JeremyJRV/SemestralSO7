<style>
    .auth-card-innovative {
        max-width: 460px;
        margin: 2rem auto;
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        overflow: visible;
        position: relative;
        background: var(--bg-card);
    }

    .auth-card-innovative .corner-deco {
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

    .auth-header-innovative {
        background: var(--primary-darker);
        color: white;
        text-align: center;
        padding: 2rem 1.5rem 1.5rem;
        border-bottom: 4px solid var(--primary);
    }

    .auth-header-innovative .auth-icon {
        width: 64px;
        height: 64px;
        border: 3px solid var(--border-dark);
        background: rgba(255, 255, 255, 0.05);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.8rem;
    }

    .auth-header-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        margin-bottom: 0.25rem;
        letter-spacing: -0.3px;
        text-transform: uppercase;
    }

    .auth-header-innovative p {
        opacity: 0.5;
        font-size: 0.85rem;
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .auth-body-innovative { padding: 2rem; }

    .auth-body-innovative .form-control {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        transition: all 0.15s ease;
        font-family: var(--font-display);
    }

    .auth-body-innovative .form-control:focus {
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
        outline: none;
    }

    .auth-body-innovative .input-group-text {
        background: var(--bg-page);
        border: 2px solid var(--border-dark);
        border-right: none;
        color: var(--text-light);
        border-radius: 0;
    }

    .auth-body-innovative .input-group .form-control { border-left: none; }

    .auth-body-innovative .btn-auth-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.75rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .auth-body-innovative .btn-auth-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 7px 7px 0px var(--border-dark);
        color: white !important;
    }

    .auth-body-innovative .auth-link {
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        font-family: var(--font-display);
        border-bottom: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .auth-body-innovative .auth-link:hover {
        border-bottom-color: var(--primary);
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

    .text-hint-innovative {
        color: var(--text-light);
        font-family: var(--font-mono);
        font-size: 0.65rem;
        margin-top: 0.3rem;
        letter-spacing: 0.3px;
    }
</style>

<div class="auth-card-innovative">
    <span class="corner-deco">✦ register</span>
    <div class="auth-header-innovative">
        <div class="auth-icon"><i class="bi bi-person-plus"></i></div>
        <h3>Crear Cuenta</h3>
        <p>Regístrate gratis y empieza a jugar</p>
    </div>
    <div class="auth-body-innovative">
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
        <form method="POST" action="<?= APP_URL ?>/register">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <div class="mb-3">
                <label class="form-label fw-semibold small text-gray-innovative text-uppercase" style="font-family: var(--font-mono); letter-spacing: 0.5px;">Nombre de usuario</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($data['username'] ?? '') ?>" placeholder="Ej. juan123">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small text-gray-innovative text-uppercase" style="font-family: var(--font-mono); letter-spacing: 0.5px;">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email'] ?? '') ?>" placeholder="tu@email.com">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small text-gray-innovative text-uppercase" style="font-family: var(--font-mono); letter-spacing: 0.5px;">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <div class="text-hint-innovative">8-12 caracteres, mayúsculas, minúsculas y números.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small text-gray-innovative text-uppercase" style="font-family: var(--font-mono); letter-spacing: 0.5px;">Confirmar contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                </div>
            </div>
            <button type="submit" class="btn btn-auth-innovative w-100">
                <i class="bi bi-person-plus me-2"></i>Registrarse
            </button>
        </form>
        <p class="text-center mt-3 mb-0 small text-gray-innovative" style="font-family: var(--font-display);">
            ¿Ya tienes cuenta? <a href="<?= APP_URL ?>/login" class="auth-link">Inicia sesión</a>
        </p>
    </div>
</div>