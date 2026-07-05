<h2>Bienvenido, <?= htmlspecialchars($user->username) ?></h2>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-bg-light">
            <div class="card-body">
                <h5 class="card-title">Puntos Totales</h5>
                <p class="card-text display-4"><?= $user->total_points ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-light">
            <div class="card-body">
                <h5 class="card-title">Nivel Actual</h5>
                <p class="card-text"><?= $currentLevel ?? 'Ninguno' ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/game" class="btn btn-primary btn-lg w-100">¡Jugar ahora!</a>
    </div>
</div>