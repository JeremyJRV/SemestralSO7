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

<div class="feedback-stats-grid">
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['mucho'] ?></div>
        <div class="stat-lbl">Mucho</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['bastante'] ?></div>
        <div class="stat-lbl">Bastante</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['regular'] ?></div>
        <div class="stat-lbl">Regular</div>
    </div>
    <div class="feedback-stat-card">
        <div class="stat-num"><?= $ratingStats['medio'] ?></div>
        <div class="stat-lbl">Medio</div>
    </div>
</div>

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