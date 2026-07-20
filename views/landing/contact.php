<style>
    /* ============================================
       HERO DE CONTACTO
    ============================================ */
    .contact-hero-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 3rem 2rem 4rem;
        text-align: center;
        position: relative;
        box-shadow: var(--shadow-hard);
        overflow: visible;
        border-radius: var(--radius);
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
        border-radius: var(--radius-sm);
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
        font-size: 2.8rem;
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
        font-size: 1.15rem;
        margin: 0.5rem auto 0;
    }

    /* ============================================
       TARJETA DE CONTACTO
    ============================================ */
    .contact-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 2rem;
        box-shadow: var(--shadow-hard);
        transition: all 0.2s ease;
        border-radius: var(--radius);
        max-width: 640px;
        margin: 0 auto;
    }

    .contact-card-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .contact-item-innovative {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        padding: 0.9rem 1.2rem;
        background: var(--primary-lighter);
        margin-bottom: 0.6rem;
        transition: all 0.2s ease;
        border: 2px solid transparent;
        border-radius: var(--radius-sm);
    }

    .contact-item-innovative:hover {
        background: var(--primary-light);
        transform: translateX(4px);
        border: 2px solid var(--border-dark);
    }

    .contact-item-innovative:last-child {
        margin-bottom: 0;
    }

    .contact-item-innovative .icon-wrapper-innovative {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border: 3px solid var(--border-dark);
        background: var(--bg-card);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: var(--primary);
        transition: all 0.2s ease;
        box-shadow: 4px 4px 0px rgba(26, 38, 52, 0.08);
        border-radius: 50%;
    }

    .contact-item-innovative:hover .icon-wrapper-innovative {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
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
        font-size: 1rem;
        font-weight: 600;
        font-family: var(--font-display);
    }

    .contact-divider {
        border: none;
        border-top: 2px solid var(--border-light);
        margin: 1.2rem 0;
    }

    /* ============================================
       SECCION: ENLACES SOCIALES
    ============================================ */
    .contact-social-section {
        padding: 0.3rem 0;
        text-align: center;
    }

    .contact-social-section .social-label {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        display: block;
        margin-bottom: 1rem;
    }

    .contact-social-section .social-label i {
        margin-right: 0.4rem;
        color: var(--primary);
    }

    .social-buttons {
        display: flex;
        justify-content: center;
        gap: 1.2rem;
        flex-wrap: wrap;
    }

    .social-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid var(--border-dark);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 4px 4px 0px var(--border-dark);
        background: var(--bg-card);
        gap: 0.2rem;
        cursor: pointer;
    }

    .social-btn i {
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    .social-btn span {
        font-family: var(--font-display);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--text-gray);
        transition: color 0.3s ease;
    }

    .social-btn:hover {
        transform: translateY(-6px) scale(1.05);
    }

    .social-btn:hover i {
        transform: scale(1.1);
    }

    .social-btn:hover span {
        color: rgba(255,255,255,0.9);
    }

    /* GitHub */
    .social-btn.github:hover {
        box-shadow: 6px 6px 0px var(--border-dark);
        background: #24292e;
        border-color: #24292e;
    }

    .social-btn.github:hover i {
        color: white;
    }

    /* WhatsApp */
    .social-btn.whatsapp:hover {
        box-shadow: 6px 6px 0px #075e54;
        background: #25D366;
        border-color: #075e54;
    }

    .social-btn.whatsapp:hover i {
        color: white;
    }

    /* LinkedIn */
    .social-btn.linkedin:hover {
        box-shadow: 6px 6px 0px #004182;
        background: #0A66C2;
        border-color: #004182;
    }

    .social-btn.linkedin:hover i {
        color: white;
    }

    /* Facebook */
    .social-btn.facebook:hover {
        box-shadow: 6px 6px 0px #0d65d9;
        background: #1877F2;
        border-color: #0d65d9;
    }

    .social-btn.facebook:hover i {
        color: white;
    }

    /* Instagram */
    .social-btn.instagram:hover {
        box-shadow: 6px 6px 0px #c13584;
        background: #E4405F;
        border-color: #c13584;
    }

    .social-btn.instagram:hover i {
        color: white;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .contact-hero-innovative {
            padding: 2rem 1.5rem 3rem;
        }
        .contact-hero-innovative h1 {
            font-size: 2rem;
        }
        .contact-hero-innovative .lead {
            font-size: 1rem;
        }
        .contact-card-innovative {
            padding: 1.5rem;
        }
        .contact-item-innovative {
            padding: 0.7rem 1rem;
            flex-wrap: wrap;
        }
        .contact-item-innovative strong {
            font-size: 0.9rem;
        }
        .social-btn {
            width: 68px;
            height: 68px;
        }
        .social-btn i {
            font-size: 1.5rem;
        }
        .social-btn span {
            font-size: 0.45rem;
        }
        .social-buttons {
            gap: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .contact-hero-innovative h1 {
            font-size: 1.6rem;
        }
        .contact-item-innovative .icon-wrapper-innovative {
            width: 38px;
            height: 38px;
            min-width: 38px;
            font-size: 1rem;
        }
        .contact-item-innovative strong {
            font-size: 0.85rem;
        }
        .social-btn {
            width: 58px;
            height: 58px;
        }
        .social-btn i {
            font-size: 1.2rem;
        }
        .social-btn span {
            font-size: 0.4rem;
        }
        .social-buttons {
            gap: 0.6rem;
        }
    }
</style>

<!-- ============================================
     HTML - CONTACTO
============================================ -->

<!-- HERO -->
<div class="contact-hero-innovative mb-5">
    <span class="corner-tag">contact</span>
    <div class="bg-icon">&#9993;</div>
    <h1>Contacto</h1>
    <p class="lead">Ponte en contacto con nosotros</p>
</div>

<!-- ============================================
     TARJETA DE CONTACTO
============================================ -->
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="contact-card-innovative">

            <!-- EMAIL -->
            <div class="contact-item-innovative">
                <div class="icon-wrapper-innovative"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="label-innovative">Email</div>
                    <strong>soporte@trivias.com</strong>
                </div>
            </div>

            <!-- UBICACION -->
            <div class="contact-item-innovative">
                <div class="icon-wrapper-innovative"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="label-innovative">Ubicacion</div>
                    <strong>Panama</strong>
                </div>
            </div>

            <hr class="contact-divider">

            <!-- ============================================
                 SECCION: BOTONES SOCIALES
            ============================================ -->
            <div class="contact-social-section">
                <span class="social-label"><i class="bi bi-share"></i> Conecta con nosotros</span>

                <div class="social-buttons">

                    <a href="https://github.com/" target="_blank" class="social-btn github">
                        <i class="bi bi-github"></i>
                        <span>GitHub</span>
                    </a>

                    <a href="https://www.whatsapp.com/?lang=es" target="_blank" class="social-btn whatsapp">
                        <i class="bi bi-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>

                    <a href="https://www.linkedin.com/" target="_blank" class="social-btn linkedin">
                        <i class="bi bi-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>

                    <a href="https://www.facebook.com/?locale=es_LA" target="_blank" class="social-btn facebook">
                        <i class="bi bi-facebook"></i>
                        <span>Facebook</span>
                    </a>

                    <a href="https://www.instagram.com/" target="_blank" class="social-btn instagram">
                        <i class="bi bi-instagram"></i>
                        <span>Instagram</span>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>