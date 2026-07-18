<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard - Trivias' ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%220%22 fill=%22%233b82f6%22/><text x=%2250%22 y=%2265%22 font-size=%2255%22 fill=%22white%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-weight=%22bold%22>T</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f0f4fe;
            --bg-card: #ffffff;
            --primary: #3b82f6;
            --primary-dark: #1e3a5f;
            --primary-darker: #0f2136;
            --primary-light: #e8f0fe;
            --primary-lighter: #f5f8ff;
            --text-dark: #1a2634;
            --text-gray: #64748b;
            --text-light: #94a3b8;
            --border-dark: #1a2634;
            --border-medium: #cbd5e1;
            --border-light: #e2e8f0;
            --shadow-hard: 6px 6px 0px rgba(26, 38, 52, 0.12);
            --shadow-hard-hover: 8px 8px 0px rgba(26, 38, 52, 0.18);
            --radius: 0px;
            --radius-sm: 0px;
            --font-display: 'Space Grotesk', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-page);
            font-family: var(--font-display);
            min-height: 100vh;
            color: var(--text-dark);
        }

        body::before {
            content: '◆ ◆ ◆';
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: rgba(59, 130, 246, 0.04);
            font-size: 1.5rem;
            letter-spacing: 8px;
            pointer-events: none;
            z-index: 0;
            transform: rotate(-15deg);
        }

        .navbar-dash-innovative {
            background: var(--primary-darker);
            padding: 0.6rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 4px solid var(--primary);
            box-shadow: 0 6px 0px rgba(26, 38, 52, 0.2);
        }

        .navbar-dash-innovative .navbar-brand {
            font-family: var(--font-display);
            font-weight: 900;
            font-size: 1.4rem;
            color: white;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .navbar-dash-innovative .navbar-brand i {
            color: var(--primary);
            margin-right: 0.5rem;
            font-size: 1.6rem;
            transform: rotate(-8deg);
            display: inline-block;
        }

        .navbar-dash-innovative .navbar-brand span {
            color: var(--primary);
        }

        .navbar-dash-innovative .nav-link {
            font-family: var(--font-display);
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5) !important;
            padding: 0.5rem 1.2rem;
            transition: all 0.2s ease;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid transparent;
        }

        .navbar-dash-innovative .nav-link i {
            margin-right: 0.4rem;
        }

        .navbar-dash-innovative .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.12);
            border: 2px solid rgba(255, 255, 255, 0.15);
            transform: translate(-2px, -2px);
        }

        .navbar-dash-innovative .dropdown-menu {
            background: var(--bg-card);
            border: 3px solid var(--border-dark);
            border-radius: 0;
            padding: 0.5rem;
            box-shadow: var(--shadow-hard);
        }

        .navbar-dash-innovative .dropdown-item {
            font-family: var(--font-display);
            color: var(--text-gray);
            border-radius: 0;
            padding: 0.6rem 1.2rem;
            transition: all 0.2s ease;
            font-weight: 500;
            border: 2px solid transparent;
        }

        .navbar-dash-innovative .dropdown-item i {
            width: 1.4rem;
            color: var(--primary);
        }

        .navbar-dash-innovative .dropdown-item:hover {
            background: var(--primary-lighter);
            color: var(--primary);
            border: 2px solid var(--border-dark);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--border-dark);
        }

        .user-badge-dash-innovative {
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.8);
            padding: 0.3rem 1.2rem;
            font-family: var(--font-mono);
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: 0.3px;
        }

        .user-badge-dash-innovative i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .btn-logout-dash-innovative {
            background: rgba(239, 68, 68, 0.12);
            border: 2px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            font-family: var(--font-display);
            font-weight: 600;
            padding: 0.4rem 1.2rem;
            transition: all 0.2s ease;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-logout-dash-innovative:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px rgba(239, 68, 68, 0.3);
        }

        .card-innovative {
            background: var(--bg-card);
            border: 3px solid var(--border-dark);
            transition: all 0.2s ease;
            box-shadow: var(--shadow-hard);
            overflow: visible;
            position: relative;
        }

        .card-innovative:hover {
            transform: translate(-3px, -3px);
            box-shadow: var(--shadow-hard-hover);
        }

        .card-innovative .card-header {
            background: var(--primary-lighter);
            border-bottom: 3px solid var(--border-dark);
            padding: 1rem 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            font-family: var(--font-display);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .card-innovative .card-header i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .card-innovative .card-body {
            padding: 1.5rem;
        }

        .table-innovative {
            background: transparent;
            border-collapse: collapse;
        }

        .table-innovative thead th {
            background: var(--primary-darker);
            color: white;
            border: none;
            padding: 0.7rem 1rem;
            font-family: var(--font-mono);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .table-innovative tbody tr {
            background: var(--bg-card);
            border-bottom: 2px solid var(--border-light);
            transition: all 0.2s ease;
        }

        .table-innovative tbody tr:hover {
            background: var(--primary-lighter);
            transform: translateX(4px);
            border-left: 4px solid var(--primary);
        }

        .table-innovative tbody td {
            border: none;
            padding: 0.7rem 1rem;
            vertical-align: middle;
            color: var(--text-gray);
            font-weight: 500;
        }

        .badge-innovative {
            background: var(--primary-light);
            color: var(--primary);
            padding: 0.25rem 0.8rem;
            font-weight: 700;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid var(--border-dark);
            font-family: var(--font-mono);
        }

        .badge-innovative-success {
            background: #dcfce7;
            color: #16a34a;
            border-color: #16a34a;
        }

        .badge-innovative-warning {
            background: #fef3c7;
            color: #d97706;
            border-color: #d97706;
        }

        .badge-innovative-danger {
            background: #fee2e2;
            color: #dc2626;
            border-color: #dc2626;
        }

        .text-primary-innovative {
            color: var(--primary);
        }

        .text-gray-innovative {
            color: var(--text-gray);
        }

        .bg-primary-light {
            background: var(--primary-light);
        }

        .bg-primary-lighter {
            background: var(--primary-lighter);
        }

        .border-dark-custom {
            border-color: var(--border-dark) !important;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-page);
            border-left: 2px solid var(--border-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border: 2px solid var(--border-dark);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide {
            animation: slideIn 0.4s ease forwards;
        }

        @media (max-width: 768px) {
            .card-innovative .card-body {
                padding: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dash-innovative">
        <div class="container">
            <a class="navbar-brand" href="<?= APP_URL ?>/dashboard">
                <i class="bi bi-controller"></i>Trivias<span>.</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APP_URL ?>/game">
                            <i class="bi bi-joystick"></i>Jugar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APP_URL ?>/profile">
                            <i class="bi bi-person-circle"></i>Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APP_URL ?>/statistics">
                            <i class="bi bi-bar-chart-line"></i>Stats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= APP_URL ?>/ranking">
                            <i class="bi bi-trophy"></i>Ranking
                        </a>
                    </li>
                    <?php if (in_array($role ?? 'guest', ['armador', 'admin'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-gear"></i>Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/users"><i class="bi bi-people"></i>Usuarios</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/themes"><i class="bi bi-collection"></i>Temas</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/questions"><i class="bi bi-question-circle"></i>Preguntas</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/prizes"><i class="bi bi-trophy"></i>Premios</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/surveys"><i class="bi bi-clipboard-data"></i>Encuestas</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/qr"><i class="bi bi-qr-code"></i>Códigos QR</a></li>
                                <?php if (($role ?? 'guest') === 'admin'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= APP_URL ?>/admin/report"><i class="bi bi-file-earmark-excel"></i>Reporte Excel</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <span class="user-badge-dash-innovative">
                            <i class="bi bi-person-fill"></i>
                            <?= htmlspecialchars($authUser->username ?? 'Usuario') ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-logout-dash-innovative" href="<?= APP_URL ?>/logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5 animate-slide">
        <?= $content ?? '' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>