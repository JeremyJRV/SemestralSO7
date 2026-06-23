<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    


// AdminController: panel de administración general (agrupa accesos)
class AdminController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $this->render('admin/dashboard');
    }

    // Añadir esto en AdminController.php
    public function downloadReport()
    {
    $this->requireRole('admin');
    $reportService = new \App\Services\ExcelReportService();
    $fileUrl = $reportService->generateUserProgressReport();

    // Redirigir al archivo para forzar la descarga
    $this->redirect($fileUrl);
    }  
}
