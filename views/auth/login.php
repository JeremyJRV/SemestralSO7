<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $fieldErrors): ?>
                <?php foreach ($fieldErrors as $err): ?>
                    <div class="alert alert-warning"><?= htmlspecialchars($err) ?></div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="POST" action="/login">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($email ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <?php if (isset($remaining)): ?>
                <small class="text-danger">Intentos restantes: <?= $remaining ?></small>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
        </form>
        <p class="mt-3">¿No tienes cuenta? <a href="/register">Regístrate gratis</a></p>
    </div>
</div>