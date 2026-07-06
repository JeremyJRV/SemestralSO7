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

    /* ========== TABLA ADMIN ========== */
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

    /* ========== BOTONES ADMIN ========== */
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

    .btn-admin-innovative-outline {
        background: transparent;
        border: 2px solid var(--border-dark);
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.5rem 1.8rem;
        transition: all 0.15s ease;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-admin-innovative-outline:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--primary);
    }

    /* ========== BADGES ========== */
    .badge-role-admin {
        display: inline-block;
        padding: 0.15rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 2px solid var(--border-dark);
    }

    .badge-role-admin-player {
        background: #dbeafe;
        color: #2563eb;
        border-color: #2563eb;
    }

    .badge-role-admin-armador {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .badge-role-admin-admin {
        background: #fce4ec;
        color: #dc2626;
        border-color: #dc2626;
    }

    /* ========== HEADER ACTIONS ========== */
    .admin-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.5rem;
    }

    .admin-search {
        display: flex;
        gap: 0.5rem;
        flex: 1;
        min-width: 200px;
    }

    .admin-search input {
        flex: 1;
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.5rem 1rem;
        font-family: var(--font-display);
        font-size: 0.9rem;
        transition: all 0.15s ease;
    }

    .admin-search input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .admin-search button {
        background: var(--border-dark);
        color: white;
        border: 2px solid var(--border-dark);
        padding: 0.5rem 1.2rem;
        font-family: var(--font-display);
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.15s ease;
        cursor: pointer;
    }

    .admin-search button:hover {
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

        .admin-search {
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
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-people"></i>Gestión de Usuarios</h2>
            <p>Administra los usuarios del sistema</p>
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
    <div class="admin-search">
        <input type="text" placeholder="Buscar usuario..." id="searchUser" onkeyup="filterTable()">
        <button><i class="bi bi-search me-1"></i>Buscar</button>
    </div>
    <a href="<?= APP_URL ?>/admin/users/create" class="btn-admin-innovative">
        <i class="bi bi-person-plus me-1"></i>Nuevo Usuario
    </a>
    <div class="admin-stats-mini">
        <span>Total: <strong><?= count($users) ?></strong></span>
    </div>
</div>

<div class="table-responsive">
    <table class="table-admin-innovative" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Puntos</th>
                <th style="text-align:center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td>#<?= $u->id ?></td>
                    <td><strong><?= htmlspecialchars($u->username) ?></strong></td>
                    <td><?= htmlspecialchars($u->email) ?></td>
                    <td>
                        <span class="badge-role-admin badge-role-admin-<?= $u->role ?>">
                            <?= $u->role ?>
                        </span>
                    </td>
                    <td><?= number_format($u->total_points ?? 0) ?></td>
                    <td style="text-align:center; white-space:nowrap;">
                        <a href="<?= APP_URL ?>/admin/users/edit/<?= $u->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <?php if ($u->id != ($user->id ?? 0)): ?>
                            <a href="<?= APP_URL ?>/admin/users/delete/<?= $u->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger" onclick="return confirm('¿Eliminar este usuario?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<hr class="divider-innovative">

<div class="text-center" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light);">
    <i class="bi bi-shield-check me-1"></i>
    Solo los administradores pueden acceder a este panel
</div>

<script>
    function filterTable() {
        const input = document.getElementById('searchUser');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('userTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            for (let j = 0; j < cells.length; j++) {
                const text = cells[j].textContent || cells[j].innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>