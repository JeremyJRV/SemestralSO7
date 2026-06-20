<?php
namespace App\Services;

use App\Models\Survey;
use App\Models\SurveyResponse;

class SurveyService
{
    public function getAllSurveys(): array
    {
        return Survey::all();
    }

    public function submitResponse(int $surveyId, string $option, ?int $userId = null): void
    {
        $response = new SurveyResponse([
            'survey_id' => $surveyId,
            'user_id' => $userId,
            'selected_option' => $option
        ]);
        $response->save();
    }
}