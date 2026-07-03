<?php
// Configuración general de la aplicación
define('APP_NAME', 'Sistema de Trivias');
define('APP_URL', 'http://localhost/trivias/public'); // Ajustar según entorno
define('APP_ENV', 'development'); // development, production

// Configuración de sesiones (si se quiere personalizar)
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // 1 si usas HTTPS