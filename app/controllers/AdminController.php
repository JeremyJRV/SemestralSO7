<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    
use App\Models\re;

// AdminController: panel de administración general (agrupa accesos)
class AdminController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $this->render('admin/dashboard');
    }
}
