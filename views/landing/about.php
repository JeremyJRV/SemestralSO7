<style>
    /* ============================================
       HERO DE ACERCA DE
    ============================================ */
    .about-hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem 4rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
        border-radius: var(--radius);
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
        border-radius: var(--radius-sm);
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
        font-size: 2.8rem;
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
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0.5rem auto 0;
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
        margin-bottom: 1rem;
    }

    .about-section-innovative .about-text:last-of-type {
        margin-bottom: 0;
    }

    /* ============================================
       SECCION: PARA QUIEN ES
    ============================================ */
    .audience-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .audience-section-innovative .section-tag {
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

    .audience-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .audience-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .audience-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .audience-section-innovative .audience-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .audience-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .audience-card {
        padding: 1.5rem 1.2rem;
        background: var(--bg-card);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        text-align: center;
        transition: all 0.2s ease;
    }

    .audience-card:hover {
        border-color: var(--border-dark);
        transform: translateY(-4px);
        box-shadow: var(--shadow-hard);
    }

    .audience-card .audience-icon {
        width: 56px;
        height: 56px;
        background: var(--primary-light);
        border: 2px solid var(--border-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        font-size: 1.4rem;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .audience-card:hover .audience-icon {
        background: var(--primary);
        color: white;
    }

    .audience-card h5 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 0.2rem;
    }

    .audience-card p {
        font-family: var(--font-display);
        font-size: 0.85rem;
        color: var(--text-gray);
        line-height: 1.4;
        margin-bottom: 0;
    }

    /* ============================================
       SECCION: COMO FUNCIONA
    ============================================ */
    .how-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .how-section-innovative .section-tag {
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

    .how-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .how-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .how-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .how-section-innovative .how-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
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
        border-radius: 50%;
    }

    .step-innovative:hover .step-number-innovative {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    .step-innovative .step-text {
        color: var(--text-dark);
        font-weight: 500;
        font-family: var(--font-display);
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .step-innovative .step-text small {
        display: block;
        font-weight: 400;
        color: var(--text-gray);
        font-size: 0.8rem;
    }

    /* ============================================
       SECCION: TECNOLOGIAS
    ============================================ */
    .tech-section-innovative {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .tech-section-innovative .section-tag {
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

    .tech-section-innovative .section-tag i {
        margin-right: 0.4rem;
    }

    .tech-section-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .tech-section-innovative h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .tech-section-innovative .tech-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.2rem;
    }

    .tech-tag-innovative {
        display: inline-block;
        background: var(--primary-lighter);
        color: var(--primary);
        padding: 0.3rem 1.2rem;
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 600;
        margin: 0.2rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
    }

    .tech-tag-innovative:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .tech-tag-innovative-dark {
        background: var(--primary-darker);
        color: white;
        border-color: var(--primary-darker);
    }

    .tech-tag-innovative-dark:hover {
        background: var(--primary);
        border-color: var(--border-dark);
    }

    /* ============================================
       CTA FINAL
    ============================================ */
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
        border-radius: var(--radius-sm);
        display: inline-block;
        text-decoration: none;
    }

    .btn-start-innovative:hover {
        background: var(--primary);
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px var(--border-dark);
        color: white !important;
    }

    .divider-innovative {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 2rem 0;
        position: relative;
    }

    .divider-innovative::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--bg-page);
        padding: 0 1rem;
        width: 12px;
        height: 12px;
        background: var(--primary);
        border: 2px solid var(--border-dark);
        transform: translate(-50%, -50%) rotate(45deg);
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .about-hero-innovative {
            padding: 2rem 1.5rem 3rem;
        }
        .about-hero-innovative h1 {
            font-size: 2rem;
        }
        .about-hero-innovative .lead {
            font-size: 1rem;
        }
        .about-section-innovative,
        .audience-section-innovative,
        .how-section-innovative,
        .tech-section-innovative {
            padding: 1.8rem 1.2rem;
        }
        .about-section-innovative h3,
        .audience-section-innovative h3,
        .how-section-innovative h3,
        .tech-section-innovative h3 {
            font-size: 1.3rem;
        }
        .audience-grid {
            grid-template-columns: 1fr 1fr;
        }
        .step-innovative {
            flex-wrap: wrap;
        }
        .btn-start-innovative {
            padding: 0.7rem 2rem;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .about-hero-innovative h1 {
            font-size: 1.6rem;
        }
        .audience-grid {
            grid-template-columns: 1fr;
        }
        .step-number-innovative {
            width: 36px;
            height: 36px;
            min-width: 36px;
            font-size: 0.9rem;
        }
    }
</style>

<!-- ============================================
     HTML - ACERCA DE
============================================ -->

<!-- HERO -->
<div class="about-hero-innovative mb-5">
    <span class="corner-tag">about</span>
    <div class="bg-icon">&#9675;</div>
    <h1>Acerca de <span>Trivias</span></h1>
    <p class="lead">Plataforma de preguntas y respuestas para aprender programacion</p>
</div>

<!-- ============================================
     SECCION: QUE ES TRIVIAS
============================================ -->
<div class="about-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-info-circle"></i> Que es</span>
    <h3><i class="bi bi-controller"></i> Que es Trivias</h3>
    <p class="about-text">
        Trivias es un proyecto academico desarrollado como parte de la materia
        Desarrollo de Software VII. Consiste en una plataforma de preguntas y
        respuestas organizadas por niveles, donde los usuarios pueden poner a
        prueba sus conocimientos en diferentes lenguajes de programacion.
    </p>
    <p class="about-text">
        El sistema permite a los usuarios registrarse, responder preguntas,
        ganar puntos y desbloquear premios a medida que avanzan. Es una
        herramienta disenada para hacer el aprendizaje mas interactivo y
        entretenido.
    </p>
</div>

<!-- ============================================
     SECCION: PARA QUIEN ES
============================================ -->
<div class="audience-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-person"></i> Para quien</span>
    <h3><i class="bi bi-people"></i> Para Quien es Trivias</h3>
    <p class="audience-sub">
        Trivias esta pensado para personas interesadas en la programacion.
    </p>

    <div class="audience-grid">
        <div class="audience-card">
            <div class="audience-icon"><i class="bi bi-mortarboard"></i></div>
            <h5>Estudiantes</h5>
            <p>Ideal para practicar y reforzar lo que aprendes en clase.</p>
        </div>
        <div class="audience-card">
            <div class="audience-icon"><i class="bi bi-code-square"></i></div>
            <h5>Programadores</h5>
            <p>Perfecto para evaluar y mantener actualizados tus conocimientos.</p>
        </div>
        <div class="audience-card">
            <div class="audience-icon"><i class="bi bi-person"></i></div>
            <h5>Aficionados</h5>
            <p>Para quienes estan empezando y quieren aprender de forma divertida.</p>
        </div>
    </div>
</div>

<!-- ============================================
     SECCION: COMO FUNCIONA
============================================ -->
<div class="how-section-innovative mb-4">
    <span class="section-tag"><i class="bi bi-play-circle"></i> Como funciona</span>
    <h3><i class="bi bi-list-check"></i> Como Funciona</h3>
    <p class="how-sub">Cuatro pasos para comenzar a usar Trivias.</p>

    <div class="step-innovative">
        <div class="step-number-innovative">01</div>
        <div class="step-text">
            Registrate gratis
            <small>Crea tu cuenta y accede a todas las preguntas disponibles.</small>
        </div>
    </div>
    <div class="step-innovative">
        <div class="step-number-innovative">02</div>
        <div class="step-text">
            Elige un tema
            <small>Selecciona entre PHP, JavaScript o los temas que esten disponibles.</small>
        </div>
    </div>
    <div class="step-innovative">
        <div class="step-number-innovative">03</div>
        <div class="step-text">
            Responde preguntas
            <small>Pon a prueba tus conocimientos con preguntas de opcion multiple o verdadero/falso.</small>
        </div>
    </div>
    <div class="step-innovative">
        <div class="step-number-innovative">04</div>
        <div class="step-text">
            Avanza de nivel
            <small>Supera cada nivel para desbloquear el siguiente y ganar puntos.</small>
        </div>
    </div>
</div>

<!-- ============================================
     SECCION: TECNOLOGIAS
============================================ -->
<div class="tech-section-innovative mb-5">
    <span class="section-tag"><i class="bi bi-code"></i> Tecnologias</span>
    <h3><i class="bi bi-stack"></i> Tecnologias Utilizadas</h3>
    <p class="tech-sub">
        Herramientas y tecnologias usadas en el desarrollo del proyecto.
    </p>

    <div>
        <span class="tech-tag-innovative">PHP</span>
        <span class="tech-tag-innovative tech-tag-innovative-dark">JavaScript</span>
        <span class="tech-tag-innovative">phpMyAdmin</span>
        <span class="tech-tag-innovative tech-tag-innovative-dark">WampServer</span>
        <span class="tech-tag-innovative">HTML5</span>
        <span class="tech-tag-innovative tech-tag-innovative-dark">CSS3</span>
        <span class="tech-tag-innovative">Bootstrap</span>
        <span class="tech-tag-innovative tech-tag-innovative-dark">MVC</span>
    </div>
</div>

<!-- ============================================
     CTA FINAL
============================================ -->
<div class="text-center">
    <a href="<?= APP_URL ?>/register" class="btn-start-innovative">
        <i class="bi bi-rocket-takeoff me-2"></i>Empezar ahora
    </a>
</div>