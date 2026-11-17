<section class="page-heading form-heading">
    <div>
        <a class="back-link" href="/motorcycles">← Kembali ke inventaris</a>
        <h1><?= e($formTitle) ?></h1>
        <p class="lead">Lengkapi detail unit supaya inventaris showroom selalu akurat.</p>
    </div>
</section>

<section class="panel form-panel">
    <?php if ($errors !== []): ?>
        <div class="form-alert" role="alert"><strong>Masih ada yang perlu diperiksa.</strong><span>Perbaiki kolom bertanda merah lalu simpan kembali.</span></div>
    <?php endif; ?>
    <form method="post" action="<?= $isEditing ? '/motorcycles/' . (int) $motorcycle['id'] . '/update' : '/motorcycles' ?>" class="motorcycle-form">
        <input type="hidden" name="_token" value="<?= e($_SESSION['_token']) ?>">
        <div class="form-section-title"><span>01</span><div><strong>Identitas motor</strong><small>Merek, model, dan jenis kendaraan</small></div></div>
        <div class="form-grid">
            <label class="field"><span>Merek <b>*</b></span><input name="brand" value="<?= e((string) $motorcycle['brand']) ?>" placeholder="Contoh: Honda" maxlength="80" required><?= isset($errors['brand']) ? '<small class="field-error">' . e($errors['brand']) . '</small>' : '' ?></label>
            <label class="field"><span>Model <b>*</b></span><input name="model" value="<?= e((string) $motorcycle['model']) ?>" placeholder="Contoh: Vario 160" maxlength="100" required><?= isset($errors['model']) ? '<small class="field-error">' . e($errors['model']) . '</small>' : '' ?></label>
            <label class="field"><span>Jenis motor <b>*</b></span><select name="category" required><option value="">Pilih jenis</option><?php foreach ($categories as $category): ?><option value="<?= e($category) ?>" <?= $motorcycle['category'] === $category ? 'selected' : '' ?>><?= e($category) ?></option><?php endforeach; ?></select><?= isset($errors['category']) ? '<small class="field-error">' . e($errors['category']) . '</small>' : '' ?></label>
            <label class="field"><span>Tahun produksi <b>*</b></span><input name="model_year" type="number" min="1990" max="<?= (int) date('Y') + 1 ?>" value="<?= e((string) $motorcycle['model_year']) ?>" placeholder="<?= (int) date('Y') ?>" required><?= isset($errors['model_year']) ? '<small class="field-error">' . e($errors['model_year']) . '</small>' : '' ?></label>
            <label class="field"><span>Kapasitas mesin <b>*</b></span><div class="input-suffix"><input name="engine_cc" type="number" min="0" max="2500" step="1" value="<?= e((string) $motorcycle['engine_cc']) ?>" placeholder="160" required><span>cc</span></div><?= isset($errors['engine_cc']) ? '<small class="field-error">' . e($errors['engine_cc']) . '</small>' : '' ?></label>
            <label class="field"><span>Warna <b>*</b></span><input name="color" value="<?= e((string) $motorcycle['color']) ?>" placeholder="Contoh: Merah doff" maxlength="40" required><?= isset($errors['color']) ? '<small class="field-error">' . e($errors['color']) . '</small>' : '' ?></label>
        </div>
        <div class="form-section-title section-spaced"><span>02</span><div><strong>Harga & ketersediaan</strong><small>Harga jual dan posisi unit di showroom</small></div></div>
        <div class="form-grid">
            <label class="field"><span>Harga jual <b>*</b></span><div class="input-prefix"><span>Rp</span><input name="price" type="number" min="0" max="9999999999" step="1000" value="<?= e((string) $motorcycle['price']) ?>" placeholder="26500000" required></div><?= isset($errors['price']) ? '<small class="field-error">' . e($errors['price']) . '</small>' : '' ?></label>
            <label class="field"><span>Jumlah unit <b>*</b></span><div class="input-suffix"><input name="stock" type="number" min="0" step="1" value="<?= e((string) $motorcycle['stock']) ?>" placeholder="3" required><span>unit</span></div><?= isset($errors['stock']) ? '<small class="field-error">' . e($errors['stock']) . '</small>' : '' ?></label>
            <label class="field full-field"><span>Lokasi showroom <b>*</b></span><input name="location" value="<?= e((string) $motorcycle['location']) ?>" placeholder="Contoh: Lantai 1 · Area matic" maxlength="60" required><?= isset($errors['location']) ? '<small class="field-error">' . e($errors['location']) . '</small>' : '' ?></label>
            <label class="field full-field"><span>Catatan unit <small>opsional</small></span><textarea name="description" rows="4" maxlength="1000" placeholder="Catat warna, tahun produksi, kondisi, atau detail menarik lainnya..."><?= e((string) $motorcycle['description']) ?></textarea><?= isset($errors['description']) ? '<small class="field-error">' . e($errors['description']) . '</small>' : '' ?></label>
        </div>
        <div class="form-actions"><a class="button button-ghost" href="/motorcycles">Batal</a><button class="button button-primary" type="submit"><?= $isEditing ? 'Simpan perubahan' : 'Simpan motor' ?> <span>→</span></button></div>
    </form>
</section>
