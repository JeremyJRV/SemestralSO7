<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    

class LandingController extends Controller
{
    public function index()
    {
        $this->render('landing/index', ['activePage' => 'home']);
    }

    public function about()
    {
        $this->render('landing/about', ['activePage' => 'about']);
    }

    public function contact()
    {
        $this->render('landing/contact', ['activePage' => 'contact']);
    }

    public function team()
    {
        $this->render('landing/team', ['activePage' => 'team']);
    }
}