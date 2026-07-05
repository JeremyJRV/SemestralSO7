<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistema de Trivias' ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%230d6efd%22/><text x=%2250%22 y=%2265%22 font-size=%2255%22 fill=%22white%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-weight=%22bold%22>T</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6fb;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card {
            border: none;
            border-radius: 0.75rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= APP_URL ?>/"><i class="bi bi-controller me-1"></i>Trivias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/about">Acerca de</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/contact">Contacto</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/login">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="btn btn-primary btn-sm text-white" href="<?= APP_URL ?>/register">Registro</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?= $content ?? '' ?>
    </div>
    <footer class="text-center text-muted py-4 mt-5">
        <small>&copy; <?= date('Y') ?> Trivias — Proyecto académico Desarrollo 7</small>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>