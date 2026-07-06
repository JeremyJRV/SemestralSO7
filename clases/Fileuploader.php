<?php
namespace clases;

/**
 * Clase centralizada para subir imágenes (avatares, premios, etc.).
 *
 * BUG DE DRY CORREGIDO: antes, PrizeController::uploadImage() y
 * ProfileController::uploadAvatar() tenían exactamente la misma lógica
 * de validación (tipos permitidos, tamaño máximo, extensión) copiada y
 * pegada en dos archivos distintos. Ahora ambos controladores llaman a
 * este único método.
 */
class FileUploader
{
    private const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    private const MAX_SIZE = 2 * 1024 * 1024; // 2MB

    /**
     * Sube un archivo de imagen a $destinationDir.
     *
     * @param array  $file            Un elemento de $_FILES (ej. $_FILES['avatar'])
     * @param string $destinationDir  Ruta absoluta de la carpeta destino
     * @param string $prefix          Prefijo para el nombre del archivo (ej. 'avatar_', 'prize_')
     * @return string                 Nombre del archivo guardado, o 'default.png' si falla
     */
    public static function upload(array $file, string $destinationDir, string $prefix = ''): string
    {
        if (empty($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return 'default.png';
        }

        $tmpPath = $file['tmp_name'];
        $mimeType = mime_content_type($tmpPath);

        if (!in_array($mimeType, self::ALLOWED_TYPES)) {
            return 'default.png'; // tipo de archivo no permitido
        }

        if ($file['size'] > self::MAX_SIZE) {
            return 'default.png'; // demasiado grande
        }

        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0775, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $prefix . uniqid() . '.' . $ext;
        $destination = rtrim($destinationDir, '/') . '/' . $filename;

        if (move_uploaded_file($tmpPath, $destination)) {
            return $filename;
        }

        return 'default.png';
    }
}