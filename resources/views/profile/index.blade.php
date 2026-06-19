@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4"><i class="fas fa-user-circle"></i> Mi Perfil</h1>
    </div>
</div>

<div class="row">
    <!-- Información del usuario -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <img src="{{ auth()->user()->avatar_path ? asset('storage/' . auth()->user()->avatar_path) : 'https://via.placeholder.com/150' }}" 
                     alt="Avatar" class="rounded-circle mb-3" width="150" height="150">
                
                <h4>{{ auth()->user()->name }}</h4>
                <p class="text-muted">@{{ auth()->user()->nickname }}</p>
                <p class="badge bg-primary">{{ strtoupper(auth()->user()->role) }}</p>

                <a href="{{ route('profile.avatar') }}" class="btn btn-primary w-100 mt-3">
                    <i class="fas fa-image"></i> Cambiar Avatar
                </a>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="col-md-8">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-star text-warning"></i> Puntos Totales</h5>
                        <p class="fs-3 fw-bold text-primary" id="totalPoints">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-trophy text-success"></i> Niveles Completados</h5>
                        <p class="fs-3 fw-bold text-success" id="completedLevels">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progreso por tema -->
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Progreso por Tema</h5>
            </div>
            <div class="card-body" id="progressContainer">
                <!-- Se cargará dinámicamente -->
            </div>
        </div>
    </div>
</div>

<!-- Premios obtenidos -->
<div class="row mt-4">
    <div class="col-md-12">
        <h3 class="mb-4"><i class="fas fa-gift"></i> Mis Premios</h3>
    </div>
</div>

<div class="row" id="prizesContainer">
    <!-- Se cargará dinámicamente -->
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadProfileData();
});

function loadProfileData() {
    // Aquí irían llamadas AJAX a /api/profile
    // loadStats();
    // loadProgress();
    // loadPrizes();
}
</script>
@endsection