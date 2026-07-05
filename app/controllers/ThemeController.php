<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Theme;
use App\Models\UserThemeRating;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        $this->render('themes/index', ['themes' => $themes]);
    }

    public function create()
    {
        $this->requireRole(['armador', 'admin']);
        $csrfToken = Session::csrfToken();
        $this->render('themes/form', ['csrfToken' => $csrfToken]);
    }

    public function store()
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $data = $_POST;
        $theme = new Theme([
            'name' => $data['name'],
            'description' => $data['description'] ?? '',
            'created_by' => Session::get('user_id')
        ]);
        $theme->save();
        $this->redirect('/admin/themes');
    }

    public function edit($id)
    {
        $this->requireRole(['armador', 'admin']);
        $theme = Theme::find($id);
        if (!$theme) $this->redirect('/admin/themes');
        $csrfToken = Session::csrfToken();
        $this->render('themes/form', ['csrfToken' => $csrfToken, 'theme' => $theme]);
    }

    public function update($id)
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();
        $theme = Theme::find($id);
        if (!$theme) $this->redirect('/admin/themes');
        $theme->name = $_POST['name'];
        $theme->description = $_POST['description'] ?? '';
        $theme->save();
        $this->redirect('/admin/themes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador', 'admin']);
        $theme = Theme::find($id);
        if ($theme) $theme->delete();
        $this->redirect('/admin/themes');
    }

    public function rate()
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->json(['error' => 'No autenticado'], 401);
            return;
        }
        $themeId = $_POST['theme_id'] ?? null;
        $rating = $_POST['rating'] ?? null;
        if (!$themeId || !in_array($rating, ['boring','interesting','great'])) {
            $this->json(['error' => 'Datos inválidos'], 422);
            return;
        }

        UserThemeRating::updateOrCreate($userId, $themeId, $rating);
        $this->json(['success' => true]);
    }

    protected function requireRole(array|string $roles): void
    {
        $userRole = Session::get('user_role');
        $roles = (array)$roles;
        if (!in_array($userRole, $roles)) {
            $this->redirect('/login');
        }
    }
}