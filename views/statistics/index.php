<h2>Estadísticas</h2>
<div class="row">
    <div class="col-md-6">
        <h4>Temas más jugados</h4>
        <ul class="list-group">
            <?php foreach ($mostPlayed as $theme): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?= htmlspecialchars($theme['name']) ?>
                    <span class="badge bg-primary"><?= $theme['total_responses'] ?> respuestas</span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-6">
        <h4>Calificaciones de temas</h4>
        <table class="table">
            <thead><tr><th>Tema</th><th>Aburrido</th><th>Interesante</th><th>Genial</th></tr></thead>
            <tbody>
                <?php foreach ($ratings as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= $r['boring'] ?></td>
                    <td><?= $r['interesting'] ?></td>
                    <td><?= $r['great'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>