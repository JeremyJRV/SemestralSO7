<h2><?= isset($question) ? 'Editar Pregunta' : 'Nueva Pregunta' ?></h2>
<form method="POST" action="<?= isset($question) ? "/admin/questions/update/{$question->id}" : '/admin/questions/store' ?>">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <div class="mb-3">
        <label>Tema y Nivel</label>
        <select name="theme_level_id" class="form-select" required>
            <?php foreach ($themeLevels as $tl): ?>
                <option value="<?= $tl->id ?>" <?= (isset($question) && $question->theme_level_id == $tl->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($tl->theme_name) ?> - <?= htmlspecialchars($tl->level_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Tipo de pregunta</label>
        <select name="type" id="typeSelect" class="form-select" required>
            <option value="multiple" <?= (isset($question) && $question->type == 'multiple') ? 'selected' : '' ?>>Opción múltiple</option>
            <option value="boolean" <?= (isset($question) && $question->type == 'boolean') ? 'selected' : '' ?>>Verdadero/Falso</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Pregunta</label>
        <textarea name="text" class="form-control" required><?= htmlspecialchars($question->text ?? '') ?></textarea>
    </div>
    <!-- Opciones dinámicas con JS -->
    <div id="multipleOptions" style="<?= (isset($question) && $question->type == 'boolean') ? 'display:none' : '' ?>">
        <label>Opciones (marca la correcta)</label>
        <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="input-group mb-2">
                <div class="input-group-text">
                    <input type="radio" name="correct_option" value="<?= $i ?>" <?= (isset($question) && $question->correct_option == $i) ? 'checked' : '' ?>>
                </div>
                <input type="text" name="options[]" class="form-control" placeholder="Opción <?= $i+1 ?>" value="<?= htmlspecialchars($question->options[$i]->text ?? '') ?>">
            </div>
        <?php endfor; ?>
    </div>
    <div id="booleanOptions" style="<?= (isset($question) && $question->type == 'boolean') ? '' : 'display:none' ?>">
        <label>Respuesta correcta</label>
        <select name="boolean_correct" class="form-select">
            <option value="1" <?= (isset($question) && $question->boolean_correct == 1) ? 'selected' : '' ?>>Verdadero</option>
            <option value="0" <?= (isset($question) && $question->boolean_correct == 0) ? 'selected' : '' ?>>Falso</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success mt-3">Guardar</button>
</form>
<script>
document.getElementById('typeSelect').addEventListener('change', function() {
    document.getElementById('multipleOptions').style.display = this.value === 'multiple' ? 'block' : 'none';
    document.getElementById('booleanOptions').style.display = this.value === 'boolean' ? 'block' : 'none';
});
</script>