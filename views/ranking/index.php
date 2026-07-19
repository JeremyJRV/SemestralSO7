<style>
    .ranking-podium-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.7rem 1rem;
        border-bottom: 2px solid var(--border-light);
    }
    .ranking-podium-item.me {
        background: var(--primary-lighter);
        border-left: 4px solid var(--primary);
    }
    .ranking-position {
        font-family: var(--font-mono);
        font-weight: 800;
        font-size: 1rem;
        width: 2.2rem;
        text-align: center;
        color: var(--text-gray);
    }
    .ranking-position.gold { color: #d4af37; }
    .ranking-position.silver { color: #a8a8a8; }
    .ranking-position.bronze { color: #b8722c; }
    .ranking-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        border: 2px solid var(--border-dark);
        object-fit: cover;
    }
    .ranking-name { font-family: var(--font-display); font-weight: 700; flex: 1; }
    .ranking-score {
        font-family: var(--font-mono);
        font-weight: 700;
        color: var(--primary);
        text-align: right;
        line-height: 1.3;
    }
    .ranking-score-sub {
        display: block;
        font-weight: 500;
        font-size: 0.65rem;
        color: var(--text-gray, #6b7280);
    }
</style>

<div class="admin-header-innovative">
    <h2><i class="bi bi-bar-chart-fill"></i>Ranking de Jugadores</h2>
    <p>Compara tu avance con el de otros jugadores por tema y nivel.</p>
</div>

<?php if (isset($_GET['error'])): ?>
    <div class="alert-innovative alert-innovative-danger" style="margin-bottom:1.5rem;">
        <i class="bi bi-exclamation-triangle me-1"></i><?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<div class="row g-3">
    <!-- ====== RANKING GLOBAL POR PUNTOS ====== -->
    <div class="col-lg-6">
        <div class="form-card-innovative" style="max-width: none;">
            <div class="corner-deco">Global</div>
            <h5 style="font-family: var(--font-display); font-weight:800; margin-bottom: 1rem;">
                <i class="bi bi-trophy-fill me-1" style="color:#d4af37;"></i>Top Jugadores (Puntos Totales)
            </h5>

            <p class="text-hint" style="margin-bottom: 1rem;">
                Tu posición global: <strong>#<?= $myGlobalPosition ?></strong>
            </p>

            <?php if (!empty($topPlayers)): ?>
                <?php foreach ($topPlayers as $i => $p): ?>
                    <?php
                        $pos = $i + 1;
                        $posClass = $pos === 1 ? 'gold' : ($pos === 2 ? 'silver' : ($pos === 3 ? 'bronze' : ''));
                        $isMe = (int)$p['id'] === (int)$currentUserId;
                    ?>
                    <div class="ranking-podium-item <?= $isMe ? 'me' : '' ?>">
                        <span class="ranking-position <?= $posClass ?>">#<?= $pos ?></span>
                        <img class="ranking-avatar" src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($p['avatar'] ?? 'default.png') ?>" alt="avatar" onerror="this.src='<?= APP_URL ?>/images/default.png'">
                        <span class="ranking-name"><?= htmlspecialchars($p['username']) ?><?= $isMe ? ' (tú)' : '' ?></span>
                        <span class="ranking-score"><?= number_format($p['total_points']) ?> pts</span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-innovative">Aún no hay jugadores con puntos.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ====== RANKING POR TEMA Y NIVEL ====== -->
    <div class="col-lg-6">
        <div class="form-card-innovative" style="max-width: none;">
            <div class="corner-deco">Por Tema</div>
            <h5 style="font-family: var(--font-display); font-weight:800; margin-bottom: 1rem;">
                <i class="bi bi-collection-fill me-1"></i>Ranking por Tema y Nivel
            </h5>

            <form method="GET" action="<?= APP_URL ?>/ranking" class="mb-3">
                <label class="form-label">Selecciona un tema y nivel</label>
                <select name="theme_level_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Selecciona --</option>
                    <?php foreach ($themeLevels as $tl): ?>
                        <option value="<?= $tl->id ?>" <?= ($selectedThemeLevel == $tl->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tl->theme_name ?? 'Tema') ?> - <?= htmlspecialchars($tl->level_name ?? 'Nivel') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($selectedThemeLevel): ?>
                <?php if ($myPosition): ?>
                    <p class="text-hint" style="margin-bottom: 1rem;">
                        Tu posición en este tema-nivel: <strong>#<?= $myPosition ?></strong>
                    </p>
                <?php else: ?>
                    <p class="text-hint" style="margin-bottom: 1rem;">
                        Aún no has jugado este tema-nivel.
                    </p>
                <?php endif; ?>

                <?php if (!empty($ranking)): ?>
                    <?php foreach ($ranking as $i => $r): ?>
                        <?php
                            $pos = $i + 1;
                            $posClass = $pos === 1 ? 'gold' : ($pos === 2 ? 'silver' : ($pos === 3 ? 'bronze' : ''));
                            $isMe = (int)$r['user_id'] === (int)$currentUserId;
                        ?>
                        <div class="ranking-podium-item <?= $isMe ? 'me' : '' ?>">
                            <span class="ranking-position <?= $posClass ?>">#<?= $pos ?></span>
                            <img class="ranking-avatar" src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($r['avatar'] ?? 'default.png') ?>" alt="avatar" onerror="this.src='<?= APP_URL ?>/images/default.png'">
                            <span class="ranking-name"><?= htmlspecialchars($r['username']) ?><?= $isMe ? ' (tú)' : '' ?></span>
                            <span class="ranking-score">
                                <?= number_format($r['theme_level_points'] ?? 0) ?> pts
                                <span class="ranking-score-sub">(<?= number_format($r['score_percentage'], 1) ?>% última partida)</span>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-innovative">Nadie ha jugado este tema-nivel todavía. ¡Sé el primero!</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-gray-innovative">Elige un tema y nivel arriba para ver el ranking.</p>
            <?php endif; ?>
        </div>
    </div>
</div>