<h2>Usuarios</h2>
<a href="<?= APP_URL ?>/admin/users/create" class="btn btn-primary mb-3">Nuevo Usuario</a>
<table class="table table-striped">
    <thead>
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u->id ?></td>
            <td><?= htmlspecialchars($u->username) ?></td>
            <td><?= htmlspecialchars($u->email) ?></td>
            <td><?= $u->role ?></td>
            <td>
                <a href="<?= APP_URL ?>/admin/users/edit/<?= $u->id ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= APP_URL ?>/admin/users/delete/<?= $u->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>