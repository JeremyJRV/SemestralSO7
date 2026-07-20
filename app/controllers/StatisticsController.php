<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Theme;
use App\Models\UserThemeRating;
use App\Models\GameSession;
use App\Models\GameResponse;
use App\Models\AppRating;

class StatisticsController extends Controller
{
    public function index()
    {
        $mostPlayedThemes = Theme::mostPlayed(); // query SQL
        $averageRatings = UserThemeRating::averageRatings();

        // AGREGADO: la valoración general de la app (mucho/bastante/regular/
        // medio) vivía solo en /admin/feedback; ahora también se muestra
        // aquí, junto a la de temas, ya que ambas son estadísticas "del
        // sistema" y tiene sentido verlas juntas.
        $appRatingStats = AppRating::stats();

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
        $userId = $this->requireAuth();
        $myAvgTimePerQuestion = GameResponse::averageTimePerQuestionForUser($userId);
        $myGamesPlayed = GameResponse::sessionsPlayedByUser($userId);
        $myAccuracy = GameResponse::accuracyForUser($userId);

        $this->render('statistics/index', [
            'mostPlayed' => $mostPlayedThemes,
            'ratings' => $averageRatings,
            'appRatingStats' => $appRatingStats,
            'avgTimePerQuestion' => $avgTimePerQuestion,
            'overallAvgTime' => $overallAvgTime,
            'myAvgTimePerQuestion' => $myAvgTimePerQuestion,
            'myGamesPlayed' => $myGamesPlayed,
            'myAccuracy' => $myAccuracy,
            'activePage' => 'statistics'
        ]);
    }
}