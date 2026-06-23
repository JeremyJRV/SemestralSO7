<h2>Perfil de <?= htmlspecialchars($user->username) ?></h2>
<div class="row">
    <div class="col-md-4 text-center">
        <img src="/uploads/avatars/<?= $user->avatar ?: 'default.png' ?>" class="rounded-circle img-thumbnail" width="150">
        <form method="POST" action="/profile/avatar" enctype="multipart/form-data" class="mt-3">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <input type="file" name="avatar" class="form-control mb-2">
            <button type="submit" class="btn btn-sm btn-outline-secondary">Subir foto</button>
        </form>
    </div>
    <div class="col-md-8">
        <table class="table">
            <tr><th>Email</th><td><?= htmlspecialchars($user->email) ?></td></tr>
            <tr><th>Puntos totales</th><td><?= $user->total_points ?></td></tr>
        </table>
        <h5>Progreso por nivel</h5>
        <ul>
            <?php foreach ($progress as $p): ?>
                <li><?= htmlspecialchars($p['theme_name']) ?> - <?= htmlspecialchars($p['level_name']) ?>: <?= $p['score_percentage'] ?>%</li>
            <?php endforeach; ?>
        </ul>
        <h5>Premios obtenidos</h5>
        <div class="row">
            <?php foreach ($prizes as $prize): ?>
                <div class="col-2 text-center">
                    <img src="/images/prizes/<?= $prize['image'] ?: 'default.png' ?>" width="50">
                    <small><?= htmlspecialchars($prize['name']) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>