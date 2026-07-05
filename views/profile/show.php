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

    .upload-avatar-form-innovative {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .upload-avatar-form-innovative .form-control {
        max-width: 200px;
        border: 2px solid var(--border-dark);
        border-radius: 0;
        font-size: 0.85rem;
        font-family: var(--font-display);
    }

    .upload-avatar-form-innovative .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-upload-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.4rem 1.5rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.85rem;
        box-shadow: 4px 4px 0px var(--border-dark);
        border-radius: 0;
    }

    .btn-upload-innovative:hover {
        background: var(--primary);
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
    }

    .prize-item-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--border-dark);
        background: var(--primary-light);
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
    }
</style>

<!-- ====== HEADER PERFIL ====== -->
<div class="profile-header-innovative">
    <img src="<?= APP_URL ?>/uploads/avatars/<?= $user->avatar ?? 'default.png' ?>" alt="Avatar" class="profile-avatar-innovative">
    <h2><?= htmlspecialchars($user->username) ?></h2>
    <div class="profile-role">
        <span class="badge-role"><?= $user->role ?></span>
        <span class="mx-2">•</span>
        <?= htmlspecialchars($user->email) ?>
    </div>

    <form method="POST" action="<?= APP_URL ?>/profile/avatar" enctype="multipart/form-data" class="upload-avatar-form-innovative">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
        <input type="file" name="avatar" class="form-control" accept="image/*">
        <button type="submit" class="btn-upload-innovative">
            <i class="bi bi-upload me-1"></i>Cambiar foto
        </button>
    </form>
</div>

<div class="row g-3">
    <!-- Informacion -->
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

    <!-- Progreso -->
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

<!-- Premios -->
<div class="row mt-3">
    <div class="col-12">
        <div class="profile-card-innovative">
            <div class="card-title"><i class="bi bi-trophy"></i>Mis Premios</div>
            <?php if (!empty($prizes)): ?>
                <div class="prize-grid-innovative">
                    <?php foreach ($prizes as $prize): ?>
                        <div class="prize-item-innovative">
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