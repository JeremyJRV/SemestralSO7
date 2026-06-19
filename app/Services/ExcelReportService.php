<?php

namespace App\Services;

use App\Models\UserLevel;
use App\Models\GameResponse;
use App\Models\GameSession;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\PatternFill;

/**
 * ExcelReportService
 * Generador de reportes en formato Excel
 */
class ExcelReportService
{
    private Spreadsheet $spreadsheet;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }

    /**
     * Genera reporte de progreso de usuarios
     */
    public function generateUserProgressReport()
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setTitle('Progreso de Usuarios');

        // Encabezados
        $headers = [
            'ID Usuario',
            'Nombre',
            'Email',
            'Apodo',
            'Tema',
            'Nivel Actual',
            'Puntos',
            'Intentos',
            'Completado',
            'Fecha Inicio',
            'Fecha Completado'
        ];

        $this->writeHeaders($sheet, $headers);

        // Datos
        $userLevels = UserLevel::with(['user', 'theme', 'level'])->get();
        $row = 2;

        foreach ($userLevels as $userLevel) {
            $sheet->setCellValue('A' . $row, $userLevel->user->id);
            $sheet->setCellValue('B' . $row, $userLevel->user->name);
            $sheet->setCellValue('C' . $row, $userLevel->user->email);
            $sheet->setCellValue('D' . $row, $userLevel->user->nickname);
            $sheet->setCellValue('E' . $row, $userLevel->theme->name);
            $sheet->setCellValue('F' . $row, $userLevel->level->name);
            $sheet->setCellValue('G' . $row, $userLevel->points);
            $sheet->setCellValue('H' . $row, $userLevel->attempts);
            $sheet->setCellValue('I' . $row, $userLevel->is_completed ? 'Sí' : 'No');
            $sheet->setCellValue('J' . $row, $userLevel->created_at->format('Y-m-d H:i'));
            $sheet->setCellValue('K' . $row, $userLevel->passed_at?->format('Y-m-d H:i') ?? 'N/A');

            $row++;
        }

        $this->autoSizeColumns($sheet);

        return $this->saveFile('Progreso_Usuarios_' . now()->format('Ymd_His'));
    }

    /**
     * Genera reporte de tiempos de respuesta
     */
    public function generateResponseTimesReport()
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setTitle('Tiempos de Respuesta');

        // Encabezados
        $headers = [
            'ID Sesión',
            'Usuario',
            'Tema',
            'Nivel',
            'ID Pregunta',
            'Texto Pregunta',
            'Tiempo (segundos)',
            'Correcto',
            'Fecha'
        ];

        $this->writeHeaders($sheet, $headers);

        // Datos
        $responses = GameResponse::with([
            'gameSession',
            'gameSession.user',
            'gameSession.theme',
            'gameSession.level',
            'question'
        ])->get();

        $row = 2;

        foreach ($responses as $response) {
            $sheet->setCellValue('A' . $row, $response->game_session_id);
            $sheet->setCellValue('B' . $row, $response->gameSession->user->name);
            $sheet->setCellValue('C' . $row, $response->gameSession->theme->name);
            $sheet->setCellValue('D' . $row, $response->gameSession->level->name);
            $sheet->setCellValue('E' . $row, $response->question_id);
            $sheet->setCellValue('F' . $row, substr($response->question->question_text, 0, 50));
            $sheet->setCellValue('G' . $row, $response->time_spent_seconds);
            $sheet->setCellValue('H' . $row, $response->is_correct ? 'Sí' : 'No');
            $sheet->setCellValue('I' . $row, $response->answered_at->format('Y-m-d H:i'));

            $row++;
        }

        $this->autoSizeColumns($sheet);

        return $this->saveFile('Tiempos_Respuesta_' . now()->format('Ymd_His'));
    }

    /**
     * Genera reporte de tiempos entre niveles
     */
    public function generateLevelTimesReport()
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setTitle('Tiempos Entre Niveles');

        // Encabezados
        $headers = [
            'Usuario',
            'Tema',
            'Nivel',
            'Tiempo Promedio (min)',
            'Tiempo Total (min)',
            'Puntuación Final',
            'Fecha Inicio',
            'Fecha Fin'
        ];

        $this->writeHeaders($sheet, $headers);

        // Datos
        $sessions = GameSession::with([
            'user',
            'theme',
            'level'
        ])->where('status', 'completada')->get();

        $row = 2;

        foreach ($sessions as $session) {
            $duration = $session->ended_at->diffInMinutes($session->started_at);
            
            $sheet->setCellValue('A' . $row, $session->user->name);
            $sheet->setCellValue('B' . $row, $session->theme->name);
            $sheet->setCellValue('C' . $row, $session->level->name);
            $sheet->setCellValue('D' . $row, round($duration / max($session->responses()->count(), 1), 2));
            $sheet->setCellValue('E' . $row, $duration);
            $sheet->setCellValue('F' . $row, $session->score);
            $sheet->setCellValue('G' . $row, $session->started_at->format('Y-m-d H:i'));
            $sheet->setCellValue('H' . $row, $session->ended_at->format('Y-m-d H:i'));

            $row++;
        }

        $this->autoSizeColumns($sheet);

        return $this->saveFile('Tiempos_Niveles_' . now()->format('Ymd_His'));
    }

    /**
     * Genera reporte estadístico general
     */
    public function generateGeneralStatisticsReport()
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setTitle('Estadísticas Generales');

        // Título
        $sheet->setCellValue('A1', 'ESTADÍSTICAS GENERALES DEL SISTEMA');
        $sheet->mergeCells('A1:B1');
        $this->styleHeader($sheet, 'A1');

        $row = 3;

        // Datos generales
        $generalData = [
            'Total de Usuarios' => \App\Models\User::count(),
            'Total de Sesiones' => GameSession::count(),
            'Total de Respuestas' => GameResponse::count(),
            'Usuarios Activos' => \App\Models\User::where('is_active', true)->count(),
            'Sesiones Completadas' => GameSession::where('status', 'completada')->count(),
            'Tiempo Promedio Sesión (min)' => round(GameSession::where('status', 'completada')
                                                    ->avg(\DB::raw('TIMESTAMPDIFF(MINUTE, started_at, ended_at)')) ?? 0, 2),
        ];

        foreach ($generalData as $label => $value) {
            $sheet->setCellValue('A' . $row, $label);
            $sheet->setCellValue('B' . $row, $value);
            $row++;
        }

        $this->autoSizeColumns($sheet);

        return $this->saveFile('Estadisticas_Generales_' . now()->format('Ymd_His'));
    }

    /**
     * Escribe encabezados con estilo
     */
    private function writeHeaders($sheet, array $headers): void
    {
        foreach ($headers as $index => $header) {
            $col = chr(65 + $index); // A, B, C...
            $sheet->setCellValue($col . '1', $header);
            $this->styleHeader($sheet, $col . '1');
        }
    }

    /**
     * Aplica estilo de encabezado
     */
    private function styleHeader($sheet, string $cell): void
    {
        $sheet->getStyle($cell)->setFont(new Font([
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ]));

        $sheet->getStyle($cell)->setFill(new PatternFill([
            'fillType' => PatternFill::FILL_SOLID,
            'startColor' => ['rgb' => '0066CC'],
        ]));

        $sheet->getStyle($cell)->setAlignment(new Alignment([
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ]));
    }

    /**
     * Ajusta el tamaño de las columnas automáticamente
     */
    private function autoSizeColumns($sheet): void
    {
        foreach ($sheet->getCoordinates() as $coord) {
            $sheet->getColumnDimension(substr($coord, 0, 1))->setAutoSize(true);
        }
    }

    /**
     * Guarda el archivo Excel
     */
    private function saveFile(string $filename): string
    {
        $writer = new Xlsx($this->spreadsheet);
        $filepath = storage_path("reports/{$filename}.xlsx");

        // Crear carpeta si no existe
        if (!is_dir(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }

        $writer->save($filepath);

        return $filepath;
    }
}