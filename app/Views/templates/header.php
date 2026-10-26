<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lestari Pekalongan - Platform edukasi pengelolaan sampah dan e-commerce kerajinan daur ulang">
    <title><?= esc($title ?? 'Lestari Pekalongan') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . time()) ?>">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="<?= base_url('/') ?>" class="navbar-brand">
                <i class="fas fa-leaf"></i>
                <span>Lestari Pekalongan</span>
            </a>
            
            <button class="navbar-toggle" id="navbarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="navbar-menu" id="navbarMenu">
                <ul class="navbar-nav">
                    <li><a href="<?= base_url('/') ?>" class="nav-link">Beranda</a></li>
                    <li><a href="<?= base_url('/edukasi') ?>" class="nav-link">Edukasi</a></li>
                    <li><a href="<?= base_url('/produk') ?>" class="nav-link">Produk</a></li>
                    <li><a href="<?= base_url('/tps') ?>" class="nav-link">Lokasi TPS</a></li>
                    <li><a href="<?= base_url('/tentang') ?>" class="nav-link">Tentang</a></li>
                </ul>
                
                <div class="navbar-actions">
                    <?php if (session()->get('logged_in')): ?>
                        <a href="<?= base_url('/keranjang') ?>" class="btn-icon" title="Keranjang">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge" id="cartBadge">0</span>
                        </a>
                        <div class="dropdown">
                            <button class="btn-user dropdown-toggle">
                                <i class="fas fa-user-circle"></i>
                                <span><?= esc(session()->get('user_nama')) ?></span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="<?= base_url('/profil') ?>"><i class="fas fa-user"></i> Profil</a>
                                <a href="<?= base_url('/pesanan') ?>"><i class="fas fa-box"></i> Pesanan Saya</a>
                                <?php if (session()->get('user_role') === 'admin'): ?>
                                    <a href="<?= base_url('/admin') ?>"><i class="fas fa-cog"></i> Admin Panel</a>
                                <?php endif; ?>
                                <hr>
                                <a href="<?= base_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('/auth/login') ?>" class="btn btn-outline">Login</a>
                        <a href="<?= base_url('/auth/register') ?>" class="btn btn-primary">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
            <button class="alert-close">&times;</button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <?= session()->getFlashdata('error') ?>
            <button class="alert-close">&times;</button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button class="alert-close">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
