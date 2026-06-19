@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4"><i class="fas fa-file-excel"></i> Reportes del Sistema</h1>
    </div>
</div>

<!-- Tarjetas de reportes -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users text-primary"></i> Progreso de Usuarios</h5>
                <p class="card-text text-muted">Descarga un reporte detallado del progreso de todos los usuarios incluidas puntuaciones, niveles completados y tiempos.</p>
                <a href="{{ route('reports.user-progress') }}" class="btn btn-primary">
                    <i class="fas fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-stopwatch text-success"></i> Tiempos de Respuesta</h5>
                <p class="card-text text-muted">Análisis de tiempos promedio de respuesta por pregunta y usuario. Útil para identificar preguntas difíciles.</p>
                <a href="{{ route('reports.response-times') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-level-up-alt text-warning"></i> Tiempos Entre Niveles</h5>
                <p class="card-text text-muted">Tiempo dedicado por usuario en completar cada nivel. Incluye duración total y fecha de inicio/fin.</p>
                <a href="{{ route('reports.level-times') }}" class="btn btn-warning">
                    <i class="fas fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chart-bar text-info"></i> Estadísticas Generales</h5>
                <p class="card-text text-muted">Resumen estadístico general del sistema: usuarios activos, sesiones totales, temas más jugados, etc.</p>
                <a href="{{ route('reports.general-statistics') }}" class="btn btn-info">
                    <i class="fas fa-download"></i> Descargar Excel
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row mt-5">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Usuarios por Rol</h5>
            </div>
            <div class="card-body">
                <canvas id="userRoleChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Temas Más Jugados</h5>
            </div>
            <div class="card-body">
                <canvas id="topicChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de usuarios por rol
    const ctxRole = document.getElementById('userRoleChart').getContext('2d');
    new Chart(ctxRole, {
        type: 'doughnut',
        data: {
            labels: ['Jugadores', 'Armadores', 'Administradores'],
            datasets: [{
                data: [150, 25, 5],
                backgroundColor: ['#0066cc', '#28a745', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Gráfico de temas más jugados
    const ctxTopic = document.getElementById('topicChart').getContext('2d');
    new Chart(ctxTopic, {
        type: 'bar',
        data: {
            labels: ['PHP', 'JavaScript', 'Laravel'],
            datasets: [{
                label: 'Partidas Jugadas',
                data: [150, 200, 100],
                backgroundColor: ['#777bb4', '#f7df1e', '#ff2d20']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            }
        }
    });
});
</script>
@endsection