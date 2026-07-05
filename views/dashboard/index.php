<div class="mb-4">
    <h2 class="fw-bold"><i class="bi bi-house-heart text-primary me-2"></i>Bienvenido, <?= htmlspecialchars($user->username) ?></h2>
    <p class="text-muted">Aquí tienes un resumen de tu progreso.</p>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-star-fill text-warning fs-3"></i>
                <div class="text-muted small text-uppercase mt-1 mb-1">Puntos Totales</div>
                <p class="display-5 fw-bold text-primary mb-0"><?= $user->total_points ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-bar-chart-steps text-success fs-3"></i>
                <div class="text-muted small text-uppercase mt-1 mb-1">Nivel Actual</div>
                <p class="fs-4 fw-semibold mb-0"><?= $currentLevel ?? 'Ninguno' ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <a href="<?= APP_URL ?>/game" class="btn btn-primary btn-lg w-100 h-100 d-flex align-items-center justify-content-center fs-5">
            <i class="bi bi-joystick me-2"></i>¡Jugar ahora!
        </a>
    </div>
</div>