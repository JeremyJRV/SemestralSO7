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

        // BUG CORREGIDO: antes solo se pasaba $user a la vista. El
        // dashboard también necesita currentLevel, nextLevel, gamesPlayed,
        // accuracy y recentActivity, que nunca se calculaban -por eso
        // siempre mostraba "Sin nivel asignado", 0 partidas jugadas, 0%
        // de aciertos y "Aún no tienes actividad" aunque el usuario ya
        // hubiera jugado.
        $levels = UserLevelProgress::currentAndNextLevelForUser($userId);
        $gamesPlayed = GameResponse::sessionsPlayedByUser($userId);
        $accuracy = GameResponse::accuracyForUser($userId);
        $recentActivity = GameResponse::recentActivityForUser($userId, 5);

        $this->render('dashboard/index', [
            'user' => $user,
            'currentLevel' => $levels['current'],
            'nextLevel' => $levels['next'],
            'gamesPlayed' => $gamesPlayed,
            'accuracy' => $accuracy,
            'recentActivity' => $recentActivity
        ]);
    }
}