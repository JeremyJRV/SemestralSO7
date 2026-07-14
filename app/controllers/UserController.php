<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\Validator;
use App\Models\User;

class UserController extends Controller
{
    // Listado (solo admin)
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
            'cedula' => 'required|cedula' // NUEVO: pedido por la rúbrica actualizada
        ]);

        if (empty($errors) && User::findByEmail($data['email'])) {
            $errors['email'][] = 'Ya existe un usuario con ese email.';
        }

        // NUEVO: la cédula también debe ser única
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

        // BUG/REGLA DE NEGOCIO NUEVA: la rúbrica exige que la cédula NO se
        // pueda editar una vez creado el usuario. Aunque el formulario de
        // edición no debería enviar 'cedula' (campo bloqueado en la
        // vista), NUNCA se asigna aquí a propósito, incluso si alguien
        // manipulara el formulario a mano e intentara mandarla: se ignora
        // por completo y se conserva siempre el valor original guardado.

        $user->save();
        $this->redirect('/admin/users');
    }

    public function delete($id)
    {
        $this->requireRole('admin');
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