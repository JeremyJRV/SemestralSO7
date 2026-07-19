<?php
namespace App\Services;

use clases\Database;
use App\Models\Theme;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExcelReportService
{
    public function generateUserProgressReport(): string
    {
        $db = Database::getInstance()->getConnection();

        $spreadsheet = new Spreadsheet();

        // ============================================================
        // HOJA 1: Progreso de Usuarios (ya existía).
        // ============================================================
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Progreso de Usuarios');
        $this->fillUserProgressSheet($sheet1, $db);

        // ============================================================
        // HOJA 2 (NUEVA): Resumen General
        // Pedido por la rúbrica actualizada (punto 15): Total de
        // jugadores, Total de partidas, Promedio de Puntuación,
        // Categoría popular, Distribución de jugadores por nivel.
        // ============================================================
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Resumen General');
        $this->fillSummarySheet($sheet2, $db);

        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'reporte_progreso_' . date('Ymd_His') . '.xlsx';
        $storageDir = __DIR__ . '/../../public/storage/';

        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        $path = $storageDir . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return '/storage/' . $filename; // URL relativa para descargar
    }

    /**
     * Hoja 1: una fila por usuario, con su progreso, puntos y tiempos.
     */
    private function fillUserProgressSheet($sheet, \PDO $db): void
    {
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

        $sheet->fromArray([
            'Usuario', 'Email', 'Niveles (Tema - Nivel - %)', 'Puntos Totales',
            'Tiempo Promedio por Pregunta (ms)', 'Tiempo Promedio entre Niveles (seg)'
        ], null, 'A1');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        $row = 2;
        foreach ($data as $user) {
            $sheet->setCellValue("A$row", $user['username']);
            $sheet->setCellValue("B$row", $user['email']);
            $sheet->setCellValue("C$row", $user['levels'] ?? 'Sin progreso');
            $sheet->setCellValue("D$row", $user['total_points']);
            $sheet->setCellValue("E$row", round($user['avg_response_time_ms'] ?? 0));
            $sheet->setCellValue("F$row", round($user['avg_session_duration_sec'] ?? 0));
            $row++;
        }

        foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    /**
     * Hoja 2 (NUEVA): agregados generales del sistema, pedidos por la
     * rúbrica: total de jugadores, total de partidas, promedio de
     * puntuación, categoría/tema popular y distribución de jugadores
     * por nivel (ej. "3 principiantes, 1 experto, 1 novato").
     */
    private function fillSummarySheet($sheet, \PDO $db): void
    {
        // --- Total de jugadores ---
        $totalPlayers = (int) $db->query(
            "SELECT COUNT(*) FROM users WHERE role = 'player'"
        )->fetchColumn();

        // --- Total de partidas (sesiones de juego creadas) ---
        $totalGames = (int) $db->query(
            "SELECT COUNT(*) FROM game_sessions"
        )->fetchColumn();

        // --- Promedio de puntuación (entre jugadores) ---
        $avgScore = (float) $db->query(
            "SELECT AVG(total_points) FROM users WHERE role = 'player'"
        )->fetchColumn();

        // --- Categoría / tema más popular (más jugado) ---
        $mostPlayed = Theme::mostPlayed(1);
        $popularCategory = $mostPlayed[0]['name'] ?? 'Sin datos aún';

        // --- Distribución de jugadores por nivel ---
        // Para cada jugador, se toma el nivel más alto que YA completó
        // (en cualquier tema). Si no ha completado ninguno, cae en
        // "Sin nivel completado".
        $distributionStmt = $db->query(
            "SELECT
                COALESCE(pl.level_name, 'Sin nivel completado') AS level_name,
                COUNT(*) AS total
             FROM (
                SELECT u.id AS user_id,
                    (SELECT l.name
                     FROM user_level_progress ulp
                     JOIN theme_levels tl ON tl.id = ulp.theme_level_id
                     JOIN levels l ON l.id = tl.level_id
                     WHERE ulp.user_id = u.id AND ulp.completed = 1
                     ORDER BY l.order_index DESC
                     LIMIT 1) AS level_name
                FROM users u
                WHERE u.role = 'player'
             ) pl
             GROUP BY level_name
             ORDER BY FIELD(level_name, 'Avanzado','Intermedio','Básico','Sin nivel completado')"
        );
        $distribution = $distributionStmt->fetchAll();

        // ---------- Escribir en la hoja ----------
        $sheet->setCellValue('A1', 'Resumen General del Sistema');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->mergeCells('A1:B1');

        $rows = [
            ['Total de Jugadores', $totalPlayers],
            ['Total de Partidas Jugadas', $totalGames],
            ['Promedio de Puntuación', round($avgScore, 2)],
            ['Categoría / Tema Más Popular', $popularCategory],
        ];

        $r = 3;
        foreach ($rows as [$label, $value]) {
            $sheet->setCellValue("A$r", $label);
            $sheet->setCellValue("B$r", $value);
            $sheet->getStyle("A$r")->getFont()->setBold(true);
            $r++;
        }

        $r += 1;
        $sheet->setCellValue("A$r", 'Distribución de Jugadores por Nivel');
        $sheet->getStyle("A$r")->getFont()->setBold(true)->setSize(12);
        $r++;

        $sheet->setCellValue("A$r", 'Nivel');
        $sheet->setCellValue("B$r", 'Cantidad de Jugadores');
        $sheet->getStyle("A$r:B$r")->getFont()->setBold(true);
        $sheet->getStyle("A$r:B$r")->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('DDEEFF');
        $r++;

        foreach ($distribution as $row) {
            $sheet->setCellValue("A$r", $row['level_name']);
            $sheet->setCellValue("B$r", $row['total']);
            $r++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
    }
}