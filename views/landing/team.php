<style>
    /* ============================================
       HERO DE EQUIPO
    ============================================ */
    .team-hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem 4rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
        border-radius: var(--radius);
    }

    .team-hero-innovative .corner-tag {
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

    .team-hero-innovative .bg-icon {
        position: absolute;
        font-size: 10rem;
        color: rgba(59, 130, 246, 0.03);
        top: -10px;
        right: 20px;
        pointer-events: none;
        font-family: var(--font-mono);
        transform: rotate(5deg);
    }

    .team-hero-innovative h1 {
        font-family: var(--font-display);
        font-weight: 900;
        color: var(--text-dark);
        position: relative;
        z-index: 1;
        letter-spacing: -1px;
        text-transform: uppercase;
        font-size: 2.8rem;
    }

    .team-hero-innovative h1 span {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .team-hero-innovative .lead {
        color: var(--text-gray);
        position: relative;
        z-index: 1;
        font-family: var(--font-display);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0.5rem auto 0;
    }

    /* ============================================
       SECCION: DESCRIPCION DEL EQUIPO
    ============================================ */
    .team-description-section {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
        text-align: center;
    }

    .team-description-section .section-tag {
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

    .team-description-section .section-tag i {
        margin-right: 0.4rem;
    }

    .team-description-section h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 1rem;
    }

    .team-description-section h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .team-description-section .team-text {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1.05rem;
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    /* ============================================
       SECCION: INFORMACION DEL PROYECTO
    ============================================ */
    .project-info-section {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .project-info-section .section-tag {
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

    .project-info-section .section-tag i {
        margin-right: 0.4rem;
    }

    .project-info-section h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .project-info-section h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .project-info-section .project-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .project-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .project-info-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem 1.2rem;
        background: var(--primary-lighter);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        transition: all 0.2s ease;
    }

    .project-info-item:hover {
        border-color: var(--border-dark);
        background: var(--primary-light);
        transform: translateX(4px);
    }

    .project-info-item .project-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        background: var(--bg-card);
        border: 2px solid var(--border-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .project-info-item:hover .project-icon {
        background: var(--primary);
        color: white;
    }

    .project-info-item .project-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--text-light);
    }

    .project-info-item .project-value {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* ============================================
       TARJETAS DE INTEGRANTES
    ============================================ */
    .team-grid-section {
        padding: 2.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        border-radius: var(--radius);
    }

    .team-grid-section .section-tag {
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

    .team-grid-section .section-tag i {
        margin-right: 0.4rem;
    }

    .team-grid-section h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.6rem;
        color: var(--text-dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .team-grid-section h3 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .team-grid-section .team-sub {
        color: var(--text-gray);
        font-family: var(--font-display);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }

    .team-card {
        background: var(--bg-card);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        padding: 1.8rem 1.2rem 1.5rem;
        text-align: center;
        transition: all 0.2s ease;
    }

    .team-card:hover {
        border-color: var(--border-dark);
        transform: translateY(-4px);
        box-shadow: var(--shadow-hard);
    }

    .team-card .team-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid var(--border-dark);
        background: var(--primary-lighter);
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: var(--primary);
        font-weight: 700;
        font-family: var(--font-display);
        overflow: hidden;
        box-shadow: 4px 4px 0px var(--border-dark);
        transition: all 0.2s ease;
    }

    .team-card:hover .team-photo {
        transform: scale(1.05);
        box-shadow: 6px 6px 0px var(--border-dark);
    }

    .team-card .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-card .team-name {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-dark);
        margin-bottom: 0.1rem;
    }

    .team-card .team-cedula {
        font-family: var(--font-mono);
        font-size: 0.75rem;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }

    .team-card .team-cedula i {
        margin-right: 0.3rem;
    }

    .team-card .team-role {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.2rem 1rem;
        border: 2px solid var(--border-dark);
        border-radius: var(--radius-sm);
    }

    .team-card .team-role i {
        margin-right: 0.3rem;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .team-hero-innovative {
            padding: 2rem 1.5rem 3rem;
        }
        .team-hero-innovative h1 {
            font-size: 2rem;
        }
        .team-hero-innovative .lead {
            font-size: 1rem;
        }
        .team-description-section,
        .project-info-section,
        .team-grid-section {
            padding: 1.8rem 1.2rem;
        }
        .team-description-section h3,
        .project-info-section h3,
        .team-grid-section h3 {
            font-size: 1.3rem;
        }
        .team-grid {
            grid-template-columns: 1fr 1fr;
        }
        .project-info-grid {
            grid-template-columns: 1fr 1fr;
        }
        .team-card .team-photo {
            width: 80px;
            height: 80px;
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {
        .team-hero-innovative h1 {
            font-size: 1.6rem;
        }
        .team-grid {
            grid-template-columns: 1fr;
        }
        .project-info-grid {
            grid-template-columns: 1fr;
        }
        .team-card .team-photo {
            width: 70px;
            height: 70px;
            font-size: 1.5rem;
        }
    }
</style>

<!-- ============================================
     HTML - SOBRE NOSOTROS
============================================ -->

<!-- HERO -->
<div class="team-hero-innovative mb-5">
    <span class="corner-tag">team</span>
    <div class="bg-icon">&#9679;</div>
    <h1>Sobre <span>Nosotros</span></h1>
    <p class="lead">El equipo y el proyecto detras de Trivias</p>
</div>

<!-- ============================================
     SECCION: DESCRIPCION DEL EQUIPO
============================================ -->
<div class="team-description-section mb-4">
    <span class="section-tag"><i class="bi bi-people"></i> Equipo</span>
    <h3><i class="bi bi-rocket"></i> Quienes Somos</h3>
    <p class="team-text">
        Somos un equipo de estudiantes de la Universidad Tecnologica de Panama,
        comprometidos con el desarrollo de soluciones educativas innovadoras.
        Trivias nace como un proyecto academico para poner en practica nuestros
        conocimientos en desarrollo de software.
    </p>
</div>

<!-- ============================================
     SECCION: INFORMACION DEL PROYECTO
============================================ -->
<div class="project-info-section mb-4">
    <span class="section-tag"><i class="bi bi-info-circle"></i> Proyecto</span>
    <h3><i class="bi bi-clipboard-data"></i> Informacion del Proyecto</h3>
    <p class="project-sub">Detalles academicos del desarrollo de Trivias.</p>

    <div class="project-info-grid">
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-mortarboard"></i></div>
            <div>
                <div class="project-label">Proyecto</div>
                <div class="project-value">Proyecto Semestral</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-book"></i></div>
            <div>
                <div class="project-label">Materia</div>
                <div class="project-value">Desarrollo de Software VII</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-person"></i></div>
            <div>
                <div class="project-label">Profesora</div>
                <div class="project-value">Irina Fong</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-building"></i></div>
            <div>
                <div class="project-label">Universidad</div>
                <div class="project-value">Universidad Tecnologica de Panama</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-laptop"></i></div>
            <div>
                <div class="project-label">Facultad</div>
                <div class="project-value">Ingenieria en Sistemas Computacionales</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-calendar"></i></div>
            <div>
                <div class="project-label">Año</div>
                <div class="project-value">2026</div>
            </div>
        </div>
        <div class="project-info-item">
            <div class="project-icon"><i class="bi bi-people"></i></div>
            <div>
                <div class="project-label">Grupo</div>
                <div class="project-value">1GS133</div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     SECCION: TARJETAS DE INTEGRANTES
============================================ -->
<div class="team-grid-section mb-5">
    <span class="section-tag"><i class="bi bi-person-badge"></i> Integrantes</span>
    <h3><i class="bi bi-person"></i> Nuestro Equipo</h3>
    <p class="team-sub">Tres estudiantes, un objetivo: crear una herramienta de aprendizaje efectiva.</p>

    <div class="team-grid">

        <!-- Integrante 1 -->
        <div class="team-card">
            <div class="team-photo">
                <img src="/SEMESTRALSO7/images/team/daniel.png" alt="Daniel Comrie" onerror="this.style.display='none'; this.parentElement.innerHTML='DC'">
            </div>
            <div class="team-name">Daniel Comrie</div>
            <div class="team-cedula"><i class="bi bi-card-text"></i> Cedula:</div>
            <span class="team-role"><i class="bi bi-code"></i> Desarrollador Backend</span>
        </div>

        <!-- Integrante 2 -->
        <div class="team-card">
            <div class="team-photo">
                <img src="/SEMESTRALSO7/images/team/jeremy.png" alt="Jeremy Rodriguez" onerror="this.style.display='none'; this.parentElement.innerHTML='JR'">
            </div>
            <div class="team-name">Jeremy Rodriguez</div>
            <div class="team-cedula"><i class="bi bi-card-text"></i> Cedula:</div>
            <span class="team-role"><i class="bi bi-window"></i> Desarrollador Frontend</span>
        </div>

        <!-- Integrante 3 -->
        <div class="team-card">
            <div class="team-photo">
                <img src="/SEMESTRALSO7/images/team/luis.png" alt="Luis De Leon" onerror="this.style.display='none'; this.parentElement.innerHTML='LD'">
            </div>
            <div class="team-name">Luis De Leon</div>
            <div class="team-cedula"><i class="bi bi-card-text"></i> Cedula:</div>
            <span class="team-role"><i class="bi bi-palette"></i> Diseñador UI/UX</span>
        </div>

    </div>
</div>