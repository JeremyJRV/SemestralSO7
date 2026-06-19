@extends('layouts.app')

@section('title', 'Temas')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4">
            <i class="fas fa-book"></i> Temas Disponibles
        </h1>
    </div>
</div>

<!-- Filtros -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="searchTheme" 
                               placeholder="Buscar tema...">
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" id="sortTheme">
                            <option value="name">Ordenar por nombre</option>
                            <option value="plays">Más jugado</option>
                            <option value="rating">Mayor calificación</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Temas -->
<div class="row" id="themesContainer">
    <!-- Se cargará dinámicamente -->
</div>

<!-- Modal para calificar tema -->
<div class="modal fade" id="rateThemeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Califica este Tema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around mb-4">
                    <button class="btn btn-outline-secondary btn-lg" onclick="rateTheme(1, 'Aburrido')">
                        <i class="fas fa-frown fa-2x"></i>
                        <p>Aburrido</p>
                    </button>
                    <button class="btn btn-outline-warning btn-lg" onclick="rateTheme(2, 'Interesante')">
                        <i class="fas fa-smile fa-2x"></i>
                        <p>Interesante</p>
                    </button>
                    <button class="btn btn-outline-success btn-lg" onclick="rateTheme(3, 'Genial')">
                        <i class="fas fa-grin-stars fa-2x"></i>
                        <p>Genial!</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
let currentThemeId = null;

document.addEventListener('DOMContentLoaded', function() {
    loadThemes();
});

function loadThemes() {
    const themes = [
        { id: 1, name: 'PHP', icon: 'fab fa-php', color: 'primary', plays: 150, rating: 4.5 },
        { id: 2, name: 'JavaScript', icon: 'fab fa-js-square', color: 'warning', plays: 200, rating: 4.8 },
        { id: 3, name: 'Laravel', icon: 'fab fa-laravel', color: 'danger', plays: 100, rating: 4.7 }
    ];

    const container = document.getElementById('themesContainer');
    container.innerHTML = '';

    themes.forEach(theme => {
        const card = `
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm theme-card">
                    <div class="card-body text-center">
                        <i class="${theme.icon} text-${theme.color} fa-4x mb-3"></i>
                        <h5 class="card-title">${theme.name}</h5>
                        <p class="text-muted mb-3">
                            <i class="fas fa-play-circle"></i> ${theme.plays} jugadas
                        </p>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <span class="fw-bold">${theme.rating}</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mb-2" onclick="playTheme(${theme.id})">
                            <i class="fas fa-play"></i> Jugar
                        </button>
                        <button class="btn btn-outline-secondary btn-sm w-100" 
                                onclick="openRateModal(${theme.id})">
                            <i class="fas fa-heart"></i> Calificar
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.innerHTML += card;
    });
}

function playTheme(themeId) {
    window.location.href = `/game/play?theme=${themeId}`;
}

function openRateModal(themeId) {
    currentThemeId = themeId;
    new bootstrap.Modal(document.getElementById('rateThemeModal')).show();
}

function rateTheme(rating, label) {
    alert(`Has calificado como "${label}". ¡Gracias!`);
    bootstrap.Modal.getInstance(document.getElementById('rateThemeModal')).hide();
}
</script>
@endsection