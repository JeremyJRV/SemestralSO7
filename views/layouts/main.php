<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - Trivias' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Trivias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/game">Jugar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profile">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="/statistics">Estadísticas</a></li>
                    <?php if (in_array($role, ['armador','admin'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Administración</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/admin/users">Usuarios</a></li>
                            <li><a class="dropdown-item" href="/admin/themes">Temas</a></li>
                            <li><a class="dropdown-item" href="/admin/questions">Preguntas</a></li>
                            <li><a class="dropdown-item" href="/admin/prizes">Premios</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><span class="navbar-text"><?= htmlspecialchars($user->username) ?></span></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <?= $content ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>