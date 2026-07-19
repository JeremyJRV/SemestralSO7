<style>
    .feedback-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .feedback-stat-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1.2rem;
        text-align: center;
    }
    .feedback-stat-card .stat-num {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2rem;
        color: var(--primary);
    }
    .feedback-stat-card .stat-lbl {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        text-transform: uppercase;
        color: var(--text-gray);
    }
    .feedback-stat-card .stat-pct {
        font-family: var(--font-display);
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-gray);
        margin-top: 0.15rem;
    }
    .feedback-total-votes {
        font-family: var(--font-display);
        font-size: 0.8rem;
        color: var(--text-gray);
        text-align: center;
        margin: -0.5rem 0 1.5rem;
    }

    /* Barra proporcional de calificación general de la app */
    .app-rating-track-innovative {
        display: flex;
        width: 100%;
        height: 1.4rem;
        border-radius: 999px;
        overflow: hidden;
        background: var(--border-light, #e5e7eb);
        margin-bottom: 0.6rem;
    }
    .app-rating-track-innovative > div {
        height: 100%;
        transition: width 0.4s ease;
    }
    .fill-mucho { background: #34d399; }
    .fill-bastante { background: #60a5fa; }
    .fill-regular { background: #fbbf24; }
    .fill-medio { background: #f87171; }

    .app-rating-legend-innovative {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem 1rem;
        font-family: var(--font-display);
        font-size: 0.75rem;
        color: var(--text-gray);
        margin-bottom: 1.5rem;
    }
    .app-rating-legend-innovative .dot {
        display: inline-block;
        width: 0.6rem;
        height: 0.6rem;
        border-radius: 50%;
        margin-right: 0.3rem;
    }
    .dot-mucho { background: #34d399; }
    .dot-bastante { background: #60a5fa; }
    .dot-regular { background: #fbbf24; }
    .dot-medio { background: #f87171; }
    .feedback-table-innovative {
        width: 100%;
        border-collapse: collapse;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
    }
    .feedback-table-innovative th {
        background: var(--primary-darker);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        text-transform: uppercase;
        padding: 0.7rem 1rem;
        text-align: left;
    }
    .feedback-table-innovative td {
        padding: 0.6rem 1rem;
        border-bottom: 2px solid var(--border-light);
        font-family: var(--font-display);
        font-size: 0.85rem;
    }
</style>

<div class="admin-header-innovative">
    <h2><i class="bi bi-chat-heart"></i>Evaluación de la Aplicación</h2>
    <p>Calificaciones generales y sugerencias de temas nuevos de los jugadores</p>
</div>

<?php
    $totalAppVotes = array_sum($ratingStats);
    $pct = fn($n) => $totalAppVotes > 0 ? number_format(($n / $totalAppVotes) * 100, 0) : 0;
    $totalForBar = $totalAppVotes > 0 ? $totalAppVotes : 1;
    $muchoPct = ($ratingStats['mucho'] / $totalForBar) * 100;
    $bastantePct = ($ratingStats['bastante'] / $totalForBar) * 100;
    $regularPct = ($ratingStats['regular'] / $totalForBar) * 100;
    $medioPct = ($ratingStats['medio'] / $totalForBar) * 100;
?>

<!-- AGREGADO: barra visual proporcional, igual estilo que la de calificación
     de temas en Estadísticas, para que se vea de un vistazo la distribución
     además de los números/porcentajes de las tarjetas de abajo. -->
<div class="app-rating-track-innovative">
    <div class="fill-mucho" style="width: <?= $muchoPct ?>%;"></div>
    <div class="fill-bastante" style="width: <?= $bastantePct ?>%;"></div>
    <div class="fill-regular" style="width: <?= $regularPct ?>%;"></div>
    <div class="fill-medio" style="width: <?= $medioPct ?>%;"></div>
</div>
<div class="app-rating-legend-innovative">
    <span class="legend-item"><span class="dot dot-mucho"></span>Mucho</span>
    <span class="legend-item"><span class="dot dot-bastante"></span>Bastante</span>
    <span class="legend-item"><span class="dot dot-regular"></span>Regular</span>
    <span class="legend-item"><span class="dot dot-medio"></span>Medio</span>
</div>

<div class="feedback-stats-grid">
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['mucho'] ?></div>
        <div class="stat-lbl">Mucho</div>
        <div class="stat-pct"><?= $pct($ratingStats['mucho']) ?>%</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['bastante'] ?></div>
        <div class="stat-lbl">Bastante</div>
        <div class="stat-pct"><?= $pct($ratingStats['bastante']) ?>%</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['regular'] ?></div>
        <div class="stat-lbl">Regular</div>
        <div class="stat-pct"><?= $pct($ratingStats['regular']) ?>%</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['medio'] ?></div>
        <div class="stat-lbl">Medio</div>
        <div class="stat-pct"><?= $pct($ratingStats['medio']) ?>%</div>
    </div>
</div>
<p class="feedback-total-votes">
    <?= $totalAppVotes ?> voto<?= $totalAppVotes === 1 ? '' : 's' ?> en total
</p>

<h5 style="font-family: var(--font-display); font-weight:700; margin-bottom:1rem;">
    <i class="bi bi-star-fill me-1"></i>Calificaciones individuales
</h5>
<table class="feedback-table-innovative">
    <thead>
        <tr><th>Usuario</th><th>Calificación</th><th>Fecha</th></tr>
    </thead>
    <tbody>
        <?php foreach ($ratings as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['username']) ?></td>
                <td><?= ucfirst($r['rating']) ?></td>
                <td><?= date('d/m/Y', strtotime($r['created_at'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5 style="font-family: var(--font-display); font-weight:700; margin-bottom:1rem;">
    <i class="bi bi-lightbulb-fill me-1"></i>Sugerencias de temas
</h5>
<table class="feedback-table-innovative">
    <thead>
        <tr><th>Usuario</th><th>Sugerencia</th><th>Fecha</th></tr>
    </thead>
    <tbody>
        <?php foreach ($suggestions as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['username']) ?></td>
                <td><?= htmlspecialchars($s['suggestion']) ?></td>
                <td><?= date('d/m/Y', strtotime($s['created_at'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>