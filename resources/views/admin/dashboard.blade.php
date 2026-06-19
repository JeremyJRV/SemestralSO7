@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4"><i class="fas fa-cog"></i> Panel de Administración</h1>
    </div>
</div>

<!-- Estadísticas generales -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-users text-primary fa-3x mb-3"></i>
                <h5>Total de Usuarios</h5>
                <p class="fs-3 fw-bold" id="totalUsers">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-book text-info fa-3x mb-3"></i>
                <h5>Total de Temas</h5>
                <p class="fs-3 fw-bold" id="totalThemes">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-question-circle text-success fa-3x mb-3"></i>
                <h5>Total de Preguntas</h5>
                <p class="fs-3 fw-bold" id="totalQuestions">0</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-gamepad text-warning fa-3x mb-3"></i>
                <h5>Total de Sesiones</h5>
                <p class="fs-3 fw-bold" id="totalSessions">0</p>
            </div>
        </div>
    </div>
</div>

<!-- Panel de control -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-tools"></i> Herramientas de Administración</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                            <i class="fas fa-user-cog"></i> Gestionar Usuarios
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.themes') }}" class="btn btn-info w-100">
                            <i class="fas fa-book-open"></i> Gestionar Temas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.questions') }}" class="btn btn-success w-100">
                            <i class="fas fa-pen-fancy"></i> Gestionar Preguntas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.reports') }}" class="btn btn-warning w-100">
                            <i class="fas fa-file-excel"></i> Ver Reportes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Últimos logins -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history"></i> Últimos Inicios de Sesión</h5>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>IP</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="loginsTable">
                        <!-- Se cargará dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection