<style>
    .stats-header-innovative {
        padding: 1.5rem 2rem;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        margin-bottom: 2rem;
        position: relative;
    }

    .stats-header-innovative::before {
        content: '▣';
        position: absolute;
        top: -8px;
        left: 20px;
        color: var(--primary);
        font-size: 1rem;
    }

    .stats-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.5px;
    }

    .stats-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.5rem;
        transform: rotate(-8deg);
        display: inline-block;
    }

    .stats-header-innovative p {
        color: var(--text-gray);
        margin-bottom: 0;
        font-family: var(--font-display);
    }

    .stat-card-stats-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        padding: 1.5rem;
        box-shadow: var(--shadow-hard);
        height: 100%;
        transition: all 0.2s ease;
    }

    .stat-card-stats-innovative:hover {
        transform: translate(-3px, -3px);
        box-shadow: var(--shadow-hard-hover);
    }

    .stat-card-stats-innovative h5 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        border-bottom: 3px solid var(--border-dark);
        padding-bottom: 0.5rem;
    }

    .stat-card-stats-innovative h5 i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .stat-list-item-innovative {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 2px solid var(--border-light);
    }

    .stat-list-item-innovative:last-child { border-bottom: none; }

    .stat-list-item-innovative .stat-name {
        color: var(--text-gray);
        font-weight: 500;
        font-family: var(--font-display);
    }

    .stat-list-item-innovative .stat-count {
        font-weight: 700;
        color: var(--text-dark);
        font-family: var(--font-display);
    }

    .stat-list-item-innovative .stat-count .badge-count {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.1rem 0.6rem;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        margin-left: 0.3rem;
        border: 2px solid var(--border-dark);
    }

    .rating-bar-innovative {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.4rem 0;
    }

    .rating-bar-innovative .rating-label {
        min-width: 100px;
        color: var(--text-gray);
        font-weight: 500;
        font-size: 0.85rem;
        font-family: var(--font-display);
    }

    .rating-track-innovative {
        flex: 1;
        height: 10px;
        background: var(--bg-page);
        border: 2px solid var(--border-dark);
        overflow: hidden;
        position: relative;
    }

    .rating-track-innovative .fill-boring {
        height: 100%;
        background: #f87171;
        float: left;
    }

    .rating-track-innovative .fill-interesting {
        height: 100%;
        background: #fbbf24;
        float: left;
    }

    .rating-track-innovative .fill-great {
        height: 100%;
        background: #34d399;
        float: left;
    }

    .rating-value-innovative {
        min-width: 30px;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--text-dark);
        text-align: right;
    }

    .rating-legend-innovative {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 0.5rem;
        padding-top: 0.8rem;
        border-top: 2px solid var(--border-dark);
    }

    .rating-legend-innovative .legend-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--font-mono);
        font-size: 0.7rem;
        color: var(--text-gray);
        font-weight: 600;
    }

    .rating-legend-innovative .legend-item .dot {
        width: 12px;
        height: 12px;
        display: inline-block;
        border: 2px solid var(--border-dark);
    }

    .dot-boring { background: #f87171; }
    .dot-interesting { background: #fbbf24; }
    .dot-great { background: #34d399; }

    /* AGREGADO: desglose en texto de % y total de votos por tema */
    .rating-pct-breakdown {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem 0.9rem;
        font-family: var(--font-display);
        font-size: 0.72rem;
        color: var(--text-gray, #6b7280);
        margin-top: 0.35rem;
    }
    .rating-pct-breakdown .pct-item.pct-boring { color: #f87171; }
    .rating-pct-breakdown .pct-item.pct-interesting { color: #d1a02e; }
    .rating-pct-breakdown .pct-item.pct-great { color: #22a876; }
    .rating-pct-breakdown .pct-total {
        font-weight: 700;
        margin-left: auto;
    }

    /* Barra de valoración de la app — MISMO componente visual que en
       views/admin/feedback.php. Se repite aquí porque cada vista trae su
       propio <style> (ver pendiente #4 de DRY: mover estos bloques
       compartidos a un solo CSS incluido en el layout). */
    .app-rating-track-innovative {
        display: flex;
        width: 100%;
        height: 1.4rem;
        border-radius: 999px;
        overflow: hidden;
        background: var(--border-light, #e5e7eb);
        margin-bottom: 0.6rem;
    }
    .app-rating-track-innovative > div {
        height: 100%;
        transition: width 0.4s ease;
    }
    .app-rating-track-innovative .fill-mucho { background: #34d399; }
    .app-rating-track-innovative .fill-bastante { background: #60a5fa; }
    .app-rating-track-innovative .fill-regular { background: #fbbf24; }
    .app-rating-track-innovative .fill-medio { background: #f87171; }

    .divider-innovative {
        border: none;
        border-top: 3px solid var(--border-dark);
        margin: 2rem 0;
        position: relative;
    }

    .divider-innovative::after {
        content: '◆';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--bg-page);
        padding: 0 1rem;
        color: var(--primary);
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .stats-header-innovative { padding: 1rem 1.2rem; }
        .rating-bar-innovative { flex-wrap: wrap; gap: 0.3rem; }
        .rating-bar-innovative .rating-label { min-width: 80px; font-size: 0.75rem; }
        .rating-legend-innovative { gap: 0.8rem; }
    }
</style>

<div class="stats-header-innovative">
    <h2><i class="bi bi-bar-chart-line"></i>Estadísticas</h2>
    <p>Resumen de actividad y rendimiento del sistema</p>
</div>

<div class="row g-3">

    <!-- Mis estadísticas (del usuario logueado, no del sistema) -->
    <div class="col-12">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-person-check"></i>Mis estadísticas</h5>

            <div class="stat-list-item-innovative">
                <span class="stat-name">Partidas jugadas</span>
                <span class="stat-count"><?= (int)($myGamesPlayed ?? 0) ?></span>
            </div>
            <div class="stat-list-item-innovative">
                <span class="stat-name">Porcentaje de aciertos</span>
                <span class="stat-count"><?= number_format($myAccuracy ?? 0, 1) ?>%</span>
            </div>

            <?php if (!empty($myAvgTimePerQuestion)): ?>
                <table class="table" style="font-family: var(--font-display); margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Tema</th>
                            <th>Nivel</th>
                            <th class="text-end">Mi tiempo promedio</th>
                            <th class="text-end">Veces respondida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($myAvgTimePerQuestion as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars(mb_strimwidth($row['question_text'], 0, 60, '...')) ?></td>
                                <td><?= htmlspecialchars($row['theme_name']) ?></td>
                                <td><?= htmlspecialchars($row['level_name']) ?></td>
                                <td class="text-end"><?= number_format($row['avg_time_ms'] / 1000, 2) ?> s</td>
                                <td class="text-end">
                                    <span class="badge-count"><?= $row['total_answers'] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> Aún no has respondido ninguna pregunta.
                </p>
            <?php endif; ?>
        </div>
    </div>

    <hr class="divider-innovative">

    <div class="row g-3">
        <div class="col-12">
            <div class="stat-card-stats-innovative">
                <h5><i class="bi bi-stopwatch"></i>Tiempo promedio de respuesta (todos los usuarios)</h5>


                <p class="stat-name" style="margin-bottom: 1rem;">
                   Promedio general del sistema: 
                   <span class="stat-count">
                    <?= number_format(($overallAvgTime ?? 0) / 1000, 2) ?> s
                   </span>
                </p>

                <?php if (!empty($avgTimePerQuestion)): ?>
                <table class="table" style="font-family: var(--font-display);">
                    <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Tema</th>
                            <th>Nivel</th>
                            <th class="text-end">Tiempo promedio</th>
                            <th class="text-end">Respuestas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($avgTimePerQuestion as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars(mb_strimwidth($row['question_text'], 0, 60, '...')) ?></td>
                                <td><?= htmlspecialchars($row['theme_name']) ?></td>
                                <td><?= htmlspecialchars($row['level_name']) ?></td>
                                <td class="text-end">
                                    <?= number_format($row['avg_time_ms'] / 1000, 2) ?> s
                                </td>
                                <td class="text-end">
                                    <span class="badge-count"><?= $row['total_answers'] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                     <i class="bi bi-emoji-smile me-1"></i> Aún no hay respuestas registradas.   
                    </p>
                <?php endif; ?>
            </div>
        </div>        
    </div>        
                           
    <!-- Temas más jugados -->
    <div class="col-md-6">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-trophy"></i>Temas más jugados</h5>
            <?php if (!empty($mostPlayed)): ?>
                <?php foreach ($mostPlayed as $theme): ?>
                    <div class="stat-list-item-innovative">
                        <span class="stat-name"><?= htmlspecialchars($theme['name']) ?></span>
                        <span class="stat-count">
                            <?= $theme['total_responses'] ?>
                            <span class="badge-count">respuestas</span>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> No hay datos aún.
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- AGREGADO: valoración general de la aplicación (mucho/bastante/
         regular/medio), misma barra que en /admin/feedback, para que se
         vea junto a la de temas ya que ambas son "del sistema". -->
    <div class="col-md-6">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-emoji-smile"></i>Valoración de la aplicación</h5>
            <?php
                $totalAppVotesStats = array_sum($appRatingStats ?? []);
            ?>
            <?php if ($totalAppVotesStats > 0): ?>
                <?php
                    $barTotalStats = $totalAppVotesStats;
                    $muchoPctS = ($appRatingStats['mucho'] ?? 0) / $barTotalStats * 100;
                    $bastantePctS = ($appRatingStats['bastante'] ?? 0) / $barTotalStats * 100;
                    $regularPctS = ($appRatingStats['regular'] ?? 0) / $barTotalStats * 100;
                    $medioPctS = ($appRatingStats['medio'] ?? 0) / $barTotalStats * 100;
                ?>
                <div class="app-rating-track-innovative">
                    <div class="fill-mucho" style="width: <?= $muchoPctS ?>%;"></div>
                    <div class="fill-bastante" style="width: <?= $bastantePctS ?>%;"></div>
                    <div class="fill-regular" style="width: <?= $regularPctS ?>%;"></div>
                    <div class="fill-medio" style="width: <?= $medioPctS ?>%;"></div>
                </div>
                <div class="rating-pct-breakdown">
                    <span class="pct-item pct-great">Mucho: <?= $appRatingStats['mucho'] ?? 0 ?> (<?= number_format($muchoPctS, 0) ?>%)</span>
                    <span class="pct-item">Bastante: <?= $appRatingStats['bastante'] ?? 0 ?> (<?= number_format($bastantePctS, 0) ?>%)</span>
                    <span class="pct-item pct-interesting">Regular: <?= $appRatingStats['regular'] ?? 0 ?> (<?= number_format($regularPctS, 0) ?>%)</span>
                    <span class="pct-item pct-boring">Medio: <?= $appRatingStats['medio'] ?? 0 ?> (<?= number_format($medioPctS, 0) ?>%)</span>
                    <span class="pct-total"><?= $totalAppVotesStats ?> voto<?= $totalAppVotesStats === 1 ? '' : 's' ?> en total</span>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-neutral me-1"></i> Nadie ha calificado la aplicación todavía.
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Calificaciones -->
    <div class="col-md-6">
        <div class="stat-card-stats-innovative">
            <h5><i class="bi bi-star"></i>Calificaciones de temas</h5>
            <?php if (!empty($ratings)): ?>
                <?php foreach ($ratings as $r): ?>
                    <div class="rating-bar-innovative">
                        <span class="rating-label"><?= htmlspecialchars($r['name']) ?></span>
                        <div class="rating-track-innovative">
                            <?php
                                $totalVotes = ($r['boring'] ?? 0) + ($r['interesting'] ?? 0) + ($r['great'] ?? 0);
                                $total = $totalVotes > 0 ? $totalVotes : 1;
                                $boringPct = ($r['boring'] ?? 0) / $total * 100;
                                $interestingPct = ($r['interesting'] ?? 0) / $total * 100;
                                $greatPct = ($r['great'] ?? 0) / $total * 100;
                            ?>
                            <div class="fill-boring" style="width: <?= $boringPct ?>%;"></div>
                            <div class="fill-interesting" style="width: <?= $interestingPct ?>%;"></div>
                            <div class="fill-great" style="width: <?= $greatPct ?>%;"></div>
                        </div>
                        <!-- AGREGADO: porcentaje y total de votos como texto, no solo
                             el color de la barra. Con pocos votos (ej. 1 solo "aburrido")
                             la barra sola se veía 100% roja sin contexto de cuántos
                             votaron en total; ahora queda explícito. -->
                        <?php if ($totalVotes > 0): ?>
                            <div class="rating-pct-breakdown">
                                <span class="pct-item pct-boring">Aburrido: <?= $r['boring'] ?? 0 ?> (<?= number_format($boringPct, 0) ?>%)</span>
                                <span class="pct-item pct-interesting">Interesante: <?= $r['interesting'] ?? 0 ?> (<?= number_format($interestingPct, 0) ?>%)</span>
                                <span class="pct-item pct-great">Genial: <?= $r['great'] ?? 0 ?> (<?= number_format($greatPct, 0) ?>%)</span>
                                <span class="pct-total"><?= $totalVotes ?> voto<?= $totalVotes === 1 ? '' : 's' ?> en total</span>
                            </div>
                        <?php else: ?>
                            <div class="rating-pct-breakdown">
                                <span class="pct-total">Sin votos todavía</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <div class="rating-legend-innovative">
                    <span class="legend-item"><span class="dot dot-boring"></span>Aburrido</span>
                    <span class="legend-item"><span class="dot dot-interesting"></span>Interesante</span>
                    <span class="legend-item"><span class="dot dot-great"></span>Genial</span>
                </div>
            <?php else: ?>
                <p class="text-gray-innovative text-center" style="padding: 1rem 0; font-family: var(--font-display);">
                    <i class="bi bi-emoji-smile me-1"></i> No hay calificaciones aún.
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>