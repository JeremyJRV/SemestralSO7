<?php
namespace App\Controllers;

use clases\Controller;
use App\Models\Theme;
use App\Models\UserThemeRating;
use App\Models\GameSession;
use App\Models\GameResponse;

class StatisticsController extends Controller
{
    public function index()
    {
        $mostPlayedThemes = Theme::mostPlayed(); // query SQL
        $averageRatings = UserThemeRating::averageRatings();

        // Tiempo promedio de respuesta por pregunta (faltaba)
        $avgTimePerQuestion = GameResponse::averageTimePerQuestion();
        $overallAvgTime = GameResponse::overallAverageTime();

        $this->render('statistics/index', [
            'mostPlayed' => $mostPlayedThemes,
            'ratings' => $averageRatings,
            'avgTimePerQuestion' => $avgTimePerQuestion,
            'overallAvgTime' => $overallAvgTime
        ]);
    }
}