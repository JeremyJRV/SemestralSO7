<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\Database;
use App\Models\Question;
use App\Models\Option;
use App\Models\ThemeLevel;

class QuestionController extends Controller
{
    public function index($themeLevelId = null)
    {
        $this->requireRole(['armador','admin']);

        // El filtro por tema-nivel viaja como query string (?theme_level_id=X),
        // no como segmento de ruta, así que el Router nunca lo pasa como
        // parámetro posicional. Lo leemos directo de $_GET.
        $themeLevelId = $_GET['theme_level_id'] ?? $themeLevelId;
        $themeLevelId = $themeLevelId !== null && $themeLevelId !== '' ? (int)$themeLevelId : null;

        $themeLevels = ThemeLevel::all();
        $questions = $themeLevelId ? Question::byThemeLevel($themeLevelId) : Question::all();

        foreach ($questions as $key => $question) {
            if (!$question->verifyIntegrity()) {
                $questions[$key]->_corrupted = true;
            }
        }

        $csrfToken = Session::csrfToken();

        $this->render('admin/questions', [
            'themeLevels' => $themeLevels,
            'questions' => $questions,
            'selectedThemeLevel' => $themeLevelId,
            'csrfToken' => $csrfToken
        ]);
    }

    public function create()
    {
        $this->requireRole(['armador','admin']);
        $themeLevels = ThemeLevel::all();
        $csrfToken = Session::csrfToken();
        $this->render('questions/form', [
            'csrfToken' => $csrfToken,
            'themeLevels' => $themeLevels,
            'question' => null
        ]);
    }

    public function store()
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();
        $data = $_POST;

        if ($data['type'] === 'multiple' && !isset($data['correct_option'])) {
            $themeLevels = ThemeLevel::all();
            $csrfToken = Session::csrfToken();
            $this->render('questions/form', [
                'csrfToken' => $csrfToken,
                'themeLevels' => $themeLevels,
                'question' => null,
                'error' => 'Debes marcar cuál opción es la correcta.'
            ]);
            return;
        }

        $question = new Question([
            'theme_level_id' => $data['theme_level_id'],
            'text' => $data['text'],
            'type' => $data['type'],
            'created_by' => Session::get('user_id')
        ]);

        $question->saveWithSignature();

        $this->saveOptionsForQuestion($question->id, $data);

        $this->redirect('/admin/questions');
    }

    public function edit($id)
    {
        $this->requireRole(['armador','admin']);

        $question = Question::findWithVerification($id);
        if (!$question) {
            $this->redirect('/admin/questions');
        }

        $existingOptions = Option::where('question_id', $question->id);
        $question->options = $existingOptions;

        if ($question->type === 'multiple') {
            foreach ($existingOptions as $index => $opt) {
                if ($opt->is_correct) {
                    $question->correct_option = $index;
                    break;
                }
            }
        } else {
            foreach ($existingOptions as $opt) {
                if ($opt->text === 'Verdadero') {
                    $question->boolean_correct = (int)$opt->is_correct;
                    break;
                }
            }
        }

        $themeLevels = ThemeLevel::all();
        $csrfToken = Session::csrfToken();
        $this->render('questions/form', [
            'csrfToken' => $csrfToken,
            'themeLevels' => $themeLevels,
            'question' => $question
        ]);
    }

    public function update($id)
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();
        $data = $_POST;

        $question = Question::findWithVerification($id);
        if (!$question) {
            $this->redirect('/admin/questions');
        }

        if ($data['type'] === 'multiple' && !isset($data['correct_option'])) {
            $existingOptions = Option::where('question_id', $question->id);
            $question->options = $existingOptions;
            $themeLevels = ThemeLevel::all();
            $csrfToken = Session::csrfToken();
            $this->render('questions/form', [
                'csrfToken' => $csrfToken,
                'themeLevels' => $themeLevels,
                'question' => $question,
                'error' => 'Debes marcar cuál opción es la correcta.'
            ]);
            return;
        }

        $question->theme_level_id = $data['theme_level_id'];
        $question->text = $data['text'];
        $question->type = $data['type'];
        $question->saveWithSignature();

        $this->deleteOptionsForceCascade($id);
        $this->saveOptionsForQuestion($id, $data);

        $this->redirect('/admin/questions');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();
        $question = Question::find($id);

        if ($question) {
            $this->deleteOptionsForceCascade($id);
            $question->delete();
        }
        $this->redirect('/admin/questions');
    }

    private function deleteQuestionResponsesForQuestion(int $questionId): void
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "DELETE gr FROM game_responses gr
             INNER JOIN options o ON o.id = gr.selected_option_id
             WHERE o.question_id = :qid"
        );
        $stmt->execute(['qid' => $questionId]);

        $stmt2 = $db->prepare("DELETE FROM game_responses WHERE question_id = :qid");
        $stmt2->execute(['qid' => $questionId]);
    }

    private function deleteOptionsForceCascade(int $questionId): void
    {
        $this->deleteQuestionResponsesForQuestion($questionId);
        Option::deleteByQuestion($questionId);
    }

    private function saveOptionsForQuestion(int $questionId, array $data): void
    {
        if ($data['type'] === 'multiple') {
            $correctOption = $data['correct_option'] ?? 0;
            foreach ($data['options'] as $index => $optionText) {
                if (!empty($optionText)) {
                    $option = new Option([
                        'question_id' => $questionId,
                        'text' => $optionText,
                        'is_correct' => ($correctOption == $index) ? 1 : 0
                    ]);
                    $option->save();
                }
            }
        } else {
            $trueOption = new Option([
                'question_id' => $questionId,
                'text' => 'Verdadero',
                'is_correct' => $data['boolean_correct'] == '1' ? 1 : 0
            ]);
            $trueOption->save();
            $falseOption = new Option([
                'question_id' => $questionId,
                'text' => 'Falso',
                'is_correct' => $data['boolean_correct'] == '0' ? 1 : 0
            ]);
            $falseOption->save();
        }
    }
}