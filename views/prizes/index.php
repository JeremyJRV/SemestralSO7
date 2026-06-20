<h2>Premios</h2>
<a href="/prizes/create" class="btn btn-primary mb-3">Nuevo Premio</a>
<table class="table">
    <thead>
        <tr><th>ID</th><th>Nombre</th><th>Puntos</th><th>Acciones</th></tr>
    </thead>
    <tbody>
        <?php foreach ($prizes as $prize): ?>
            <tr>
                <td><?= $prize->id ?></td>
                <td><?= htmlspecialchars($prize->name) ?></td>
                <td><?= $prize->points_value ?></td>
                <td>
                    <a href="/prizes/edit/<?= $prize->id ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/prizes/delete/<?= $prize->id ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>