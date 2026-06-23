<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Prize;
use App\Models\Level;

class PrizeController extends Controller
{
    public function index()
    {
        $this->requireRole(['armador','admin']);
        $prizes = Prize::all();
        $this->render('prizes/index', ['prizes' => $prizes]);
    }

    public function create()
    {
        $this->requireRole(['armador','admin']);
        $levels = Level::all();
        $csrfToken = Session::csrfToken();
        $this->render('prizes/form', [
            'csrfToken' => $csrfToken,
            'levels' => $levels,
            'prize' => null
        ]);
    }

    public function store()
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();

        $prize = new Prize([
            'name' => $_POST['name'],
            'points_value' => $_POST['points_value'],
            'image' => $this->uploadImage('image') // implementación de subida
        ]);
        $prize->save();

        // Asignar niveles (checkbox array)
        if (!empty($_POST['levels'])) {
            $prize->syncLevels($_POST['levels']);
        }

        $this->redirect('/prizes');
    }

    public function edit($id)
    {
        $this->requireRole(['armador','admin']);
        $prize = Prize::find($id);
        if (!$prize) $this->redirect('/prizes');
        $levels = Level::all();
        $csrfToken = Session::csrfToken();
        $this->render('prizes/form', [
            'csrfToken' => $csrfToken,
            'levels' => $levels,
            'prize' => $prize
        ]);
    }

    public function update($id)
    {
        $this->requireRole(['armador','admin']);
        $this->csrfCheck();
        $prize = Prize::find($id);
        $prize->name = $_POST['name'];
        $prize->points_value = $_POST['points_value'];
        if (!empty($_FILES['image']['name'])) {
            $prize->image = $this->uploadImage('image');
        }
        $prize->save();
        $prize->syncLevels($_POST['levels'] ?? []);
        $this->redirect('/prizes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $prize = Prize::find($id);
        if ($prize) $prize->delete();
        $this->redirect('/prizes');
    }

    private function uploadImage($field): string
    {
        // Lógica de subida de imagen (validar tipo, tamaño, mover a public/uploads/)
        // Retorna nombre de archivo.
        return 'default.png';
    }
}