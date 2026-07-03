<div class="row justify-content-center">
    <div class="col-md-5">
        <h2>Registro Gratuito</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (isset($errors)): ?>
            <?php foreach ($errors as $field => $msgs): ?>
                <?php foreach ($msgs as $msg): ?>
                    <div class="alert alert-warning"><?= htmlspecialchars($msg) ?></div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="POST" action="<?= APP_URL ?>/register">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <div class="mb-3">
                <label>Nombre de usuario</label>
                <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($data['username'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label>Contraseña (8-12 caracteres, mayúsculas, minúsculas, números)</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registrarse</button>
        </form>
    </div>
</div>