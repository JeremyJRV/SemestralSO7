<style>
    .result-icon-animated {
        font-size: 5rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 3;
    }

    .result-icon-animated.tier-perfect {
        color: #d4af37;
        animation: bounce-in 0.6s ease, glow-pulse 1.5s ease-in-out infinite 0.6s;
    }

    .result-icon-animated.tier-excellent {
        color: var(--primary);
        animation: bounce-in 0.6s ease, pulse-scale 1.8s ease-in-out infinite 0.6s;
    }

    .result-icon-animated.tier-good {
        color: #22c55e;
        animation: bounce-in 0.6s ease, wiggle 2s ease-in-out infinite 0.6s;
    }

    .result-icon-animated.tier-practice {
        color: #f59e0b;
        animation: bounce-in 0.6s ease, gentle-shake 2.5s ease-in-out infinite 0.6s;
    }

    .result-icon-animated.tier-retry {
        color: #64748b;
        animation: bounce-in 0.6s ease, breathe 2.2s ease-in-out infinite 0.6s;
    }

    .confetti-piece {
        position: absolute;
        width: 8px;
        height: 8px;
        top: -10px;
        opacity: 0.9;
        animation: confetti-fall 1.8s ease-in forwards;
        z-index: 1;
    }

    .celebration-static {
        position: absolute;
        font-size: 2.2rem;
        opacity: 0.7;
        pointer-events: none;
        z-index: 2;
        animation: float-static 3s ease-in-out infinite;
    }

    .celebration-static-1 {
        top: 2%;
        left: 2%;
        font-size: 3.2rem;
        color: #fbbf24;
        animation-delay: 0s;
    }

    .celebration-static-2 {
        top: 2%;
        right: 2%;
        font-size: 3.2rem;
        color: #f472b6;
        animation-delay: 0.5s;
    }

    .celebration-static-3 {
        bottom: 10%;
        left: 2%;
        font-size: 2.8rem;
        color: #60a5fa;
        animation-delay: 1s;
    }

    .celebration-static-4 {
        bottom: 10%;
        right: 2%;
        font-size: 2.8rem;
        color: #34d399;
        animation-delay: 1.5s;
    }

    .celebration-static-5 {
        top: 35%;
        left: 0.5%;
        font-size: 2.2rem;
        color: #a78bfa;
        animation-delay: 0.3s;
    }

    .celebration-static-6 {
        top: 35%;
        right: 0.5%;
        font-size: 2.2rem;
        color: #f59e0b;
        animation-delay: 0.8s;
    }

    .celebration-static-7 {
        top: 15%;
        left: 15%;
        font-size: 1.8rem;
        color: #fb923c;
        animation-delay: 0.2s;
    }

    .celebration-static-8 {
        top: 15%;
        right: 15%;
        font-size: 1.8rem;
        color: #f87171;
        animation-delay: 0.7s;
    }

    .celebration-static-9 {
        bottom: 25%;
        left: 15%;
        font-size: 1.8rem;
        color: #facc15;
        animation-delay: 1.2s;
    }

    .celebration-static-10 {
        bottom: 25%;
        right: 15%;
        font-size: 1.8rem;
        color: #a78bfa;
        animation-delay: 1.7s;
    }

    @keyframes float-static {
        0%, 100% { transform: translateY(0) scale(1) rotate(0deg); }
        50% { transform: translateY(-10px) scale(1.08) rotate(5deg); }
    }

    @keyframes bounce-in {
        0%   { transform: scale(0) rotate(-15deg); opacity: 0; }
        60%  { transform: scale(1.2) rotate(5deg); opacity: 1; }
        100% { transform: scale(1) rotate(0deg); }
    }

    @keyframes glow-pulse {
        0%, 100% { filter: drop-shadow(0 0 4px rgba(212,175,55,0.5)); transform: scale(1); }
        50%      { filter: drop-shadow(0 0 20px rgba(212,175,55,0.9)); transform: scale(1.08); }
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
        100% { transform: translateY(140px) rotate(720deg); opacity: 0; }
    }

    .results-header-innovative {
        padding: 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        text-align: center;
        position: relative;
        margin-bottom: 2rem;
        overflow: hidden;
        min-height: 280px;
    }

    .result-title-large {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2.8rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -1px;
        margin-top: 0.5rem;
        position: relative;
        z-index: 3;
    }

    .result-title-large .highlight-perfect {
        background: linear-gradient(135deg, #d4af37, #fbbf24);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .result-title-large .highlight-excellent {
        background: linear-gradient(135deg, var(--primary), #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .result-title-large .highlight-good {
        color: #22c55e;
    }

    .result-title-large .highlight-practice {
        color: #f59e0b;
    }

    .result-title-large .highlight-retry {
        color: #64748b;
    }

    .result-subtitle {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1.1rem;
        margin-top: 0.2rem;
        position: relative;
        z-index: 3;
    }

    .celebration-message {
        font-family: var(--font-display);
        font-size: 1rem;
        color: var(--text-gray);
        margin-top: 0.3rem;
        font-weight: 400;
        position: relative;
        z-index: 3;
    }

    .celebration-message i {
        color: var(--primary);
        margin: 0 0.2rem;
    }

    .result-divider {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 0.5rem auto 1rem;
        width: 80px;
        position: relative;
        z-index: 3;
    }

    .result-divider::after {
        content: '◆';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--bg-card);
        padding: 0 0.8rem;
        color: var(--primary);
        font-size: 0.6rem;
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
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .result-detail-card .detail-q .q-number {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        color: var(--text-light);
        margin-right: 0.5rem;
    }

    .result-detail-card .detail-answer-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.2rem 0;
        font-family: var(--font-display);
        font-size: 0.9rem;
        color: var(--text-gray);
        flex-wrap: wrap;
    }

    .result-detail-card .detail-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--text-light);
        min-width: 110px;
    }

    .result-detail-card .icon-correct {
        color: var(--success);
        font-size: 1.1rem;
    }

    .result-detail-card .icon-incorrect {
        color: var(--danger);
        font-size: 1.1rem;
    }

    .result-detail-card .answer-text.correct-text {
        color: var(--success);
        font-weight: 500;
    }

    .result-detail-card .answer-text.incorrect-text {
        color: var(--danger);
        font-weight: 500;
    }

    .result-detail-card .detail-answer-status {
        font-weight: 600;
        font-size: 0.8rem;
    }

    .result-detail-card .detail-answer-status.correct {
        color: var(--success);
    }

    .result-detail-card .detail-answer-status.incorrect {
        color: var(--danger);
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

    .detail-response-correct {
        border-left: 4px solid var(--success);
    }

    .detail-response-incorrect {
        border-left: 4px solid var(--danger);
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

    .prize-won-banner {
        background: linear-gradient(135deg, #fffbeb 0%, var(--bg-card) 100%);
        border: 3px solid #d4af37;
        box-shadow: 6px 6px 0px var(--border-dark);
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
        animation: bounce-in 0.6s ease;
    }

    .prize-won-banner .prize-won-label {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #b8860b;
        margin-bottom: 0.8rem;
        display: block;
    }

    .prize-won-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.2rem;
    }

    .prize-won-item {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: 4px 4px 0px var(--border-dark);
        padding: 1rem 1.2rem;
        text-align: center;
        min-width: 140px;
    }

    .prize-won-item img {
        width: 64px;
        height: 64px;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }

    .prize-won-item .prize-won-name {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-dark);
        margin-bottom: 0.2rem;
    }

    .prize-won-item .prize-won-points {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--primary);
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

    .extra-confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .result-stats-innovative {
            grid-template-columns: repeat(2, 1fr);
        }
        .result-title-large {
            font-size: 1.8rem;
        }
        .result-stat-innovative .stat-number {
            font-size: 1.8rem;
        }
        .btn-again-innovative, .btn-home-innovative {
            width: 100%;
            text-align: center;
        }
        .prize-won-banner {
            padding: 1.2rem;
        }
        .prize-won-item {
            min-width: 110px;
            padding: 0.8rem;
        }
        .prize-won-item img {
            width: 48px;
            height: 48px;
        }
        .celebration-static-1,
        .celebration-static-2 {
            font-size: 2.2rem;
            top: 2%;
        }
        .celebration-static-3,
        .celebration-static-4 {
            font-size: 1.8rem;
            bottom: 8%;
        }
        .celebration-static-5,
        .celebration-static-6 {
            display: none;
        }
        .celebration-static-7,
        .celebration-static-8,
        .celebration-static-9,
        .celebration-static-10 {
            display: none;
        }
        .results-header-innovative {
            min-height: 220px;
            padding: 1.5rem;
        }
        .result-detail-card {
            padding: 1rem;
        }
        .result-detail-card .detail-answer-row {
            font-size: 0.8rem;
        }
        .result-detail-card .detail-label {
            min-width: 80px;
            font-size: 0.55rem;
        }
        .result-detail-card .badge-result {
            font-size: 0.5rem;
            padding: 0.1rem 0.6rem;
        }
    }

    @media (max-width: 480px) {
        .celebration-static-1,
        .celebration-static-2 {
            font-size: 1.5rem;
            top: 1%;
        }
        .celebration-static-3,
        .celebration-static-4 {
            font-size: 1.2rem;
            bottom: 5%;
        }
        .result-title-large {
            font-size: 1.4rem;
        }
        .result-icon-animated {
            font-size: 3.5rem;
        }
        .results-header-innovative {
            min-height: 180px;
            padding: 1rem;
        }
        .result-detail-card .detail-q {
            font-size: 0.9rem;
        }
        .result-detail-card .detail-label {
            min-width: 60px;
            font-size: 0.5rem;
        }
    }
