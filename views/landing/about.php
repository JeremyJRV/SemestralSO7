<style>
    .about-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        border-radius: 1rem;
        position: relative;
        overflow: hidden;
    }
    .about-hero .bg-icon {
        position: absolute;
        font-size: 9rem;
        color: rgba(255,255,255,0.08);
        top: -10px;
        right: 15px;
        pointer-events: none;
    }
    .step-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }
    .step-item:last-child { border-bottom: none; }
    .step-number {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        background: var(--bs-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<div class="text-center text-white py-5 px-4 mb-5 about-hero">
    <i class="bi bi-info-circle bg-icon"></i>
    <h1 class="fw-bold">Acerca de Trivias</h1>
    <p class="lead mb-0">Aprendizaje gamificado para desarrolladores web</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <p>Trivias es un sistema de aprendizaje gamificado enfocado en tecnologías web, principalmente PHP y JavaScript. Fue desarrollado como proyecto académico siguiendo los principios de arquitectura MVC, SOLID y DRY, con especial atención a las buenas prácticas de seguridad recomendadas por OWASP.</p>
                <p class="mb-0">Nuestro objetivo es que cualquier persona interesada en desarrollo web pueda reforzar sus conocimientos de forma entretenida, avanzando por niveles de dificultad y compitiendo con otros usuarios en modo multijugador.</p>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <h4 class="mb-3"><i class="bi bi-list-check me-2 text-primary"></i>¿Cómo funciona?</h4>
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div>Regístrate gratis y elige un tema.</div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div>Responde preguntas de opción múltiple o verdadero/falso.</div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div>Supera el 80% de aciertos para avanzar al siguiente nivel.</div>
                </div>
                <div class="step-item">
                    <div class="step-number">4</div>
                    <div>Gana puntos y premios conforme avanzas.</div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="<?= APP_URL ?>/register" class="btn btn-primary btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>Empezar ahora
            </a>
        </div>
    </div>
</div>