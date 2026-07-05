<style>
    .contact-hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem 4rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
    }

    .contact-hero-innovative .corner-tag {
        position: absolute;
        bottom: -8px;
        left: -8px;
        background: var(--primary-dark);
        color: white;
        padding: 0.2rem 1rem;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid var(--border-dark);
        transform: rotate(-2deg);
    }

    .contact-hero-innovative .bg-icon {
        position: absolute;
        font-size: 10rem;
        color: rgba(59, 130, 246, 0.03);
        bottom: -10px;
        left: 20px;
        pointer-events: none;
        font-family: var(--font-mono);
        transform: rotate(-10deg);
    }

    .contact-hero-innovative h1 {
        font-family: var(--font-display);
        font-weight: 900;
        color: var(--text-dark);
        position: relative;
        z-index: 1;
        letter-spacing: -1px;
        text-transform: uppercase;
    }

    .contact-hero-innovative h1 span {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-hero-innovative .lead {
        color: var(--text-gray);
        position: relative;
        z-index: 1;
        font-family: var(--font-display);
    }

    .contact-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
    }

    .contact-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .contact-item-innovative {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        padding: 1.2rem 1.2rem;
        background: var(--primary-lighter);
        margin-bottom: 0.75rem;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    .contact-item-innovative:hover {
        background: #bfdbfe;
        transform: translateX(6px);
        border: 2px solid var(--border-dark);
    }

    .contact-item-innovative:last-child {
        margin-bottom: 0;
    }

    .contact-item-innovative .icon-wrapper-innovative {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border: 3px solid var(--border-dark);
        background: var(--bg-card);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--primary);
        transition: all 0.2s ease;
        box-shadow: 4px 4px 0px rgba(26, 38, 52, 0.08);
    }

    .contact-item-innovative:hover .icon-wrapper-innovative {
        background: var(--primary);
        color: white;
        transform: rotate(-5deg) scale(1.05);
        box-shadow: 6px 6px 0px var(--border-dark);
    }

    .contact-item-innovative .label-innovative {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
    }

    .contact-item-innovative strong {
        color: var(--text-dark);
        font-size: 1.05rem;
        font-weight: 600;
        font-family: var(--font-display);
    }

    .group-badge-innovative {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.15rem 1rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-top: 0.2rem;
        border: 2px solid var(--border-dark);
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

<div class="contact-hero-innovative mb-5">
    <span class="corner-tag">✦ contact</span>
    <div class="bg-icon">✉</div>
    <h1>Contacto</h1>
    <p class="lead">¿Dudas o sugerencias? Escríbenos</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="contact-card-innovative">
            <div class="contact-item-innovative">
                <div class="icon-wrapper-innovative"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="label-innovative">Email</div>
                    <strong>soporte@trivias.com</strong>
                </div>
            </div>
            <div class="contact-item-innovative">
                <div class="icon-wrapper-innovative"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="label-innovative">Ubicación</div>
                    <strong>Panamá</strong>
                </div>
            </div>
            <div class="contact-item-innovative">
                <div class="icon-wrapper-innovative"><i class="bi bi-mortarboard"></i></div>
                <div>
                    <div class="label-innovative">Proyecto Semestral</div>
                    <strong>Desarrollo de Software VII</strong>
                    <div><span class="group-badge-innovative">Grupo 1GS133</span></div>
                </div>
            </div>
        </div>
    </div>
</div>