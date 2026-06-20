<h2><?= isset($user) ? 'Editar Usuario' : 'Nuevo Usuario' ?></h2>
<form method="POST" action="<?= isset($user) ? "/admin/users/update/{$user->id}" : '/admin/users/store' ?>">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user->username ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user->email ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Contraseña (dejar en blanco para no cambiar)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Rol</label>
        <select name="role" class="form-select">
            <option value="player" <?= (isset($user) && $user->role == 'player') ? 'selected' : '' ?>>Jugador</option>
            <option value="armador" <?= (isset($user) && $user->role == 'armador') ? 'selected' : '' ?>>Armador</option>
            <option value="admin" <?= (isset($user) && $user->role == 'admin') ? 'selected' : '' ?>>Administrador</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>