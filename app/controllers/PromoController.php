<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    
use App\Models\Survey;
use App\Models\SurveyResponse;

class PromoController extends Controller
{
    public function index()
    {
        // Página promocional con encuestas
        $surveys = \App\Models\Survey::all();
        $csrfToken = Session::csrfToken();
        $this->render('promo/index', ['surveys' => $surveys, 'csrfToken' => $csrfToken]);
    }

    public function submitSurvey()
    {
        $this->csrfCheck();
        $data = $_POST;
        $surveyResponse = new \App\Models\SurveyResponse([
            'survey_id' => $data['survey_id'],
            'user_id' => Session::get('user_id'),
            'selected_option' => $data['option']
        ]);
        $surveyResponse->save();
        $this->json(['success' => true]);
    }
}