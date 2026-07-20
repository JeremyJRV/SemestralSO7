<style>
    .play-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .play-header-innovative::before {
        content: '▶';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .play-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .play-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .play-header-innovative .play-meta {
        color: var(--text-gray);
        font-family: var(--font-mono);
        font-size: 0.75rem;
        letter-spacing: 0.3px;
    }

    .play-header-innovative .play-meta span {
        background: var(--primary-light);
        padding: 0.2rem 0.8rem;
        border: 2px solid var(--border-dark);
        font-weight: 700;
        color: var(--primary);
    }

    .question-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem 2rem;
        box-shadow: var(--shadow-hard);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .question-card-innovative .q-number {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
        border-bottom: 2px solid var(--border-light);
        padding-bottom: 0.5rem;
    }

    .question-card-innovative .q-number i {
        color: var(--primary);
        margin-right: 0.3rem;
    }

    .question-card-innovative .q-text {
        font-family: var(--font-display);
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .question-card-innovative .q-type {
        display: inline-block;
        background: var(--primary-lighter);
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
        padding: 0.15rem 0.8rem;
        border: 2px solid var(--border-dark);
        margin-bottom: 1rem;
    }

    .option-item-innovative {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.6rem 1rem;
        margin-bottom: 0.5rem;
        border: 2px solid var(--border-light);
        cursor: pointer;
        transition: all 0.15s ease;
        font-family: var(--font-display);
        background: var(--bg-card);
    }

    .option-item-innovative:hover {
        border-color: var(--border-dark);
        background: var(--primary-lighter);
        transform: translateX(4px);
    }

    .option-item-innovative input[type="radio"] {
        appearance: none;
        width: 20px;
        height: 20px;
        min-width: 20px;
        border: 3px solid var(--border-dark);
        background: var(--bg-card);
        cursor: pointer;
        transition: all 0.15s ease;
        position: relative;
    }

    .option-item-innovative input[type="radio"]:checked {
        background: var(--primary);
        border-color: var(--border-dark);
    }

    .option-item-innovative input[type="radio"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
    }

    .option-item-innovative .option-label {
        color: var(--text-dark);
        font-weight: 500;
        flex: 1;
    }

    .option-item-innovative .option-letter {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.7rem;
        color: var(--text-light);
        background: var(--bg-page);
        padding: 0.1rem 0.5rem;
        border: 2px solid var(--border-light);
    }

    .option-item-innovative:hover .option-letter {
        border-color: var(--border-dark);
        color: var(--primary);
    }

    .btn-submit-innovative {
        background: var(--success);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.6rem 1.8rem;
        font-size: 0.9rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 4px 4px 0px var(--border-dark);
        width: 100%;
        cursor: pointer;
    }

    .btn-submit-innovative:hover {
        background: var(--success);
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .btn-next-question {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.6rem 1.8rem;
        font-size: 0.9rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 4px 4px 0px var(--border-dark);
        width: 100%;
        cursor: pointer;
    }

    .btn-next-question:hover:not(:disabled) {
        background: var(--primary);
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .btn-next-question:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        box-shadow: 2px 2px 0px var(--border-dark);
    }

    .progress-bar-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 0.8rem 1.5rem;
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .progress-bar-innovative .progress-text {
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-gray);
        letter-spacing: 0.3px;
    }

    .progress-bar-innovative .progress-text strong {
        color: var(--text-dark);
    }

    .progress-track-innovative {
        flex: 1;
        height: 12px;
        background: var(--bg-page);
        border: 2px solid var(--border-dark);
        min-width: 100px;
        position: relative;
    }

    .progress-track-innovative .progress-fill {
        height: 100%;
        background: var(--primary);
        transition: width 0.3s ease;
        position: relative;
    }

    .progress-track-innovative .progress-fill::after {
        content: '';
        position: absolute;
        right: -4px;
        top: -4px;
        width: 16px;
        height: 16px;
        background: var(--primary);
        border: 2px solid var(--border-dark);
        transform: rotate(45deg);
    }

    .question-counter {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--text-dark);
        background: var(--primary-light);
        padding: 0.2rem 1rem;
        border: 2px solid var(--border-dark);
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .play-header-innovative {
            padding: 1rem 1.2rem;
        }

        .question-card-innovative {
            padding: 1.2rem;
        }

        .progress-bar-innovative {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-submit-innovative {
            font-size: 0.8rem;
            padding: 0.6rem 1.2rem;
        }
        .btn-next-question {
            font-size: 0.8rem;
            padding: 0.6rem 1.2rem;
        }
    }
</style>

<?php
$totalQuestions = count($questions ?? []);
$currentQuestion = 0;
$progress = $totalQuestions > 0 ? round((($currentQuestion + 1) / $totalQuestions) * 100) : 0;
?>

<div class="play-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-joystick"></i>¡En juego!</h2>
            <div class="play-meta">
                Sesión: <span>#<?= $session->id ?? 'N/A' ?></span>
            </div>
        </div>
        <div class="question-counter" id="questionCounter">
            <i class="bi bi-question-circle me-1"></i>
            <?= ($currentQuestion + 1) ?> / <?= $totalQuestions ?>
        </div>
    </div>
</div>

<!-- Progress Bar -->
<div class="progress-bar-innovative">
    <span class="progress-text">
        <i class="bi bi-arrow-right-short me-1"></i>
        Progreso: <strong id="progressPct"><?= $progress ?>%</strong>
    </span>
    <div class="progress-track-innovative">
        <div class="progress-fill" id="progressFill" style="width: <?= $progress ?>%;"></div>
    </div>
</div>

<form method="POST" action="<?= APP_URL ?>/game/submit/<?= $session->id ?? '' ?>" id="gameForm">
    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

    <?php foreach ($questions as $index => $question): ?>
        <div class="question-card-innovative"
             data-qindex="<?= $index ?>"
             data-qid="<?= $question->id ?>"
             style="<?= $index === 0 ? '' : 'display:none;' ?>">
            <span class="q-number">
                <i class="bi bi-hash"></i> Pregunta <?= $index + 1 ?> de <?= $totalQuestions ?>
            </span>
            <span class="q-type">
                <?= $question->type === 'multiple' ? 'Opción Múltiple' : 'Verdadero / Falso' ?>
            </span>
            <div class="q-text"><?= htmlspecialchars($question->text) ?></div>

            <?php if ($question->type === 'multiple'): ?>
                <?php
                $letters = ['A', 'B', 'C', 'D'];
                foreach ($question->options as $optIndex => $opt):
                ?>
                    <label class="option-item-innovative">
                        <input type="radio" name="answers[<?= $question->id ?>]" value="<?= $opt->id ?>" required>
                        <span class="option-letter"><?= $letters[$optIndex] ?? '?' ?></span>
                        <span class="option-label"><?= htmlspecialchars($opt->text) ?></span>
                    </label>
                <?php endforeach; ?>
            <?php else: ?>
                <label class="option-item-innovative">
                    <input type="radio" name="answers[<?= $question->id ?>]" value="1" required>
                    <span class="option-letter">V</span>
                    <span class="option-label">Verdadero</span>
                </label>
                <label class="option-item-innovative">
                    <input type="radio" name="answers[<?= $question->id ?>]" value="0" required>
                    <span class="option-letter">F</span>
                    <span class="option-label">Falso</span>
                </label>
            <?php endif; ?>

            <input type="hidden" name="times[<?= $question->id ?>]" class="response-time" value="0">

            <?php if ($index < $totalQuestions - 1): ?>
                <button type="button" class="btn-next-question" disabled>
                    Siguiente pregunta <i class="bi bi-arrow-right ms-1"></i>
                </button>
            <?php else: ?>
                <button type="submit" class="btn-submit-innovative" disabled>
                    <i class="bi bi-check2-circle me-2"></i>Enviar respuestas
                </button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</form>

<script>
    const totalQuestions = <?= $totalQuestions ?>;
    const questionCards = Array.from(document.querySelectorAll('.question-card-innovative'));
    const questionStartTimes = {};

    function showQuestion(index) {
        questionCards.forEach((card, i) => {
            card.style.display = (i === index) ? '' : 'none';
        });

        const qId = questionCards[index].dataset.qid;
        questionStartTimes[qId] = Date.now();

        const progress = Math.round(((index + 1) / totalQuestions) * 100);
        document.getElementById('progressPct').textContent = progress + '%';
        document.getElementById('progressFill').style.width = progress + '%';
        document.getElementById('questionCounter').innerHTML =
            '<i class="bi bi-question-circle me-1"></i>' + (index + 1) + ' / ' + totalQuestions;
    }

    document.querySelectorAll('.option-item-innovative input[type="radio"]').forEach(input => {
        const questionId = input.name.match(/\[(.*?)\]/)[1];
        const timeField = document.querySelector(`input[name="times[${questionId}]"]`);

        input.addEventListener('change', () => {
            if (timeField && questionStartTimes[questionId]) {
                timeField.value = Date.now() - questionStartTimes[questionId];
            }
            const card = input.closest('.question-card-innovative');
            const advanceBtn = card.querySelector('.btn-next-question, .btn-submit-innovative');
            if (advanceBtn) advanceBtn.disabled = false;
        });
    });

    document.querySelectorAll('.btn-next-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.question-card-innovative');
            const currentIndex = parseInt(card.dataset.qindex, 10);
            showQuestion(currentIndex + 1);
            window.scrollTo({ top: card.offsetTop - 20, behavior: 'smooth' });
        });
    });

    showQuestion(0);
</script>