<style>
    .game-select-header-innovative {
        margin-bottom: 2rem;
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        position: relative;
    }

    .game-select-header-innovative::before {
        content: '◆';
        position: absolute;
        top: -8px;
        left: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .game-select-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .game-select-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .game-select-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .game-mode-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-hard);
        height: 100%;
        text-align: center;
        position: relative;
    }

    .game-mode-card-innovative:hover {
        transform: translate(-4px, -4px);
        box-shadow: var(--shadow-hard-hover);
    }

    .game-mode-card-innovative .corner-num {
        position: absolute;
        top: -8px;
        left: -8px;
        background: var(--primary-darker);
        color: white;
        padding: 0.1rem 0.6rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        border: 2px solid var(--border-dark);
        transform: rotate(-2deg);
    }

    .game-mode-card-innovative .mode-icon {
        width: 64px;
        height: 64px;
        border: 3px solid var(--border-dark);
        background: var(--primary-lighter);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        font-size: 2rem;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .game-mode-card-innovative:hover .mode-icon {
        background: var(--primary);
        color: white;
        transform: rotate(-5deg) scale(1.05);
    }

    .game-mode-card-innovative h5 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.2rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        font-size: 0.9rem;
    }

    .game-mode-card-innovative .level-name {
        color: var(--text-gray);
        font-size: 0.85rem;
        margin-bottom: 0.8rem;
        font-family: var(--font-display);
    }

    .btn-mode-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.4rem 1.8rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px var(--border-dark);
        text-decoration: none;
        display: inline-block;
        margin-bottom: 0.8rem;
    }

    .btn-mode-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px var(--border-dark);
        color: white !important;
    }

    .rating-section {
        margin-top: 0.5rem;
        padding-top: 0.8rem;
        border-top: 2px solid var(--border-light);
    }

    .rating-section .rating-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        display: block;
        margin-bottom: 0.4rem;
    }

    .rating-buttons {
        display: flex;
        gap: 0.3rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-rating-innovative {
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.6rem;
        padding: 0.2rem 0.8rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        cursor: pointer;
        background: var(--bg-card);
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .btn-rating-innovative:hover {
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-rating-innovative.boring:hover {
        background: #fee2e2;
        color: #dc2626;
        border-color: #dc2626;
    }

    .btn-rating-innovative.interesting:hover {
        background: #fef3c7;
        color: #d97706;
        border-color: #d97706;
    }

    .btn-rating-innovative.great:hover {
        background: #dcfce7;
        color: #16a34a;
        border-color: #16a34a;
    }

    .btn-rating-innovative:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn-rating-innovative.voted {
        background: var(--primary);
        color: white;
        border-color: var(--border-dark);
    }

    .input-code-innovative {
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: center;
        width: 100%;
    }

    .input-code-innovative:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 4px 4px 0px var(--border-dark);
    }

    .btn-mode-innovative-outline {
        background: transparent;
        border: 2px solid var(--border-dark);
        color: var(--text-gray);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.3rem 1.2rem;
        transition: all 0.15s ease;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-block;
        border-radius: 0;
    }

    .btn-mode-innovative-outline:hover {
        background: var(--border-dark);
        color: white;
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px var(--primary);
    }

    .btn-admin-innovative {
        background: var(--primary-dark);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.5rem 1.8rem;
        border: 2px solid var(--border-dark);
        transition: all 0.15s ease;
        font-size: 0.85rem;
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
        .game-select-header-innovative { padding: 1rem 1.2rem; }
        .game-mode-card-innovative { padding: 1.2rem; }
        .rating-buttons { gap: 0.2rem; }
        .btn-rating-innovative { font-size: 0.55rem; padding: 0.15rem 0.6rem; }
    }
</style>

<div class="game-select-header-innovative">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <h2><i class="bi bi-joystick"></i>Selecciona tu juego</h2>
            <p>Elige un tema y nivel para comenzar tu partida</p>
        </div>
        <?php if (in_array($role ?? 'guest', ['armador', 'admin'])): ?>
            <a href="<?= APP_URL ?>/game/room/create" class="btn-admin-innovative">
                <i class="bi bi-people me-1"></i>Crear Sala
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="row g-4">
    <?php foreach ($levels as $tl): ?>
        <div class="col-md-4 col-lg-3">
            <div class="game-mode-card-innovative">
                <span class="corner-num">▶</span>
                <div class="mode-icon">
                    <i class="bi bi-layers"></i>
                </div>
                <h5><?= htmlspecialchars($tl['theme_name']) ?></h5>
                <div class="level-name"><?= htmlspecialchars($tl['level_name']) ?></div>

                <a href="<?= APP_URL ?>/game/start/<?= $tl['id'] ?>" class="btn-mode-innovative">
                    <i class="bi bi-play-fill me-1"></i>Jugar
                </a>

                <div class="rating-section">
                    <span class="rating-label">
                        <i class="bi bi-star me-1"></i>Que te parece este tema
                    </span>
                    <div class="rating-buttons">
                        <button type="button" class="btn-rating-innovative boring rate-btn"
                                data-theme="<?= $tl['theme_id'] ?>"
                                data-rating="boring">
                            <i class="bi bi-emoji-frown me-1"></i>Aburrido
                        </button>
                        <button type="button" class="btn-rating-innovative interesting rate-btn"
                                data-theme="<?= $tl['theme_id'] ?>"
                                data-rating="interesting">
                            <i class="bi bi-emoji-smile me-1"></i>Interesante
                        </button>
                        <button type="button" class="btn-rating-innovative great rate-btn"
                                data-theme="<?= $tl['theme_id'] ?>"
                                data-rating="great">
                            <i class="bi bi-emoji-heart-eyes me-1"></i>Genial
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="col-md-4 col-lg-3">
        <div class="game-mode-card-innovative">
            <span class="corner-num">◀</span>
            <div class="mode-icon" style="color: #7c3aed; background: #f5f3ff; border-color: #7c3aed;">
                <i class="bi bi-door-open"></i>
            </div>
            <h5>Unirse a Sala</h5>
            <div class="level-name">Ingresa el codigo de una sala</div>

            <form onsubmit="event.preventDefault(); const code = document.getElementById('roomCodeInput').value.trim(); if(code) window.location.href = '<?= APP_URL ?>/game/room/' + encodeURIComponent(code);">
                <div class="d-flex gap-1">
                    <input type="text" id="roomCodeInput" class="input-code-innovative" placeholder="Codigo" required>
                    <button type="submit" class="btn-mode-innovative-outline" style="border-radius:0;">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<hr class="divider-innovative">

<div class="text-center" style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-light);">
    <i class="bi bi-shield-check me-1"></i>
    Tu opinion nos ayuda a mejorar la experiencia
</div>

<script>
document.querySelectorAll('.rate-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const themeId = this.dataset.theme;
        const rating = this.dataset.rating;
        const parent = this.closest('.rating-buttons');

        parent.querySelectorAll('.rate-btn').forEach(b => {
            b.disabled = true;
        });

        this.classList.add('voted');

        fetch('<?= APP_URL ?>/themes/rate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'theme_id=' + themeId + '&rating=' + rating
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const ratingLabel = parent.closest('.rating-section').querySelector('.rating-label');
                const originalText = ratingLabel.innerHTML;
                ratingLabel.innerHTML = '<i class="bi bi-check-circle me-1" style="color: #22c55e;"></i>Gracias por tu opinion';
                setTimeout(() => {
                    ratingLabel.innerHTML = originalText;
                    parent.querySelectorAll('.rate-btn').forEach(b => {
                        b.disabled = false;
                        b.classList.remove('voted');
                    });
                }, 3000);
            } else {
                alert(data.error || 'Error al calificar');
                parent.querySelectorAll('.rate-btn').forEach(b => {
                    b.disabled = false;
                    b.classList.remove('voted');
                });
            }
        })
        .catch(() => {
            alert('Error de conexion');
            parent.querySelectorAll('.rate-btn').forEach(b => {
                b.disabled = false;
                b.classList.remove('voted');
            });
        });
    });
});
</script>