@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="mb-4"><i class="fas fa-users"></i> Gestión de Usuarios</h1>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </button>
    </div>
</div>

<!-- Tabla de usuarios -->
<div class="card shadow">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchUser" 
                       placeholder="Buscar usuario...">
            </div>
            <div class="col-md-6">
                <select class="form-select" id="filterRole">
                    <option value="">Todos los roles</option>
                    <option value="administrador">Administrador</option>
                    <option value="armador">Armador</option>
                    <option value="jugador">Jugador</option>
                </select>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="usersTable">
                <!-- Se cargará dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal crear usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Apodo</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="jugador">Jugador</option>
                            <option value="armador">Armador</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
});

function loadUsers() {
    // Aquí iría llamada AJAX a /api/users
    const usersTable = document.getElementById('usersTable');
    const rows = `
        <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>juan@example.com</td>
            <td><span class="badge bg-primary">Jugador</span></td>
            <td><span class="badge bg-success">Activo</span></td>
            <td>2025-01-15</td>
            <td>
                <button class="btn btn-sm btn-info" title="Editar">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger" title="Eliminar">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
    usersTable.innerHTML = rows;
}

document.getElementById('createUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Usuario creado exitosamente');
    bootstrap.Modal.getInstance(document.getElementById('createUserModal')).hide();
});
</script>
@endsection