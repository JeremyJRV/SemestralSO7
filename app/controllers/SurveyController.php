<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Services\SurveyService;

class SurveyController extends Controller
{
    private SurveyService $surveyService;

    public function __construct()
    {
        $this->surveyService = new SurveyService();
    }

    public function index()
    {
        $this->requireRole(['armador', 'admin']);
        $surveys = $this->surveyService->getAllSurveys();
        $csrfToken = Session::csrfToken();
        $this->render('admin/surveys', [
            'surveys' => $surveys,
            'csrfToken' => $csrfToken
        ]);
    }

    public function create()
    {
        $this->requireRole(['armador', 'admin']);
        $csrfToken = Session::csrfToken();
        $this->render('surveys/form', [
            'csrfToken' => $csrfToken,
            'survey' => null
        ]);
    }

    public function store()
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $question = trim($_POST['question'] ?? '');
        $options = array_filter(array_map('trim', $_POST['options'] ?? []));

        if ($question === '' || count($options) < 2) {
            $csrfToken = Session::csrfToken();
            $this->render('surveys/form', [
                'csrfToken' => $csrfToken,
                'survey' => null,
                'error' => 'La encuesta necesita una pregunta y al menos 2 opciones.'
            ]);
            return;
        }

        $this->surveyService->createSurvey($question, $options);
        $this->redirect('/admin/surveys');
    }

    public function edit($id)
    {
        $this->requireRole(['armador', 'admin']);
        $survey = $this->surveyService->findSurvey((int)$id);
        if (!$survey) {
            $this->redirect('/admin/surveys');
        }

        $csrfToken = Session::csrfToken();
        $this->render('surveys/form', [
            'csrfToken' => $csrfToken,
            'survey' => $survey
        ]);
    }

    public function update($id)
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $question = trim($_POST['question'] ?? '');
        $options = array_filter(array_map('trim', $_POST['options'] ?? []));

        if ($question === '' || count($options) < 2) {
            $survey = $this->surveyService->findSurvey((int)$id);
            $csrfToken = Session::csrfToken();
            $this->render('surveys/form', [
                'csrfToken' => $csrfToken,
                'survey' => $survey,
                'error' => 'La encuesta necesita una pregunta y al menos 2 opciones.'
            ]);
            return;
        }

        $this->surveyService->updateSurvey((int)$id, $question, $options);
        $this->redirect('/admin/surveys');
    }

    public function delete($id)
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        try {
            $this->surveyService->deleteSurvey((int)$id);
        } catch (\PDOException $e) {
            error_log('No se pudo eliminar encuesta ID ' . $id . ': ' . $e->getMessage());
            $this->redirect('/admin/surveys?error=' . urlencode(
                'No se puede eliminar esta encuesta porque ya tiene respuestas registradas.'
            ));
            return;
        }
        $this->redirect('/admin/surveys');
    }
}