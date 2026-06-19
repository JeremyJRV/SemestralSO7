@extends('layouts.app')

@section('title', 'Gestión de Preguntas')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1 class="mb-4"><i class="fas fa-pen-fancy"></i> Gestión de Preguntas</h1>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createQuestionModal">
            <i class="fas fa-plus"></i> Nueva Pregunta
        </button>
    </div>
</div>

<!-- Filtros -->
<div class="row mb-4">
    <div class="col-md-4">
        <select class="form-select" id="filterTheme">
            <option value="">Todos los temas</option>
            <option value="1">PHP</option>
            <option value="2">JavaScript</option>
            <option value="3">Laravel</option>
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-select" id="filterLevel">
            <option value="">Todos los niveles</option>
            <option value="1">Básico</option>
            <option value="2">Intermedio</option>
            <option value="3">Avanzado</option>
        </select>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" id="searchQuestion" 
               placeholder="Buscar pregunta...">
    </div>
</div>

<!-- Tabla de preguntas -->
<div class="card shadow">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pregunta</th>
                    <th>Tema</th>
                    <th>Nivel</th>
                    <th>Tipo</th>
                    <th>Dificultad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="questionsTable">
                <!-- Se cargará dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal crear pregunta -->
<div class="modal fade" id="createQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Pregunta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createQuestionForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tema</label>
                        <select class="form-select" name="theme_id" required>
                            <option>Seleccionar tema...</option>
                            <option value="1">PHP</option>
                            <option value="2">JavaScript</option>
                            <option value="3">Laravel</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nivel</label>
                            <select class="form-select" name="level_id" required>
                                <option>Seleccionar nivel...</option>
                                <option value="1">Básico</option>
                                <option value="2">Intermedio</option>
                                <option value="3">Avanzado</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo</label>
                            <select class="form-select" name="type" required onchange="changeQuestionType(this)">
                                <option value="opción_múltiple">Opción Múltiple</option>
                                <option value="verdadero_falso">Verdadero/Falso</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pregunta</label>
                        <textarea class="form-control" name="question_text" rows="3" required></textarea>
                    </div>

                    <div id="optionsContainer">
                        <!-- Opciones dinámicas -->
                        <label class="form-label">Opciones de respuesta</label>
                        <div class="mb-2">
                            <input type="text" class="form-control mb-2" placeholder="Opción 1">
                            <input type="text" class="form-control mb-2" placeholder="Opción 2">
                            <input type="text" class="form-control mb-2" placeholder="Opción 3">
                            <input type="text" class="form-control mb-3" placeholder="Opción 4">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Respuesta Correcta</label>
                        <select class="form-select" name="correct_answer_id" required>
                            <option>Seleccionar...</option>
                            <option value="1">Opción 1</option>
                            <option value="2">Opción 2</option>
                            <option value="3">Opción 3</option>
                            <option value="4">Opción 4</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Explicación</label>
                        <textarea class="form-control" name="explanation" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Pregunta</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadQuestions();
});

function loadQuestions() {
    // Aquí iría llamada AJAX a /api/questions
    const table = document.getElementById('questionsTable');
    const rows = `
        <tr>
            <td>1</td>
            <td>¿Cuál es la palabra clave para crear una función en PHP?</td>
            <td>PHP</td>
            <td>Básico</td>
            <td><span class="badge bg-info">Opción Múltiple</span></td>
            <td><span class="badge bg-warning">5/10</span></td>
            <td>
                <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    `;
    table.innerHTML = rows;
}

function changeQuestionType(select) {
    const container = document.getElementById('optionsContainer');
    if (select.value === 'verdadero_falso') {
        container.innerHTML = `
            <label class="form-label">Opciones de respuesta</label>
            <div class="mb-2">
                <input type="text" class="form-control mb-2" value="Verdadero" readonly>
                <input type="text" class="form-control mb-3" value="Falso" readonly>
            </div>
        `;
    }
}

document.getElementById('createQuestionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Pregunta creada exitosamente');
    bootstrap.Modal.getInstance(document.getElementById('createQuestionModal')).hide();
});
</script>
@endsection