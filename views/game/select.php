<h2>Selecciona Tema y Nivel</h2>
<div class="row">
    <?php foreach ($levels as $tl): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5><?= htmlspecialchars($tl['theme_name']) ?> - <?= htmlspecialchars($tl['level_name']) ?></h5>
                    <a href="<?= APP_URL ?>/game/start/<?= $tl['id'] ?>" class="btn btn-outline-primary">Empezar</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>