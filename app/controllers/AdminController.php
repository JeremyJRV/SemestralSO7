<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    


// AdminController: descarga del reporte de progreso en Excel
class AdminController extends Controller
{
    // Nota: existía aquí un método index() que renderizaba 'admin/dashboard',
    // pero esa vista nunca se creó y routes/web.php nunca definió una ruta
    // hacia este método (era código muerto e inalcanzable). Se eliminó para
    // no dejar confusión; el panel de administración real se organiza por
    // secciones (Usuarios, Temas, Preguntas, Premios, Reporte), cada una con
    // su propio controlador y ruta.

    public function downloadReport()
    {
    $this->requireRole('admin');
    $reportService = new \App\Services\ExcelReportService();
    $fileUrl = $reportService->generateUserProgressReport();

    // Redirigir al archivo para forzar la descarga
    $this->redirect($fileUrl);
    }  
}