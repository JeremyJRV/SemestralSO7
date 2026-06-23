<h2>Encuesta de Intereses</h2>
<?php foreach ($surveys as $survey): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5><?= htmlspecialchars($survey->question) ?></h5>
            <form class="survey-form">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <input type="hidden" name="survey_id" value="<?= $survey->id ?>">
                <?php $options = json_decode($survey->options, true); ?>
                <?php foreach ($options as $opt): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" value="<?= htmlspecialchars($opt) ?>">
                        <label class="form-check-label"><?= htmlspecialchars($opt) ?></label>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-sm btn-primary mt-2">Votar</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<script>
document.querySelectorAll('.survey-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const res = await fetch('/promo/submit-survey', { method: 'POST', body: formData });
        const result = await res.json();
        if (result.success) {
            alert('¡Gracias por participar!');
            form.reset();
        }
    });
});
</script>