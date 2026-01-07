<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>🌿 Lestari Pekalongan</h1>
            <p>Platform edukasi pengelolaan sampah dan e-commerce kerajinan daur ulang untuk mewujudkan lingkungan yang lebih bersih dan berkelanjutan.</p>
            <div class="hero-buttons">
                <a href="<?= base_url('/edukasi') ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-book-open"></i> Mulai Belajar
                </a>
                <a href="<?= base_url('/produk') ?>" class="btn btn-outline btn-lg">
                    <i class="fas fa-shopping-bag"></i> Lihat Produk
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Apa yang Kami Tawarkan</h2>
            <p>Berbagai layanan untuk membantu Anda berkontribusi dalam pengelolaan sampah yang lebih baik</p>
        </div>
        
        <div class="grid grid-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Edukasi Lingkungan</h3>
                <p>Pelajari cara mengelola sampah dengan benar, daur ulang, dan gaya hidup ramah lingkungan melalui artikel dan panduan lengkap.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3>E-Commerce Kerajinan</h3>
                <p>Beli produk kerajinan tangan unik yang terbuat dari sampah daur ulang. Berkontribusi sambil mendapatkan barang berkualitas.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Lokasi TPS</h3>
                <p>Temukan Tempat Pengumpulan Sampah terdekat dengan peta interaktif. Mudah, cepat, dan praktis.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section bg-white">
    <div class="container">
        <div class="grid grid-4">
            <div class="stat-card">
                <div class="stat-number"><?= $tps_aktif ?? 0 ?></div>
                <div class="stat-label">TPS Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100+</div>
                <div class="stat-label">Produk Kerajinan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Artikel Edukasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">500+</div>
                <div class="stat-label">Anggota Aktif</div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Products -->
<?php if (!empty($produk_unggulan)): ?>
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Produk Unggulan</h2>
            <p>Kerajinan tangan berkualitas dari sampah daur ulang</p>
        </div>
        
        <div class="grid grid-4">
            <?php foreach ($produk_unggulan as $produk): ?>
            <div class="card product-card">
                <?php if ($produk['gambar']): ?>
                    <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" alt="<?= esc($produk['nama']) ?>" class="card-img">
                <?php else: ?>
                    <div class="card-img" style="background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image" style="font-size: 3rem; color: var(--gray-400);"></i>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <span class="card-category"><?= esc($produk['kategori_nama'] ?? 'Produk') ?></span>
                    <h4 class="card-title"><?= esc($produk['nama']) ?></h4>
                    <div class="product-info">
                        <span class="card-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                        <span class="product-stock <?= $produk['stok'] < 5 ? 'low' : '' ?>">
                            Stok: <?= $produk['stok'] ?>
                        </span>
                    </div>
                    <a href="<?= base_url('/produk/' . $produk['slug']) ?>" class="btn btn-primary btn-block mt-4">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-8">
            <a href="<?= base_url('/produk') ?>" class="btn btn-outline btn-lg">
                Lihat Semua Produk <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Latest Articles -->
<?php if (!empty($artikel_terbaru)): ?>
<section class="section bg-white">
    <div class="container">
        <div class="section-title">
            <h2>Artikel Terbaru</h2>
            <p>Pelajari lebih lanjut tentang pengelolaan sampah dan lingkungan</p>
        </div>
        
        <div class="grid grid-3">
            <?php foreach ($artikel_terbaru as $artikel): ?>
            <div class="card article-card">
                <?php if ($artikel['gambar']): ?>
                    <img src="<?= base_url('uploads/artikel/' . $artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>" class="card-img">
                <?php else: ?>
                    <div class="card-img" style="background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper" style="font-size: 3rem; color: var(--gray-400);"></i>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <span class="card-category"><?= esc($artikel['kategori_nama'] ?? 'Artikel') ?></span>
                    <h4 class="card-title"><?= esc($artikel['judul']) ?></h4>
                    <p class="card-text"><?= esc(substr($artikel['ringkasan'] ?? '', 0, 100)) ?>...</p>
                    <div class="card-meta">
                        <span><i class="fas fa-eye"></i> <?= $artikel['views'] ?></span>
                        <span><i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($artikel['created_at'])) ?></span>
                    </div>
                    <a href="<?= base_url('/edukasi/' . $artikel['slug']) ?>" class="btn btn-outline btn-block mt-4">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-8">
            <a href="<?= base_url('/edukasi') ?>" class="btn btn-outline btn-lg">
                Lihat Semua Artikel <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white;">
    <div class="container">
        <div class="hero-content">
            <h2 style="color: white;">Bergabunglah Bersama Kami!</h2>
            <p>Jadilah bagian dari gerakan untuk menjaga kelestarian lingkungan Pekalongan. Daftar sekarang dan mulai berkontribusi!</p>
            <div class="hero-buttons">
                <a href="<?= base_url('/auth/register') ?>" class="btn btn-primary btn-lg" style="background: white; color: var(--primary);">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="<?= base_url('/tps') ?>" class="btn btn-outline btn-lg" style="border-color: white; color: white;">
                    <i class="fas fa-map-marker-alt"></i> Cari TPS Terdekat
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.stat-card {
    text-align: center;
    padding: var(--space-8);
}

.stat-number {
    font-size: var(--font-size-4xl);
    font-weight: 700;
    color: var(--primary);
    margin-bottom: var(--space-2);
}

.stat-label {
    font-size: var(--font-size-lg);
    color: var(--gray-600);
}
</style>
