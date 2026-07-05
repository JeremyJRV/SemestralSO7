<style>
    .hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 4rem 2rem 5rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
    }

    .hero-innovative::before {
        content: '';
        position: absolute;
        top: -15px;
        right: -15px;
        width: 100px;
        height: 100px;
        background: var(--primary);
        opacity: 0.05;
        transform: rotate(45deg);
        pointer-events: none;
    }

    .hero-innovative::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: -15px;
        width: 80px;
        height: 80px;
        background: var(--primary-dark);
        opacity: 0.04;
        transform: rotate(-30deg);
        pointer-events: none;
    }

    .hero-innovative .corner-deco {
        position: absolute;
        top: -8px;
        left: -8px;
        background: var(--primary);
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

    .hero-innovative .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-innovative .hero-badge {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.3rem 1.2rem;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        border: 2px solid var(--border-dark);
        text-transform: uppercase;
    }

    .hero-innovative .hero-badge i {
        margin-right: 0.4rem;
    }

    .hero-innovative h1 {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 3.2rem;
        color: var(--text-dark);
        line-height: 1.05;
        letter-spacing: -2px;
        text-transform: uppercase;
    }

    .hero-innovative h1 span {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .hero-innovative h1 span::after {
        content: '⬡';
        font-size: 1.2rem;
        -webkit-text-fill-color: var(--primary);
        margin-left: 4px;
    }

    .hero-innovative .lead {
        color: var(--text-gray);
        font-size: 1.15rem;
        max-width: 600px;
        margin: 1.2rem auto;
        font-weight: 400;
        font-family: var(--font-display);
    }

    .btn-hero-innovative {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.85rem 3rem;
        font-size: 1.05rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px var(--border-dark);
        border-radius: 0;
        display: inline-block;
        text-decoration: none;
    }

    .btn-hero-innovative:hover {
        background: var(--primary);
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .feature-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.2s ease;
        height: 100%;
        box-shadow: var(--shadow-hard);
        position: relative;
    }

    .feature-card-innovative:hover {
        transform: translate(-4px, -4px);
        box-shadow: var(--shadow-hard-hover);
    }

    .feature-card-innovative .corner-num {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--primary-darker);
        color: white;
        padding: 0.2rem 0.6rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        border: 2px solid var(--border-dark);
        transform: rotate(3deg);
    }

    .feature-icon-innovative {
        width: 72px;
        height: 72px;
        border: 3px solid var(--border-dark);
        background: var(--primary-lighter);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-size: 2.2rem;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .feature-card-innovative:hover .feature-icon-innovative {
        background: var(--primary);
        color: white;
        transform: rotate(-5deg) scale(1.05);
    }

    .feature-card-innovative h3 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .feature-card-innovative p {
        color: var(--text-gray);
        font-size: 0.95rem;
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .cta-innovative {
        background: var(--primary-darker);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
    }

    .cta-innovative::before {
        content: '⬡ ⬡ ⬡';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary);
        color: white;
        padding: 0 1.2rem;
        font-size: 0.6rem;
        letter-spacing: 6px;
        border: 2px solid var(--border-dark);
    }

    .cta-innovative h4 {
        font-family: var(--font-display);
        font-weight: 800;
        color: white;
        position: relative;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .cta-innovative .btn-cta-primary {
        background: var(--primary);
        color: white !important;
        font-family: var(--font-display);
        font-weight: 700;
        padding: 0.6rem 2.2rem;
        border: 3px solid var(--border-dark);
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
        border-radius: 0;
        display: inline-block;
        text-decoration: none;
    }

    .cta-innovative .btn-cta-primary:hover {
        background: var(--primary);
        transform: translate(-3px, -3px);
        box-shadow: 7px 7px 0px rgba(0,0,0,0.3);
        color: white !important;
    }

    .cta-innovative .btn-cta-secondary {
        background: rgba(255, 255, 255, 0.05);
        border: 3px solid rgba(255, 255, 255, 0.15);
        color: rgba(255, 255, 255, 0.7);
        font-family: var(--font-display);
        font-weight: 600;
        padding: 0.6rem 2.2rem;
        transition: all 0.15s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
        z-index: 1;
        border-radius: 0;
        display: inline-block;
        text-decoration: none;
    }

    .cta-innovative .btn-cta-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.3);
        transform: translate(-3px, -3px);
    }

    .feature-strip {
        margin-top: -3rem;
        position: relative;
        z-index: 2;
    }

    .divider-innovative {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 2.5rem 0;
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
        .hero-innovative h1 {
            font-size: 2.2rem;
        }
        .hero-innovative {
            padding: 3rem 1.5rem;
        }
        .feature-card-innovative {
            padding: 1.5rem;
        }
    }
</style>

<div class="hero-innovative mb-5">
    <span class="corner-deco">✦ v1.0</span>
    <div class="hero-content">
        <div class="hero-badge">
            <i class="bi bi-star-fill"></i> Aprendizaje Gamificado
        </div>
        <h1>Aprende <span>PHP &amp; JS</span><br>Jugando</h1>
        <p class="lead">
            Trivias es un sistema de preguntas y respuestas por niveles para poner a prueba
            tus conocimientos de desarrollo web.
        </p>
        <a href="<?= APP_URL ?>/register" class="btn-hero-innovative">
            <i class="bi bi-rocket-takeoff me-2"></i>Registrate Gratis
        </a>
    </div>
</div>

<div class="row feature-strip g-4 px-3 mb-5">
    <div class="col-md-4">
        <div class="feature-card-innovative">
            <span class="corner-num">01</span>
            <div class="feature-icon-innovative"><i class="bi bi-layers"></i></div>
            <h3>Temas y Niveles</h3>
            <p>Preguntas de PHP y JavaScript por niveles: Basico, Intermedio y Avanzado.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-card-innovative">
            <span class="corner-num">02</span>
            <div class="feature-icon-innovative"><i class="bi bi-trophy"></i></div>
            <h3>Premios y Puntos</h3>
            <p>Gana puntos por cada acierto y desbloquea premios al completar cada nivel.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-card-innovative">
            <span class="corner-num">03</span>
            <div class="feature-icon-innovative"><i class="bi bi-people"></i></div>
            <h3>Modo Multijugador</h3>
            <p>Crea una sala, comparte el codigo, y compite con tus companeros.</p>
        </div>
    </div>
</div>

<hr class="divider-innovative">

<div class="cta-innovative text-center">
    <h4 class="mb-3">Listo para poner a prueba tus conocimientos</h4>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= APP_URL ?>/register" class="btn-cta-primary">
            <i class="bi bi-person-plus me-2"></i>Crear Cuenta
        </a>
        <a href="<?= APP_URL ?>/login" class="btn-cta-secondary">
            <i class="bi bi-box-arrow-in-right me-2"></i>Ya tengo cuenta
        </a>
    </div>
</div>