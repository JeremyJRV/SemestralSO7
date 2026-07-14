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
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $user = User::find($userId);
        $progress = UserLevelProgress::byUser($userId);
        $prizes = UserPrize::byUser($userId);
        $this->render('profile/show', compact('user', 'progress', 'prizes'));
    }

    /**
     * Subida rápida de avatar desde la pantalla de Perfil.
     *
     * ACTUALIZADO: antes esto sobreescribía directamente el campo
     * users.avatar, sin dejar historial ni permitir desactivar sin
     * borrar. Ahora crea un registro nuevo en la tabla `avatars` (CRUD
     * completo en /avatars) y lo activa automáticamente, cumpliendo con
     * el requisito de la rúbrica de tener un módulo de avatares con
     * campo "Activo".
     */
    public function updateAvatar()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

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