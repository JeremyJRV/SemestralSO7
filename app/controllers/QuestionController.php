<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Question;
use App\Models\Option;
use App\Models\ThemeLevel;

class QuestionController extends Controller
{
    public function index($themeLevelId = null)
    {
        $this->requireRole(['armador','admin']);
        $themeLevels = ThemeLevel::all();
        $questions = $themeLevelId ? Question::byThemeLevel($themeLevelId) : Question::all();
        
        // Verificar integridad de cada pregunta
        foreach ($questions as $key => $question) {
            if (!$question->verifyIntegrity()) {
                $questions[$key]->_corrupted = true;
            }
        }
        
        $this->render('admin/questions', [
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
        
        // Guardar con firma digital
        $question->saveWithSignature();

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
        } else {
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
        $this->redirect('/admin/questions');
    }

    public function edit($id)
    {
        $this->requireRole(['armador','admin']);
        
        // Verificar integridad de la pregunta
        $question = Question::findWithVerification($id);
        if (!$question) {
            $this->redirect('/admin/questions');
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
        
        // Verificar integridad antes de actualizar
        $question = Question::findWithVerification($id);
        if (!$question) {
            $this->redirect('/admin/questions');
        }

        $question->theme_level_id = $_POST['theme_level_id'];
        $question->text = $_POST['text'];
        
        // Guardar con nueva firma
        $question->saveWithSignature();

        Option::deleteByQuestion($id);
        $this->redirect('/admin/questions');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $question = Question::find($id);
        if ($question) $question->delete();
        $this->redirect('/admin/questions');
    }
}