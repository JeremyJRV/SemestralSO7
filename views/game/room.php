<h2>Código de Sala: <?= htmlspecialchars($roomCode) ?></h2>
<p>Comparte este código con otros jugadores para que se unan.</p>
<a href="/game/play/<?= $sessionId ?>" class="btn btn-success">Comenzar partida</a>