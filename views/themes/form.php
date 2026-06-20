<h2><?= isset($theme) ? 'Editar Tema' : 'Nuevo Tema' ?></h2>
<form method="POST" action="<?= isset($theme) ? "/themes/update/{$theme->id}" : '/themes/store' ?>">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($theme->name ?? '') ?>">
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($theme->description ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>