<style>
    .hero-photo {
        background:
            linear-gradient(180deg, rgba(10,15,30,0.55) 0%, rgba(10,15,30,0.85) 100%),
            url("https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1920&q=80");
        background-size: cover;
        background-position: center;
        border-radius: 1rem 1rem 0 0;
        padding: 5rem 2rem 7rem;
        text-align: center;
        color: white;
    }
    .feature-strip {
        margin-top: -4rem;
        position: relative;
        z-index: 2;
    }
    .feature-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transition: transform 0.2s ease;
    }
    .feature-card:hover {
        transform: translateY(-4px);
    }
    .feature-icon {
        font-size: 2.2rem;
        color: var(--bs-primary);
    }
</style>

<div class="hero-photo">
    <h1 class="display-4 fw-bold">Aprende PHP y JavaScript Jugando</h1>
    <p class="lead">Trivias es un sistema de preguntas y respuestas por niveles para poner a prueba tus conocimientos de desarrollo web.</p>
    <a href="<?= APP_URL ?>/register" class="btn btn-light btn-lg mt-3 fw-semibold">Regístrate Gratis</a>
</div>

<div class="row feature-strip g-3 px-3 mb-5">
    <div class="col-md-4">
        <div class="card feature-card h-100">
            <div class="card-body text-center py-4">
                <div class="feature-icon mb-2"><i class="bi bi-layers"></i></div>
                <h3 class="h5">Temas y Niveles</h3>
                <p class="text-muted mb-0">Preguntas de PHP y JavaScript por niveles: Básico, Intermedio y Avanzado.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card feature-card h-100">
            <div class="card-body text-center py-4">
                <div class="feature-icon mb-2"><i class="bi bi-trophy"></i></div>
                <h3 class="h5">Premios y Puntos</h3>
                <p class="text-muted mb-0">Gana puntos por cada acierto y desbloquea premios al completar cada nivel.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card feature-card h-100">
            <div class="card-body text-center py-4">
                <div class="feature-icon mb-2"><i class="bi bi-people"></i></div>
                <h3 class="h5">Modo Multijugador</h3>
                <p class="text-muted mb-0">Crea una sala, comparte el código, y compite con tus compañeros.</p>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-5 py-4 bg-light rounded">
    <h4>¿Listo para poner a prueba tus conocimientos?</h4>
    <a href="<?= APP_URL ?>/register" class="btn btn-primary btn-lg me-2">Crear Cuenta Gratis</a>
    <a href="<?= APP_URL ?>/login" class="btn btn-outline-primary btn-lg">Ya tengo cuenta</a>
</div>