@extends('layouts.app')

@section('title', 'Jugando Trivia')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-0">
                            <i class="fas fa-question-circle"></i> Pregunta <span id="currentQuestion">1</span> de <span id="totalQuestions">10</span>
                        </h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-sm btn-warning" id="abandonBtn">
                            <i class="fas fa-flag"></i> Abandonar
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Barra de progreso -->
                <div class="progress mb-4" style="height: 25px;">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 10%">
                        10%
                    </div>
                </div>

                <!-- Pregunta -->
                <h4 class="mb-4" id="questionText">Cargando pregunta...</h4>

                <!-- Opciones -->
                <div id="optionsContainer">
                    <!-- Se cargará dinámicamente -->
                </div>

                <!-- Botón siguiente -->
                <div class="mt-4">
                    <button class="btn btn-primary btn-lg w-100" id="nextBtn" disabled>
                        <i class="fas fa-arrow-right"></i> Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timer -->
<div class="position-fixed bottom-0 end-0 p-3">
    <div class="card shadow">
        <div class="card-body">
            <h6 class="mb-0">Tiempo: <span id="timer">00:00</span></h6>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
let currentQuestionIndex = 0;
let selectedOption = null;
let sessionId = null;

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar sesión de juego
    initializeGame();
    startTimer();
});

function initializeGame() {
    const params = new URLSearchParams(window.location.search);
    const themeId = params.get('theme');
    const levelId = params.get('level');

    // Aquí iría llamada AJAX a /api/game/start-session
    // loadNextQuestion();
}

function loadNextQuestion() {
    currentQuestionIndex++;
    updateProgressBar();
    
    const question = {
        id: currentQuestionIndex,
        text: '¿Cuál es la palabra clave para crear una función en PHP?',
        type: 'opción_múltiple',
        options: [
            { id: 1, text: 'function' },
            { id: 2, text: 'func' },
            { id: 3, text: 'def' },
            { id: 4, text: 'void' }
        ]
    };

    displayQuestion(question);
}

function displayQuestion(question) {
    document.getElementById('questionText').textContent = question.text;
    document.getElementById('currentQuestion').textContent = currentQuestionIndex;

    let optionsHtml = '';
    question.options.forEach(option => {
        optionsHtml += `
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="answer" 
                       id="option${option.id}" value="${option.id}" 
                       onchange="selectOption(${option.id})">
                <label class="form-check-label" for="option${option.id}">
                    ${option.text}
                </label>
            </div>
        `;
    });

    document.getElementById('optionsContainer').innerHTML = optionsHtml;
}

function selectOption(optionId) {
    selectedOption = optionId;
    document.getElementById('nextBtn').disabled = false;
}

function updateProgressBar() {
    const progress = (currentQuestionIndex / 10) * 100;
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = progress + '%';
    progressBar.textContent = Math.round(progress) + '%';
}

function startTimer() {
    let seconds = 0;
    setInterval(() => {
        seconds++;
        const minutes = Math.floor(seconds / 60);
        const secs = seconds % 60;
        document.getElementById('timer').textContent = 
            `${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }, 1000);
}
</script>
@endsection