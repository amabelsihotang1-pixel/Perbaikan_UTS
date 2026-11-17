<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f8f8f4">
    <title><?= e($pageTitle) ?> · Garasi Pukimart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar" id="sidebar">
        <a class="brand" href="/" aria-label="Garasi Pukimart, beranda">
            <span class="brand-mark">gr<span>.</span></span>
            <span class="brand-name">garasi<span>pukimart</span></span>
        </a>
        <div class="sidebar-caption">RUANG KERJA</div>
        <nav class="side-nav" aria-label="Navigasi utama">
            <a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="/">
                <span class="nav-icon">⌂</span><span>Ringkasan</span>
            </a>
            <a class="nav-link <?= $activePage === 'motorcycles' ? 'active' : '' ?>" href="/motorcycles">
                <span class="nav-icon">⌁</span><span>Inventaris motor</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <div class="showroom-card">
                <span class="showroom-mark">✳</span>
                <strong>Ruang untuk berkendara</strong>
                <p>Temukan teman perjalanan yang paling cocok buatmu.</p>
            </div>
            <div class="profile">
                <div class="avatar">GR</div>
                <div><strong>Tim Garasi Roda</strong><small>Pengelola showroom</small></div>
                <span class="profile-dots">···</span>
            </div>
        </div>
    </aside>

    <main class="main-area">
        <header class="topbar">
            <button class="menu-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false">☰</button>
            <div class="breadcrumb">Garasi Roda <span>/</span> <strong><?= e($pageTitle) ?></strong></div>
            <div class="topbar-right">
                <span class="open-status"><i></i> Toko beroperasi</span>
                <div class="top-avatar">K</div>
            </div>
        </header>
        <div class="page-content">
            <?php if (!empty($_SESSION['flash'])): ?>
                <?php $flash = $_SESSION['flash']; unset($_SESSION['flash']); ?>
                <div class="flash flash-<?= e($flash['type']) ?>" role="status"><?= e($flash['message']) ?></div>
            <?php endif; ?>
            <?= $content ?>
        </div>
        <footer class="footer">Garasi Pukimart <span>·</span> Temukan jalanmu.</footer>
    </main>
</div>
<script src="/assets/js/app.js"></script>
</body>
</html>
