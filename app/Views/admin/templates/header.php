<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin - Lestari Pekalongan') ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="<?= base_url('/admin') ?>" class="sidebar-brand">
                <i class="fas fa-leaf"></i>
                <span>Lestari Admin</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href="<?= base_url('/admin') ?>" class="nav-link <?= uri_string() == 'admin' ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/artikel') ?>" class="nav-link <?= strpos(uri_string(), 'admin/artikel') !== false ? 'active' : '' ?>">
                        <i class="fas fa-newspaper"></i>
                        <span>Artikel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/produk') ?>" class="nav-link <?= strpos(uri_string(), 'admin/produk') !== false ? 'active' : '' ?>">
                        <i class="fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/tps') ?>" class="nav-link <?= strpos(uri_string(), 'admin/tps') !== false ? 'active' : '' ?>">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>TPS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/pesanan') ?>" class="nav-link <?= strpos(uri_string(), 'admin/pesanan') !== false ? 'active' : '' ?>">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/anggota') ?>" class="nav-link <?= strpos(uri_string(), 'admin/anggota') !== false ? 'active' : '' ?>">
                        <i class="fas fa-users"></i>
                        <span>Anggota</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <a href="<?= base_url('/') ?>" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <header class="admin-topbar">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="topbar-right">
                <div class="dropdown">
                    <button class="user-dropdown">
                        <i class="fas fa-user-circle"></i>
                        <span><?= esc(session()->get('user_nama')) ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="<?= base_url('/profil') ?>"><i class="fas fa-user"></i> Profil</a>
                        <a href="<?= base_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

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

        <!-- Page Content -->
        <div class="admin-content">
