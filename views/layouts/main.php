<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - Trivias' ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%230d6efd%22/><text x=%2250%22 y=%2265%22 font-size=%2255%22 fill=%22white%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-weight=%22bold%22>T</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-primary: #0d6efd;
            --brand-secondary: #6610f2;
            --brand-bg: #f4f6fb;
        }

        body {
            background-color: var(--brand-bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
        }

        .navbar-brand {
            letter-spacing: 0.5px;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .btn {
            border-radius: 0.5rem;
        }

        .table {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= APP_URL ?>/dashboard"><i class="bi bi-controller me-1"></i> Trivias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/game"><i class="bi bi-joystick me-1"></i>Jugar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/profile"><i class="bi bi-person-circle me-1"></i>Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= APP_URL ?>/statistics"><i class="bi bi-bar-chart-line me-1"></i>Estadísticas</a></li>
                    <?php if (in_array($role ?? 'guest', ['armador', 'admin'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-gear me-1"></i>Administración</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/users"><i class="bi bi-people me-2"></i>Usuarios</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/themes"><i class="bi bi-collection me-2"></i>Temas</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/questions"><i class="bi bi-question-circle me-2"></i>Preguntas</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/prizes"><i class="bi bi-trophy me-2"></i>Premios</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><span class="navbar-text text-white-50 me-2"><i class="bi bi-person-fill me-1"></i><?= htmlspecialchars($user->username ?? '') ?></span></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="<?= APP_URL ?>/logout"><i class="bi bi-box-arrow-right me-1"></i>Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4 mb-5">
        <?= $content ?? '' ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>