</style>

<?php
$percentage = $result['percentage'] ?? 0;
$correct = $result['correct'] ?? 0;
$total = $result['total'] ?? 0;

if ($total > 0 && $correct === $total) {
    $tier = 'perfect';
    $bsIcon = 'bi-trophy-fill';
    $title = 'PERFECTO';
    $highlightClass = 'highlight-perfect';
    $subtitle = 'Respondiste absolutamente todo correctamente';
    $showCelebration = true;
} elseif ($percentage >= 80) {
    $tier = 'excellent';
    $bsIcon = 'bi-star-fill';
    $title = 'Excelente';
    $highlightClass = 'highlight-excellent';
    $subtitle = 'Has superado el nivel con exito';
    $showCelebration = false;
} elseif ($percentage >= 50) {
    $tier = 'good';
    $bsIcon = 'bi-hand-thumbs-up-fill';
    $title = 'Bien hecho';
    $highlightClass = 'highlight-good';
    $subtitle = 'Vas por buen camino, sigue asi';
    $showCelebration = false;
} elseif ($percentage > 0) {
    $tier = 'practice';
    $bsIcon = 'bi-bullseye';
    $title = 'Sigue practicando';
    $highlightClass = 'highlight-practice';
    $subtitle = 'Cada intento te acerca mas a dominarlo';
    $showCelebration = false;
} else {
    $tier = 'retry';
    $bsIcon = 'bi-emoji-smile-fill';
    $title = 'No te rindas';
    $highlightClass = 'highlight-retry';
    $subtitle = 'Vuelve a intentarlo, tu puedes lograrlo';
    $showCelebration = false;
}

