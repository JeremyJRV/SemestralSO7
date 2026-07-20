<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Trivias - Aprende jugando' ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%220%22 fill=%22%233b82f6%22/><text x=%2250%22 y=%2265%22 font-size=%2255%22 fill=%22white%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-weight=%22bold%22>T</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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
            --shadow-hard: 6px 6px 0px rgba(26, 38, 52, 0.15);
            --shadow-hard-hover: 8px 8px 0px rgba(26, 38, 52, 0.2);
            --radius: 12px;
            --radius-sm: 6px;
            --font-display: 'Space Grotesk', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
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
            display: flex;
            flex-direction: column;
        }

        body::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 500px;
            height: 500px;
            background: rgba(59, 130, 246, 0.03);
            transform: rotate(45deg);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: rgba(59, 130, 246, 0.02);
            transform: rotate(-30deg);
            pointer-events: none;
            z-index: 0;
        }

        .main-content {
            flex: 1;
        }

        /* ============================================
           NAVBAR
        ============================================ */
        .navbar-innovative {
            background: var(--bg-card);
            border-bottom: 3px solid var(--border-dark);
            padding: 0.7rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-hard);
        }

        .navbar-innovative .navbar-brand {
            font-family: var(--font-display);
            font-weight: 900;
            font-size: 1.6rem;
            color: var(--text-dark);
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .navbar-innovative .navbar-brand i {
            color: var(--primary);
            margin-right: 0.5rem;
            font-size: 1.8rem;
            display: inline-block;
            transform: rotate(-8deg);
        }

        .navbar-innovative .navbar-brand span {
            color: var(--primary);
            position: relative;
        }

        .navbar-innovative .navbar-brand span::after {
            content: '';
            font-size: 0.6rem;
            margin-left: 2px;
            color: var(--primary);
        }

        .navbar-innovative .nav-link {
            font-family: var(--font-display);
            font-weight: 600;
            color: var(--text-gray) !important;
            padding: 0.5rem 1.2rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            border: 2px solid transparent;
            border-radius: var(--radius-sm);
        }

        .navbar-innovative .nav-link:hover {
            color: var(--text-dark) !important;
            background: #dbeafe;
            border: 2px solid var(--border-dark);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--border-dark);
        }

        .navbar-innovative .nav-link.active {
            color: var(--text-dark) !important;
            background: var(--primary-light);
            border: 2px solid var(--border-dark);
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--border-dark);
        }

        .btn-primary-innovative {
            background: var(--primary);
            color: white !important;
            font-family: var(--font-display);
            font-weight: 700;
            padding: 0.5rem 1.8rem;
            border: 3px solid var(--border-dark);
            transition: all 0.15s ease;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 4px 4px 0px var(--border-dark);
            position: relative;
            border-radius: var(--radius-sm);
        }

        .btn-primary-innovative:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px var(--border-dark);
            color: white !important;
            background: var(--primary);
        }

        .btn-primary-innovative:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px var(--border-dark);
        }

        .btn-outline-innovative {
            background: transparent;
            border: 3px solid var(--border-dark);
            color: var(--text-gray);
            font-family: var(--font-display);
            font-weight: 600;
            padding: 0.4rem 1.5rem;
            transition: all 0.15s ease;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: var(--radius-sm);
        }

        .btn-outline-innovative:hover {
            background: var(--border-dark);
            color: white;
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px var(--primary);
        }

        /* ============================================
           CARDS
        ============================================ */
        .card-innovative {
            background: var(--bg-card);
            border: 3px solid var(--border-dark);
            transition: all 0.2s ease;
            box-shadow: var(--shadow-hard);
            position: relative;
            border-radius: var(--radius);
        }

        .card-innovative:hover {
            transform: translate(-3px, -3px);
            box-shadow: var(--shadow-hard-hover);
        }

        /* ============================================
           FOOTER
        ============================================ */
        .footer-innovative {
            background: var(--primary-darker);
            padding: 2.5rem 0;
            margin-top: 4rem;
            border-top: 4px solid var(--primary);
            position: relative;
        }

        .footer-innovative::before {
            content: '';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            padding: 0 1.5rem;
            width: 60px;
            height: 4px;
        }

        .footer-innovative small {
            color: rgba(255, 255, 255, 0.5);
            font-family: var(--font-mono);
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .footer-innovative small span {
            color: var(--primary);
            font-weight: 700;
        }

        /* ============================================
           BADGES
        ============================================ */
        .badge-innovative {
            background: var(--primary-light);
            color: var(--primary);
            padding: 0.3rem 1rem;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 2px solid var(--border-dark);
            font-family: var(--font-mono);
            border-radius: var(--radius-sm);
        }

        /* ============================================
           DECORATIVE ELEMENTS
        ============================================ */
        .corner-tag {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--primary);
            color: white;
            padding: 0.2rem 1rem;
            font-family: var(--font-mono);
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid var(--border-dark);
            transform: rotate(3deg);
            border-radius: var(--radius-sm);
        }

        .corner-tag-left {
            position: absolute;
            bottom: -10px;
            left: -10px;
            background: var(--border-dark);
            color: white;
            padding: 0.2rem 0.8rem;
            font-family: var(--font-mono);
            font-size: 0.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transform: rotate(-2deg);
            border-radius: var(--radius-sm);
        }

        .divider-innovative {
            border: none;
            border-top: 3px solid var(--border-dark);
            margin: 2rem 0;
            position: relative;
        }

        .divider-innovative::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--bg-page);
            padding: 0 1rem;
            width: 12px;
            height: 12px;
            background: var(--primary);
            border: 2px solid var(--border-dark);
            transform: translate(-50%, -50%) rotate(45deg);
        }

        /* ============================================
           UTILITY
        ============================================ */
        .text-primary-innovative {
            color: var(--primary);
        }

        .text-gray-innovative {
            color: var(--text-gray);
        }

        .bg-primary-light {
            background: var(--primary-light);
        }

        /* Scrollbar */
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

        /* Animacion */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) rotate(-0.5deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) rotate(0deg);
            }
        }

        .animate-slide {
            animation: slideIn 0.5s ease forwards;
        }

        @media (max-width: 768px) {
            .navbar-innovative .navbar-brand {
                font-size: 1.2rem;
            }

            .card-innovative {
                padding: 1.5rem;
            }

            .footer-innovative {
                padding: 2rem 0;
            }

            .footer-innovative small {
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-innovative">
        <div class="container">
            <a class="navbar-brand" href="<?= APP_URL ?>/">
                <i class="bi bi-controller"></i>Trivias<span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>" href="<?= APP_URL ?>/">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>" href="<?= APP_URL ?>/about">
                            Acerca de
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'team' ? 'active' : '' ?>" href="<?= APP_URL ?>/team">
                            Sobre nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>" href="<?= APP_URL ?>/contact">
                            Contacto
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="btn btn-outline-innovative" href="<?= APP_URL ?>/login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-innovative" href="<?= APP_URL ?>/register">
                            <i class="bi bi-person-plus me-1"></i>Registro
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container mt-4 animate-slide">
            <?= $content ?? '' ?>
        </div>
    </div>

    <footer class="footer-innovative">
        <div class="container text-center">
            <small>&copy; <?= date('Y') ?> <span>Trivias</span> — Desarrollo de Software VII - Proyecto Semestral</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>