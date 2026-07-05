<h2>Crear Sala Multijugador</h2>
<form method="POST" action="<?= APP_URL ?>/game/room/store">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <div class="mb-3">
        <label>Tema y Nivel</label>
        <select name="theme_level_id" class="form-select">
            <?php foreach ($themeLevels as $tl): ?>
                <option value="<?= $tl['id'] ?>"><?= htmlspecialchars($tl['theme_name']) ?> - <?= htmlspecialchars($tl['level_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Crear Sala</button>
</form>