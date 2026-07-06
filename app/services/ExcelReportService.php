<?php
namespace App\Services;

use clases\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelReportService
{
    public function generateUserProgressReport(): string
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query(
            "SELECT u.username, u.email,
                    GROUP_CONCAT(CONCAT(t.name, ' - ', l.name, ' (', ulp.score_percentage, '%)') SEPARATOR ', ') as levels,
                    u.total_points,
                    (SELECT AVG(gr.response_time_ms)
                     FROM game_responses gr
                     JOIN game_sessions gs ON gr.session_id = gs.id
                     WHERE gr.user_id = u.id) as avg_response_time_ms,
                    (SELECT AVG(TIMESTAMPDIFF(SECOND, gs.started_at, gs.finished_at))
                     FROM game_sessions gs
                     WHERE gs.host_user_id = u.id AND gs.finished_at IS NOT NULL) as avg_session_duration_sec
             FROM users u
             LEFT JOIN user_level_progress ulp ON u.id = ulp.user_id
             LEFT JOIN theme_levels tl ON ulp.theme_level_id = tl.id
             LEFT JOIN themes t ON tl.theme_id = t.id
             LEFT JOIN levels l ON tl.level_id = l.id
             GROUP BY u.id"
        );
        $data = $stmt->fetchAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Progreso de Usuarios');

        // Encabezados
        $sheet->fromArray([
            'Usuario', 'Email', 'Niveles (Tema - Nivel - %)', 'Puntos Totales',
            'Tiempo Promedio por Pregunta (ms)', 'Tiempo Promedio entre Niveles (seg)'
        ], null, 'A1');

        // Datos
        $row = 2;
        foreach ($data as $user) {
            $sheet->setCellValue("A$row", $user['username']);
            $sheet->setCellValue("B$row", $user['email']);
            $sheet->setCellValue("C$row", $user['levels'] ?? 'Sin progreso');
            $sheet->setCellValue("D$row", $user['total_points']);
            $sheet->setCellValue("E$row", $user['avg_response_time_ms'] ?? 0);
            $sheet->setCellValue("F$row", $user['avg_session_duration_sec'] ?? 0);
            $row++;
        }

        $filename = 'reporte_progreso_' . date('Ymd_His') . '.xlsx';

        // BUG CORREGIDO: este archivo vive en app/services/, así que hacen
        // falta DOS niveles hacia arriba (../../) para llegar a la raíz del
        // proyecto y de ahí a public/storage/. Antes solo subía un nivel
        // (../public/storage/), lo que apuntaba a app/public/storage/,
        // una carpeta que no existe, y hacía fallar el guardado del Excel.
        $storageDir = __DIR__ . '/../../public/storage/';

        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        $path = $storageDir . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return '/storage/' . $filename; // URL relativa para descargar
    }
}