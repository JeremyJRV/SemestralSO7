<style>
    .stats-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .stats-header-innovative::before {
        content: '▣';
        position: absolute;
        top: -8px;
        left: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .stats-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .stats-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .stats-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .stat-card-stats-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem;
        box-shadow: var(--shadow-hard);
        height: 100%;
        transition: all 0.2s ease;
    }

    .stat-card-stats-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .stat-card-stats-innovative h5 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        border-bottom: 3px solid var(--border-dark);
        padding-bottom: 0.5rem;
    }

    .stat-card-stats-innovative h5 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .stat-list-item-innovative {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 2px solid var(--border-light);
    }

    .stat-list-item-innovative:last-child { border-bottom: none; }

    .stat-list-item-innovative .stat-name {
        color: var(--text-gray);
        font-weight: 500;
        font-family: var(--font-display);
    }

    .stat-list-item-innovative .stat-count {
        font-weight: 700;
        color: var(--text-dark);
        font-family: var(--font-display);
    }

    .stat-list-item-innovative .stat-count .badge-count {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.1rem 0.6rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        margin-left: 0.3rem;
        border: 2px solid var(--border-dark);
    }

    .rating-bar-innovative {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.4rem 0;
    }

    .rating-bar-innovative .rating-label {
        min-width: 100px;
        color: var(--text-gray);
        font-weight: 500;
        font-size: 0.85rem;
        font-family: var(--font-display);
    }

    .rating-track-innovative {
        flex: 1;
        height: 10px;
        background: var(--bg-page);
        border: 2px solid var(--border-dark);
        overflow: hidden;
        position: relative;
    }

    .rating-track-innovative .fill-boring {
        height: 100%;
        background: #f87171;
        float: left;
    }

    .rating-track-innovative .fill-interesting {
        height: 100%;
        background: #fbbf24;
        float: left;
    }

    .rating-track-innovative .fill-great {
        height: 100%;
        background: #34d399;
        float: left;
    }

    .rating-value-innovative {
        min-width: 30px;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--text-dark);
        text-align: right;
    }

    .rating-legend-innovative {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 0.5rem;
        padding-top: 0.8rem;
        border-top: 2px solid var(--border-dark);
    }

    .rating-legend-innovative .legend-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        color: var(--text-gray);
        font-weight: 600;
    }

    .rating-legend-innovative .legend-item .dot {
        width: 12px;
        height: 12px;
        display: inline-block;
        border: 2px solid var(--border-dark);
    }

    .dot-boring { background: #f87171; }
    .dot-interesting { background: #fbbf24; }
    .dot-great { background: #34d399; }

    .divider-innovative {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 2rem 0;
        position: relative;
    }

    .divider-innovative::after {
        content: '◆';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--bg-page);
        padding: 0 1rem;
        color: var(--primary);
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .stats-header-innovative { padding: 1rem 1.2rem; }
        .rating-bar-innovative { flex-wrap: wrap; gap: 0.3rem; }
        .rating-bar-innovative .rating-label { min-width: 80px; font-size: 0.75rem; }
        .rating-legend-innovative { gap: 0.8rem; }
    }
</style>

<div class="stats-header-innovative">
    <h2><i class="bi bi-bar-chart-line"></i>Estadísticas</h2>
    <p>Resumen de actividad y rendimiento del sistema</p>
</div>

<div class="row g-3">
    <!-- Temas más jugados -->
    <div class="col-md-6">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-trophy"></i>Temas más jugados</h5>
            <?php if (!empty($mostPlayed)): ?>
                <?php foreach ($mostPlayed as $theme): ?>
                    <div class="stat-list-item-innovative">
                        <span class="stat-name"><?= htmlspecialchars($theme['name']) ?></span>
                        <span class="stat-count">
                            <?= $theme['total_responses'] ?>
                            <span class="badge-count">respuestas</span>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> No hay datos aún.
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Calificaciones -->
    <div class="col-md-6">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-star"></i>Calificaciones de temas</h5>
            <?php if (!empty($ratings)): ?>
                <?php foreach ($ratings as $r): ?>
                    <div class="rating-bar-innovative">
                        <span class="rating-label"><?= htmlspecialchars($r['name']) ?></span>
                        <div class="rating-track-innovative">
                            <?php
                                $total = ($r['boring'] ?? 0) + ($r['interesting'] ?? 0) + ($r['great'] ?? 0);
                                $total = $total > 0 ? $total : 1;
                                $boringPct = ($r['boring'] ?? 0) / $total * 100;
                                $interestingPct = ($r['interesting'] ?? 0) / $total * 100;
                                $greatPct = ($r['great'] ?? 0) / $total * 100;
                            ?>
                            <div class="fill-boring" style="width: <?= $boringPct ?>%;"></div>
                            <div class="fill-interesting" style="width: <?= $interestingPct ?>%;"></div>
                            <div class="fill-great" style="width: <?= $greatPct ?>%;"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="rating-legend-innovative">
                    <span class="legend-item"><span class="dot dot-boring"></span>Aburrido</span>
                    <span class="legend-item"><span class="dot dot-interesting"></span>Interesante</span>
                    <span class="legend-item"><span class="dot dot-great"></span>Genial</span>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> No hay calificaciones aún.
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>