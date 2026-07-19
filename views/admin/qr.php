<style>
    .qr-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.2rem; }
    .qr-card {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.2rem;
        text-align: center;
        box-shadow: var(--shadow-hard);
    }
    .qr-card img { border: 2px solid var(--border-dark); margin-bottom: 0.8rem; }
    .qr-card h6 { font-family: var(--font-display); font-weight: 800; margin-bottom: 0.3rem; }
    .qr-link-box {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        background: #f1f5f9;
        border: 1px solid var(--border-light);
        padding: 0.4rem;
        word-break: break-all;
        margin: 0.6rem 0;
    }
</style>

<div class="admin-header-innovative">
    <h2><i class="bi bi-qr-code"></i>Códigos QR de Acceso</h2>
    <p>Comparte estos códigos para que los jugadores accedan directo a un set de preguntas.</p>
</div>

<?php if (!empty($themeLevels)): ?>
    <div class="qr-grid">
        <?php foreach ($themeLevels as $tl): ?>
            <?php
                $link = APP_URL . '/qr/' . $tl->id;
                $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' . urlencode($link);
            ?>
            <div class="qr-card">
                <h6><?= htmlspecialchars($tl->theme_name ?? 'Tema') ?></h6>
                <p class="text-hint" style="margin-bottom:0.6rem;"><?= htmlspecialchars($tl->level_name ?? 'Nivel') ?></p>

                <img src="<?= htmlspecialchars($qrImageUrl) ?>" alt="QR <?= htmlspecialchars($tl->theme_name) ?> - <?= htmlspecialchars($tl->level_name) ?>" width="180" height="180">

                <div class="qr-link-box"><?= htmlspecialchars($link) ?></div>

                <a href="<?= htmlspecialchars($qrImageUrl) ?>" download="qr_<?= htmlspecialchars($tl->theme_name) ?>_<?= htmlspecialchars($tl->level_name) ?>.png" class="btn-admin-innovative btn-admin-innovative-sm">
                    <i class="bi bi-download me-1"></i>Descargar
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-gray-innovative">Aún no hay temas con niveles creados.</p>
<?php endif; ?>