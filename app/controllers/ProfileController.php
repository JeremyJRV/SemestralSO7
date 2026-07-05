<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use App\Models\User;
use App\Models\UserLevelProgress;
use App\Models\UserPrize;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $user = User::find($userId);
        $progress = UserLevelProgress::byUser($userId);
        $prizes = UserPrize::byUser($userId);
        $this->render('profile/show', compact('user', 'progress', 'prizes'));
    }

    public function updateAvatar()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $this->csrfCheck();
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = $this->uploadAvatar($_FILES['avatar']);
            $user = User::find($userId);
            $user->avatar = $avatar;
            $user->save();
        }
        $this->redirect('/profile');
    }

    // Sube la foto de avatar a public/uploads/avatars/, o usa default.png si falla
    private function uploadAvatar($file): string
    {
        if (empty($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return 'default.png';
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $tmpPath = $file['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, $allowedTypes)) {
            return 'default.png'; // tipo de archivo no permitido
        }

        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($file['size'] > $maxSize) {
            return 'default.png'; // demasiado grande
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'avatar_' . uniqid() . '.' . $ext;
        $destination = __DIR__ . '/../../public/uploads/avatars/' . $filename;

        if (move_uploaded_file($tmpPath, $destination)) {
            return $filename;
        }

        return 'default.png';
    }
}