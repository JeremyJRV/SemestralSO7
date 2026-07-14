<style>
    /* ---------- Contenedor del ícono animado ---------- */
    .result-icon-animated {
        font-size: 5rem;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    /* Tier 1: PERFECTO (100%) - trofeo dorado con rebote + brillo */
    .result-icon-animated.tier-perfect {
        color: #d4af37;
        animation: bounce-in 0.6s ease, glow-pulse 1.5s ease-in-out infinite 0.6s;
    }

    /* Tier 2: EXCELENTE (80-99%) - estrella con pulso */
    .result-icon-animated.tier-excellent {
        color: var(--primary);
        animation: bounce-in 0.6s ease, pulse-scale 1.8s ease-in-out infinite 0.6s;
    }

    /* Tier 3: BIEN (50-79%) - pulgar arriba con meneo */
    .result-icon-animated.tier-good {
        color: #22c55e;
        animation: bounce-in 0.6s ease, wiggle 2s ease-in-out infinite 0.6s;
    }

    /* Tier 4: SIGUE PRACTICANDO (1-49%) - diana con vibración suave */
    .result-icon-animated.tier-practice {
        color: #f59e0b;
        animation: bounce-in 0.6s ease, gentle-shake 2.5s ease-in-out infinite 0.6s;
    }

    /* Tier 5: NO TE RINDAS (0%) - carita amigable con respiración */
    .result-icon-animated.tier-retry {
        color: #64748b;
        animation: bounce-in 0.6s ease, breathe 2.2s ease-in-out infinite 0.6s;
    }

    /* ---------- Confeti para el tier perfecto ---------- */
    .confetti-piece {
        position: absolute;
        width: 8px;
        height: 8px;
        top: -10px;
        opacity: 0.9;
        animation: confetti-fall 1.8s ease-in forwards;
    }

    /* ---------- Keyframes ---------- */
    @keyframes bounce-in {
        0%   { transform: scale(0) rotate(-15deg); opacity: 0; }
        60%  { transform: scale(1.2) rotate(5deg); opacity: 1; }
        100% { transform: scale(1) rotate(0deg); }
    }

    @keyframes glow-pulse {
        0%, 100% { filter: drop-shadow(0 0 4px rgba(212,175,55,0.5)); transform: scale(1); }
        50%      { filter: drop-shadow(0 0 16px rgba(212,175,55,0.9)); transform: scale(1.08); }
    }

    @keyframes pulse-scale {
        0%, 100% { transform: scale(1); }
        50%      { transform: scale(1.12); }
    }

    @keyframes wiggle {
        0%, 100% { transform: rotate(0deg); }
        25%      { transform: rotate(-8deg); }
        75%      { transform: rotate(8deg); }
    }

    @keyframes gentle-shake {
        0%, 100% { transform: translateX(0); }
        25%      { transform: translateX(-4px) rotate(-3deg); }
        75%      { transform: translateX(4px) rotate(3deg); }
    }

    @keyframes breathe {
        0%, 100% { transform: scale(1); opacity: 0.85; }
        50%      { transform: scale(1.06); opacity: 1; }
    }

    @keyframes confetti-fall {
        0%   { transform: translateY(0) rotate(0deg); opacity: 1; }
        100% { transform: translateY(120px) rotate(360deg); opacity: 0; }
    }

    .results-header-innovative {
        padding: 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        text-align: center;
        position: relative;
        margin-bottom: 2rem;
    }

    .results-header-innovative::before {
        content: '★';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary);
        color: white;
        padding: 0 1rem;
        font-size: 0.8rem;
    }

    .results-header-innovative .result-icon {
        font-size: 4rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .results-header-innovative .result-icon.pass {
        color: var(--success);
    }

    .results-header-innovative .result-icon.fail {
        color: var(--danger);
    }

    .results-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .results-header-innovative .result-subtitle {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1.1rem;
    }

    .result-stats-innovative {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .result-stat-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.2rem;
        text-align: center;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
    }

    .result-stat-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .result-stat-innovative .stat-number {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2.2rem;
        color: var(--text-dark);
        line-height: 1;
    }

    .result-stat-innovative .stat-number.green { color: var(--success); }
    .result-stat-innovative .stat-number.blue { color: var(--primary); }
    .result-stat-innovative .stat-number.orange { color: var(--warning); }
    .result-stat-innovative .stat-number.red { color: var(--danger); }

    .result-stat-innovative .stat-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        margin-top: 0.2rem;
        display: block;
    }

    .result-detail-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem;
        box-shadow: var(--shadow-hard);
        margin-bottom: 1rem;
        transition: all 0.2s ease;
    }

    .result-detail-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: var(--shadow-hard-hover);
    }

    .result-detail-card .detail-q {
        font-family: var(--font-display);
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    .result-detail-card .detail-answer {
        font-family: var(--font-mono);
        font-size: 0.85rem;
        color: var(--text-gray);
    }

    .result-detail-card .detail-answer .correct {
        color: var(--success);
        font-weight: 700;
    }

    .result-detail-card .detail-answer .incorrect {
        color: var(--danger);
        font-weight: 700;
    }

    .result-detail-card .badge-result {
        display: inline-block;
        padding: 0.15rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid var(--border-dark);
    }

    .badge-result-correct {
        background: #dcfce7;
        color: #16a34a;
        border-color: #16a34a;
    }

    .badge-result-incorrect {
        background: #fee2e2;
        color: #dc2626;
        border-color: #dc2626;
    }

    .btn-again-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.85rem 2.5rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px var(--border-dark);
        text-decoration: none;
        display: inline-block;
    }

    .btn-again-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .btn-home-innovative {
        background: transparent;
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.85rem 2.5rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-home-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--primary);
    }

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
        .result-stats-innovative {
            grid-template-columns: repeat(2, 1fr);
        }
        .results-header-innovative h2 { font-size: 1.5rem; }
        .result-stat-innovative .stat-number { font-size: 1.8rem; }
        .btn-again-innovative, .btn-home-innovative {
            width: 100%;
            text-align: center;
        }
    }
