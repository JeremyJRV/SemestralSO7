<?php

namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\Prize;
use App\Models\ThemeLevel;
use clases\Database;
use clases\DigitalSignature;
use clases\FileUploader;

class PrizeController extends Controller
{
    public function index()
    {
        $this->requireRole(['armador', 'admin']);

        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT id, name, description, image, points_value, signature FROM prizes");
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

        $csrfToken = Session::csrfToken();

        $this->render('prizes/index', [
            'prizes' => $prizes,
            'corruptedCount' => $corruptedCount,
            'signedCount' => $signedCount,
            'unsignedCount' => $unsignedCount,
            'csrfToken' => $csrfToken
        ]);
    }

    public function create()
    {
        $this->requireRole(['armador', 'admin']);
        $themeLevels = ThemeLevel::all();
        $csrfToken = Session::csrfToken();
        $this->render('prizes/form', [
            'csrfToken' => $csrfToken,
            'themeLevels' => $themeLevels,
            'prize' => null
        ]);
    }

    public function store()
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $prize = new Prize([
            'name' => $_POST['name'],
            'description' => $_POST['description'] ?? '',
            'points_value' => (int)$_POST['points_value'],
            'image' => $this->uploadImage('image')
        ]);

        $prize->saveWithSignature();

        if (!empty($_POST['theme_levels'])) {
            $prize->syncThemeLevels($_POST['theme_levels']);
        }

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

        $themeLevels = ThemeLevel::all();
        $prizeThemeLevelIds = $prize->themeLevelIds();
        $csrfToken = Session::csrfToken();
        $this->render('prizes/form', [
            'csrfToken' => $csrfToken,
            'themeLevels' => $themeLevels,
            'prizeThemeLevelIds' => $prizeThemeLevelIds,
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

        $prize->name = $_POST['name'];
        $prize->description = $_POST['description'] ?? '';
        $prize->points_value = (int)$_POST['points_value'];

        if (!empty($_FILES['image']['name'])) {
            $prize->image = $this->uploadImage('image');
        }

        $prize->saveWithSignature();

        $prize->syncThemeLevels($_POST['theme_levels'] ?? []);

        $this->redirect('/admin/prizes');
    }

    public function delete($id)
    {
        $this->requireRole(['armador', 'admin']);
        $this->csrfCheck();

        $db = Database::getInstance()->getConnection();

        $db->prepare("DELETE FROM prize_levels WHERE prize_id = :pid")->execute(['pid' => $id]);
        $db->prepare("DELETE FROM user_prizes WHERE prize_id = :pid")->execute(['pid' => $id]);

        $stmt = $db->prepare("DELETE FROM prizes WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $this->redirect('/admin/prizes');
    }

    private function uploadImage($field): string
    {
        if (empty($_FILES[$field]['name'])) {
            return 'default.png';
        }
        return FileUploader::upload(
            $_FILES[$field],
            __DIR__ . '/../../public/images/prizes/',
            'prize_'
        );
    }
}