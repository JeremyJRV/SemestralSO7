<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $users = User::all();
        $this->render('admin/users', ['users' => $users]);
    }

    public function create()
    {
        $this->requireRole('admin');
        $csrfToken = Session::csrfToken();
        $this->render('admin/user_form', ['csrfToken' => $csrfToken, 'user' => null]);
    }

    public function store()
    {
        $this->requireRole('admin');
        $this->csrfCheck();

        $data = $_POST;
        $errors = $this->validate($data, [
            'email' => 'required|email',
            'username' => 'required',
            'cedula' => 'required|cedula'
        ]);

        if (empty($errors) && User::findByEmail($data['email'])) {
            $errors['email'][] = 'Ya existe un usuario con ese email.';
        }

        if (empty($errors) && $this->cedulaExists($data['cedula'])) {
            $errors['cedula'][] = 'Ya existe un usuario con esa cédula.';
        }

        if (!empty($errors)) {
            $this->render('admin/user_form', ['errors' => $errors, 'user' => $data]);
            return;
        }

        $user = new User([
            'email' => $data['email'],
            'username' => $data['username'],
            'cedula' => $data['cedula'],
            'password' => password_hash($data['password'] ?? 'default123', PASSWORD_DEFAULT),
            'role' => $data['role'] ?? 'player'
        ]);
        $user->save();
        $this->redirect('/admin/users');
    }

    public function edit($id)
    {
        $this->requireRole('admin');
        $user = User::find($id);
        if (!$user) $this->redirect('/admin/users');
        $csrfToken = Session::csrfToken();
        $this->render('admin/user_form', ['csrfToken' => $csrfToken, 'user' => $user]);
    }

    public function update($id)
    {
        $this->requireRole('admin');
        $this->csrfCheck();
        $user = User::find($id);
        if (!$user) $this->redirect('/admin/users');

        $data = $_POST;

        $existing = User::findByEmail($data['email']);
        if ($existing && (int)$existing->id !== (int)$id) {
            $csrfToken = Session::csrfToken();
            $this->render('admin/user_form', [
                'csrfToken' => $csrfToken,
                'user' => $user,
                'error' => 'Ese email ya está en uso por otro usuario.'
            ]);
            return;
        }

        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->role = $data['role'];
        if (!empty($data['password'])) {
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $user->save();
        $this->redirect('/admin/users');
    }

    public function delete($id)
    {
        $this->requireRole('admin');
        $this->csrfCheck();
        $user = User::find($id);

        if ($user && $user->id != Session::get('user_id')) {
            try {
                $user->delete();
            } catch (\PDOException $e) {
                error_log('No se pudo eliminar usuario ID ' . $id . ': ' . $e->getMessage());
                $this->redirect('/admin/users?error=' . urlencode(
                    'No se puede eliminar este usuario porque tiene actividad registrada (partidas jugadas, temas o preguntas creadas).'
                ));
                return;
            }
        }
        $this->redirect('/admin/users');
    }

    private function cedulaExists(string $cedula): bool
    {
        $db = \clases\Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id FROM users WHERE cedula = :cedula LIMIT 1");
        $stmt->execute(['cedula' => $cedula]);
        return (bool) $stmt->fetch();
    }
}