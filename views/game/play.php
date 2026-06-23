<h2><?= htmlspecialchars($session->id) ?> - Preguntas</h2>
<form method="POST" action="/game/submit/<?= $session->id ?>" id="gameForm">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    <?php foreach ($questions as $index => $question): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><?= ($index+1) ?>. <?= htmlspecialchars($question->text) ?></h5>
                <?php if ($question->type === 'multiple'): ?>
                    <?php foreach ($question->options as $opt): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[<?= $question->id ?>]" value="<?= $opt->id ?>" required>
                            <label class="form-check-label"><?= htmlspecialchars($opt->text) ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?= $question->id ?>]" value="1" required> Verdadero
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[<?= $question->id ?>]" value="0"> Falso
                    </div>
                <?php endif; ?>
                <input type="hidden" name="times[<?= $question->id ?>]" class="response-time" value="0">
            </div>
        </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-success">Enviar respuestas</button>
</form>

<script>
// Medir tiempo de respuesta por pregunta (básico)
document.querySelectorAll('.form-check-input').forEach(input => {
    const questionId = input.name.match(/\[(.*?)\]/)[1];
    const timeField = document.querySelector(`input[name="times[${questionId}]"]`);
    let start = Date.now();
    input.addEventListener('change', () => {
        timeField.value = Date.now() - start;
        start = Date.now(); // reiniciar para siguiente intento? mejor medir global
    });
});
</script>