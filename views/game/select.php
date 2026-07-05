<h2>Selecciona Tema y Nivel</h2>

<div class="row mb-4">
    <?php if (in_array($role ?? 'guest', ['armador','admin'])): ?>
    <div class="col-md-6">
        <a href="<?= APP_URL ?>/game/room/create" class="btn btn-outline-success">Crear Sala Multijugador</a>
    </div>
    <?php endif; ?>
    <div class="col-md-6">
        <form class="d-flex" onsubmit="event.preventDefault(); const code = document.getElementById('roomCodeInput').value.trim(); if(code) window.location.href = '<?= APP_URL ?>/game/room/' + encodeURIComponent(code);">
            <input type="text" id="roomCodeInput" class="form-control me-2" placeholder="Código de sala (ej. 4635c5)" required>
            <button type="submit" class="btn btn-primary text-nowrap">Unirse a Sala</button>
        </form>
    </div>
</div>

<div class="row">
    <?php foreach ($levels as $tl): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5><?= htmlspecialchars($tl['theme_name']) ?> - <?= htmlspecialchars($tl['level_name']) ?></h5>
                    <a href="<?= APP_URL ?>/game/start/<?= $tl['id'] ?>" class="btn btn-outline-primary mb-2">Empezar</a>
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1">¿Qué te parece este tema?</small>
                        <button type="button" class="btn btn-sm btn-outline-secondary rate-btn" data-theme="<?= $tl['theme_id'] ?>" data-rating="boring">Aburrido</button>
                        <button type="button" class="btn btn-sm btn-outline-warning rate-btn" data-theme="<?= $tl['theme_id'] ?>" data-rating="interesting">Interesante</button>
                        <button type="button" class="btn btn-sm btn-outline-success rate-btn" data-theme="<?= $tl['theme_id'] ?>" data-rating="great">Genial</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
document.querySelectorAll('.rate-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const themeId = btn.dataset.theme;
        const rating = btn.dataset.rating;
        fetch('<?= APP_URL ?>/themes/rate', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `theme_id=${themeId}&rating=${rating}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                btn.textContent = '¡Gracias!';
                btn.disabled = true;
            } else {
                alert(data.error || 'Error al calificar');
            }
        });
    });
});
</script>