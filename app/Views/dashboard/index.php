<section class="welcome-row">
    <div>
        <div class="eyebrow"><span class="eyebrow-dot"></span> SENIN, 16 NOVEMBER 2026</div>
        <h1>Selamat datang di Garasi Pukimart 🏁</h1>
        <p class="lead">Ringkasan showroom dan motor yang siap menemukan pemilik baru.</p>
    </div>
    <a class="button button-primary" href="/motorcycles/create"><span>＋</span> Tambah motor</a>
</section>

<section class="stats-grid" aria-label="Statistik inventaris">
    <article class="stat-card">
        <div class="stat-icon icon-rust">⌁</div>
        <div class="stat-label">Model tersedia</div>
        <div class="stat-value"><?= number_format((int) $stats['varieties'], 0, ',', '.') ?><span class="stat-unit"> model</span></div>
        <div class="stat-note"><span class="note-dot green"></span> Pilihan di showroom</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon icon-peach">▤</div>
        <div class="stat-label">Unit di garasi</div>
        <div class="stat-value"><?= number_format((int) $stats['units'], 0, ',', '.') ?><span class="stat-unit"> unit</span></div>
        <div class="stat-note">Semua jenis sepeda motor</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon icon-lilac">↗</div>
        <div class="stat-label">Nilai inventaris</div>
        <div class="stat-value stat-money"><?= e(rupiah((float) $stats['inventory_value'])) ?></div>
        <div class="stat-note">Berdasarkan stok saat ini</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon icon-yellow">!</div>
        <div class="stat-label">Stok menipis</div>
        <div class="stat-value"><?= number_format((int) $stats['low_stock'], 0, ',', '.') ?><span class="stat-unit"> model</span></div>
        <div class="stat-note"><span class="note-dot amber"></span> Tersedia 2 unit atau kurang</div>
    </article>
</section>

<section class="dashboard-grid">
    <article class="panel recent-panel">
        <div class="panel-heading">
            <div><h2>Baru masuk garasi</h2><p>Motor terbaru dalam inventaris showroom.</p></div>
            <a class="text-link" href="/motorcycles">Lihat inventaris <span>→</span></a>
        </div>
        <?php if ($recentMotorcycles === []): ?>
            <div class="empty-state compact"><span>🏍</span><strong>Garasi masih kosong</strong><p>Tambahkan motor pertama ke inventaris.</p></div>
        <?php else: ?>
            <div class="recent-list">
                <?php foreach ($recentMotorcycles as $motorcycle): ?>
                    <a class="recent-item" href="/motorcycles/<?= (int) $motorcycle['id'] ?>/edit">
                        <div class="motorcycle-emoji <?= category_tone($motorcycle['category']) ?>"><?= category_icon($motorcycle['category']) ?></div>
                        <div class="recent-info"><strong><?= e($motorcycle['brand']) ?> <?= e($motorcycle['model']) ?></strong><span><?= e($motorcycle['model_year']) ?> · <?= e($motorcycle['engine_cc']) ?> cc</span></div>
                        <div class="recent-stock"><strong><?= number_format((int) $motorcycle['stock'], 0, ',', '.') ?></strong><span>unit</span></div>
                        <span class="row-arrow">↗</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
    <aside class="panel note-panel">
        <div class="note-art" aria-hidden="true"><span>✳</span><div class="bike-wheel wheel-back"></div><div class="bike-wheel wheel-front"></div><div class="bike-frame"></div><div class="bike-tank"></div></div>
        <div class="note-content">
            <span class="mini-tag">CATATAN SHOWROOM</span>
            <h2>Perjalanan hebat<br>dimulai di sini.</h2>
            <p>Inventaris teratur membantu setiap pengendara menemukan motor yang tepat.</p>
            <a href="/motorcycles" class="text-link">Kelola inventaris <span>→</span></a>
        </div>
    </aside>
</section>
