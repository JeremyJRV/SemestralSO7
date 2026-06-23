<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    


// DashboardController: panel para jugadores/armadores
class DashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $user = User::find($userId);
        // Mostrar resumen de progreso, últimos premios, etc.
        $this->render('dashboard/index', ['user' => $user]);
    }
}