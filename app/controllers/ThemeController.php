<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Theme;
use App\Models\UserThemeRating;
use App\Models\Level;
use App\Models\ThemeLevel;

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

        // BUG CORREGIDO: themes.name tiene una restricción UNIQUE en la BD.
        // Antes, crear un tema con un nombre ya existente (ej. "PHP" otra
        // vez) tronaba con un error 500 sin control en vez de mostrar un
        // mensaje amigable.
        try {
            $theme->save();
        } catch (\PDOException $e) {
            $csrfToken = Session::csrfToken();
            $this->render('themes/form', [
                'csrfToken' => $csrfToken,
                'error' => 'Ya existe un tema con ese nombre.'
            ]);
            return;
        }

        // FUNCIONALIDAD FALTANTE AGREGADA: al crear un tema no se generaban
        // sus niveles (Básico/Intermedio/Avanzado) en theme_levels. Sin esas
        // filas, el tema nunca aparece en los selectores de "Tema y Nivel"
        // (preguntas, selección de juego, etc.) porque todo el sistema arma
        // sus consultas a partir de theme_levels, no de themes directamente.
        // Ahora, al crear un tema, se crea automáticamente una fila en
        // theme_levels por cada nivel existente (Básico, Intermedio,
        // Avanzado), igual que ya estaban los temas PHP y JavaScript
        // sembrados a mano en el script SQL original.
        $levels = Level::all();
        foreach ($levels as $level) {
            $themeLevel = new ThemeLevel([
                'theme_id' => $theme->id,
                'level_id' => $level->id
            ]);
            $themeLevel->save();
        }

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

        try {
            $theme->save();
        } catch (\PDOException $e) {
            $csrfToken = Session::csrfToken();
            $this->render('themes/form', [
                'csrfToken' => $csrfToken,
                'theme' => $theme,
                'error' => 'Ya existe un tema con ese nombre.'
            ]);
            return;
        }

        $this->redirect('/admin/themes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador', 'admin']);
        $theme = Theme::find($id);

        if ($theme) {
            // BUG CORREGIDO: borrar un tema que ya tiene sesiones de juego
            // jugadas (a través de sus theme_levels) viola la restricción
            // de game_sessions.theme_level_id, que NO tiene ON DELETE
            // CASCADE a propósito (para no perder el historial). Antes
            // esto tronaba con un error 500 sin control.
            try {
                $theme->delete();
            } catch (\PDOException $e) {
                error_log('No se pudo eliminar tema ID ' . $id . ': ' . $e->getMessage());
                $this->redirect('/admin/themes?error=' . urlencode(
                    'No se puede eliminar este tema porque ya tiene partidas jugadas asociadas.'
                ));
                return;
            }
        }
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
}