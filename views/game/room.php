<style>
    .room-detail-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
        text-align: center;
    }

    .room-detail-header-innovative::before {
        content: '◆';
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary);
        color: white;
        padding: 0 1rem;
        font-size: 0.7rem;
    }

    .room-detail-header-innovative .room-code-display {
        font-family: var(--font-mono);
        font-size: 3rem;
        font-weight: 900;
        letter-spacing: 8px;
        color: var(--text-dark);
        background: var(--primary-light);
        padding: 0.5rem 2rem;
        border: 3px solid var(--border-dark);
        display: inline-block;
        box-shadow: 6px 6px 0px var(--border-dark);
        margin-bottom: 0.5rem;
    }

    .room-detail-header-innovative .room-code-display span {
        color: var(--primary);
    }

    .room-detail-header-innovative p {
        color: var(--text-gray);
        font-family: var(--font-display);
        margin-bottom: 0;
    }

    .room-detail-header-innovative p i {
        color: var(--primary);
        margin-right: 0.3rem;
    }

    .room-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .room-info-item-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.2rem;
        text-align: center;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
    }

    .room-info-item-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .room-info-item-innovative .info-number {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2.2rem;
        color: var(--text-dark);
        line-height: 1;
    }

    .room-info-item-innovative .info-number.blue { color: var(--primary); }
    .room-info-item-innovative .info-number.green { color: var(--success); }

    .room-info-item-innovative .info-label {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        margin-top: 0.2rem;
        display: block;
    }

    .btn-room-action-innovative {
        background: var(--success);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.85rem 2.5rem;
        font-size: 1.1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px var(--border-dark);
        text-decoration: none;
        display: inline-block;
    }

    .btn-room-action-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .btn-room-leave-innovative {
        background: transparent;
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.85rem 2.5rem;
        font-size: 1rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-room-leave-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-3px, -3px);
        box-shadow: 6px 6px 0px var(--danger);
    }

    .copy-code-btn-innovative {
        background: transparent;
        border: 3px solid var(--border-dark);
        color: var(--text-gray);
        font-family: var(--font-mono);
        font-weight: 600;
        padding: 0.3rem 1.2rem;
        font-size: 0.8rem;
        transition: all 0.15s ease;
        cursor: pointer;
    }

    .copy-code-btn-innovative:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--primary);
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
        .room-detail-header-innovative { padding: 1rem 1.2rem; }
        .room-detail-header-innovative .room-code-display {
            font-size: 2rem;
            letter-spacing: 4px;
            padding: 0.3rem 1rem;
        }
        .room-info-grid { grid-template-columns: 1fr 1fr; }
        .btn-room-action-innovative, .btn-room-leave-innovative {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="room-detail-header-innovative">
    <div class="room-code-display">
        #<span><?= htmlspecialchars($roomCode) ?></span>
    </div>
    <p>
        <i class="bi bi-info-circle"></i>
        Comparte este código con otros jugadores para que se unan a tu sala
    </p>
    <button class="copy-code-btn-innovative mt-2" onclick="copyRoomCode()">
        <i class="bi bi-clipboard me-1"></i>Copiar código
    </button>
</div>

<div class="room-info-grid">
    <div class="room-info-item-innovative">
        <div class="info-number blue"><?= $playersCount ?? 1 ?></div>
        <span class="info-label"><i class="bi bi-people me-1"></i>Jugadores conectados</span>
    </div>
    <div class="room-info-item-innovative">
        <div class="info-number green"><?= $status ?? 'Esperando' ?></div>
        <span class="info-label"><i class="bi bi-clock me-1"></i>Estado de la sala</span>
    </div>
</div>

<hr class="divider-innovative">

<div class="d-flex flex-wrap justify-content-center gap-3">
    <a href="<?= APP_URL ?>/game/play/<?= $sessionId ?>" class="btn-room-action-innovative">
        <i class="bi bi-play-fill me-2"></i>Comenzar partida
    </a>
    <a href="<?= APP_URL ?>/game" class="btn-room-leave-innovative">
        <i class="bi bi-box-arrow-left me-2"></i>Salir de la sala
    </a>
</div>

<script>
function copyRoomCode() {
    const code = '<?= htmlspecialchars($roomCode) ?>';
    navigator.clipboard.writeText(code).then(() => {
        const btn = document.querySelector('.copy-code-btn-innovative');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle me-1"></i>¡Copiado!';
        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    });
}
</script>