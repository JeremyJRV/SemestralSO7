<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\AppRating;
use App\Models\ThemeSuggestion;

class FeedbackController extends Controller
{
    public function rateApp()
    {
        $userId = $this->requireAuth();

        $this->csrfCheck();

        $rating = $_POST['rating'] ?? '';
        if (!in_array($rating, ['mucho', 'regular', 'medio', 'bastante'])) {
            $this->json(['error' => 'Calificación inválida'], 422);
            return;
        }

        $saved = AppRating::submit($userId, $rating);
        if (!$saved) {
            $this->json(['error' => 'Ya calificaste la aplicación anteriormente'], 409);
            return;
        }

        $this->json(['success' => true]);
    }

    public function suggestTheme()
    {
        $userId = $this->requireAuth();

        $this->csrfCheck();

        $suggestion = trim($_POST['suggestion'] ?? '');
        if ($suggestion === '') {
            $this->json(['error' => 'Escribe una sugerencia antes de enviar'], 422);
            return;
        }

        ThemeSuggestion::submit($userId, $suggestion);
        $this->json(['success' => true]);
    }

    public function adminIndex()
    {
        $this->requireRole(['armador', 'admin']);

        $ratingStats = AppRating::stats();
        $ratings = AppRating::all();
        $suggestions = ThemeSuggestion::all();

        $this->render('admin/feedback', [
            'ratingStats' => $ratingStats,
            'ratings' => $ratings,
            'suggestions' => $suggestions
        ]);
    }
}