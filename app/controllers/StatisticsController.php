<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
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

        // FUNCIONALIDAD FALTANTE AGREGADA: todo lo anterior es del sistema
        // completo (todos los usuarios juntos), por eso un jugador que
        // recién entra ve exactamente los mismos números que cualquier
        // otro usuario, sin importar quién jugó qué. GameResponse ya tenía
        // un método averageTimePerQuestionForUser() listo desde hace
        // tiempo, pero nunca se llamaba desde ningún controlador. Ahora se
        // usa aquí, junto con accuracyForUser() y sessionsPlayedByUser()
        // (los mismos que ya usa el Dashboard), para mostrar una sección
        // aparte con las estadísticas PERSONALES del usuario logueado.
        $userId = Session::get('user_id');
        $myAvgTimePerQuestion = $userId ? GameResponse::averageTimePerQuestionForUser($userId) : [];
        $myGamesPlayed = $userId ? GameResponse::sessionsPlayedByUser($userId) : 0;
        $myAccuracy = $userId ? GameResponse::accuracyForUser($userId) : 0;

        $this->render('statistics/index', [
            'mostPlayed' => $mostPlayedThemes,
            'ratings' => $averageRatings,
            'avgTimePerQuestion' => $avgTimePerQuestion,
            'overallAvgTime' => $overallAvgTime,
            'myAvgTimePerQuestion' => $myAvgTimePerQuestion,
            'myGamesPlayed' => $myGamesPlayed,
            'myAccuracy' => $myAccuracy
        ]);
    }
}