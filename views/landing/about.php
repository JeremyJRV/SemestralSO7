<style>
    .about-hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem 4rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
    }

    .about-hero-innovative .corner-tag {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--primary);
        color: white;
        padding: 0.2rem 1rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid var(--border-dark);
        transform: rotate(3deg);
    }

    .about-hero-innovative .bg-icon {
        position: absolute;
        font-size: 10rem;
        color: rgba(59, 130, 246, 0.03);
        top: -10px;
        right: 20px;
        pointer-events: none;
        font-family: var(--font-mono);
        transform: rotate(5deg);
    }

    .about-hero-innovative h1 {
        font-family: var(--font-display);
        font-weight: 900;
        color: var(--text-dark);
        position: relative;
        z-index: 1;
        letter-spacing: -1px;
        text-transform: uppercase;
    }

    .about-hero-innovative h1 span {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .about-hero-innovative .lead {
        color: var(--text-gray);
        position: relative;
        z-index: 1;
        font-family: var(--font-display);
    }

    .about-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
    }

    .about-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .about-card-innovative p {
        color: var(--text-gray);
        line-height: 1.8;
        font-family: var(--font-display);
    }

    .step-innovative {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        padding: 0.8rem 1.2rem;
        border-bottom: 2px solid var(--border-light);
        transition: all 0.2s ease;
    }

    .step-innovative:last-child {
        border-bottom: none;
    }

    .step-innovative:hover {
        background: #dbeafe;
        transform: translateX(6px);
    }

    .step-number-innovative {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border: 3px solid var(--border-dark);
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.2s ease;
    }

    .step-innovative:hover .step-number-innovative {
        background: var(--primary);
        color: white;
        transform: rotate(-5deg) scale(1.05);
    }

    .step-innovative .step-text {
        color: var(--text-dark);
        font-weight: 500;
        font-family: var(--font-display);
    }

    .btn-start-innovative {
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

    .btn-start-innovative:hover {
        background: var(--primary);
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .tech-tag-innovative {
        display: inline-block;
        background: var(--primary-lighter);
        color: var(--primary);
        padding: 0.2rem 1rem;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 600;
        margin: 0.2rem;
        border: 2px solid var(--border-dark);
    }

    .tech-tag-innovative-dark {
        background: var(--primary-darker);
        color: white;
        border-color: var(--primary-darker);
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
</style>

<div class="about-hero-innovative mb-5">
    <span class="corner-tag">✦ about</span>
    <div class="bg-icon">⧗</div>
    <h1>Acerca de <span>Trivias</span></h1>
    <p class="lead">Aprendizaje gamificado para desarrolladores web</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="about-card-innovative mb-4">
            <p>
                Trivias es un sistema de aprendizaje gamificado enfocado en tecnologias web,
                principalmente <span class="tech-tag-innovative">PHP</span> y
                <span class="tech-tag-innovative tech-tag-innovative-dark">JavaScript</span>.
                Fue desarrollado como proyecto academico siguiendo los principios de arquitectura
                MVC, SOLID y DRY, con especial atencion a las buenas practicas de seguridad
                recomendadas por OWASP.
            </p>
            <p class="mb-0">
                Nuestro objetivo es que cualquier persona interesada en desarrollo web pueda
                reforzar sus conocimientos de forma entretenida, avanzando por niveles de
                dificultad y compitiendo con otros usuarios en modo multijugador.
            </p>
        </div>

        <hr class="divider-innovative">

        <div class="about-card-innovative mb-4">
            <h4 class="mb-3 fw-bold" style="color: var(--text-dark); font-family: var(--font-display); text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.9rem;">
                <i class="bi bi-list-check me-2" style="color: var(--primary);"></i>
                Como funciona
            </h4>
            <div class="step-innovative">
                <div class="step-number-innovative">01</div>
                <div class="step-text">Registrate gratis y elige un tema.</div>
            </div>
            <div class="step-innovative">
                <div class="step-number-innovative">02</div>
                <div class="step-text">Responde preguntas de opcion multiple o verdadero/falso.</div>
            </div>
            <div class="step-innovative">
                <div class="step-number-innovative">03</div>
                <div class="step-text">Supera el 80% de aciertos para avanzar al siguiente nivel.</div>
            </div>
            <div class="step-innovative">
                <div class="step-number-innovative">04</div>
                <div class="step-text">Gana puntos y premios conforme avanzas.</div>
            </div>
        </div>

        <div class="text-center">
            <a href="<?= APP_URL ?>/register" class="btn-start-innovative">
                <i class="bi bi-rocket-takeoff me-2"></i>Empezar ahora
            </a>
        </div>
    </div>
</div>