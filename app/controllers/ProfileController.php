<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\FileUploader;
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
            // BUG DE DRY CORREGIDO: este método privado duplicaba
            // exactamente la misma lógica que PrizeController::uploadImage().
            // Ahora ambos usan clases\FileUploader::upload().
            $avatar = FileUploader::upload(
                $_FILES['avatar'],
                __DIR__ . '/../../public/uploads/avatars/',
                'avatar_'
            );
            $user = User::find($userId);
            $user->avatar = $avatar;
            $user->save();
        }
        $this->redirect('/profile');
    }
}