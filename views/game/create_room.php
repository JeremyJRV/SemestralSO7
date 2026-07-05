<style>
    .room-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .room-header-innovative::before {
        content: '✦';
        position: absolute;
        top: -8px;
        right: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .room-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .room-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .room-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .room-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        max-width: 560px;
        margin: 0 auto;
        position: relative;
        transition: all 0.2s ease;
    }

    .room-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .room-card-innovative .corner-deco {
        position: absolute;
        bottom: -8px;
        right: -8px;
        background: var(--primary-dark);
        color: white;
        padding: 0.2rem 0.8rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid var(--border-dark);
        transform: rotate(-2deg);
    }

    .room-card-innovative .form-label {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
    }

    .room-card-innovative .form-select {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.65rem 1rem;
        font-family: var(--font-display);
        font-weight: 500;
        transition: all 0.15s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231a2634' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px;
    }

    .room-card-innovative .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-room-create-innovative {
        background: var(--primary);
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

    .btn-room-create-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .btn-room-cancel-innovative {
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

    .btn-room-cancel-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--primary);
    }

    .room-info-box {
        background: var(--primary-lighter);
        border: 2px solid var(--border-dark);
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .room-info-box i {
        color: var(--primary);
        font-size: 1.5rem;
    }

    .room-info-box .info-text {
        font-family: var(--font-display);
        font-size: 0.9rem;
        color: var(--text-gray);
        margin: 0;
    }

    .room-info-box .info-text strong {
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
        .room-header-innovative { padding: 1rem 1.2rem; }
        .room-card-innovative { padding: 1.5rem; }
        .room-info-box { flex-direction: column; text-align: center; }
    }
</style>

<div class="room-header-innovative">
    <h2><i class="bi bi-people"></i>Crear Sala Multijugador</h2>
    <p>Invita a otros jugadores y compite en tiempo real</p>
</div>

<div class="room-card-innovative">
    <span class="corner-deco">✦ room</span>
    
    <div class="room-info-box">
        <i class="bi bi-info-circle"></i>
        <p class="info-text">
            <strong>¿Cómo funciona?</strong> Crea una sala, comparte el código con tus amigos 
            y compitan para ver quién obtiene la mejor puntuación.
        </p>
    </div>

    <form method="POST" action="<?= APP_URL ?>/game/room/store">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-4">
            <label class="form-label">
                <i class="bi bi-layers me-1"></i> Tema y Nivel
            </label>
            <select name="theme_level_id" class="form-select" required>
                <option value="">— Selecciona un tema —</option>
                <?php foreach ($themeLevels as $tl): ?>
                    <option value="<?= $tl['id'] ?>">
                        <?= htmlspecialchars($tl['theme_name']) ?> — <?= htmlspecialchars($tl['level_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn-room-create-innovative">
                <i class="bi bi-plus-circle me-2"></i>Crear Sala
            </button>
            <a href="<?= APP_URL ?>/game" class="btn-room-cancel-innovative">
                <i class="bi bi-arrow-left me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>