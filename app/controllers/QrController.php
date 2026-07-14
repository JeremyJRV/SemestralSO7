<?php
namespace App\Controllers;

use clases\Controller;
use App\Models\ThemeLevel;

/**
 * Panel de administración para generar/ver los códigos QR de acceso
 * directo a cada set de preguntas (tema-nivel). Rúbrica punto 10.
 */
class QrController extends Controller
{
    public function index()
    {
        $this->requireRole(['armador', 'admin']);
        $themeLevels = ThemeLevel::all();
        $this->render('admin/qr', ['themeLevels' => $themeLevels]);
    }
}