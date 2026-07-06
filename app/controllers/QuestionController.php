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

        $this->saveOptionsForQuestion($question->id, $data);

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

        // Precargar las opciones existentes para que el formulario
        // pueda mostrarlas (antes esto no se hacía y el formulario
        // de edición siempre aparecía con las opciones vacías).
        $existingOptions = Option::where('question_id', $question->id);
        $question->options = $existingOptions;

        // Precargar cuál opción es la correcta / valor booleano correcto
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

        // Verificar integridad antes de actualizar
        $question = Question::findWithVerification($id);
        if (!$question) {
            $this->redirect('/admin/questions');
        }

        $question->theme_level_id = $data['theme_level_id'];
        $question->text = $data['text'];
        $question->type = $data['type']; // BUG CORREGIDO: antes nunca se actualizaba el tipo

        // Guardar con nueva firma
        $question->saveWithSignature();

        // BUG CORREGIDO: antes se borraban las opciones viejas y nunca se
        // volvían a crear las nuevas, dejando la pregunta sin opciones.
        Option::deleteByQuestion($id);
        $this->saveOptionsForQuestion($id, $data);

        $this->redirect('/admin/questions');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $question = Question::find($id);

        if ($question) {
            // BUG CORREGIDO: borrar una pregunta ya respondida en algún
            // juego viola la restricción de game_responses.question_id
            // (y .selected_option_id sobre sus opciones), que NO tiene
            // ON DELETE CASCADE a propósito (para no perder el historial
            // de partidas). Antes esto tronaba con un error 500 sin
            // control, y además se borraban las opciones ANTES de saber
            // si la pregunta se podía borrar, dejando datos huérfanos.
            try {
                Option::deleteByQuestion($id);
                $question->delete();
            } catch (\PDOException $e) {
                error_log('No se pudo eliminar pregunta ID ' . $id . ': ' . $e->getMessage());
                $this->redirect('/admin/questions?error=' . urlencode(
                    'No se puede eliminar esta pregunta porque ya fue respondida en alguna partida.'
                ));
                return;
            }
        }
        $this->redirect('/admin/questions');
    }

    /**
     * Crea las opciones (múltiple o verdadero/falso) para una pregunta,
     * a partir de los datos del formulario. Centralizado aquí porque
     * store() y update() necesitan hacer exactamente lo mismo (DRY).
     */
    private function saveOptionsForQuestion(int $questionId, array $data): void
    {
        if ($data['type'] === 'multiple') {
            foreach ($data['options'] as $index => $optionText) {
                if (!empty($optionText)) {
                    $option = new Option([
                        'question_id' => $questionId,
                        'text' => $optionText,
                        'is_correct' => ($data['correct_option'] == $index) ? 1 : 0
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