<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;
use App\Models\UserLevelProgress;
use App\Models\ThemeLevel;

/**
 * Nueva funcionalidad pedida por la rúbrica actualizada: "el jugador
 * puede ver el avance de otros jugadores, y ver su posición frente a
 * temas comunes que hayan jugado otros jugadores".
 */
class RankingController extends Controller
{
    public function index()
    {
        $userId = $this->requireAuth();

        $themeLevels = ThemeLevel::all();
        $selectedThemeLevel = $_GET['theme_level_id'] ?? null;

        $ranking = [];
        $myPosition = null;
        if ($selectedThemeLevel) {
            $ranking = UserLevelProgress::rankingByThemeLevel((int)$selectedThemeLevel);
            $myPosition = UserLevelProgress::rankPositionForUser($userId, (int)$selectedThemeLevel);
        }

        $topPlayers = User::topByPoints(20);
        $myGlobalPosition = User::globalRankPosition($userId);

        $this->render('ranking/index', [
            'themeLevels' => $themeLevels,
            'selectedThemeLevel' => $selectedThemeLevel,
            'ranking' => $ranking,
            'myPosition' => $myPosition,
            'topPlayers' => $topPlayers,
            'myGlobalPosition' => $myGlobalPosition,
            'currentUserId' => $userId,
            'activePage' => 'ranking'
        ]);
    }
}