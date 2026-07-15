<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\Validator;
use App\Models\User;
use App\Models\LoginAttempt;
//Revisar la implementación de las expceciones 
class AuthController extends Controller
{
    // Muestra formulario de login
    public function showLogin()
    {
        $this->render('auth/login');
    }

    // Procesa login
    public function login()
    {
        $email = Validator::sanitizeString($_POST['email'] ?? ''); //para sanitizar el email, aunque se validará después no se si esta bien
        $password = $_POST['password'] ?? '';
        $csrfToken = $_POST['csrf_token'] ?? '';

        if (!Session::validateCsrf($csrfToken)) {
            $this->json(['error' => 'Token CSRF inválido'], 403);
            return;
        }

        // Validación básica
        $errors = $this->validate($_POST, ['email' => 'required|email', 'password' => 'required']);
        if (!empty($errors)) {
            $this->render('auth/login', ['errors' => $errors, 'email' => $email]);
            return;
        }

        $user = User::findByEmail($email);

        // Verificar bloqueo de cuenta
        $clientIp = $_SERVER['REMOTE_ADDR'];
        if (LoginAttempt::isBlocked($clientIp)) {
            LoginAttempt::log(null, $clientIp, false);
            $this->render('auth/login', ['error' => 'Demasiados intentos fallidos. Intente de nuevo en 15 minutos.']);
            return;
        }

        if ($user && password_verify($password, $user->password)) {
            // Login exitoso
            LoginAttempt::log($user->id, $clientIp, true);
            Session::set('user_id', $user->id);
            Session::set('user_role', $user->role);

            // NUEVO (acceso por QR): si venía de escanear un código QR
            // antes de loguearse, lo mandamos directo a jugar ese set de
            // preguntas en vez de al dashboard.
            $pendingQr = Session::get('qr_redirect_theme_level');
            if ($pendingQr) {
                // BUG CORREGIDO: se llamaba a Session::delete(), que no
                // existe en la clase (el método real se llama remove()).
                // Esto rompía el login con un error fatal justo después
                // de escanear un QR sin sesión iniciada.
                Session::remove('qr_redirect_theme_level');
                $this->redirect('/game/start/' . (int)$pendingQr);
                return;
            }

            $this->redirect('/dashboard');
        } else {
            // Falló
            LoginAttempt::log($user->id ?? null, $clientIp, false);
            $remaining = LoginAttempt::remainingAttempts($clientIp);
            $this->render('auth/login', [
                'error' => 'Credenciales incorrectas.',
                'remaining' => $remaining,
                'email' => $email
            ]);
        }
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect('/login');
    }

    // Registro público
    public function showRegister()
    {
        $csrfToken = Session::csrfToken();
        $this->render('auth/register', ['csrfToken' => $csrfToken]);
    }

    public function register()
    {
        $csrfToken = $_POST['csrf_token'] ?? '';
        if (!Session::validateCsrf($csrfToken)) {
            $this->json(['error' => 'Token CSRF inválido'], 403);
            return;
        }

        $data = [
            'email' => Validator::sanitizeString($_POST['email']),
            'username' => Validator::sanitizeString($_POST['username']),
            'cedula' => Validator::sanitizeString($_POST['cedula'] ?? ''), // NUEVO
            'password' => $_POST['password'],
            'password_confirmation' => $_POST['password_confirmation'] ?? ''
        ];

        // Validar
        $errors = $this->validate($data, [
            'email' => 'required|email',
            'username' => 'required',
            'cedula' => 'required|cedula', // NUEVO: pedido por la rúbrica actualizada
            'password' => 'required'
        ]);
        if ($data['password'] !== $data['password_confirmation']) {
            $errors['password_confirmation'] = ['Las contraseñas no coinciden.'];
        }
        $passwordCheck = Validator::validatePassword($data['password']);
        if ($passwordCheck !== true) {
            $errors['password'] = $passwordCheck;
        }

        if (!empty($errors)) {
            $this->render('auth/register', ['errors' => $errors, 'data' => $data]);
            return;
        }

        // Verificar email único
        if (User::findByEmail($data['email'])) {
            $this->render('auth/register', ['error' => 'El email ya está registrado.', 'data' => $data]);
            return;
        }

        // NUEVO: verificar cédula única
        if ($this->cedulaExists($data['cedula'])) {
            $this->render('auth/register', ['error' => 'Esa cédula ya está registrada.', 'data' => $data]);
            return;
        }

        $user = new User([
            'email' => $data['email'],
            'username' => $data['username'],
            'cedula' => $data['cedula'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'player'
        ]);
        $user->save();

        Session::set('user_id', $user->id);
        Session::set('user_role', $user->role);

        // NUEVO (acceso por QR): mismo comportamiento que en login().
        $pendingQr = Session::get('qr_redirect_theme_level');
        if ($pendingQr) {
            // BUG CORREGIDO: mismo error que en login() (Session::delete()
            // no existe, es Session::remove()).
            Session::remove('qr_redirect_theme_level');
            $this->redirect('/game/start/' . (int)$pendingQr);
            return;
        }

        $this->redirect('/dashboard');
    }

    private function cedulaExists(string $cedula): bool
    {
        $db = \clases\Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id FROM users WHERE cedula = :cedula LIMIT 1");
        $stmt->execute(['cedula' => $cedula]);
        return (bool) $stmt->fetch();
    }
}