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

    .table-admin-innovative tbody tr.corrupted {
        background: #fee2e2;
        border-left: 4px solid #dc2626;
    }

    .table-admin-innovative tbody tr.corrupted:hover {
        background: #fecaca;
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

    .integrity-badge-innovative {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.2rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 2px solid var(--border-dark);
    }

    .integrity-badge-innovative.valid {
        background: #dcfce7;
        color: #16a34a;
        border-color: #16a34a;
    }

    .integrity-badge-innovative.valid i {
        color: #16a34a;
    }

    .integrity-badge-innovative.invalid {
        background: #fee2e2;
        color: #dc2626;
        border-color: #dc2626;
    }

    .integrity-badge-innovative.invalid i {
        color: #dc2626;
    }

    .integrity-badge-innovative.unsigned {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .integrity-badge-innovative.unsigned i {
        color: #d97706;
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

    .prize-image-preview {
        width: 40px;
        height: 40px;
        object-fit: contain;
        border: 2px solid var(--border-dark);
        background: var(--bg-page);
        padding: 0.2rem;
    }

    .badge-prize-points {
        display: inline-block;
        background: #fef3c7;
        color: #d97706;
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.15rem 0.8rem;
        border: 2px solid #d97706;
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

        .integrity-badge-innovative {
            font-size: 0.55rem;
            padding: 0.1rem 0.5rem;
        }
    }
</style>

<div class="admin-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-trophy"></i>Gestión de Premios</h2>
            <p>Administra los premios que los jugadores pueden obtener</p>
        </div>
        <div>
            <span class="admin-badge"><i class="bi bi-shield-lock me-1"></i>Panel de Administración</span>
        </div>
    </div>
</div>

<div class="admin-actions">
    <a href="<?= APP_URL ?>/admin/prizes/create" class="btn-admin-innovative">
        <i class="bi bi-plus-circle me-1"></i>Nuevo Premio
    </a>
    <div class="admin-stats-mini">
        <span>Total: <strong><?= count($prizes) ?></strong></span>
        <?php if (isset($corruptedCount) && $corruptedCount > 0): ?>
            <span style="background: #fee2e2; border-color: #dc2626;">
                ⚠️ Corruptos: <strong style="color: #dc2626;"><?= $corruptedCount ?></strong>
            </span>
        <?php endif; ?>
        <?php if (isset($signedCount) && $signedCount > 0): ?>
            <span style="background: #dcfce7; border-color: #16a34a;">
                ✅ Verificados: <strong style="color: #16a34a;"><?= $signedCount ?></strong>
            </span>
        <?php endif; ?>
        <?php if (isset($unsignedCount) && $unsignedCount > 0): ?>
            <span style="background: #fef3c7; border-color: #d97706;">
                ⚠️ Sin firma: <strong style="color: #d97706;"><?= $unsignedCount ?></strong>
            </span>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive">
    <table class="table-admin-innovative" id="prizesTable">
        <thead>
            <tr>
                <th style="width:50px;">ID</th>
                <th style="width:60px;">Imagen</th>
                <th>Nombre</th>
                <th>Puntos</th>
                <th style="text-align:center;">Integridad</th>
                <th style="text-align:center; width:150px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prizes as $prize): ?>
                <?php
                // Determinar estado de integridad
                $hasSignature = !empty($prize->signature);
                $isCorrupted = isset($prize->_corrupted) && $prize->_corrupted === true;

                // Si tiene firma y no está marcado como corrupto, está verificado
                $isVerified = $hasSignature && !$isCorrupted;
                ?>
                <tr class="<?= $isCorrupted ? 'corrupted' : '' ?>">
                    <td>#<?= $prize->id ?></td>
                    <td>
                        <img src="<?= APP_URL ?>/images/prizes/<?= $prize->image ?? 'default.png' ?>" alt="<?= htmlspecialchars($prize->name) ?>" class="prize-image-preview">
                    </td>
                    <td><strong><?= htmlspecialchars($prize->name) ?></strong></td>
                    <td><span class="badge-prize-points"><?= $prize->points_value ?> pts</span></td>
                    <td style="text-align:center;">
                        <?php
                        // Verificar si tiene firma (buscando en attributes o directamente)
                        $signature = $prize->attributes['signature'] ?? $prize->signature ?? null;
                        $hasSignature = !empty($signature);
                        $isCorrupted = isset($prize->_corrupted) && $prize->_corrupted === true;
                        ?>

                        <?php if ($isCorrupted): ?>
                            <span class="integrity-badge-innovative invalid">
                                <i class="bi bi-x-circle"></i> CORRUPTO
                            </span>
                        <?php elseif ($hasSignature): ?>
                            <span class="integrity-badge-innovative valid">
                                <i class="bi bi-check-circle"></i> VERIFICADO
                            </span>
                        <?php else: ?>
                            <span class="integrity-badge-innovative unsigned">
                                <i class="bi bi-exclamation-triangle"></i> SIN FIRMA
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center; white-space:nowrap;">
                        <a href="<?= APP_URL ?>/admin/prizes/edit/<?= $prize->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="<?= APP_URL ?>/admin/prizes/delete/<?= $prize->id ?>" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger" onclick="return confirm('¿Eliminar este premio?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#prizesTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, searchable: false, targets: 1 },  // columna "Imagen"
                { orderable: false, searchable: false, targets: -1 } // columna "Acciones"
            ],
            order: [[0, 'desc']],
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50]
        });
    });
</script>

<hr class="divider-innovative">

<div class="text-center" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light);">
    <i class="bi bi-shield-check me-1"></i>
    Solo administradores y armadores pueden gestionar premios
</div>