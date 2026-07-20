<?php
namespace App\Controllers;

use clases\Controller;
use clases\Session;
use clases\FileUploader;
use App\Models\Avatar;

class AvatarController extends Controller
{
    public function index()
    {
        $userId = $this->requireAuth();

        $avatars = Avatar::byUser($userId);
        $csrfToken = Session::csrfToken();
        $this->render('avatars/index', [
            'avatars' => $avatars,
            'csrfToken' => $csrfToken
        ]);
    }

    public function store()
    {
        $userId = $this->requireAuth();
        $this->csrfCheck();

        if (empty($_FILES['image']['name'])) {
            $this->redirect('/profile?error=' . urlencode('Selecciona una imagen.'));
            return;
        }

        $filename = FileUploader::upload(
            $_FILES['image'],
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

        $this->redirect('/profile');
    }

    public function update($id)
    {
        $userId = $this->requireAuth();
        $this->csrfCheck();

        $avatar = Avatar::find($id);
        if (!$avatar || (int)$avatar->user_id !== (int)$userId) {
            $this->redirect('/profile');
            return;
        }

        if (!empty($_FILES['image']['name'])) {
            $wasActive = (bool)$avatar->activo;
            $avatar->image = FileUploader::upload(
                $_FILES['image'],
                __DIR__ . '/../../public/uploads/avatars/',
                'avatar_'
            );
            $avatar->save();

            if ($wasActive) {
                Avatar::activate($avatar->id, $userId);
            }
        }

        $this->redirect('/profile');
    }

    public function activate($id)
    {
        $userId = $this->requireAuth();
        $this->csrfCheck();
        Avatar::activate((int)$id, $userId);
        $this->redirect('/profile');
    }

    public function deactivate($id)
    {
        $userId = $this->requireAuth();
        $this->csrfCheck();
        Avatar::deactivate((int)$id, $userId);
        $this->redirect('/profile');
    }

    public function destroy($id)
    {
        $userId = $this->requireAuth();
        $this->csrfCheck();

        $deleted = Avatar::deleteWithFile((int)$id, $userId);
        if (!$deleted) {
            $this->redirect('/profile?error=' . urlencode(
                'No se puede eliminar el avatar activo. Desactívalo o usa otro primero.'
            ));
            return;
        }

        $this->redirect('/profile');
    }
}