<h2>Temas</h2>
<a href="<?= APP_URL ?>/admin/themes/create" class="btn btn-primary mb-3">Nuevo Tema</a>
<table class="table">
    <thead><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach ($themes as $theme): ?>
        <tr>
            <td><?= $theme->id ?></td>
            <td><?= htmlspecialchars($theme->name) ?></td>
            <td>
                <a href="<?= APP_URL ?>/admin/themes/edit/<?= $theme->id ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="<?= APP_URL ?>/admin/themes/delete/<?= $theme->id ?>" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>