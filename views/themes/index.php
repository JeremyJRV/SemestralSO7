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
        background: var(--primary-lighter);
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
        border: 2px solid var(--border-dark);
        cursor: pointer;
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

    .theme-id-badge {
        display: inline-block;
        background: var(--primary-darker);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        padding: 0.1rem 0.6rem;
        border: 2px solid var(--border-dark);
    }

    .delete-form-inline {
        display: inline-block;
        margin: 0;
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
        .admin-header-innovative { padding: 1rem 1.2rem; }
        .admin-actions { flex-direction: column; align-items: stretch; }
        .admin-stats-mini { justify-content: center; flex-wrap: wrap; }
        .table-admin-innovative { font-size: 0.85rem; }
        .table-admin-innovative thead th,
        .table-admin-innovative tbody td { padding: 0.5rem 0.7rem; }
        .btn-admin-innovative-sm { font-size: 0.6rem; padding: 0.15rem 0.6rem; }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-collection"></i>Temas</h2>
            <p>Administra los temas disponibles para las trivias</p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-innovative alert-innovative-danger" style="border-radius:0; border:2px solid #dc2626; background:#fee2e2; color:#dc2626; padding:0.75rem 1rem; font-family: var(--font-display); margin-bottom: 1.5rem;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<div class="admin-actions">
    <a href="<?= APP_URL ?>/admin/themes/create" class="btn-admin-innovative">
        <i class="bi bi-plus-circle me-1"></i>Nuevo Tema
    </a>
    <div class="admin-stats-mini">
        <span>Total: <strong><?= count($themes) ?></strong></span>
    </div>
</div>

<div class="table-responsive">
    <table class="table-admin-innovative">
        <thead>
            <tr>
                <th style="width:60px;">ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th style="text-align:center; width:180px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($themes as $theme): ?>
                <tr>
                    <td><span class="theme-id-badge">#<?= $theme->id ?></span></td>
                    <td><strong><?= htmlspecialchars($theme->name) ?></strong></td>
                    <td><?= htmlspecialchars($theme->description ?? 'Sin descripción') ?></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <a href="<?= APP_URL ?>/admin/themes/edit/<?= $theme->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form method="POST" action="<?= APP_URL ?>/admin/themes/delete/<?= $theme->id ?>" class="delete-form-inline" onsubmit="return confirm('¿Eliminar este tema?')">
                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                            <button type="submit" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<hr class="divider-innovative">

<div class="text-center" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light);">
    <i class="bi bi-shield-check me-1"></i>
    Solo administradores y armadores pueden gestionar temas
</div>