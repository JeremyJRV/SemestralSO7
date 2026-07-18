<?php
namespace App\Services;

use App\Models\Survey;
use App\Models\SurveyResponse;
use clases\Database;

class SurveyService
{
    public function getAllSurveys(): array
    {
        return Survey::all();
    }

    public function findSurvey(int $id): ?Survey
    {
        return Survey::find($id);
    }

    public function createSurvey(string $question, array $options): Survey
    {
        $survey = new Survey([
            'question' => $question,
            'options' => json_encode(array_values($options))
        ]);
        $survey->save();
        return $survey;
    }

    public function updateSurvey(int $id, string $question, array $options): ?Survey
    {
        $survey = Survey::find($id);
        if (!$survey) {
            return null;
        }
        $survey->question = $question;
        $survey->options = json_encode(array_values($options));
        $survey->save();
        return $survey;
    }

    public function deleteSurvey(int $id): bool
    {
        $survey = Survey::find($id);
        if (!$survey) {
            return false;
        }
        $survey->delete();
        return true;
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

    public function getUnansweredSurveyForUser(?int $userId): ?Survey
    {
        $db = Database::getInstance()->getConnection();

        if ($userId) {
            $stmt = $db->prepare(
                "SELECT * FROM surveys
                 WHERE id NOT IN (
                     SELECT survey_id FROM survey_responses WHERE user_id = :uid
                 )
                 ORDER BY id DESC LIMIT 1"
            );
            $stmt->execute(['uid' => $userId]);
        } else {
            $stmt = $db->query("SELECT * FROM surveys ORDER BY id DESC LIMIT 1");
        }

        $row = $stmt->fetch();
        return $row ? new Survey($row) : null;
    }
}