$passed = $percentage >= 80;
?>

<div class="results-header-innovative">

    <?php if ($showCelebration): ?>
        <div class="extra-confetti-container">
            <?php
            $confettiColors = ['#fbbf24', '#f472b6', '#60a5fa', '#34d399', '#a78bfa', '#fb923c', '#f87171', '#facc15'];
            for ($i = 0; $i < 25; $i++):
                $left = rand(2, 98);
                $delay = rand(0, 12) / 10;
                $duration = 1.2 + (rand(0, 10) / 10);
                $size = rand(5, 10);
                $color = $confettiColors[array_rand($confettiColors)];
                $rotation = rand(0, 360);
            ?>
                <span class="confetti-piece" style="left:<?= $left ?>%; background:<?= $color ?>; animation-delay:<?= $delay ?>s; animation-duration:<?= $duration ?>s; width:<?= $size ?>px; height:<?= $size ?>px; transform:rotate(<?= $rotation ?>deg);"></span>
            <?php endfor; ?>
        </div>

        <div class="celebration-static celebration-static-1">
            <i class="bi bi-stars"></i>
        </div>
        <div class="celebration-static celebration-static-2">
            <i class="bi bi-stars"></i>
        </div>
        <div class="celebration-static celebration-static-3">
            <i class="bi bi-emoji-party"></i>
        </div>
        <div class="celebration-static celebration-static-4">
            <i class="bi bi-emoji-party"></i>
        </div>
        <div class="celebration-static celebration-static-5">
            <i class="bi bi-balloon"></i>
        </div>
        <div class="celebration-static celebration-static-6">
            <i class="bi bi-balloon"></i>
        </div>
        <div class="celebration-static celebration-static-7">
            <i class="bi bi-hand-thumbs-up"></i>
        </div>
        <div class="celebration-static celebration-static-8">
            <i class="bi bi-hand-thumbs-up"></i>
        </div>
        <div class="celebration-static celebration-static-9">
            <i class="bi bi-award"></i>
        </div>
        <div class="celebration-static celebration-static-10">
            <i class="bi bi-award"></i>
        </div>
    <?php endif; ?>

    <span class="result-icon-animated tier-<?= $tier ?>">
        <i class="bi <?= $bsIcon ?>"></i>
    </span>

    <div class="result-title-large">
        <span class="<?= $highlightClass ?>"><?= htmlspecialchars($title) ?></span>
    </div>

    <hr class="result-divider">

    <p class="result-subtitle"><?= htmlspecialchars($subtitle) ?></p>

    <p class="celebration-message">
        <i class="bi bi-arrow-right-short"></i>
        Sigue asi, cada partida te hace mejor programador
        <i class="bi bi-arrow-left-short"></i>
    </p>
