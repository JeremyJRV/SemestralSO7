<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;    

class LandingController extends Controller
{
    public function index()
    {
        $this->render('landing/index');
    }

    public function about()
    {
        $this->render('landing/about');
    }

    public function contact()
    {
        $this->render('landing/contact');
    }
}
