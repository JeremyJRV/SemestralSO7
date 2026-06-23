<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Question;
use App\Models\Option;
use App\Models\ThemeLevel;

class QuestionController extends Controller
{
    // CRUD solo armador y admin
    public function index($themeLevelId = null)
    {
        $this->requireRole(['armador','admin']);
        $themeLevels = ThemeLevel::all(); // lista para filtro
        $questions = $themeLevelId ? Question::byThemeLevel($themeLevelId) : Question::all();
        $this->render('questions/index', [
            'themeLevels' => $themeLevels,
            'questions' => $questions,
            'selectedThemeLevel' => $themeLevelId
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

        $question = new Question([
            'theme_level_id' => $data['theme_level_id'],
            'text' => $data['text'],
            'type' => $data['type'],
            'created_by' => Session::get('user_id')
        ]);
        $question->save();

        if ($data['type'] === 'multiple') {
            foreach ($data['options'] as $index => $optionText) {
                if (!empty($optionText)) {
                    $option = new Option([
                        'question_id' => $question->id,
                        'text' => $optionText,
                        'is_correct' => ($data['correct_option'] == $index) ? 1 : 0
                    ]);
                    $option->save();
                }
            }
        } else { // boolean
            $trueOption = new Option([
                'question_id' => $question->id,
                'text' => 'Verdadero',
                'is_correct' => $data['boolean_correct'] == '1' ? 1 : 0
            ]);
            $trueOption->save();
            $falseOption = new Option([
                'question_id' => $question->id,
                'text' => 'Falso',
                'is_correct' => $data['boolean_correct'] == '0' ? 1 : 0
            ]);
            $falseOption->save();
        }
        $this->redirect('/questions');
    }

    public function edit($id)
    {
        $this->requireRole(['armador','admin']);
        $question = Question::find($id);
        if (!$question) $this->redirect('/questions');
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
        $question = Question::find($id);
        if (!$question) $this->redirect('/questions');

        $question->theme_level_id = $_POST['theme_level_id'];
        $question->text = $_POST['text'];
        $question->save();

        // Borrar opciones existentes y recrear (simplificado)
        Option::deleteByQuestion($id);
        // Crear nuevas como en store
        // ... (código similar, omitido por brevedad)
        $this->redirect('/questions');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $question = Question::find($id);
        if ($question) $question->delete();
        $this->redirect('/questions');
    }
}