</div>

<?php if (!empty($newPrizes)): ?>
    <div class="prize-won-banner">
        <span class="prize-won-label">
            <i class="bi bi-gift-fill me-1"></i>
            <?= count($newPrizes) === 1 ? 'Ganaste un premio nuevo' : 'Ganaste premios nuevos' ?>
        </span>
        <div class="prize-won-grid">
            <?php foreach ($newPrizes as $prize): ?>
                <div class="prize-won-item">
                    <img src="<?= APP_URL ?>/images/prizes/<?= htmlspecialchars($prize->image ?? 'default.png') ?>" alt="<?= htmlspecialchars($prize->name) ?>">
                    <div class="prize-won-name"><?= htmlspecialchars($prize->name) ?></div>
                    <div class="prize-won-points">+<?= number_format($prize->points_value) ?> pts</div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="result-stats-innovative">
    <div class="result-stat-innovative">
        <div class="stat-number <?= $passed ? 'green' : 'red' ?>"><?= $result['percentage'] ?? 0 ?>%</div>
        <span class="stat-label">Precision</span>
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

<?php if (!empty($responses)): ?>
    <h4 style="font-family: var(--font-display); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.9rem; margin-bottom: 1rem;">
        <i class="bi bi-list-ul me-2" style="color: var(--primary);"></i>Detalle de respuestas
    </h4>

    <?php foreach ($responses as $idx => $r): ?>
        <div class="result-detail-card <?= $r->is_correct ? 'detail-response-correct' : 'detail-response-incorrect' ?>">

            <div class="detail-q">
                <span class="q-number">#<?= $idx + 1 ?></span>
                <?= htmlspecialchars($r->question_text ?? 'Pregunta') ?>
            </div>

            <?php if ($r->is_correct): ?>
                <div class="detail-answer-row">
                    <span class="detail-label">Respondiste:</span>
                    <span class="icon-correct">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <span class="answer-text correct-text">
                        <?= htmlspecialchars($r->user_answer_text ?? 'Respuesta correcta') ?>
                    </span>
                    <span class="detail-answer-status correct"></span>
                </div>

            <?php else: ?>
                <div class="detail-answer-row">
                    <span class="detail-label">Respondiste:</span>
                    <span class="icon-incorrect">
                        <i class="bi bi-x-circle-fill"></i>
                    </span>
                    <span class="answer-text incorrect-text">
                        <?= htmlspecialchars($r->user_answer_text ?? 'Respuesta incorrecta') ?>
                    </span>
                    <span class="detail-answer-status incorrect"></span>
                </div>
                <div class="detail-answer-row">
                    <span class="detail-label">Respuesta correcta:</span>
                    <span class="icon-correct">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>
                    <span class="answer-text correct-text">
                        <?= htmlspecialchars($r->correct_answer_text ?? 'Respuesta correcta') ?>
                    </span>
                    <span class="detail-answer-status correct"></span>
                </div>
            <?php endif; ?>

            <div class="detail-answer-row" style="margin-top: 0.3rem;">
                <span class="badge-result <?= $r->is_correct ? 'badge-result-correct' : 'badge-result-incorrect' ?>">
                    <?= $r->is_correct ? 'Correcta' : 'Incorrecta' ?>
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