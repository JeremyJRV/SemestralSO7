<style>
    /* ============================================
       RANKING - LAYOUT DE DOS COLUMNAS
       Sidebar izquierda | Lista derecha
    ============================================ */

    /* ============================================
       CONTENEDOR PRINCIPAL - DOS COLUMNAS
    ============================================ */
    .ranking-layout-innovative {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 992px) {
        .ranking-layout-innovative {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }

    /* ============================================
       SIDEBAR IZQUIERDA - POSICION + FILTRO
    ============================================ */
    .ranking-sidebar-innovative {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
        position: sticky;
        top: 80px;
    }

    @media (max-width: 992px) {
        .ranking-sidebar-innovative {
            position: static;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .ranking-sidebar-innovative > * {
            flex: 1;
            min-width: 200px;
        }
    }

    @media (max-width: 576px) {
        .ranking-sidebar-innovative {
            flex-direction: column;
        }

        .ranking-sidebar-innovative > * {
            flex: none;
            min-width: auto;
        }
    }

    /* TARJETA DE POSICION */
    .my-rank-card-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1rem 1.2rem;
        text-align: center;
        position: relative;
    }

    .my-rank-card-innovative::before {
        content: '\F47D';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -8px;
        right: 12px;
        color: var(--primary);
        font-size: 0.8rem;
        opacity: 0.3;
    }

    .my-rank-card-innovative .rank-label {
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
        display: block;
        margin-bottom: 0.1rem;
    }

    .my-rank-card-innovative .rank-number {
        font-family: var(--font-display);
        font-weight: 900;
        font-size: 2.4rem;
        color: var(--primary);
        line-height: 1.1;
        display: block;
    }

    .my-rank-card-innovative .rank-sub {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        color: var(--text-gray);
        margin-top: 0.2rem;
        display: block;
    }

    .my-rank-card-innovative .rank-badge {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        padding: 0.1rem 0.8rem;
        border: 2px solid var(--border-dark);
        margin-top: 0.4rem;
        background: var(--primary);
        color: white;
    }

    /* FILTRO EN SIDEBAR */
    .ranking-filter-sidebar-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 1rem 1.2rem;
    }

    .ranking-filter-sidebar-innovative label {
        font-family: var(--font-mono);
        font-size: 0.55rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-gray);
        display: block;
        margin-bottom: 0.3rem;
    }

    .ranking-filter-sidebar-innovative label i {
        margin-right: 0.3rem;
    }

    .ranking-filter-sidebar-innovative select {
        width: 100%;
        border: 2px solid var(--border-dark);
        border-radius: 0;
        padding: 0.4rem 0.8rem;
        font-family: var(--font-display);
        font-size: 0.8rem;
        transition: all 0.2s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231a2634' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.8rem center;
        background-size: 10px;
        cursor: pointer;
    }

    .ranking-filter-sidebar-innovative select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 3px 3px 0px var(--border-dark);
    }

    .ranking-filter-sidebar-innovative .filter-hint {
        font-family: var(--font-mono);
        font-size: 0.5rem;
        color: var(--text-light);
        margin-top: 0.3rem;
        display: block;
    }

    /* ============================================
       COLUMNA PRINCIPAL DERECHA - LISTA
    ============================================ */
    .ranking-main-innovative {
        min-width: 0;
    }

    .ranking-header-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 0.8rem 1.5rem;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .ranking-header-innovative h2 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: -0.3px;
        margin: 0;
    }

    .ranking-header-innovative h2 i {
        color: var(--primary);
        margin-right: 0.4rem;
        font-size: 1.1rem;
    }

    .ranking-header-innovative .header-count {
        font-family: var(--font-mono);
        font-size: 0.6rem;
        font-weight: 700;
        color: var(--text-gray);
        background: var(--primary-lighter);
        padding: 0.1rem 0.8rem;
        border: 2px solid var(--border-dark);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* ============================================
       LISTA DE JUGADORES - COMPACTA
    ============================================ */
    .ranking-list-container-innovative {
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        overflow: hidden;
    }

    .ranking-list-header-innovative {
        display: grid;
        grid-template-columns: 48px 1fr 90px;
        gap: 0.8rem;
        padding: 0.5rem 1rem;
        background: var(--primary-darker);
        color: white;
        font-family: var(--font-mono);
        font-size: 0.55rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .ranking-list-header-innovative span:last-child {
        text-align: right;
    }

    .ranking-list-item-innovative {
        display: grid;
        grid-template-columns: 48px 1fr 90px;
        gap: 0.8rem;
        align-items: center;
        padding: 0.4rem 1rem;
        border-bottom: 2px solid var(--border-light);
        transition: background 0.15s ease;
        min-height: 44px;
    }

    .ranking-list-item-innovative:last-child {
        border-bottom: none;
    }

    .ranking-list-item-innovative:hover {
        background: var(--primary-lighter);
    }

    /* JUGADOR ACTUAL - DESTACADO */
    .ranking-list-item-innovative.me {
        background: #dbeafe;
        border-left: 4px solid var(--primary);
        border-bottom-color: var(--primary);
    }

    /* POSICION */
    .ranking-list-item-innovative .pos {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 0.9rem;
        color: var(--text-gray);
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .ranking-list-item-innovative .pos .pos-medal {
        font-size: 0.7rem;
        line-height: 1;
    }

    .ranking-list-item-innovative .pos .pos-medal.gold {
        color: var(--gold);
    }

    .ranking-list-item-innovative .pos .pos-medal.silver {
        color: var(--silver);
    }

    .ranking-list-item-innovative .pos .pos-medal.bronze {
        color: var(--bronze);
    }

    .ranking-list-item-innovative .pos .pos-number {
        min-width: 24px;
    }

    /* JUGADOR */
    .ranking-list-item-innovative .player {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        min-width: 0;
    }

    .ranking-list-item-innovative .player .player-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 2px solid var(--border-dark);
        object-fit: cover;
        background: var(--bg-page);
        flex-shrink: 0;
    }

    .ranking-list-item-innovative .player .player-name {
        font-family: var(--font-display);
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.85rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ranking-list-item-innovative .player .player-name .me-tag {
        font-size: 0.45rem;
        font-weight: 700;
        color: var(--primary);
        background: var(--primary-light);
        padding: 0.05rem 0.35rem;
        border: 2px solid var(--border-dark);
        margin-left: 0.3rem;
        display: inline-block;
        vertical-align: middle;
    }

    /* PUNTAJE */
    .ranking-list-item-innovative .score {
        font-family: var(--font-mono);
        font-weight: 700;
        color: var(--primary);
        text-align: right;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    /* ============================================
       RANKING POR TEMA (en columna principal)
    ============================================ */
    .ranking-theme-section-innovative {
        margin-top: 1.5rem;
        border-top: 3px solid var(--border-dark);
        padding-top: 1.2rem;
        position: relative;
    }

    .ranking-theme-section-innovative::before {
        content: '\F4E6';
        font-family: 'bootstrap-icons';
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--bg-page);
        color: var(--primary);
        padding: 0 1rem;
        font-size: 0.7rem;
        border: 2px solid var(--border-dark);
    }

    .ranking-theme-header-innovative {
        background: var(--primary-darker);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
        padding: 0.6rem 1.2rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .ranking-theme-header-innovative h3 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 1rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin: 0;
    }

    .ranking-theme-header-innovative h3 i {
        color: var(--gold);
        margin-right: 0.4rem;
    }

    .ranking-theme-header-innovative .theme-count {
        font-family: var(--font-mono);
        font-size: 0.5rem;
        color: rgba(255,255,255,0.4);
        letter-spacing: 0.3px;
    }

    /* ============================================
       ESTADO VACIO
    ============================================ */
    .ranking-empty-innovative {
        padding: 2rem 1rem;
        text-align: center;
        background: var(--bg-card);
        border: 3px solid var(--border-dark);
        box-shadow: var(--shadow-hard);
    }

    .ranking-empty-innovative .empty-icon {
        font-size: 2.5rem;
        color: var(--text-light);
        display: block;
        margin-bottom: 0.3rem;
    }

    .ranking-empty-innovative p {
        font-family: var(--font-display);
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .ranking-empty-innovative p strong {
        color: var(--primary);
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .ranking-list-header-innovative {
            grid-template-columns: 36px 1fr 70px;
            font-size: 0.5rem;
            padding: 0.4rem 0.8rem;
            gap: 0.5rem;
        }

        .ranking-list-item-innovative {
            grid-template-columns: 36px 1fr 70px;
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
            gap: 0.5rem;
            min-height: 38px;
        }

        .ranking-list-item-innovative .player .player-avatar {
            width: 24px;
            height: 24px;
        }

        .ranking-list-item-innovative .player .player-name {
            font-size: 0.8rem;
        }

        .ranking-list-item-innovative .score {
            font-size: 0.75rem;
        }

        .ranking-list-item-innovative .pos {
            font-size: 0.8rem;
        }

        .ranking-header-innovative h2 {
            font-size: 1rem;
        }

        .my-rank-card-innovative .rank-number {
            font-size: 2rem;
        }

        .ranking-theme-header-innovative {
            padding: 0.5rem 1rem;
        }

        .ranking-theme-header-innovative h3 {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        .ranking-list-header-innovative {
            grid-template-columns: 30px 1fr 55px;
            font-size: 0.45rem;
            padding: 0.3rem 0.6rem;
            gap: 0.3rem;
        }

        .ranking-list-item-innovative {
            grid-template-columns: 30px 1fr 55px;
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
            gap: 0.3rem;
            min-height: 34px;
        }

        .ranking-list-item-innovative .player .player-avatar {
            width: 20px;
            height: 20px;
        }

        .ranking-list-item-innovative .player .player-name {
            font-size: 0.7rem;
        }

        .ranking-list-item-innovative .score {
            font-size: 0.65rem;
        }

        .ranking-list-item-innovative .pos {
            font-size: 0.7rem;
        }

        .my-rank-card-innovative .rank-number {
            font-size: 1.6rem;
        }

        .ranking-header-innovative {
            padding: 0.6rem 1rem;
        }

        .ranking-header-innovative h2 {
            font-size: 0.85rem;
        }

        .ranking-filter-sidebar-innovative select {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }
    }
</style>

<!-- ============================================
     LAYOUT DE DOS COLUMNAS
     SIDEBAR IZQUIERDA | LISTA DERECHA
============================================ -->
<div class="ranking-layout-innovative">

    <!-- ============================================
         SIDEBAR IZQUIERDA - POSICION + FILTRO
    ============================================ -->
    <div class="ranking-sidebar-innovative">

        <!-- MI POSICION -->
        <div class="my-rank-card-innovative">
            <span class="rank-label"><i class="bi bi-person-fill me-1"></i>Tu posicion</span>
            <?php if ($myGlobalPosition && $myGlobalPosition > 0): ?>
                <span class="rank-number">#<?= $myGlobalPosition ?></span>
                <span class="rank-sub">
                    <?php 
                        $total = count($topPlayers ?? []);
                        if ($total > 0) {
                            echo 'de ' . $total . ' jugadores';
                        } else {
                            echo 'sin jugadores registrados';
                        }
                    ?>
                </span>
                <span class="rank-badge">
                    <?php 
                        if ($myGlobalPosition <= 3) echo 'TOP 3';
                        elseif ($myGlobalPosition <= 10) echo 'TOP 10';
                        elseif ($myGlobalPosition <= 50) echo 'TOP 50';
                        else echo 'SIGUE MEJORANDO';
                    ?>
                </span>
            <?php else: ?>
                <span class="rank-number" style="font-size: 1.4rem;">Sin posicion</span>
                <span class="rank-sub">Juega una partida para aparecer</span>
            <?php endif; ?>
        </div>

        <!-- FILTRO -->
        <div class="ranking-filter-sidebar-innovative">
            <label for="themeFilter"><i class="bi bi-funnel"></i>Filtrar por tema</label>
            <form method="GET" action="<?= APP_URL ?>/ranking">
                <select name="theme_level_id" id="themeFilter" onchange="this.form.submit()">
                    <option value="">-- Todos --</option>
                    <?php foreach ($themeLevels as $tl): ?>
                        <option value="<?= $tl->id ?>" <?= ($selectedThemeLevel == $tl->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tl->theme_name ?? 'Tema') ?> · <?= htmlspecialchars($tl->level_name ?? 'Nivel') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="filter-hint">
                    <i class="bi bi-info-circle me-1"></i>
                    Ver ranking por nivel especifico
                </span>
            </form>
        </div>
    </div>

    <!-- ============================================
         COLUMNA PRINCIPAL DERECHA - LISTA
    ============================================ -->
    <div class="ranking-main-innovative">

        <!-- HEADER COMPACTO -->
        <div class="ranking-header-innovative">
            <h2><i class="bi bi-trophy-fill"></i>Ranking Global</h2>
            <span class="header-count">
                <i class="bi bi-people-fill me-1"></i>
                <?= count($topPlayers ?? []) ?> jugadores
            </span>
        </div>

        <!-- LISTA DE JUGADORES -->
        <?php if (!empty($topPlayers)): ?>
            <div class="ranking-list-container-innovative">
                <div class="ranking-list-header-innovative">
                    <span>Pos</span>
                    <span>Jugador</span>
                    <span>Puntos</span>
                </div>

                <?php foreach ($topPlayers as $i => $p): ?>
                    <?php
                        $pos = $i + 1;
                        $isMe = (int)$p['id'] === (int)$currentUserId;
                        $medalClass = '';
                        $medalIcon = '';

                        if ($pos === 1) {
                            $medalClass = 'gold';
                            $medalIcon = '<i class="bi bi-trophy-fill pos-medal gold"></i>';
                        } elseif ($pos === 2) {
                            $medalClass = 'silver';
                            $medalIcon = '<i class="bi bi-trophy pos-medal silver"></i>';
                        } elseif ($pos === 3) {
                            $medalClass = 'bronze';
                            $medalIcon = '<i class="bi bi-trophy pos-medal bronze"></i>';
                        } elseif ($pos === 4) {
                            $medalIcon = '<i class="bi bi-star-fill pos-medal gold" style="font-size:0.55rem;"></i>';
                        }
                    ?>
                    <div class="ranking-list-item-innovative <?= $isMe ? 'me' : '' ?>">
                        <div class="pos">
                            <?php if ($medalIcon): ?>
                                <span class="pos-medal <?= $medalClass ?>"><?= $medalIcon ?></span>
                            <?php endif; ?>
                            <span class="pos-number"><?= $pos ?></span>
                        </div>
                        <div class="player">
                            <img class="player-avatar" 
                                 src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($p['avatar'] ?? 'default.png') ?>" 
                                 alt="Avatar de <?= htmlspecialchars($p['username']) ?>"
                                 onerror="this.src='<?= APP_URL ?>/images/default.png'">
                            <span class="player-name">
                                <?= htmlspecialchars($p['username']) ?>
                                <?php if ($isMe): ?>
                                    <span class="me-tag">TU</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="score"><?= number_format($p['total_points']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="ranking-empty-innovative">
                <span class="empty-icon"><i class="bi bi-emoji-smile"></i></span>
                <p>Aun no hay jugadores con puntos.<br><strong>Se el primero en aparecer aqui</strong></p>
            </div>
        <?php endif; ?>

        <!-- RANKING POR TEMA -->
        <?php if ($selectedThemeLevel): ?>
            <div class="ranking-theme-section-innovative">
                <div class="ranking-theme-header-innovative">
                    <h3><i class="bi bi-collection-fill"></i><?= htmlspecialchars($themeLevelName ?? 'Tema seleccionado') ?></h3>
                    <span class="theme-count"><?= count($ranking ?? []) ?> jugadores</span>
                </div>

                <?php if (!empty($ranking)): ?>
                    <div class="ranking-list-container-innovative">
                        <div class="ranking-list-header-innovative">
                            <span>Pos</span>
                            <span>Jugador</span>
                            <span>Precision</span>
                        </div>

                        <?php foreach ($ranking as $i => $r): ?>
                            <?php
                                $pos = $i + 1;
                                $isMe = (int)$r['user_id'] === (int)$currentUserId;
                                $medalIcon = '';
                                if ($pos === 1) {
                                    $medalIcon = '<i class="bi bi-trophy-fill pos-medal gold"></i>';
                                } elseif ($pos === 2) {
                                    $medalIcon = '<i class="bi bi-trophy pos-medal silver"></i>';
                                } elseif ($pos === 3) {
                                    $medalIcon = '<i class="bi bi-trophy pos-medal bronze"></i>';
                                }
                            ?>
                            <div class="ranking-list-item-innovative <?= $isMe ? 'me' : '' ?>">
                                <div class="pos">
                                    <?php if ($medalIcon): ?>
                                        <span class="pos-medal"><?= $medalIcon ?></span>
                                    <?php endif; ?>
                                    <span class="pos-number"><?= $pos ?></span>
                                </div>
                                <div class="player">
                                    <img class="player-avatar" 
                                         src="<?= APP_URL ?>/uploads/avatars/<?= htmlspecialchars($r['avatar'] ?? 'default.png') ?>" 
                                         alt="Avatar"
                                         onerror="this.src='<?= APP_URL ?>/images/default.png'">
                                    <span class="player-name">
                                        <?= htmlspecialchars($r['username']) ?>
                                        <?php if ($isMe): ?>
                                            <span class="me-tag">TU</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="score"><?= number_format($r['score_percentage'], 1) ?>%</div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="ranking-empty-innovative" style="padding: 1.2rem 1rem;">
                        <span class="empty-icon" style="font-size: 1.8rem;"><i class="bi bi-emoji-smile"></i></span>
                        <p style="font-size: 0.85rem;">Nadie ha jugado este nivel.<br><strong>Se el primero</strong></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>