<?php
namespace App\Controllers;

use clases\Controller;
use App\Models\Theme;
use App\Models\UserThemeRating;
use App\Models\GameSession;

class StatisticsController extends Controller
{
    public function index()
    {
        $mostPlayedThemes = Theme::mostPlayed(); // query SQL
        $averageRatings = UserThemeRating::averageRatings();
        $this->render('statistics/index', [
            'mostPlayed' => $mostPlayedThemes,
            'ratings' => $averageRatings
        ]);
    }
}