<?php

namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Prize;
use App\Models\Level;
use clases\Database;
use clases\DigitalSignature;

class PrizeController extends Controller
{
    public function index()
    {
        $this->requireRole(['armador', 'admin']);

        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT id, name, image, points_value, signature FROM prizes");
        $rows = $stmt->fetchAll();

        $prizes = [];
        $corruptedCount = 0;
        $signedCount = 0;
        $unsignedCount = 0;

        foreach ($rows as $row) {
            $prize = new Prize($row);
            $prize->signature = $row['signature'] ?? null;

            if (empty($row['signature'])) {
                $prize->_corrupted = false;
                $unsignedCount++;
            } else {
                $data = $row;
                unset($data['signature']);
                $isValid = DigitalSignature::verify($data, $row['signature']);
                $prize->_corrupted = !$isValid;

                if ($isValid) {
                    $signedCount++;
                } else {
                    $corruptedCount++;
                }
            }

            $prizes[] = $prize;
        }

        $this->render('prizes/index', [
            'prizes' => $prizes,
            'corruptedCount' => $corruptedCount,
            'signedCount' => $signedCount,
            'unsignedCount' => $unsignedCount
        ]);
    }

    public function create()
    {
        $this->requireRole(['armador', 'admin']);
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
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $prize = new Prize([
            'name' => $_POST['name'],
            'points_value' => (int)$_POST['points_value'],
            'image' => $this->uploadImage('image')
        ]);

        $prize->saveWithSignature();

        if (!empty($_POST['levels'])) {
            $prize->syncLevels($_POST['levels']);
        }

        // RECARGAR EL PREMIO DESDE LA BASE DE DATOS PARA ASEGURAR QUE LA FIRMA ESTÉ DISPONIBLE
        $prize = Prize::find($prize->id);

        $this->redirect('/admin/prizes');
    }
    public function edit($id)
    {
        $this->requireRole(['armador', 'admin']);

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM prizes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            $this->redirect('/admin/prizes');
        }

        $prize = new Prize($row);
        $prize->signature = $row['signature'] ?? null;

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
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM prizes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            $this->redirect('/admin/prizes');
        }

        $prize = new Prize($row);

        // Actualizar datos
        $prize->name = $_POST['name'];
        $prize->points_value = (int)$_POST['points_value'];

        if (!empty($_FILES['image']['name'])) {
            $prize->image = $this->uploadImage('image');
        }

        // Guardar CON firma (esto regenera la firma)
        $prize->saveWithSignature();

        // Sincronizar niveles
        $prize->syncLevels($_POST['levels'] ?? []);

        $this->redirect('/admin/prizes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador', 'admin']);

        $db = Database::getInstance()->getConnection();

        // Eliminar relaciones primero
        $db->prepare("DELETE FROM prize_levels WHERE prize_id = :pid")->execute(['pid' => $id]);
        $db->prepare("DELETE FROM user_prizes WHERE prize_id = :pid")->execute(['pid' => $id]);

        // Luego eliminar el premio
        $stmt = $db->prepare("DELETE FROM prizes WHERE id = :id");
        $stmt->execute(['id' => $id]);

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
