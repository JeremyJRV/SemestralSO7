<?php
namespace clases;

use clases\Session;
use clases\Validator;
use App\Models\User;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        $userId = Session::get('user_id');

        // BUG CORREGIDO: antes esto se guardaba bajo la clave 'user',
        // que es la MISMA clave que usan varios controladores (ej.
        // UserController) para pasar el usuario que se está editando.
        // Como esta línea se ejecutaba justo antes del extract($data),
        // SIEMPRE sobreescribía ese 'user' con el usuario de la sesión
        // actual, sin importar qué controlador lo llamara. Por eso,
        // al editar cualquier usuario desde el panel de admin, el
        // formulario terminaba mostrando (y actualizando) al admin
        // logueado en vez del usuario seleccionado.
        //
        // Ahora se guarda bajo 'authUser', una clave separada que no
        // choca con nada que los controladores quieran pasar a sus vistas.
        $data['authUser'] = $userId ? User::find($userId) : null;
        $data['role'] = Session::get('user_role', 'guest');
        $data['csrfToken'] = Session::csrfToken();

        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            throw new \Exception("Vista no encontrada: $view");
        }

        $layout = ($userId) ? 'layouts/main' : 'layouts/guest';
        $content = '';
        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require __DIR__ . '/../views/' . $layout . '.php';
    }

    protected function redirect(string $url): void
    {
        // Si es una ruta interna (empieza con "/"), le anteponemos APP_URL
        // para que funcione dentro de la subcarpeta del proyecto (ej: /SemestralSO7/public)
        if (str_starts_with($url, '/') && defined('APP_URL')) {
            $url = APP_URL . $url;
        }
        header("Location: $url");
        exit;
    }

    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function csrfCheck(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!Session::validateCsrf($token)) {
            $this->json(['error' => 'Token CSRF inválido'], 403);
        }
    }

    protected function requireRole(array|string $roles): void
    {
        $userRole = Session::get('user_role', '');
        $roles = (array)$roles;
        if (!in_array($userRole, $roles)) {
            $this->redirect('/login');
        }
    }

    protected function validate(array $data, array $rules): array
    {
        return Validator::validateMultiple($data, $rules);
    }
}