</style>

<?php
// NUEVO (rúbrica punto 16): antes solo había 2 estados (aprobado/no
// aprobado según el 80%). Ahora se muestra una imagen animada distinta
// según el puntaje EXACTO obtenido (5/5 no es lo mismo que 4/5), con
// 5 niveles de resultado.
$percentage = $result['percentage'] ?? 0;
$correct = $result['correct'] ?? 0;
$total = $result['total'] ?? 0;

if ($total > 0 && $correct === $total) {
    $tier = 'perfect';
    $bsIcon = 'bi-trophy-fill';
    $title = '¡PERFECTO! ' . $correct . '/' . $total;
    $subtitle = '¡Respondiste absolutamente todo correctamente!';
} elseif ($percentage >= 80) {
    $tier = 'excellent';
    $bsIcon = 'bi-star-fill';
    $title = '¡Excelente!';
    $subtitle = 'Has superado el nivel con éxito';
} elseif ($percentage >= 50) {
    $tier = 'good';
    $bsIcon = 'bi-hand-thumbs-up-fill';
    $title = '¡Bien hecho!';
    $subtitle = 'Vas por buen camino, sigue así';
} elseif ($percentage > 0) {
    $tier = 'practice';
    $bsIcon = 'bi-bullseye';
    $title = 'Sigue practicando';
    $subtitle = 'Cada intento te acerca más a dominarlo';
} else {
    $tier = 'retry';
    $bsIcon = 'bi-emoji-smile-fill';
    $title = 'No te rindas';
    $subtitle = 'Vuelve a intentarlo, tú puedes lograrlo';
}

$passed = $percentage >= 80; // se conserva para el color verde/rojo de "Precisión"
?>

