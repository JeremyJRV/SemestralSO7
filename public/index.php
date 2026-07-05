<?php
// public/index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Cargar configuración y constantes
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/constants.php';

// Autocarga de clases (PSR-4 simple sin Composer)
spl_autoload_register(function ($class) {
    // Prefijos en minúscula/tal cual se usan en el código con "use"
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'core\\' => __DIR__ . '/../core/',
        'clases\\' => __DIR__ . '/../clases/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        // strncasecmp = comparación SIN distinguir mayúsculas/minúsculas
        if (strncasecmp($prefix, $class, $len) !== 0) {
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
clases\Session::start();

// Registrar manejador de errores
clases\ErrorHandler::register();

// Enrutamiento
$router = new clases\Router();
require_once __DIR__ . '/../routes/web.php'; // Carga las definiciones de rutas
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);