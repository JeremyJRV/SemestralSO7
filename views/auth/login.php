<style>
    .auth-card {
        max-width: 420px;
        margin: 2rem auto;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .auth-header {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        color: white;
        text-align: center;
        padding: 2rem 1.5rem 1.5rem;
    }
    .auth-header i {
        font-size: 2.5rem;
    }
</style>

<div class="card auth-card">
    <div class="auth-header">
        <i class="bi bi-shield-lock"></i>
        <h3 class="fw-bold mt-2 mb-0">Iniciar Sesión</h3>
        <p class="mb-0 small opacity-75">Ingresa tus credenciales para continuar</p>
    </div>
    <div class="card-body p-4">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger py-2"><i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $fieldErrors): ?>
                <?php foreach ($fieldErrors as $err): ?>
                    <div class="alert alert-warning py-2"><?= htmlspecialchars($err) ?></div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="POST" action="<?= APP_URL ?>/login">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <div class="mb-3">
                <label class="form-label small text-muted">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($email ?? '') ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label small text-muted">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <?php if (isset($remaining)): ?>
                <small class="text-danger d-block mb-2"><i class="bi bi-exclamation-circle me-1"></i>Intentos restantes: <?= $remaining ?></small>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary w-100 mt-2 py-2">Entrar</button>
        </form>
        <p class="text-center mt-3 mb-0 small">¿No tienes cuenta? <a href="<?= APP_URL ?>/register" class="fw-semibold">Regístrate gratis</a></p>
    </div>
</div>