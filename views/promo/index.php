<style>
    .promo-header-innovative {
        padding: 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
    }

    .promo-header-innovative::before {
        content: '▣';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary);
        color: white;
        padding: 0 1rem;
        font-size: 0.7rem;
    }

    .promo-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .promo-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .promo-header-innovative p {
        color: var(--text-gray);
        font-family: var(--font-display);
        margin-bottom: 0;
    }

    .survey-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem 2rem;
        box-shadow: var(--shadow-hard);
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
        position: relative;
    }

    .survey-card-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: var(--shadow-hard-hover);
    }

    .survey-card-innovative .survey-number {
        position: absolute;
        top: -8px;
        left: -8px;
        background: var(--primary-darker);
        color: white;
        padding: 0.1rem 0.6rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        border: 2px solid var(--border-dark);
        transform: rotate(-2deg);
    }

    .survey-card-innovative h5 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        font-size: 1rem;
        margin-bottom: 1rem;
        padding-right: 1.5rem;
    }

    .survey-card-innovative h5 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .survey-option-innovative {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.5rem 1rem;
        margin-bottom: 0.4rem;
        border: 2px solid var(--border-light);
        cursor: pointer;
        transition: all 0.15s ease;
        font-family: var(--font-display);
    }

    .survey-option-innovative:hover {
        border-color: var(--border-dark);
        background: var(--primary-lighter);
        transform: translateX(4px);
    }

    .survey-option-innovative input[type="radio"] {
        appearance: none;
        width: 18px;
        height: 18px;
        min-width: 18px;
        border: 3px solid var(--border-dark);
        background: var(--bg-card);
        cursor: pointer;
        transition: all 0.15s ease;
        position: relative;
    }

    .survey-option-innovative input[type="radio"]:checked {
        background: var(--primary);
        border-color: var(--border-dark);
    }

    .survey-option-innovative input[type="radio"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.6rem;
        font-weight: 700;
    }

    .survey-option-innovative .option-label {
        color: var(--text-dark);
        font-weight: 500;
        flex: 1;
    }

    .btn-survey-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.4rem 1.8rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px var(--border-dark);
        margin-top: 0.5rem;
    }

    .btn-survey-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .btn-survey-innovative:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }

    .survey-voted-badge {
        display: inline-block;
        background: #dcfce7;
        color: #16a34a;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 1rem;
        border: 2px solid #16a34a;
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
        .promo-header-innovative { padding: 1.2rem; }
        .survey-card-innovative { padding: 1.2rem; }
        .survey-option-innovative { padding: 0.4rem 0.8rem; }
    }
</style>

<div class="promo-header-innovative">
    <h2><i class="bi bi-chat-dots"></i>Encuesta de Intereses</h2>
    <p>Ayúdanos a mejorar respondiendo estas breves preguntas</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <?php foreach ($surveys as $index => $survey): ?>
            <div class="survey-card-innovative">
                <span class="survey-number">#<?= $index + 1 ?></span>
                <h5><i class="bi bi-question-circle"></i><?= htmlspecialchars($survey->question) ?></h5>

                <form class="survey-form" data-survey-id="<?= $survey->id ?>">
                    <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                    <input type="hidden" name="survey_id" value="<?= $survey->id ?>">

                    <?php $options = json_decode($survey->options, true); ?>
                    <?php foreach ($options as $opt): ?>
                        <label class="survey-option-innovative">
                            <input type="radio" name="option" value="<?= htmlspecialchars($opt) ?>" required>
                            <span class="option-label"><?= htmlspecialchars($opt) ?></span>
                        </label>
                    <?php endforeach; ?>

                    <button type="submit" class="btn-survey-innovative">
                        <i class="bi bi-send me-1"></i>Votar
                    </button>
                </form>
            </div>
        <?php endforeach; ?>

        <hr class="divider-innovative">

        <div class="text-center" style="padding: 1rem 0;">
            <p style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--text-light);">
                <i class="bi bi-shield-check me-1"></i>
                Tus respuestas son anónimas y nos ayudan a mejorar la experiencia
            </p>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.survey-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const submitBtn = form.querySelector('.btn-survey-innovative');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Enviando...';

        try {
            const res = await fetch('<?= APP_URL ?>/promo/submit-survey', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            if (result.success) {
                submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>¡Gracias!';
                submitBtn.style.background = '#22c55e';

                // Deshabilitar todos los radios
                form.querySelectorAll('input[type="radio"]').forEach(input => {
                    input.disabled = true;
                });

                // Mostrar badge de votado
                const badge = document.createElement('span');
                badge.className = 'survey-voted-badge ms-2';
                badge.innerHTML = '<i class="bi bi-check-circle me-1"></i>Votado';
                submitBtn.parentNode.insertBefore(badge, submitBtn.nextSibling);

                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>¡Votado!';
                }, 2000);
            } else {
                submitBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-1"></i>Error';
                submitBtn.style.background = '#ef4444';
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.style.background = '';
                    submitBtn.disabled = false;
                }, 3000);
            }
        } catch (err) {
            submitBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-1"></i>Error';
            submitBtn.style.background = '#ef4444';
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.style.background = '';
                submitBtn.disabled = false;
            }, 3000);
        }
    });
});
</script>