<section class="page-heading">
    <div>
        <div class="eyebrow"><span class="eyebrow-dot"></span> INVENTARIS SHOWROOM</div>
        <h1>Inventaris motor</h1>
        <p class="lead">Lihat motor yang tersedia, harga, dan posisi unit di showroom.</p>
    </div>
    <a class="button button-primary" href="/motorcycles/create"><span>＋</span> Tambah motor</a>
</section>

<section class="panel inventory-panel">
    <form class="filter-bar" action="/motorcycles" method="get">
        <label class="search-box">
            <span aria-hidden="true">⌕</span>
            <input type="search" name="q" value="<?= e($search) ?>" placeholder="Cari merek, model, lokasi..." aria-label="Cari motor">
        </label>
        <label class="select-wrap">
            <span class="sr-only">Filter jenis motor</span>
            <select name="kategori">
                <option value="">Semua jenis</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= e($category) ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>><?= e($category) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button class="button button-soft" type="submit">Terapkan</button>
        <?php if ($search !== '' || $selectedCategory !== ''): ?><a class="clear-filter" href="/motorcycles">Reset</a><?php endif; ?>
    </form>

    <div class="table-meta"><span><strong><?= count($motorcycles) ?></strong> model ditemukan</span><span>Informasi inventaris showroom</span></div>
    <?php if ($motorcycles === []): ?>
        <div class="empty-state"><span>🏍</span><strong>Motor belum ditemukan</strong><p>Coba ubah pencarian atau tambahkan motor ke inventaris.</p><a class="button button-primary" href="/motorcycles/create">Tambah motor</a></div>
    <?php else: ?>
        <div class="table-scroll">
            <table class="inventory-table">
                <thead><tr><th>MEREK & MODEL</th><th>JENIS</th><th>TAHUN</th><th>MESIN</th><th>HARGA</th><th>STOK</th><th>LOKASI</th><th><span class="sr-only">Aksi</span></th></tr></thead>
                <tbody>
                <?php foreach ($motorcycles as $motorcycle): ?>
                    <tr>
                        <td><div class="motorcycle-cell"><div class="motorcycle-emoji <?= category_tone($motorcycle['category']) ?>"><?= category_icon($motorcycle['category']) ?></div><div><strong><?= e($motorcycle['brand']) ?> <?= e($motorcycle['model']) ?></strong><span><?= e($motorcycle['color']) ?> · <?= e($motorcycle['category']) ?></span></div></div></td>
                        <td><span class="category-pill"><?= e($motorcycle['category']) ?></span></td>
                        <td class="engine-cell"><?= (int) $motorcycle['model_year'] ?></td>
                        <td class="engine-cell"><?= number_format((int) $motorcycle['engine_cc'], 0, ',', '.') ?> cc</td>
                        <td class="price-cell"><?= e(rupiah((float) $motorcycle['price'])) ?></td>
                        <td><span class="stock-pill <?= (int) $motorcycle['stock'] <= 2 ? 'stock-low' : 'stock-ok' ?>"><?= number_format((int) $motorcycle['stock'], 0, ',', '.') ?> unit</span></td>
                        <td class="location-cell"><span>⌖</span> <?= e($motorcycle['location']) ?></td>
                        <td><div class="table-actions"><a class="icon-button" href="/motorcycles/<?= (int) $motorcycle['id'] ?>/edit" aria-label="Edit <?= e($motorcycle['brand'] . ' ' . $motorcycle['model']) ?>" title="Edit">↗</a><form method="post" action="/motorcycles/<?= (int) $motorcycle['id'] ?>/delete" data-confirm="Hapus <?= e($motorcycle['brand'] . ' ' . $motorcycle['model']) ?> dari inventaris?"><input type="hidden" name="_token" value="<?= e($_SESSION['_token']) ?>"><button class="icon-button delete-button" type="submit" aria-label="Hapus <?= e($motorcycle['brand'] . ' ' . $motorcycle['model']) ?>" title="Hapus">×</button></form></div></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
<p class="inventory-footnote"><span>✳</span> Motor dengan stok 2 unit atau kurang ditandai agar mudah dipantau.</p>
