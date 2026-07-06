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
        $errors = $this->validate($data, ['email' => 'required|email', 'username' => 'required']);

        // BUG CORREGIDO: antes no se validaba si el email ya existía antes
        // de insertar. users.email tiene una restricción UNIQUE en la BD,
        // así que un correo duplicado tronaba con un error 500 sin
        // controlar en vez de mostrar un mensaje de validación amigable.
        if (empty($errors) && User::findByEmail($data['email'])) {
            $errors['email'][] = 'Ya existe un usuario con ese email.';
        }

        if (!empty($errors)) {
            $this->render('admin/user_form', ['errors' => $errors, 'user' => $data]);
            return;
        }

        $user = new User([
            'email' => $data['email'],
            'username' => $data['username'],
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

        // BUG CORREGIDO: validar que el nuevo email no pertenezca a OTRO
        // usuario (si no cambió el email, o es el mismo usuario, se permite).
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
        $user = User::find($id);

        if ($user && $user->id != Session::get('user_id')) {
            // BUG CORREGIDO: borrar un usuario que ya jugó partidas, creó
            // temas/preguntas, o alojó sesiones de juego, viola varias
            // restricciones de llave foránea que NO tienen ON DELETE CASCADE
            // a propósito (para no perder el historial). Antes esto tronaba
            // con un error 500 sin control; ahora se captura y se muestra
            // un mensaje amigable, cumpliendo con el manejo de excepciones
            // que pide el proyecto.
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

    // BUG DE DRY CORREGIDO: este método era una copia casi idéntica de
    // Controller::csrfCheck() (la clase base ya llama a json(), que
    // internamente hace exit; el exit extra aquí era redundante). Se
    // eliminó el override: ahora UserController usa el de la clase base,
    // igual que todos los demás controladores.
}