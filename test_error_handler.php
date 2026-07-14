<?php
// test_error_handler.php
// -------------------------------------------------------------
// Script DESECHABLE para probar que ErrorHandlerInterface y
// ValidatorInterface quedaron bien conectados.
//
// Uso: colócalo en la raíz del proyecto (junto a
// regenerate_signatures.php) y visítalo desde el navegador:
//
//   http://localhost/SemestralSO7/test_error_handler.php
//
// BÓRRALO cuando termines de probar (igual que los demás scripts
// de prueba: nunca debe quedar accesible en producción).
// -------------------------------------------------------------

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/constants.php';

// Mismo autoloader manual que usa public/index.php
spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\' => __DIR__ . '/app/',
        'core\\' => __DIR__ . '/core/',
        'clases\\' => __DIR__ . '/clases/',
    ];
    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncasecmp($prefix, $class, $len) !== 0) continue;
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

echo "<h1>🧪 Prueba de ErrorHandler + Interfaces</h1>";

// --------------------------------------------------------------
// PRUEBA 1: ¿La interfaz y la clase cargan sin error?
// --------------------------------------------------------------
try {
    $implementsInterface = in_array(
        'clases\interfaces\ErrorHandlerInterface',
        class_implements(\clases\ErrorHandler::class)
    );
    echo "<p>✅ clases\\ErrorHandler se cargó correctamente.</p>";
    echo $implementsInterface
        ? "<p style='color:green;'>✅ ErrorHandler SÍ implementa ErrorHandlerInterface.</p>"
        : "<p style='color:red;'>❌ ErrorHandler NO está implementando la interfaz (revisa el 'implements').</p>";

    $implementsValidator = in_array(
        'clases\interfaces\ValidatorInterface',
        class_implements(\clases\Validator::class)
    );
    echo $implementsValidator
        ? "<p style='color:green;'>✅ Validator SÍ implementa ValidatorInterface.</p>"
        : "<p style='color:red;'>❌ Validator NO está implementando la interfaz.</p>";

} catch (\Throwable $e) {
    echo "<p style='color:red;'>❌ Error al cargar las clases: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Revisa que las rutas de archivos sean correctas:<br>";
    echo "- clases/interfaces/ErrorHandlerInterface.php<br>";
    echo "- clases/interfaces/ValidatorInterface.php<br>";
    echo "- clases/ErrorHandler.php (con 'implements ErrorHandlerInterface')<br>";
    echo "- clases/Validator.php (con 'implements ValidatorInterface')</p>";
    exit;
}

echo "<hr>";

// --------------------------------------------------------------
// PRUEBA 2: registrar el manejador y lanzar una excepción a propósito
// --------------------------------------------------------------
echo "<p>Registrando ErrorHandler y lanzando una excepción de prueba en 2 segundos...</p>";
echo "<p><em>Si todo está bien, vas a ver un cuadro rojo con el detalle del error abajo de esta línea (porque APP_ENV = 'development'). Si ves solo 'Error interno del servidor', revisa que APP_ENV esté en 'development' en config/app.php.</em></p>";
echo "<hr>";

\clases\ErrorHandler::register();

// Esta excepción es INTENCIONAL, para comprobar que el manejador la atrapa
throw new \Exception("Esta es una excepción de PRUEBA generada por test_error_handler.php - todo funciona si ves esto en un cuadro rojo con detalles.");