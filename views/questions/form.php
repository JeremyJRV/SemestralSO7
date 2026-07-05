<style>
    .form-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        max-width: 700px;
        margin: 0 auto;
        position: relative;
        transition: all 0.2s ease;
    }

    .form-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .form-card-innovative .corner-deco {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--primary);
        color: white;
        padding: 0.2rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid var(--border-dark);
        transform: rotate(3deg);
    }

    .form-card-innovative .form-label {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
    }

    .form-card-innovative .form-control {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-size: 0.95rem;
        transition: all 0.15s ease;
    }

    .form-card-innovative .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .form-card-innovative .form-select {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-weight: 500;
        transition: all 0.15s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231a2634' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px;
    }

    .form-card-innovative .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .form-card-innovative textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    .form-card-innovative .option-group {
        border: 2px solid var(--border-light);
        padding: 0.8rem 1rem;
        margin-bottom: 0.5rem;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .form-card-innovative .option-group:hover {
        border-color: var(--border-dark);
        background: var(--primary-lighter);
    }

    .form-card-innovative .option-group .option-radio {
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

    .form-card-innovative .option-group .option-radio:checked {
        background: var(--primary);
        border-color: var(--border-dark);
    }

    .form-card-innovative .option-group .option-radio:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.6rem;
        font-weight: 700;
    }

    .form-card-innovative .option-group .option-input {
        flex: 1;
        border: none;
        border-bottom: 2px solid var(--border-light);
        padding: 0.3rem 0.5rem;
        font-family: var(--font-display);
        font-size: 0.9rem;
        background: transparent;
        transition: all 0.15s ease;
    }

    .form-card-innovative .option-group .option-input:focus {
        outline: none;
        border-bottom-color: var(--primary);
    }

    .form-card-innovative .option-group .option-label {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.7rem;
        color: var(--text-light);
        letter-spacing: 0.3px;
    }

    .btn-form-submit-innovative {
        background: var(--success);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px var(--border-dark);
        width: 100%;
    }

    .btn-form-submit-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .btn-form-cancel-innovative {
        background: transparent;
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        width: 100%;
    }

    .btn-form-cancel-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--danger);
    }

    .alert-innovative {
        border-radius: 0;
        border: 2px solid var(--border-dark);
        font-size: 0.9rem;
        padding: 0.75rem 1rem;
        font-family: var(--font-display);
    }

    .alert-innovative-danger {
        background: #fee2e2;
        color: #dc2626;
        border-color: #dc2626;
    }

    .alert-innovative-warning {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .text-hint {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--text-light);
        margin-top: 0.3rem;
        letter-spacing: 0.3px;
    }

    .divider-innovative {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 1.5rem 0;
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
        font-size: 0.7rem;
    }

    @media (max-width: 768px) {
        .form-card-innovative { padding: 1.5rem; }
        .form-card-innovative .option-group { flex-wrap: wrap; }
        .form-card-innovative .option-group .option-input { min-width: 100px; }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-question-circle"></i><?= isset($question) ? 'Editar Pregunta' : 'Nueva Pregunta' ?></h2>
            <p><?= isset($question) ? 'Modifica los datos de la pregunta' : 'Crea una nueva pregunta para las trivias' ?></p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="form-card-innovative">
    <span class="corner-deco">✦ <?= isset($question) ? 'editar' : 'nueva' ?></span>

    <?php if (isset($error)): ?>
        <div class="alert alert-innovative alert-innovative-danger">
            <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= isset($question) ? APP_URL . "/admin/questions/update/{$question->id}" : APP_URL . '/admin/questions/store' ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-collection me-1"></i>Tema y Nivel</label>
            <select name="theme_level_id" class="form-select" required>
                <option value="">— Selecciona —</option>
                <?php foreach ($themeLevels as $tl): ?>
                    <option value="<?= $tl->id ?>" <?= (isset($question) && $question->theme_level_id == $tl->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tl->theme_name ?? 'Tema') ?> — <?= htmlspecialchars($tl->level_name ?? 'Nivel') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-type me-1"></i>Tipo de Pregunta</label>
            <select name="type" id="typeSelect" class="form-select" required>
                <option value="multiple" <?= (isset($question) && $question->type == 'multiple') ? 'selected' : '' ?>>Opción Múltiple</option>
                <option value="boolean" <?= (isset($question) && $question->type == 'boolean') ? 'selected' : '' ?>>Verdadero / Falso</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="bi bi-card-text me-1"></i>Texto de la Pregunta</label>
            <textarea name="text" class="form-control" required placeholder="Escribe la pregunta aquí..."><?= htmlspecialchars($question->text ?? '') ?></textarea>
        </div>

        <!-- Opción Múltiple -->
        <div id="multipleOptions" style="<?= (isset($question) && $question->type == 'boolean') ? 'display:none' : '' ?>">
            <label class="form-label"><i class="bi bi-list-ul me-1"></i>Opciones (marca la correcta)</label>
            <?php for ($i = 0; $i < 4; $i++):
                $letter = chr(65 + $i);
            ?>
                <div class="option-group">
                    <span class="option-label"><?= $letter ?></span>
                    <input type="radio" name="correct_option" value="<?= $i ?>" class="option-radio" <?= (isset($question) && ($question->correct_option ?? -1) == $i) ? 'checked' : '' ?>>
                    <input type="text" name="options[]" class="option-input" placeholder="Opción <?= $letter ?>" value="<?= htmlspecialchars($question->options[$i]->text ?? '') ?>">
                </div>
            <?php endfor; ?>
            <div class="text-hint"><i class="bi bi-info-circle me-1"></i>Selecciona el radio para marcar la opción correcta</div>
        </div>

        <!-- Verdadero / Falso -->
        <div id="booleanOptions" style="<?= (isset($question) && $question->type == 'boolean') ? '' : 'display:none' ?>">
            <label class="form-label"><i class="bi bi-check-circle me-1"></i>Respuesta Correcta</label>
            <select name="boolean_correct" class="form-select">
                <option value="1" <?= (isset($question) && ($question->boolean_correct ?? 1) == 1) ? 'selected' : '' ?>>Verdadero</option>
                <option value="0" <?= (isset($question) && ($question->boolean_correct ?? 1) == 0) ? 'selected' : '' ?>>Falso</option>
            </select>
        </div>

        <hr class="divider-innovative">

        <div class="d-grid gap-2">
            <button type="submit" class="btn-form-submit-innovative">
                <i class="bi <?= isset($question) ? 'bi-check2-circle' : 'bi-plus-circle' ?> me-2"></i>
                <?= isset($question) ? 'Actualizar Pregunta' : 'Crear Pregunta' ?>
            </button>
            <a href="<?= APP_URL ?>/admin/questions" class="btn-form-cancel-innovative">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('typeSelect').addEventListener('change', function() {
    document.getElementById('multipleOptions').style.display = this.value === 'multiple' ? 'block' : 'none';
    document.getElementById('booleanOptions').style.display = this.value === 'boolean' ? 'block' : 'none';
});
</script>