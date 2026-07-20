<style>
    /* ============================================
       HERO PRINCIPAL
    ============================================ */
    .hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 4rem 2rem 5rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
        border-radius: var(--radius);
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
        border-radius: var(--radius-sm);
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
        border-radius: var(--radius-sm);
    }

    .hero-innovative .hero-badge i {
        margin-right: 0.4rem;
    }

    .hero-innovative .hero-title {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 3.2rem;
        color: var(--text-dark);
        line-height: 1.05;
        letter-spacing: -2px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .hero-innovative .hero-title span {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .hero-innovative .hero-sub {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.8rem;
    }

    .hero-innovative .hero-sub i {
        color: var(--primary);
        margin: 0 0.3rem;
    }

    .hero-innovative .lead {
        color: var(--text-gray);
        font-size: 1.15rem;
        max-width: 700px;
        margin: 0 auto 1.8rem;
        font-weight: 400;
        font-family: var(--font-display);
        line-height: 1.7;
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
        border-radius: var(--radius-sm);
        display: inline-block;
        text-decoration: none;
    }

    .btn-hero-innovative:hover {
        background: var(--primary);
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    /* ============================================
       SECCION: QUE ES TRIVIAS
    ============================================ */
    .about-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
        position: relative;
    }

    .about-section-innovative .section-tag {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.15rem 1rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-bottom: 1rem;
    }

    .about-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .about-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 1rem;
    }

    .about-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .about-section-innovative .about-text {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }

    .about-audience-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 0.8rem;
        margin-top: 0.5rem;
    }

    .about-audience-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1rem;
        background: var(--primary-lighter);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        font-family: var(--font-display);
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .about-audience-item:hover {
        border-color: var(--border-dark);
        background: var(--primary-light);
        transform: translateX(4px);
    }

    .about-audience-item i {
        color: var(--primary);
        font-size: 1.1rem;
    }

    /* ============================================
       SECCION: BENEFICIOS
    ============================================ */
    .benefits-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .benefits-section-innovative .section-tag {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.15rem 1rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-bottom: 1rem;
    }

    .benefits-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .benefits-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .benefits-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .benefits-section-innovative .benefits-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.2rem;
    }

    .benefit-card {
        background: var(--bg-card);
        border: 2px solid var(--border-light);
        padding: 1.5rem 1.2rem;
        transition: all 0.2s ease;
        border-radius: var(--radius-sm);
        position: relative;
    }

    .benefit-card:hover {
        border-color: var(--border-dark);
        transform: translateY(-4px);
        box-shadow: var(--shadow-hard);
    }

    .benefit-card .benefit-icon {
        width: 52px;
        height: 52px;
        background: var(--primary-light);
        border: 2px solid var(--border-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--primary);
        margin-bottom: 0.8rem;
        transition: all 0.2s ease;
    }

    .benefit-card:hover .benefit-icon {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    .benefit-card h5 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    .benefit-card p {
        font-family: var(--font-display);
        font-size: 0.85rem;
        color: var(--text-gray);
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* ============================================
       SECCION: TEMAS DISPONIBLES
    ============================================ */
    .topics-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .topics-section-innovative .section-tag {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.15rem 1rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-bottom: 1rem;
    }

    .topics-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .topics-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .topics-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .topics-section-innovative .topics-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .topics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .topic-card {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem 1.2rem;
        background: var(--primary-lighter);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
        font-family: var(--font-display);
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
    }

    .topic-card:hover {
        border-color: var(--border-dark);
        background: var(--primary-light);
        transform: translateX(4px);
    }

    .topic-card i {
        color: var(--primary);
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
    }

    .topic-card .topic-badge {
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        padding: 0.1rem 0.5rem;
        background: var(--primary);
        color: white;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-left: auto;
    }

    /* ============================================
       SECCION: NOVEDADES
    ============================================ */
    .news-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .news-section-innovative .section-tag {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.15rem 1rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-bottom: 1rem;
    }

    .news-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .news-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .news-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .news-section-innovative .news-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .news-list {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    .news-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.8rem 1.2rem;
        background: var(--primary-lighter);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
    }

    .news-item:hover {
        border-color: var(--border-dark);
        background: var(--primary-light);
        transform: translateX(4px);
    }

    .news-item .news-date {
        font-family: var(--font-mono);
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--primary);
        background: var(--bg-card);
        padding: 0.2rem 0.8rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        white-space: nowrap;
        min-width: 90px;
        text-align: center;
    }

    .news-item .news-date i {
        margin-right: 0.3rem;
    }

    .news-item .news-text {
        font-family: var(--font-display);
        font-size: 0.9rem;
        color: var(--text-dark);
        font-weight: 500;
    }

    .news-item .news-text i {
        color: var(--primary);
        margin-right: 0.3rem;
    }

    .news-item .news-badge {
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        padding: 0.15rem 0.6rem;
        background: var(--primary);
        color: white;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        margin-left: auto;
        white-space: nowrap;
    }

    /* ============================================
       FEATURES
    ============================================ */
    .feature-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.2s ease;
        height: 100%;
        box-shadow: var(--shadow-hard);
        position: relative;
        border-radius: var(--radius);
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
        border-radius: var(--radius-sm);
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
        border-radius: 50%;
    }

    .feature-card-innovative:hover .feature-icon-innovative {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
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

    /* ============================================
       CTA FINAL
    ============================================ */
    .cta-innovative {
        background: var(--primary-darker);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
        border-radius: var(--radius);
    }

    .cta-innovative::before {
        content: '';
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
        border-radius: var(--radius-sm);
        width: 60px;
        height: 4px;
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
        border-radius: var(--radius-sm);
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
        border-radius: var(--radius-sm);
        display: inline-block;
        text-decoration: none;
    }

    .cta-innovative .btn-cta-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.3);
        transform: translate(-3px, -3px);
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 992px) {
        .hero-innovative .hero-title {
            font-size: 2.6rem;
        }
        .hero-innovative .hero-sub {
            font-size: 1.1rem;
        }
        .benefits-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .topics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .hero-innovative {
            padding: 3rem 1.5rem;
        }
        .hero-innovative .hero-title {
            font-size: 2rem;
        }
        .hero-innovative .hero-sub {
            font-size: 1rem;
        }
        .hero-innovative .lead {
            font-size: 1rem;
        }
        .about-section-innovative,
        .benefits-section-innovative,
        .topics-section-innovative,
        .news-section-innovative {
            padding: 1.8rem 1.2rem;
        }
        .about-section-innovative h3,
        .benefits-section-innovative h3,
        .topics-section-innovative h3,
        .news-section-innovative h3 {
            font-size: 1.3rem;
        }
        .benefits-grid {
            grid-template-columns: 1fr;
        }
        .topics-grid {
            grid-template-columns: 1fr 1fr;
        }
        .about-audience-grid {
            grid-template-columns: 1fr 1fr;
        }
        .news-item {
            flex-wrap: wrap;
        }
        .news-item .news-badge {
            margin-left: 0;
        }
        .feature-card-innovative {
            padding: 1.5rem;
        }
        .cta-innovative {
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .hero-innovative .hero-title {
            font-size: 1.6rem;
        }
        .hero-innovative .hero-sub {
            font-size: 0.9rem;
        }
        .about-audience-grid {
            grid-template-columns: 1fr;
        }
        .topics-grid {
            grid-template-columns: 1fr;
        }
        .news-item .news-date {
            min-width: auto;
            font-size: 0.6rem;
        }
        .btn-hero-innovative {
            padding: 0.7rem 2rem;
            font-size: 0.9rem;
        }
    }
</style>

<!-- ============================================
     HTML - LANDING PAGE
============================================ -->

<!-- HERO -->
<div class="hero-innovative mb-5">
    <span class="corner-deco">v1.0</span>
    <div class="hero-content">
        <div class="hero-badge">
            <i class="bi bi-star-fill"></i> Aprendizaje Gamificado
        </div>
        <h1 class="hero-title">Bienvenido a <span>Trivias</span></h1>
        <p class="hero-sub">
            <i class="bi bi-arrow-right-short"></i> Aprende programacion jugando <i class="bi bi-arrow-right-short"></i> Refuerza tus conocimientos
        </p>
        <p class="lead">
            Plataforma de preguntas y respuestas por niveles para poner a prueba
            y reforzar tus conocimientos en lenguajes de programacion y frameworks.
            PHP, JavaScript, Laravel y mas.
        </p>
        <a href="<?= APP_URL ?>/register" class="btn-hero-innovative">
            <i class="bi bi-rocket-takeoff me-2"></i>Comenzar ahora
        </a>
    </div>
</div>

<!-- ============================================
     SECCION: QUE ES TRIVIAS
============================================ -->
<div class="about-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-info-circle"></i> Que es</span>
    <h3><i class="bi bi-controller"></i> Que es Trivias</h3>
    <p class="about-text">
        Trivias es una plataforma de aprendizaje gamificado que combina preguntas
        y respuestas con un sistema de niveles, puntos y premios. Esta disenada
        para ayudarte a reforzar y evaluar tus conocimientos en programacion de
        forma entretenida y efectiva.
    </p>
    <p class="about-text" style="margin-bottom: 0.8rem;">
        Ideal para:
    </p>
    <div class="about-audience-grid">
        <span class="about-audience-item">
            <i class="bi bi-mortarboard"></i> Estudiantes
        </span>
        <span class="about-audience-item">
            <i class="bi bi-code-square"></i> Desarrolladores
        </span>
        <span class="about-audience-item">
            <i class="bi bi-building"></i> Empresas
        </span>
        <span class="about-audience-item">
            <i class="bi bi-person-workspace"></i> Profesionales de TI
        </span>
    </div>
</div>

<!-- ============================================
     SECCION: BENEFICIOS
============================================ -->
<div class="benefits-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-graph-up"></i> Beneficios</span>
    <h3><i class="bi bi-trophy"></i> Por que usar Trivias</h3>
    <p class="benefits-sub">
        Una forma dinamica y efectiva de aprender y evaluar tus habilidades.
    </p>

    <div class="benefits-grid">
        <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-clock-history"></i></div>
            <h5>Aprende jugando</h5>
            <p>Pon a prueba tus conocimientos con preguntas de programacion. Cada respuesta correcta te acerca al siguiente nivel.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-arrow-repeat"></i></div>
            <h5>Progreso a tu ritmo</h5>
            <p>Avanza cuando estes listo. Cada nivel se desbloquea al superar el 80% de aciertos.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-award"></i></div>
            <h5>Recompensas y premios</h5>
            <p>Gana puntos y desbloquea premios por cada nivel completado. Un incentivo para seguir aprendiendo.</p>
        </div>
        <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-gear"></i></div>
            <h5>Contenido variado</h5>
            <p>Diferentes temas y niveles de dificultad. Desde fundamentos hasta temas avanzados.</p>
        </div>
    </div>
</div>

<!-- ============================================
     SECCION: TEMAS DISPONIBLES
============================================ -->
<div class="topics-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-collection"></i> Temas</span>
    <h3><i class="bi bi-book"></i> Temas Disponibles</h3>
    <p class="topics-sub">
        Explora los diferentes temas de programacion disponibles en la plataforma.
    </p>

    <div class="topics-grid">
        <div class="topic-card">
            <i class="bi bi-filetype-php"></i>
            PHP
            <span class="topic-badge">Disponible</span>
        </div>
        <div class="topic-card">
            <i class="bi bi-filetype-js"></i>
            JavaScript
            <span class="topic-badge">Disponible</span>
        </div>
        <div class="topic-card">
            <i class="bi bi-box"></i>
            Laravel
            <span class="topic-badge">Proximo</span>
        </div>
        <div class="topic-card">
            <i class="bi bi-database"></i>
            Bases de Datos
            <span class="topic-badge">Proximo</span>
        </div>
        <div class="topic-card">
            <i class="bi bi-braces"></i>
            Estructuras de Datos
            <span class="topic-badge">Proximo</span>
        </div>
        <div class="topic-card">
            <i class="bi bi-terminal"></i>
            Algoritmos
            <span class="topic-badge">Proximo</span>
        </div>
    </div>
</div>

<!-- ============================================
     SECCION: NOVEDADES
============================================ -->
<div class="news-section-innovative mb-5">
    <span class="section-tag"><i class="bi bi-megaphone"></i> Novedades</span>
    <h3><i class="bi bi-newspaper"></i> Ultimas Novedades</h3>
    <p class="news-sub">Mantente al dia con las mejoras y actualizaciones de la plataforma.</p>

    <div class="news-list">
        <?php
        $newsItems = [
            ['date' => '15/07/2026', 'text' => 'Nuevo tema: "JavaScript Avanzado" disponible', 'badge' => 'Nuevo'],
            ['date' => '05/07/2026', 'text' => 'Se agregaron 20 nuevas preguntas de PHP', 'badge' => 'Actualizacion'],
            ['date' => '01/07/2026', 'text' => 'Lanzamiento del sistema de premios y logros', 'badge' => 'Lanzamiento'],
        ];
        ?>
        <?php foreach ($newsItems as $item): ?>
            <div class="news-item">
                <span class="news-date"><i class="bi bi-calendar3"></i> <?= $item['date'] ?></span>
                <span class="news-text">
                    <i class="bi bi-arrow-right-short"></i> <?= htmlspecialchars($item['text']) ?>
                </span>
                <span class="news-badge"><?= $item['badge'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ============================================
     CTA FINAL
============================================ -->
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