<div class="results-header-innovative" style="position:relative; overflow:hidden;">
    <?php if ($tier === 'perfect'): ?>
        <!-- Confeti (solo en el resultado perfecto) -->
        <?php
        $confettiColors = ['#fbbf24', '#f472b6', '#60a5fa', '#34d399', '#a78bfa'];
        for ($i = 0; $i < 14; $i++):
            $left = rand(5, 95);
            $delay = rand(0, 8) / 10;
            $color = $confettiColors[array_rand($confettiColors)];
        ?>
            <span class="confetti-piece" style="left:<?= $left ?>%; background:<?= $color ?>; animation-delay:<?= $delay ?>s;"></span>
        <?php endfor; ?>
    <?php endif; ?>

    <span class="result-icon-animated tier-<?= $tier ?>">
        <i class="bi <?= $bsIcon ?>"></i>
    </span>
    <h2><?= htmlspecialchars($title) ?></h2>
    <p class="result-subtitle"><?= htmlspecialchars($subtitle) ?></p>
</div>

<div class="result-stats-innovative">
    <div class="result-stat-innovative">
        <div class="stat-number <?= $passed ? 'green' : 'red' ?>"><?= $result['percentage'] ?? 0 ?>%</div>
        <span class="stat-label">Precisión</span>
    </div>
    <div class="result-stat-innovative">
        <div class="stat-number blue"><?= $result['correct'] ?? 0 ?>/<?= $result['total'] ?? 0 ?></div>
        <span class="stat-label">Correctas / Totales</span>
    </div>
    <div class="result-stat-innovative">
        <div class="stat-number orange"><?= round(($result['avg_time_ms'] ?? 0) / 1000, 1) ?>s</div>
        <span class="stat-label">Tiempo promedio</span>
    </div>
    <div class="result-stat-innovative">
        <div class="stat-number" style="background: linear-gradient(135deg, var(--primary), #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            +<?= $result['points_earned'] ?? 0 ?>
        </div>
        <span class="stat-label">Puntos ganados</span>
    </div>
</div>

<hr class="divider-innovative">

<!-- Detalle de respuestas -->
<?php if (!empty($responses)): ?>
    <h4 style="font-family: var(--font-display); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.9rem; margin-bottom: 1rem;">
        <i class="bi bi-list-ul me-2" style="color: var(--primary);"></i>Detalle de respuestas
    </h4>
    <?php foreach ($responses as $idx => $r): ?>
        <div class="result-detail-card">
            <div class="d-flex align-items-start justify-content-between gap-2">
                <div>
                    <div class="detail-q">
                        <span style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light); margin-right: 0.5rem;">#<?= $idx + 1 ?></span>
                        <?= htmlspecialchars($r->question_text ?? 'Pregunta') ?>
                    </div>
                    <div class="detail-answer">
                        <i class="bi bi-arrow-right-short me-1"></i>
                        Tu respuesta: 
                        <span class="<?= $r->is_correct ? 'correct' : 'incorrect' ?>">
                            <?= $r->is_correct ? '✓ Correcta' : '✗ Incorrecta' ?>
                        </span>
                        <?php if (!empty($r->response_time_ms)): ?>
                            <span style="color: var(--text-light); font-size: 0.75rem; margin-left: 0.5rem;">
                                (<?= round($r->response_time_ms / 1000, 1) ?>s)
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <span class="badge-result <?= $r->is_correct ? 'badge-result-correct' : 'badge-result-incorrect' ?>">
                    <?= $r->is_correct ? '✓ Acierto' : '✗ Fallo' ?>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr class="divider-innovative">

<div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
    <a href="<?= APP_URL ?>/game" class="btn-again-innovative">
        <i class="bi bi-arrow-repeat me-2"></i>Jugar de nuevo
    </a>
    <a href="<?= APP_URL ?>/dashboard" class="btn-home-innovative">
        <i class="bi bi-house me-2"></i>Ir al inicio
    </a>
</div>