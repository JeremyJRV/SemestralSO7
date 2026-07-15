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
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');

        $avatars = Avatar::byUser($userId);
        $csrfToken = Session::csrfToken();
        $this->render('avatars/index', [
            'avatars' => $avatars,
            'csrfToken' => $csrfToken
        ]);
    }

    // Agregar una imagen nueva (se activa automáticamente al subirla)
    public function store()
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $this->csrfCheck();

        if (empty($_FILES['image']['name'])) {
            $this->redirect('/avatars?error=' . urlencode('Selecciona una imagen.'));
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

        $this->redirect('/avatars');
    }

    // Modificar la imagen de un avatar ya existente
    public function update($id)
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $this->csrfCheck();

        $avatar = Avatar::find($id);
        if (!$avatar || (int)$avatar->user_id !== (int)$userId) {
            $this->redirect('/avatars');
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

            // Si este avatar era el activo, refrescar users.avatar con la nueva imagen
            if ($wasActive) {
                Avatar::activate($avatar->id, $userId);
            }
        }

        $this->redirect('/avatars');
    }

    // Marcar un avatar como el activo (desactiva los demás automáticamente)
    public function activate($id)
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        // BUG CORREGIDO: esta acción modifica datos pero estaba expuesta
        // como link GET sin validar CSRF (a diferencia de store()/update()
        // en este mismo controlador). Un <img src="...avatars/deactivate/5">
        // en un sitio externo podía activar/desactivar el avatar de
        // cualquier usuario logueado sin que lo supiera. Ahora exige POST
        // + token CSRF, igual que el resto de acciones que modifican datos.
        $this->csrfCheck();
        Avatar::activate((int)$id, $userId);
        $this->redirect('/avatars');
    }

    // "Eliminar" = desactivar (campo Activo). NUNCA se borra de la BD.
    public function deactivate($id)
    {
        $userId = Session::get('user_id');
        if (!$userId) $this->redirect('/login');
        $this->csrfCheck();
        Avatar::deactivate((int)$id, $userId);
        $this->redirect('/avatars');
    }
}