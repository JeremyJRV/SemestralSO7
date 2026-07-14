<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;
use App\Models\GameResponse;
use App\Models\UserLevelProgress;

// DashboardController: panel para jugadores/armadores
class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $user = User::find($userId);

        // BUG CORREGIDO: antes se usaba currentAndNextLevelForUser(), que
        // mezclaba todos los temas y solo mostraba UN nivel "actual" (el
        // más alto entre todos). Ahora se calcula por tema, para que se
        // vea el avance real en cada uno (ej. PHP: Intermedio,
        // JavaScript: Básico, Laravel: Sin iniciar).
        $levelsByTheme = UserLevelProgress::currentAndNextLevelByTheme($userId);

        $gamesPlayed = GameResponse::sessionsPlayedByUser($userId);
        $accuracy = GameResponse::accuracyForUser($userId);
        $recentActivity = GameResponse::recentActivityForUser($userId, 5);

        $this->render('dashboard/index', [
            'user' => $user,
            'levelsByTheme' => $levelsByTheme,
            'gamesPlayed' => $gamesPlayed,
            'accuracy' => $accuracy,
            'recentActivity' => $recentActivity
        ]);
    }
}