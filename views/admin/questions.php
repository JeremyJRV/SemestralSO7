<style>
    .admin-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .admin-header-innovative::before {
        content: '⚙';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1.2rem;
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
        transform: rotate(-8deg);
        display: inline-block;
    }

    .admin-header-innovative .admin-badge {
        display: inline-block;
        background: var(--primary-darker);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.2rem 1rem;
        border: 2px solid var(--border-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .table-admin-innovative {
        background: transparent;
        border-collapse: collapse;
        width: 100%;
    }

    .table-admin-innovative thead th {
        background: var(--primary-darker);
        color: white;
        border: none;
        padding: 0.8rem 1rem;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        text-align: left;
    }

    .table-admin-innovative thead th:first-child {
        border-left: 3px solid var(--primary);
    }

    .table-admin-innovative thead th:last-child {
        border-right: 3px solid var(--primary);
    }

    .table-admin-innovative tbody tr {
        background: var(--bg-card);
        border-bottom: 2px solid var(--border-light);
        transition: all 0.2s ease;
    }

    .table-admin-innovative tbody tr:hover {
        background: #dbeafe;
        border-left: 4px solid var(--primary);
        transform: translateX(2px);
    }

    .table-admin-innovative tbody td {
        border: none;
        padding: 0.8rem 1rem;
        vertical-align: middle;
        color: var(--text-gray);
        font-weight: 500;
        font-family: var(--font-display);
    }

    .table-admin-innovative tbody td:first-child {
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-admin-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.5rem 1.8rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px var(--border-dark);
        text-decoration: none;
        display: inline-block;
    }

    .btn-admin-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .btn-admin-innovative-sm {
        padding: 0.25rem 1rem;
        font-size: 0.7rem;
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .btn-admin-innovative-sm:hover {
        transform: translate(-2px, -2px);
        box-shadow: 5px 5px 0px var(--border-dark);
    }

    .btn-admin-innovative-warning {
        background: var(--warning);
        color: var(--text-dark) !important;
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-admin-innovative-warning:hover {
        box-shadow: 6px 6px 0px var(--border-dark);
        color: var(--text-dark) !important;
    }

    .btn-admin-innovative-danger {
        background: var(--danger);
        color: white !important;
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-admin-innovative-danger:hover {
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .admin-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.5rem;
    }

    .admin-filter {
        display: flex;
        gap: 0.5rem;
        flex: 1;
        min-width: 200px;
        flex-wrap: wrap;
    }

    .admin-filter select {
        flex: 1;
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.5rem 1rem;
        font-family: var(--font-display);
        font-size: 0.85rem;
        transition: all 0.15s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231a2634' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px;
    }

    .admin-filter select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .admin-filter button {
        background: var(--border-dark);
        color: white;
        border: 2px solid var(--border-dark);
        padding: 0.5rem 1.2rem;
        font-family: var(--font-display);
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.15s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .admin-filter button:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .admin-stats-mini {
        display: flex;
        gap: 1rem;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        color: var(--text-gray);
    }

    .admin-stats-mini span {
        background: var(--primary-lighter);
        padding: 0.2rem 0.8rem;
        border: 2px solid var(--border-dark);
    }

    .admin-stats-mini strong {
        color: var(--text-dark);
    }

    .badge-question-type {
        display: inline-block;
        padding: 0.15rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 2px solid var(--border-dark);
    }

    .badge-question-type-multiple {
        background: #dbeafe;
        color: #2563eb;
        border-color: #2563eb;
    }

    .badge-question-type-boolean {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .question-preview {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
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
        .admin-header-innovative {
            padding: 1rem 1.2rem;
        }

        .admin-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .admin-filter {
            flex-direction: column;
        }

        .admin-stats-mini {
            justify-content: center;
            flex-wrap: wrap;
        }

        .table-admin-innovative {
            font-size: 0.85rem;
        }

        .table-admin-innovative thead th,
        .table-admin-innovative tbody td {
            padding: 0.5rem 0.7rem;
        }

        .btn-admin-innovative-sm {
            font-size: 0.6rem;
            padding: 0.15rem 0.6rem;
        }

        .question-preview {
            max-width: 120px;
        }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-question-circle"></i>Gestión de Preguntas</h2>
            <p>Administra las preguntas del sistema</p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="admin-actions">
    <div class="admin-filter">
        <form method="GET" action="<?= APP_URL ?>/admin/questions" style="display: flex; gap: 0.5rem; flex: 1; flex-wrap: wrap;">
            <select name="theme_level_id" onchange="this.form.submit()" style="flex: 1; min-width: 150px;">
                <option value="">Todos los temas</option>
                <?php foreach ($themeLevels as $tl): ?>
                    <option value="<?= $tl->id ?>" <?= ($selectedThemeLevel == $tl->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tl->theme_name ?? 'Tema') ?> - <?= htmlspecialchars($tl->level_name ?? 'Nivel') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <noscript>
                <button type="submit"><i class="bi bi-funnel me-1"></i>Filtrar</button>
            </noscript>
        </form>
    </div>
    <a href="<?= APP_URL ?>/admin/questions/create" class="btn-admin-innovative">
        <i class="bi bi-plus-circle me-1"></i>Nueva Pregunta
    </a>
    <div class="admin-stats-mini">
        <span>Total: <strong><?= count($questions) ?></strong></span>
    </div>
</div>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-innovative alert-innovative-danger" style="border-radius:0; border:2px solid #dc2626; background:#fee2e2; color:#dc2626; padding:0.75rem 1rem; font-family: var(--font-display); margin-bottom: 1.5rem;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table-admin-innovative">
        <thead>
            <tr>
                <th style="width:50px;">ID</th>
                <th>Pregunta</th>
                <th>Tipo</th>
                <th>Tema - Nivel</th>
                <th style="text-align:center; width:150px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $q): ?>
                <tr>
                    <td>#<?= $q->id ?></td>
                    <td>
                        <span class="question-preview" title="<?= htmlspecialchars($q->text) ?>">
                            <?= htmlspecialchars($q->text) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge-question-type badge-question-type-<?= $q->type ?>">
                            <?= $q->type === 'multiple' ? 'Múltiple' : 'V/F' ?>
                        </span>
                    </td>
                    <td>
                        <?= htmlspecialchars($q->theme_name ?? 'N/A') ?> -
                        <?= htmlspecialchars($q->level_name ?? 'N/A') ?>
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                        <a href="<?= APP_URL ?>/admin/questions/edit/<?= $q->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="<?= APP_URL ?>/admin/questions/delete/<?= $q->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger" onclick="return confirm('¿Eliminar esta pregunta?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<hr class="divider-innovative">

<div class="text-center" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light);">
    <i class="bi bi-shield-check me-1"></i>
    Solo administradores y armadores pueden gestionar preguntas
</div>