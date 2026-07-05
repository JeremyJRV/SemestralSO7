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
            'image' => $this->uploadImage('image')
        ]);
        $prize->save();

        if (!empty($_POST['levels'])) {
            $prize->syncLevels($_POST['levels']);
        }

        $this->redirect('/admin/prizes');
    }

    public function edit($id)
    {
        $this->requireRole(['armador','admin']);
        $prize = Prize::find($id);
        if (!$prize) $this->redirect('/admin/prizes');
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
        $this->redirect('/admin/prizes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador','admin']);
        $prize = Prize::find($id);
        if ($prize) $prize->delete();
        $this->redirect('/admin/prizes');
    }

    private function uploadImage($field): string
    {
        if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            return 'default.png';
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $tmpPath = $_FILES[$field]['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedTypes)) {
            return 'default.png';
        }

        $maxSize = 2 * 1024 * 1024;
        if ($_FILES[$field]['size'] > $maxSize) {
            return 'default.png';
        }

        $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
        $filename = uniqid('prize_') . '.' . $ext;
        $destination = __DIR__ . '/../../public/images/prizes/' . $filename;

        if (move_uploaded_file($tmpPath, $destination)) {
            return $filename;
        }

        return 'default.png';
    }
}