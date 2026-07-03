<?php
// public/index.php

// Cargar configuración y constantes
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';

// Autocarga de clases (PSR-4 simple sin Composer)
spl_autoload_register(function ($class) {
    // Namespace base: "App", "Core", "Clases" (si renombraste) -> mapear a carpetas
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'Core\\' => __DIR__ . '/../core/',
        'Clases\\' => __DIR__ . '/../clases/',   // Si renombraste core a clases
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// Iniciar sesión
Clases\Session::start();

// Registrar manejador de errores
Clases\ErrorHandler::register();

// Enrutamiento
$router = new Clases\Router();
require_once __DIR__ . '/../routes/web.php'; // Carga las definiciones de rutas
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);