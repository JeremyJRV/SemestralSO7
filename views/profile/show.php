<style>
    .profile-header-innovative {
        padding: 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .profile-header-innovative::before {
        content: '◆';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .profile-avatar-innovative {
        width: 120px;
        height: 120px;
        border: 4px solid var(--border-dark);
        object-fit: cover;
        margin-bottom: 1rem;
        background: var(--bg-page);
        box-shadow: 6px 6px 0px var(--border-dark);
    }

    .profile-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.2rem;
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .profile-header-innovative .profile-role {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 0.9rem;
    }

    .profile-header-innovative .profile-role .badge-role {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.2rem 0.8rem;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.65rem;
        border: 2px solid var(--border-dark);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .btn-change-avatar-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.5rem 1.6rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.85rem;
        box-shadow: 4px 4px 0px var(--border-dark);
        margin-top: 1rem;
        cursor: pointer;
    }

    .btn-change-avatar-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .profile-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem;
        box-shadow: var(--shadow-hard);
        height: 100%;
        transition: all 0.2s ease;
    }

    .profile-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .profile-card-innovative .card-title {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        border-bottom: 3px solid var(--border-dark);
        padding-bottom: 0.5rem;
    }

    .profile-card-innovative .card-title i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .profile-info-item-innovative {
        display: flex;
        justify-content: space-between;
        padding: 0.6rem 0;
        border-bottom: 2px solid var(--border-light);
    }

    .profile-info-item-innovative:last-child {
        border-bottom: none;
    }

    .profile-info-item-innovative .label {
        color: var(--text-gray);
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .profile-info-item-innovative .value {
        color: var(--text-dark);
        font-weight: 600;
        font-family: var(--font-display);
    }

    .prize-grid-innovative {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 1rem;
    }

    .prize-item-innovative {
        text-align: center;
        padding: 0.8rem 0.5rem;
        background: var(--primary-lighter);
        border: 2px solid var(--border-dark);
        transition: all 0.2s ease;
        position: relative;
        cursor: help;
    }

    .prize-item-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--border-dark);
        background: var(--primary-light);
        z-index: 5;
    }

    .prize-item-innovative img {
        width: 48px;
        height: 48px;
        object-fit: contain;
    }

    .prize-item-innovative .prize-name {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        color: var(--text-gray);
        margin-top: 0.3rem;
        display: block;
        font-weight: 600;
    }

    .prize-item-innovative .prize-tooltip {
        position: absolute;
        bottom: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(4px);
        background: var(--bg-card);
        border: 2px solid var(--border-dark);
        box-shadow: 4px 4px 0px var(--border-dark);
        padding: 0.6rem 0.9rem;
        font-family: var(--font-display);
        font-size: 0.75rem;
        color: var(--text-dark);
        width: 180px;
        text-align: left;
        line-height: 1.3;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.15s ease, transform 0.15s ease;
        z-index: 10;
    }

    .prize-item-innovative .prize-tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: var(--border-dark);
    }

    .prize-item-innovative .prize-tooltip::before {
        content: '';
        position: absolute;
        top: calc(100% - 2px);
        left: 50%;
        transform: translateX(-50%);
        border: 5px solid transparent;
        border-top-color: var(--bg-card);
        z-index: 1;
    }

    .prize-item-innovative:hover .prize-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .progress-list-innovative .progress-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.6rem 0;
        border-bottom: 2px solid var(--border-light);
    }

    .progress-list-innovative .progress-item:last-child {
        border-bottom: none;
    }

    .progress-list-innovative .progress-item .progress-info {
        flex: 1;
    }

    .progress-list-innovative .progress-item .progress-info strong {
        color: var(--text-dark);
        font-weight: 600;
        font-family: var(--font-display);
    }

    .progress-list-innovative .progress-item .progress-info small {
        color: var(--text-gray);
        font-family: var(--font-mono);
        font-size: 0.7rem;
        display: block;
    }

    .progress-track-small {
        width: 60px;
        height: 8px;
        background: var(--bg-page);
        border: 2px solid var(--border-dark);
        overflow: hidden;
    }

    .progress-track-small .fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), #7c3aed);
        transition: width 0.6s ease;
    }

    .progress-percent-innovative {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--text-dark);
        min-width: 40px;
        text-align: right;
    }

    .avatar-modal-content {
        border: 3px solid var(--border-dark);
        border-radius: 0;
        box-shadow: var(--shadow-hard);
    }

    .avatar-modal-content .modal-header {
        border-bottom: 3px solid var(--border-dark);
    }

    .avatar-modal-content .modal-title {
        font-family: var(--font-display);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .avatar-upload-box {
        background: var(--primary-lighter);
        border: 2px solid var(--border-dark);
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .avatar-upload-box label {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.8rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .avatar-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem; }
    .avatar-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 0.8rem;
        text-align: center;
        box-shadow: 4px 4px 0px var(--border-dark);
        transition: all 0.2s ease;
        position: relative;
    }
    .avatar-card.active { border-color: #22c55e; box-shadow: 4px 4px 0px #22c55e; }
    .avatar-card.inactive { opacity: 0.55; }
    .avatar-card img {
        width: 80px; height: 80px; border-radius: 50%;
        object-fit: cover; border: 2px solid var(--border-dark);
        margin-bottom: 0.6rem;
    }
    .avatar-status-badge {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.1rem 0.6rem;
        border: 2px solid var(--border-dark);
        margin-bottom: 0.5rem;
    }
    .avatar-status-badge.active { background: #dcfce7; color: #16a34a; }
    .avatar-status-badge.inactive { background: #f1f5f9; color: #64748b; }
    .avatar-card-actions { display: flex; flex-direction: column; gap: 0.35rem; }
    .avatar-card-actions .btn-admin-innovative-sm { font-size: 0.6rem; }

    @media (max-width: 768px) {
        .profile-header-innovative {
            padding: 1.5rem;
        }
        .profile-avatar-innovative {
            width: 80px;
            height: 80px;
        }
        .prize-grid-innovative {
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
        }
        .profile-info-item-innovative {
            flex-direction: column;
            gap: 0.2rem;
        }
        .profile-info-item-innovative .value {
            font-size: 0.95rem;
        }
        .prize-item-innovative .prize-tooltip {
            width: 140px;
            font-size: 0.7rem;
        }
    }
</style>

<div class="profile-header-innovative">
    <img src="<?= APP_URL ?>/uploads/avatars/<?= $user->avatar ?? 'default.png' ?>" alt="Avatar" class="profile-avatar-innovative">
    <h2><?= htmlspecialchars($user->username) ?></h2>
    <div class="profile-role">
        <span class="badge-role"><?= $user->role ?></span>
        <span class="mx-2">•</span>
        <?= htmlspecialchars($user->email) ?>
    </div>

    <button type="button" class="btn-change-avatar-innovative" data-bs-toggle="modal" data-bs-target="#avatarModal">
        <i class="bi bi-camera-fill me-1"></i>Cambiar avatar
    </button>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="profile-card-innovative">
            <div class="card-title"><i class="bi bi-person-badge"></i>Informacion</div>
            <div class="profile-info-item-innovative">
                <span class="label">Usuario</span>
                <span class="value"><?= htmlspecialchars($user->username) ?></span>
            </div>
            <div class="profile-info-item-innovative">
                <span class="label">Email</span>
                <span class="value"><?= htmlspecialchars($user->email) ?></span>
            </div>
            <div class="profile-info-item-innovative">
                <span class="label">Rol</span>
                <span class="value">
                    <span class="badge-role" style="font-size: 0.6rem;"><?= $user->role ?></span>
                </span>
            </div>
            <div class="profile-info-item-innovative">
                <span class="label">Puntos Totales</span>
                <span class="value" style="color: var(--primary);"><?= number_format($user->total_points ?? 0) ?></span>
            </div>
            <div class="profile-info-item-innovative">
                <span class="label">Miembro desde</span>
                <span class="value"><?= date('d/m/Y', strtotime($user->created_at ?? 'now')) ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="profile-card-innovative">
            <div class="card-title"><i class="bi bi-bar-chart-steps"></i>Progreso por Nivel</div>
            <?php if (!empty($progress)): ?>
                <div class="progress-list-innovative">
                    <?php foreach ($progress as $p): ?>
                        <div class="progress-item">
                            <div class="progress-info">
                                <strong><?= htmlspecialchars($p['theme_name']) ?></strong>
                                <small><?= htmlspecialchars($p['level_name']) ?></small>
                            </div>
                            <div class="progress-track-small">
                                <div class="fill" style="width: <?= $p['score_percentage'] ?? 0 ?>%;"></div>
                            </div>
                            <div class="progress-percent-innovative"><?= $p['score_percentage'] ?? 0 ?>%</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> Aun no has jugado ningun nivel.
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="profile-card-innovative">
            <div class="card-title"><i class="bi bi-trophy"></i>Mis Premios</div>
            <?php if (!empty($prizes)): ?>
                <div class="prize-grid-innovative">
                    <?php foreach ($prizes as $prize): ?>
                        <div class="prize-item-innovative">
                            <?php if (!empty($prize['description'])): ?>
                                <div class="prize-tooltip"><?= htmlspecialchars($prize['description']) ?></div>
                            <?php endif; ?>
                            <img src="<?= APP_URL ?>/images/prizes/<?= $prize['image'] ?? 'default.png' ?>" alt="<?= htmlspecialchars($prize['name']) ?>">
                            <span class="prize-name"><?= htmlspecialchars($prize['name']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> Aun no has ganado premios. Sigue jugando.
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content avatar-modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-badge-fill me-1"></i>Cambiar Avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-innovative alert-innovative-danger" style="border-radius:0; border:2px solid #dc2626; background:#fee2e2; color:#dc2626; padding:0.6rem 1rem; font-family: var(--font-display); margin-bottom: 1rem; font-size: 0.85rem;">
                        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <div class="avatar-upload-box">
                    <label><i class="bi bi-cloud-upload-fill me-1"></i>Subir imagen nueva</label>
                    <form method="POST" action="<?= APP_URL ?>/avatars/store" enctype="multipart/form-data" class="d-flex gap-2 flex-wrap align-items-end">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input type="file" name="image" class="form-control flex-grow-1" accept="image/*" required style="max-width: 260px;">
                        <button type="submit" class="btn-admin-innovative btn-admin-innovative-sm">
                            <i class="bi bi-plus-lg me-1"></i>Subir y activar
                        </button>
                    </form>
                </div>

                <?php if (!empty($avatars)): ?>
                    <div class="avatar-grid">
                        <?php foreach ($avatars as $avatar): ?>
                            <div class="avatar-card <?= $avatar->activo ? 'active' : 'inactive' ?>">
                                <span class="avatar-status-badge <?= $avatar->activo ? 'active' : 'inactive' ?>">
                                    <?= $avatar->activo ? 'Activo' : 'Inactivo' ?>
                                </span>
                                <br>
                                <img src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($avatar->image) ?>" alt="Avatar">

                                <div class="avatar-card-actions">
                                    <?php if (!$avatar->activo): ?>
                                        <form method="POST" action="<?= APP_URL ?>/avatars/activate/<?= $avatar->id ?>">
                                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                                            <button type="submit" class="btn-admin-innovative btn-admin-innovative-sm">
                                                <i class="bi bi-check-circle me-1"></i>Usar este
                                            </button>
                                        </form>
                                        <form method="POST" action="<?= APP_URL ?>/avatars/delete/<?= $avatar->id ?>"
                                              onsubmit="return confirm('¿Eliminar esta imagen para siempre? No se puede deshacer.')">
                                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                                            <button type="submit" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger">
                                                <i class="bi bi-trash me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if ($avatar->activo): ?>
                                        <form method="POST" action="<?= APP_URL ?>/avatars/deactivate/<?= $avatar->id ?>"
                                              onsubmit="return confirm('¿Desactivar este avatar? No se borrará, solo dejará de usarse.')">
                                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                                            <button type="submit" class="btn-admin-innovative btn-admin-innovative-sm btn-admin-innovative-danger">
                                                <i class="bi bi-slash-circle me-1"></i>Desactivar
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-innovative">Aún no has subido ningún avatar. ¡Sube el primero arriba!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const avatarModalEl = document.getElementById('avatarModal');
        if (!avatarModalEl) return;

        if (avatarModalEl.parentElement !== document.body) {
            document.body.appendChild(avatarModalEl);
        }

        avatarModalEl.addEventListener('hidden.bs.modal', function () {
            document.querySelectorAll('.modal-backdrop').forEach(function (bd) {
                bd.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('overflow');
            document.body.style.removeProperty('padding-right');
        });
    });
</script>