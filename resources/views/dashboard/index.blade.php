@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4">
            <i class="fas fa-gamepad text-primary"></i> Bienvenido, {{ auth()->user()->name }}!
        </h1>
    </div>
</div>

<!-- Tarjetas de estadísticas -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-star text-warning fa-3x mb-3"></i>
                <h5 class="card-title">Puntos Totales</h5>
                <p class="card-text fs-3 fw-bold text-primary" id="totalPoints">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-trophy text-success fa-3x mb-3"></i>
                <h5 class="card-title">Niveles Completados</h5>
                <p class="card-text fs-3 fw-bold text-success" id="completedLevels">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-gift text-danger fa-3x mb-3"></i>
                <h5 class="card-title">Premios Obtenidos</h5>
                <p class="card-text fs-3 fw-bold text-danger" id="totalPrizes">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-play-circle text-info fa-3x mb-3"></i>
                <h5 class="card-title">Sesiones Jugadas</h5>
                <p class="card-text fs-3 fw-bold text-info" id="totalSessions">0</p>
            </div>
        </div>
    </div>
</div>

<!-- Temas disponibles -->
<div class="row">
    <div class="col-md-12">
        <h3 class="mb-4"><i class="fas fa-book"></i> Elige un Tema para Jugar</h3>
    </div>
</div>

<div class="row" id="themesContainer">
    <!-- Se cargará dinámicamente con JavaScript -->
</div>

<!-- Modal para seleccionar nivel -->
<div class="modal fade" id="selectLevelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="themeModalTitle">Selecciona un Nivel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="levelList">
                <!-- Se cargará dinámicamente -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cargar estadísticas del usuario
    loadUserStats();
    // Cargar temas disponibles
    loadThemes();
});

function loadUserStats() {
    // Aquí iría la llamada AJAX a /api/profile
    // Por ahora, solo placeholders
}

function loadThemes() {
    const container = document.getElementById('themesContainer');
    
    // Temas de ejemplo
    const themes = [
        { id: 1, name: 'PHP', icon: 'fab fa-php', color: 'primary' },
        { id: 2, name: 'JavaScript', icon: 'fab fa-js-square', color: 'warning' },
        { id: 3, name: 'Laravel', icon: 'fab fa-laravel', color: 'danger' }
    ];

    themes.forEach(theme => {
        const card = `
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm cursor-pointer theme-card" onclick="selectTheme(${theme.id}, '${theme.name}')">
                    <div class="card-body text-center">
                        <i class="${theme.icon} text-${theme.color} fa-4x mb-3"></i>
                        <h5 class="card-title">${theme.name}</h5>
                        <p class="card-text text-muted">Haz clic para comenzar</p>
                    </div>
                </div>
            </div>
        `;
        container.innerHTML += card;
    });
}

function selectTheme(themeId, themeName) {
    document.getElementById('themeModalTitle').textContent = `Selecciona un nivel de ${themeName}`;
    
    const levels = [
        { id: 1, name: 'Básico' },
        { id: 2, name: 'Intermedio' },
        { id: 3, name: 'Avanzado' }
    ];

    let levelList = '';
    levels.forEach(level => {
        levelList += `
            <button class="btn btn-outline-primary w-100 mb-2" onclick="startGame(${themeId}, ${level.id})">
                <i class="fas fa-play"></i> ${level.name}
            </button>
        `;
    });

    document.getElementById('levelList').innerHTML = levelList;
    new bootstrap.Modal(document.getElementById('selectLevelModal')).show();
}

function startGame(themeId, levelId) {
    window.location.href = `/game/play?theme=${themeId}&level=${levelId}`;
}
</script>
@endsection