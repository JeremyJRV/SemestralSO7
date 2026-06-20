<?php
namespace Clases;

use Clases\Session;
use Clases\Validator;
use App\Models\User;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        $userId = Session::get('user_id');
        $data['user'] = $userId ? User::find($userId) : null;
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