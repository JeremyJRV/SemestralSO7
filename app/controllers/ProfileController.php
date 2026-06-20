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

    private function uploadAvatar($file): string
    {
        // Validación y movimiento a public/uploads/avatars/
        return 'default_avatar.png';
    }
}