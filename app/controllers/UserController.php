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
            $user->delete();
        }
        $this->redirect('/admin/users');
    }

    protected function csrfCheck(): void
    {
        if (!Session::validateCsrf($_POST['csrf_token'] ?? '')) {
            $this->json(['error' => 'CSRF token inválido'], 403);
            exit;
        }
    }
}