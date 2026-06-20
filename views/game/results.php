<h2>Resultados</h2>
<div class="card">
    <div class="card-body">
        <h5>Puntuación: <?= $result['percentage'] ?? 0 ?>%</h5>
        <p>Respuestas correctas: <?= $result['correct'] ?? 0 ?>/<?= $result['total'] ?? 0 ?></p>
        <p>Tiempo promedio: <?= round(($result['avg_time_ms'] ?? 0)/1000, 2) ?> segundos</p>
        <p>Puntos ganados: <?= $result['points_earned'] ?? 0 ?></p>
        <a href="/game" class="btn btn-primary">Volver a jugar</a>
    </div>
</div>