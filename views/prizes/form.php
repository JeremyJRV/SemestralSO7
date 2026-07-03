<h2><?= isset($prize) ? 'Editar Premio' : 'Nuevo Premio' ?></h2>
<form method="POST" enctype="multipart/form-data" action="<?= isset($prize) ? "/prizes/update/{$prize->id}" : '/prizes/store' ?>">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($prize->name ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Valor en puntos</label>
        <input type="number" name="points_value" class="form-control" required value="<?= $prize->points_value ?? 0 ?>">
    </div>
    <div class="mb-3">
        <label>Imagen</label>
        <input type="file" name="image" class="form-control">
        <?php if (isset($prize) && $prize->image): ?>
            <img src="/images/prizes/<?= $prize->image ?>" width="80" class="mt-2">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label>Asignar a Niveles</label>
        <div>
            <?php foreach ($levels as $level): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="levels[]" value="<?= $level->id ?>"
                        <?= (isset($prize) && in_array($level->id, $prize->levels ?? [])) ? 'checked' : '' ?>>
                    <label class="form-check-label"><?= htmlspecialchars($level->name) ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>