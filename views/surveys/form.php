<style>
    .admin-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .admin-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .admin-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .admin-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .form-card-survey {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1.5rem 2rem;
        max-width: 700px;
    }

    .form-card-survey label {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--text-dark);
        margin-bottom: 0.4rem;
        display: block;
    }

    .form-card-survey input[type="text"] {
        width: 100%;
        border: 2px solid var(--border-dark);
        padding: 0.6rem 1rem;
        font-family: var(--font-display);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .form-card-survey input[type="text"]:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .survey-option-row {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.6rem;
        align-items: center;
    }

    .survey-option-row input[type="text"] {
        margin-bottom: 0;
        flex: 1;
    }

    .btn-remove-option {
        background: var(--danger);
        color: white;
        border: 2px solid var(--border-dark);
        width: 38px;
        height: 38px;
        font-weight: 700;
        cursor: pointer;
        flex-shrink: 0;
    }

    .btn-add-option {
        background: var(--border-dark);
        color: white;
        border: 2px solid var(--border-dark);
        padding: 0.5rem 1.2rem;
        font-family: var(--font-display);
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        margin-bottom: 1.5rem;
    }

    .btn-add-option:hover {
        background: var(--primary);
        border-color: var(--primary);
    }

    .btn-submit-survey {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.6rem 2rem;
        border: 2px solid var(--border-dark);
        box-shadow: 4px 4px 0px var(--border-dark);
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }

    .btn-submit-survey:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
    }

    .btn-cancel-survey {
        background: transparent;
        border: 2px solid var(--border-dark);
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.6rem 2rem;
        text-decoration: none;
        display: inline-block;
        font-size: 0.85rem;
    }
</style>

<div class="admin-header-innovative">
    <h2><i class="bi bi-clipboard-data"></i><?= $survey ? 'Editar Encuesta' : 'Nueva Encuesta' ?></h2>
    <p>Define la pregunta y las opciones de respuesta</p>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-innovative alert-innovative-danger" style="border-radius:0; border:2px solid #dc2626; background:#fee2e2; color:#dc2626; padding:0.75rem 1rem; font-family: var(--font-display); margin-bottom: 1.5rem; max-width:700px;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<div class="form-card-survey">
    <form method="POST" action="<?= APP_URL ?>/admin/surveys/<?= $survey ? 'update/' . $survey->id : 'store' ?>">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <label>Pregunta</label>
        <input type="text" name="question" value="<?= htmlspecialchars($survey->question ?? '') ?>" placeholder="Ej: ¿Qué tan probable es que recomiendes esta app?" required>

        <label>Opciones de respuesta</label>
        <div id="optionsContainer">
            <?php
                $existingOptions = $survey ? (json_decode($survey->options ?? '[]', true) ?: []) : ['', ''];
                if (count($existingOptions) < 2) {
                    $existingOptions = array_pad($existingOptions, 2, '');
                }
            ?>
            <?php foreach ($existingOptions as $opt): ?>
                <div class="survey-option-row">
                    <input type="text" name="options[]" value="<?= htmlspecialchars($opt) ?>" placeholder="Opción de respuesta" required>
                    <button type="button" class="btn-remove-option" onclick="removeOption(this)">×</button>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="btn-add-option" onclick="addOption()">
            <i class="bi bi-plus"></i> Agregar opción
        </button>

        <div>
            <button type="submit" class="btn-submit-survey">Guardar Encuesta</button>
            <a href="<?= APP_URL ?>/admin/surveys" class="btn-cancel-survey">Cancelar</a>
        </div>
    </form>
</div>

<script>
    function addOption() {
        const container = document.getElementById('optionsContainer');
        const row = document.createElement('div');
        row.className = 'survey-option-row';
        row.innerHTML = '<input type="text" name="options[]" placeholder="Opción de respuesta" required>' +
            '<button type="button" class="btn-remove-option" onclick="removeOption(this)">&times;</button>';
        container.appendChild(row);
    }

    function removeOption(button) {
        const container = document.getElementById('optionsContainer');
        if (container.children.length > 2) {
            button.parentElement.remove();
        } else {
            alert('Una encuesta necesita al menos 2 opciones.');
        }
    }
</script>