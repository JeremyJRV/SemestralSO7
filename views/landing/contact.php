<style>
    .contact-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        border-radius: 1rem;
        position: relative;
        overflow: hidden;
    }
    .contact-hero .bg-icon {
        position: absolute;
        font-size: 9rem;
        color: rgba(255,255,255,0.08);
        top: -10px;
        right: 15px;
        pointer-events: none;
    }
    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        margin-bottom: 0.75rem;
    }
    .contact-item i {
        font-size: 1.5rem;
        color: var(--bs-primary);
    }
</style>

<div class="text-center text-white py-5 px-4 mb-5 contact-hero">
    <i class="bi bi-envelope-heart bg-icon"></i>
    <h1 class="fw-bold">Contacto</h1>
    <p class="lead mb-0">¿Dudas o sugerencias? Escríbenos</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <div>
                        <div class="text-muted small">Email</div>
                        <strong>soporte@trivias.com</strong>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                        <div class="text-muted small">Ubicación</div>
                        <strong>Panamá</strong>
                    </div>
                </div>
                <div class="contact-item mb-0">
                    <i class="bi bi-mortarboard"></i>
                    <div>
                        <div class="text-muted small">Proyecto Semestral</div>
                        <strong>Desarrollo de Software VII — Grupo 1GS133</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>