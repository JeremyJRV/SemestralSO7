<?php
namespace clases;

class Router
{
    private array $routes = [];

    public function get(string $uri, string $controller, string $action): void
    {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post(string $uri, string $controller, string $action): void
    {
        $this->add('POST', $uri, $controller, $action);
    }

    private function add(string $method, string $uri, string $controller, string $action): void
    {
        $this->routes[] = compact('method', 'uri', 'controller', 'action');
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $route['uri']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === strtoupper($requestMethod) && preg_match($pattern, $uri, $matches)) {
                $controllerClass = "App\\Controllers\\{$route['controller']}";
                if (!class_exists($controllerClass)) {
                    throw new \Exception("Controlador no encontrado: $controllerClass");
                }
                $controller = new $controllerClass();
                $action = $route['action'];
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }
        http_response_code(404);
        echo "404 Página no encontrada";
    }
}