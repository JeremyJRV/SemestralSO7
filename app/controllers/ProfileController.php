<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\FileUploader;
use App\Models\User;
use App\Models\Avatar;
use App\Models\UserLevelProgress;
use App\Models\UserPrize;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = $this->requireAuth();

        $user = User::find($userId);
        $progress = UserLevelProgress::byUser($userId);
        $prizes = UserPrize::byUser($userId);
        $avatars = Avatar::byUser($userId);
        $csrfToken = Session::csrfToken();

        $this->render('profile/show', compact('user', 'progress', 'prizes', 'avatars', 'csrfToken') + ['activePage' => 'profile']);
    }

    public function updateAvatar()
    {
        $userId = $this->requireAuth();

        $this->csrfCheck();
        if (!empty($_FILES['avatar']['name'])) {
            $filename = FileUploader::upload(
                $_FILES['avatar'],
                __DIR__ . '/../../public/uploads/avatars/',
                'avatar_'
            );

            $avatar = new Avatar([
                'user_id' => $userId,
                'image' => $filename,
                'activo' => 1
            ]);
            $avatar->save();
            Avatar::activate($avatar->id, $userId);
        }
        $this->redirect('/profile');
    }
}