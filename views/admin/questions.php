<h2>Preguntas</h2>
<form method="GET" class="mb-3">
    <label>Filtrar por Tema-Nivel:</label>
    <select name="theme_level_id" class="form-select" onchange="this.form.submit()">
        <option value="">Todos</option>
        <?php foreach ($themeLevels as $tl): ?>
            <option value="<?= $tl->id ?>" <?= ($selectedThemeLevel == $tl->id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($tl->theme_name) ?> - <?= htmlspecialchars($tl->level_name) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>
<a href="/admin/questions/create" class="btn btn-primary mb-3">Nueva Pregunta</a>
<table class="table">
    <thead><tr><th>ID</th><th>Texto</th><th>Tipo</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach ($questions as $q): ?>
        <tr>
            <td><?= $q->id ?></td>
            <td><?= htmlspecialchars($q->text) ?></td>
            <td><?= $q->type ?></td>
            <td>
                <a href="/admin/questions/edit/<?= $q->id ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="/admin/questions/delete/<?= $q->id ?>" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>