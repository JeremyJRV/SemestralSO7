<style>
    /* ========== DASHBOARD HEADER ========== */
    .dash-header-innovative {
        margin-bottom: 2rem;
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        position: relative;
    }

    .dash-header-innovative::before {
        content: '◆';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .dash-header-innovative .greeting {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
    }

    .dash-header-innovative .greeting i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .dash-header-innovative .subtitle {
        color: var(--text-gray);
        font-weight: 400;
        margin-top: 0.2rem;
        font-family: var(--font-display);
    }

    .dash-header-innovative .subtitle span {
        color: var(--primary);
        font-weight: 700;
    }

    .dash-header-innovative .subtitle .badge-level {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.15rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        border: 2px solid var(--border-dark);
        margin-left: 0.3rem;
    }

    .dash-level-badge-innovative {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.3rem 1.2rem;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.75rem;
        border: 2px solid var(--border-dark);
        letter-spacing: 0.3px;
    }

    .dash-level-badge-innovative i { margin-right: 0.3rem; }

    /* ========== STAT CARDS ========== */
    .stat-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem 1.5rem 1.8rem;
        text-align: center;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-hard);
        height: 100%;
        position: relative;
    }

    .stat-card-innovative:hover {
        transform: translate(-4px, -4px);
        box-shadow: var(--shadow-hard-hover);
    }

    .stat-card-innovative .corner-accent {
        position: absolute;
        top: -6px;
        left: -6px;
        width: 30px;
        height: 30px;
        background: var(--primary);
        border: 2px solid var(--border-dark);
        transform: rotate(45deg);
    }

    .stat-icon-innovative {
        width: 60px;
        height: 60px;
        border: 3px solid var(--border-dark);
        background: var(--primary-lighter);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        font-size: 1.8rem;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .stat-card-innovative:hover .stat-icon-innovative {
        background: var(--primary);
        color: white;
        transform: rotate(-5deg) scale(1.05);
    }

    .stat-card-innovative .stat-label {
        color: var(--text-light);
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .stat-card-innovative .stat-value {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 2.6rem;
        line-height: 1.1;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    .stat-card-innovative .stat-value.primary {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-card-innovative .stat-value.purple {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-card-innovative .stat-value.green {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-card-innovative .stat-sub {
        color: var(--text-gray);
        font-size: 0.8rem;
        margin-top: 0.3rem;
        font-family: var(--font-display);
    }

    .stat-card-innovative .stat-sub i { color: var(--primary); margin-right: 0.2rem; }

    /* ========== BOTÓN JUGAR ========== */
    .btn-play-innovative {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 1.2rem 1.5rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        box-shadow: 6px 6px 0px var(--border-dark);
        width: 100%;
        height: 100%;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        position: relative;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.1rem;
    }

    .btn-play-innovative::before {
        content: '→';
        position: absolute;
        right: 1.5rem;
        font-size: 1.5rem;
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    .btn-play-innovative:hover {
        transform: translate(-4px, -4px);
        box-shadow: 10px 10px 0px var(--border-dark);
        color: white !important;
    }

    .btn-play-innovative:hover::before {
        opacity: 1;
        transform: translateX(4px);
    }

    .btn-play-innovative i { font-size: 2rem; margin-right: 0.8rem; }

    .btn-play-innovative .play-sub {
        font-weight: 400;
        font-size: 0.7rem;
        opacity: 0.7;
        display: block;
        margin-top: 0.2rem;
        text-transform: none;
        letter-spacing: 0;
    }

    /* ========== ACTIVIDAD RECIENTE ========== */
    .activity-innovative {
        margin-top: 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem 2rem;
        box-shadow: var(--shadow-hard);
        position: relative;
    }

    .activity-innovative .activity-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .activity-innovative .activity-title i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .activity-item-innovative {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.7rem 0;
        border-bottom: 2px solid var(--border-light);
    }

    .activity-item-innovative:last-child { border-bottom: none; }

    .activity-item-innovative .activity-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border: 2px solid var(--border-dark);
        background: var(--primary-lighter);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 0.9rem;
    }

    .activity-item-innovative .activity-text {
        flex: 1;
        color: var(--text-gray);
        font-size: 0.9rem;
        font-family: var(--font-display);
    }

    .activity-item-innovative .activity-text strong {
        color: var(--text-dark);
        font-weight: 600;
    }

    .activity-item-innovative .activity-time {
        color: var(--text-light);
        font-family: var(--font-mono);
        font-size: 0.7rem;
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .dash-header-innovative .greeting { font-size: 1.3rem; }
        .stat-card-innovative .stat-value { font-size: 2rem; }
        .btn-play-innovative { min-height: 100px; font-size: 0.95rem; }
        .btn-play-innovative i { font-size: 1.5rem; }
        .dash-header-innovative { padding: 1.2rem 1.5rem; }
        .activity-innovative { padding: 1.2rem 1.5rem; }
        .btn-play-innovative::before { display: none; }
    }
</style>

<!-- ====== HEADER ====== -->
<div class="dash-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <div class="greeting">
                <i class="bi bi-controller"></i>¡Bienvenido, <?= htmlspecialchars($user->username) ?>!
            </div>
            <div class="subtitle">
                <i class="bi bi-arrow-right-short"></i> Nivel actual:
                <span><?= $currentLevel ?? 'Sin nivel asignado' ?></span>
                <?php if (!empty($currentLevel)): ?>
                    <span class="badge-level"><?= $currentLevel ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div>
            <span class="dash-level-badge-innovative">
                <i class="bi bi-trophy"></i>
                <?= number_format($user->total_points ?? 0) ?> pts
            </span>
        </div>
    </div>
</div>

<!-- ====== STATS ====== -->
<div class="row g-3">
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent"></span>
            <div class="stat-icon-innovative"><i class="bi bi-star-fill"></i></div>
            <div class="stat-label">Puntos Totales</div>
            <div class="stat-value primary"><?= number_format($user->total_points ?? 0) ?></div>
            <div class="stat-sub"><i class="bi bi-arrow-up-short"></i> Sigue así!</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent" style="background: #7c3aed;"></span>
            <div class="stat-icon-innovative" style="color: #7c3aed; background: #f5f3ff;"><i class="bi bi-bar-chart-steps"></i></div>
            <div class="stat-label">Nivel Actual</div>
            <div class="stat-value purple"><?= $currentLevel ?? '—' ?></div>
            <div class="stat-sub"><i class="bi bi-flag"></i> Siguiente: <?= $nextLevel ?? 'Completa más' ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent" style="background: #22c55e;"></span>
            <div class="stat-icon-innovative" style="color: #22c55e; background: #f0fdf4;"><i class="bi bi-joystick"></i></div>
            <div class="stat-label">Partidas Jugadas</div>
            <div class="stat-value green"><?= $gamesPlayed ?? 0 ?></div>
            <div class="stat-sub"><i class="bi bi-check-circle-fill" style="color: #22c55e;"></i> <?= $accuracy ?? 0 ?>% aciertos</div>
        </div>
    </div>
</div>

<!-- ====== BOTÓN JUGAR ====== -->
<div class="row mt-3">
    <div class="col-12">
        <a href="<?= APP_URL ?>/game" class="btn btn-play-innovative">
            <i class="bi bi-joystick"></i>
            <div>
                ¡Jugar ahora!
                <span class="play-sub">Elige un tema y empieza a ganar puntos</span>
            </div>
        </a>
    </div>
</div>

<!-- ====== ACTIVIDAD ====== -->
<?php if (!empty($recentActivity)): ?>
<div class="activity-innovative">
    <div class="activity-title">
        <i class="bi bi-clock-history"></i> Actividad Reciente
    </div>
    <?php foreach ($recentActivity as $activity): ?>
        <div class="activity-item-innovative">
            <div class="activity-icon">
                <i class="bi <?= $activity['icon'] ?? 'bi-dot' ?>"></i>
            </div>
            <div class="activity-text">
                <?= htmlspecialchars($activity['description']) ?>
            </div>
            <div class="activity-time">
                <i class="bi bi-clock me-1"></i><?= $activity['time'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="activity-innovative text-center" style="padding: 2rem;">
    <div class="activity-title">
        <i class="bi bi-clock-history"></i> Actividad Reciente
    </div>
    <p class="text-gray-innovative" style="margin: 0.5rem 0 0; font-family: var(--font-display);">
        <i class="bi bi-emoji-smile me-1"></i> Aún no tienes actividad. ¡Juega una partida!
    </p>
</div>
<?php endif; ?>