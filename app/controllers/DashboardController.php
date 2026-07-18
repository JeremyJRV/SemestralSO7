<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;
use App\Models\GameResponse;
use App\Models\UserLevelProgress;
use App\Services\SurveyService;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $user = User::find($userId);

        $levelsByTheme = UserLevelProgress::currentAndNextLevelByTheme($userId);

        $gamesPlayed = GameResponse::sessionsPlayedByUser($userId);
        $accuracy = GameResponse::accuracyForUser($userId);
        $recentActivity = GameResponse::recentActivityForUser($userId, 5);

        $surveyService = new SurveyService();
        $survey = $surveyService->getUnansweredSurveyForUser($userId);
        $csrfToken = Session::csrfToken();

        $this->render('dashboard/index', [
            'user' => $user,
            'levelsByTheme' => $levelsByTheme,
            'gamesPlayed' => $gamesPlayed,
            'accuracy' => $accuracy,
            'recentActivity' => $recentActivity,
            'survey' => $survey,
            'csrfToken' => $csrfToken
        ]);
    }
}