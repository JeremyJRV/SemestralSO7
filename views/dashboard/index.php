<style>
    :root {
        --bg-page: #f0f4fe;
        --bg-card: #ffffff;
        --primary: #3b82f6;
        --primary-dark: #1e3a5f;
        --primary-darker: #0f2136;
        --primary-light: #e8f0fe;
        --primary-lighter: #f5f8ff;
        --text-dark: #1a2634;
        --text-gray: #64748b;
        --text-light: #94a3b8;
        --border-dark: #1a2634;
        --border-medium: #cbd5e1;
        --border-light: #e2e8f0;
        --shadow-hard: 6px 6px 0px rgba(26, 38, 52, 0.12);
        --shadow-hard-hover: 8px 8px 0px rgba(26, 38, 52, 0.18);
        --font-display: 'Space Grotesk', sans-serif;
        --font-mono: 'JetBrains Mono', monospace;
        --success: #22c55e;
        --warning: #f59e0b;
        --danger: #ef4444;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--bg-page);
        font-family: var(--font-display);
        min-height: 100vh;
        color: var(--text-dark);
    }

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

    .dash-level-badge-innovative i {
        margin-right: 0.3rem;
    }

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

    .stat-card-innovative .stat-sub i {
        color: var(--primary);
        margin-right: 0.2rem;
    }

    .theme-progress-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1.5rem 2rem;
    }

    .theme-progress-card .stat-label {
        color: var(--text-light);
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-play-innovative {
        position: relative;
        display: block;
        text-decoration: none;
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #3b82f6 0%, #7c3aed 50%, #ec4899 100%);
        background-size: 200% 200%;
        border: 3px solid var(--border-dark);
        box-shadow: 8px 8px 0px var(--border-dark);
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        overflow: hidden;
        text-align: center;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.2rem;
    }

    .btn-play-innovative:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 12px 12px 0px var(--border-dark);
        background-position: 100% 100%;
    }

    .btn-play-innovative:active {
        transform: translateY(2px) scale(0.98);
        box-shadow: 4px 4px 0px var(--border-dark);
        transition-duration: 0.05s;
    }

    .btn-play-innovative .play-icon {
        font-size: 3rem;
        color: white;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        flex-shrink: 0;
    }

    .btn-play-innovative:hover .play-icon {
        transform: scale(1.2) rotate(-8deg) translateX(-4px);
    }

    .btn-play-innovative .play-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: white;
        font-family: var(--font-display);
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        z-index: 1;
    }

    .btn-play-innovative .play-text .main {
        font-size: 1.8rem;
        font-weight: 900;
        line-height: 1.1;
        text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .btn-play-innovative:hover .play-text .main {
        transform: translateX(4px);
    }

    .btn-play-innovative .play-text .sub {
        font-size: 0.8rem;
        font-weight: 400;
        opacity: 0.85;
        text-transform: none;
        letter-spacing: 0.5px;
        margin-top: 0.2rem;
        transition: opacity 0.3s ease;
    }

    .btn-play-innovative:hover .play-text .sub {
        opacity: 1;
    }

    .btn-play-innovative .play-arrow {
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.6);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        flex-shrink: 0;
        margin-left: 0.5rem;
    }

    .btn-play-innovative:hover .play-arrow {
        transform: translateX(12px) scale(1.2);
        color: rgba(255, 255, 255, 1);
    }

    .btn-play-innovative::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, rgba(255,255,255,0.15) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.6s ease;
        pointer-events: none;
        transform: rotate(25deg);
    }

    .btn-play-innovative:hover::before {
        opacity: 1;
    }

    .btn-play-innovative .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        pointer-events: none;
        opacity: 0;
        transition: all 0.8s ease;
    }

    .btn-play-innovative .particle.p1 {
        top: 15%;
        left: 10%;
    }
    .btn-play-innovative .particle.p2 {
        bottom: 20%;
        right: 15%;
    }
    .btn-play-innovative .particle.p3 {
        top: 50%;
        right: 8%;
    }

    .btn-play-innovative:hover .particle.p1 {
        opacity: 1;
        transform: translate(-20px, -20px) scale(1.5);
        background: rgba(236, 72, 153, 0.8);
    }
    .btn-play-innovative:hover .particle.p2 {
        opacity: 1;
        transform: translate(20px, -15px) scale(1.8);
        background: rgba(59, 130, 246, 0.8);
    }
    .btn-play-innovative:hover .particle.p3 {
        opacity: 1;
        transform: translate(-15px, -25px) scale(1.3);
        background: rgba(124, 58, 237, 0.8);
    }

    .survey-card-dash {
        margin-top: 1.5rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .survey-card-dash .survey-title {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .survey-card-dash .survey-title i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .survey-card-dash .survey-question {
        font-family: var(--font-display);
        font-weight: 600;
        color: var(--text-gray);
        margin-bottom: 1rem;
    }

    .survey-option-label {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1rem;
        border: 2px solid var(--border-dark);
        margin-bottom: 0.5rem;
        cursor: pointer;
        font-family: var(--font-display);
        transition: all 0.2s ease;
    }

    .survey-option-label:hover {
        background: var(--primary-lighter);
    }

    .btn-submit-survey-dash {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.5rem 1.8rem;
        border: 2px solid var(--border-dark);
        box-shadow: 4px 4px 0px var(--border-dark);
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .btn-submit-survey-dash:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
    }

    .survey-thanks {
        font-family: var(--font-display);
        color: #16a34a;
        font-weight: 700;
        display: none;
    }

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

    .activity-item-innovative:last-child {
        border-bottom: none;
    }

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

    .text-gray-innovative {
        color: var(--text-gray);
    }

    @media (max-width: 768px) {
        .dash-header-innovative .greeting {
            font-size: 1.3rem;
        }

        .stat-card-innovative .stat-value {
            font-size: 2rem;
        }

        .dash-header-innovative {
            padding: 1.2rem 1.5rem;
        }

        .activity-innovative {
            padding: 1.2rem 1.5rem;
        }

        .btn-play-innovative {
            padding: 1.2rem 1.5rem;
            min-height: 100px;
            flex-direction: column;
            gap: 0.8rem;
            box-shadow: 6px 6px 0px var(--border-dark);
        }

        .btn-play-innovative:hover {
            box-shadow: 10px 10px 0px var(--border-dark);
        }

        .btn-play-innovative .play-icon {
            font-size: 2.2rem;
        }

        .btn-play-innovative .play-text .main {
            font-size: 1.3rem;
        }

        .btn-play-innovative .play-text .sub {
            font-size: 0.7rem;
        }

        .btn-play-innovative .play-arrow {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .btn-play-innovative .play-text .main {
            font-size: 1.1rem;
        }

        .btn-play-innovative .play-icon {
            font-size: 1.8rem;
        }
    }
</style>

<?php $user = $user ?? null; ?>

<div class="dash-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <div class="greeting">
                <i class="bi bi-controller"></i>Bienvenido, <?= htmlspecialchars($user->username ?? 'Jugador') ?>
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

<div class="row g-3">
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent"></span>
            <div class="stat-icon-innovative"><i class="bi bi-star-fill"></i></div>
            <div class="stat-label">Puntos Totales</div>
            <div class="stat-value primary"><?= number_format($user->total_points ?? 0) ?></div>
            <div class="stat-sub"><i class="bi bi-arrow-up-short"></i> Sigue asi</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent" style="background:#7c3aed;"></span>
            <div class="stat-icon-innovative" style="color:#7c3aed; background:#f5f3ff;"><i class="bi bi-joystick"></i></div>
            <div class="stat-label">Partidas Jugadas</div>
            <div class="stat-value purple"><?= number_format($gamesPlayed ?? 0) ?></div>
            <div class="stat-sub"><i class="bi bi-clock-history"></i> Total historico</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card-innovative">
            <span class="corner-accent" style="background:#22c55e;"></span>
            <div class="stat-icon-innovative" style="color:#22c55e; background:#f0fdf4;"><i class="bi bi-bullseye"></i></div>
            <div class="stat-label">Precision</div>
            <div class="stat-value green"><?= number_format($accuracy ?? 0, 1) ?>%</div>
            <div class="stat-sub"><i class="bi bi-check2-circle"></i> Respuestas correctas</div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <a href="<?= APP_URL ?>/game" class="btn-play-innovative">
            <span class="particle p1"></span>
            <span class="particle p2"></span>
            <span class="particle p3"></span>

            <span class="play-icon">
                <i class="bi bi-joystick"></i>
            </span>

            <span class="play-text">
                <span class="main">Jugar ahora</span>
                <span class="sub">Elige un tema y empieza a ganar puntos</span>
            </span>

            <span class="play-arrow">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </span>
        </a>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="theme-progress-card">
            <div class="stat-label" style="margin-bottom: 0.8rem;">Nivel Actual por Tema</div>

            <?php if (!empty($levelsByTheme)): ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($levelsByTheme as $lvl): ?>
                        <div class="d-flex justify-content-between align-items-center" style="border-bottom: 2px solid var(--border-light); padding-bottom: 0.5rem;">
                            <span style="font-family: var(--font-display); font-weight: 700; color: var(--text-dark);">
                                <?= htmlspecialchars($lvl['theme_name']) ?>
                            </span>
                            <span style="font-family: var(--font-mono); font-size: 0.8rem;">
                                <?php if ($lvl['current']): ?>
                                    <span class="dash-level-badge-innovative">
                                        <i class="bi bi-check-circle"></i><?= htmlspecialchars($lvl['current']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-innovative">Sin iniciar</span>
                                <?php endif; ?>
                                <?php if ($lvl['next']): ?>
                                    <span class="text-gray-innovative"> → <?= htmlspecialchars($lvl['next']) ?></span>
                                <?php else: ?>
                                    <span class="text-gray-innovative"> · Nivel maximo</span>
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative mb-0">Aun no hay temas disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($survey): ?>
    <?php $surveyOptions = json_decode($survey->options ?? '[]', true) ?: []; ?>
    <div class="survey-card-dash" id="surveyCard">
        <div class="survey-title"><i class="bi bi-clipboard-data"></i>Ayudanos con una pregunta rapida</div>
        <div class="survey-question"><?= htmlspecialchars($survey->question) ?></div>

        <form id="surveyForm">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <input type="hidden" name="survey_id" value="<?= $survey->id ?>">

            <?php foreach ($surveyOptions as $i => $opt): ?>
                <label class="survey-option-label">
                    <input type="radio" name="option" value="<?= htmlspecialchars($opt) ?>" required>
                    <?= htmlspecialchars($opt) ?>
                </label>
            <?php endforeach; ?>

            <button type="submit" class="btn-submit-survey-dash">Enviar respuesta</button>
        </form>

        <div class="survey-thanks" id="surveyThanks">
            <i class="bi bi-check-circle me-1"></i>Gracias por tu respuesta
        </div>
    </div>

    <script>
        document.getElementById('surveyForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('<?= APP_URL ?>/promo/submit-survey', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('surveyForm').style.display = 'none';
                        document.getElementById('surveyThanks').style.display = 'block';
                    }
                })
                .catch(() => {});
        });
    </script>
<?php endif; ?>

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
        <i class="bi bi-emoji-smile me-1"></i> Aun no tienes actividad. Juega una partida
    </p>
</div>
<?php endif; ?>