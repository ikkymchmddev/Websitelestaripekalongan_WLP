<!-- Hero Section -->
<section class="hero">
    <div class="hero-pattern"></div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-text-col">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    <i class="fas fa-seedling"></i>
                    <span>Inisiatif Lingkungan Kota Pekalongan</span>
                </div>
                <h1>
                    Ubah Sampah Jadi <span class="hero-highlight">Karya & Kelestarian</span> Bumi Kita
                </h1>
                <p>
                    Platform terpadu edukasi 3R, marketplace kerajinan daur ulang berkualitas, serta panduan lokasi TPS untuk mewujudkan Pekalongan yang bersih, asri, dan berkelanjutan.
                </p>
                <div class="hero-buttons">
                    <a href="<?= base_url('/edukasi') ?>" class="btn btn-hero-primary btn-lg">
                        <i class="fas fa-book-open"></i> Mulai Belajar
                    </a>
                    <a href="<?= base_url('/produk') ?>" class="btn btn-hero-outline btn-lg">
                        <i class="fas fa-shopping-bag"></i> Lihat Produk
                    </a>
                </div>
                <div class="hero-features-list">
                    <div class="hero-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>100% Bahan Daur Ulang</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Lokasi TPS Terverifikasi</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Edukasi Terbuka Warga</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual-col">
                <!-- Ambient Radial Glow Behind Card -->
                <div class="hero-card-glow"></div>

                <!-- Floating Chip 1 (Top Right) -->
                <div class="floating-chip floating-chip-1">
                    <div class="chip-icon recycle">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <div class="chip-text">
                        <strong>Eco-Movement</strong>
                        <span>Kelola Sampah Kreatif</span>
                    </div>
                </div>

                <!-- Main Glassmorphism Showcase Card -->
                <div class="hero-glass-card">
                    <div class="glass-header">
                        <span class="glass-tag">
                            <i class="fas fa-leaf"></i> Lestari Pekalongan Hub
                        </span>
                        <div class="glass-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="glass-center">
                        <div class="eco-orb">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        <h3>Pekalongan Asri & Bersih</h3>
                        <p>Bersinergi bersama masyarakat, relawan & pengrajin lokal.</p>
                    </div>

                    <div class="glass-stats-grid">
                        <div class="glass-stat-item">
                            <strong><?= $tps_aktif ?? 0 ?></strong>
                            <span>TPS Terdaftar</span>
                        </div>
                        <div class="glass-stat-item">
                            <strong>100+</strong>
                            <span>Karya Produk</span>
                        </div>
                        <div class="glass-stat-item">
                            <strong>50+</strong>
                            <span>Panduan 3R</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Chip 2 -->
                <div class="floating-chip floating-chip-2">
                    <div class="chip-icon craft">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="chip-text">
                        <strong>Dukung UMKM</strong>
                        <span>Produk Ramah Lingkungan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SVG Wave Divider to Next Section -->
    <div class="hero-wave">
        <svg viewBox="0 0 1440 90" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,32 C320,75 520,12 760,48 C1000,84 1220,24 1440,52 L1440,90 L0,90 Z" fill="var(--gray-50)"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="section" style="background-color: var(--gray-50);">
    <div class="container">
        <div class="section-title">
            <span class="section-tag"><i class="fas fa-shapes"></i> Fitur Unggulan</span>
            <h2>Apa yang Kami Tawarkan</h2>
            <p>Berbagai layanan terintegrasi untuk membantu Anda berkontribusi nyata dalam menjaga kelestarian lingkungan Kota Pekalongan</p>
        </div>
        
        <div class="grid grid-3">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Edukasi Lingkungan</h3>
                <p>Pelajari cara memilah sampah dengan benar, komposting mandiri, daur ulang kreatif, dan panduan gaya hidup minim sampah (zero waste).</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3>E-Commerce Kerajinan</h3>
                <p>Beli aneka produk kerajinan tangan unik bernilai seni tinggi hasil karya pengrajin lokal yang memanfaatkan sampah daur ulang.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Peta Lokasi TPS</h3>
                <p>Temukan titik Tempat Penampungan Sementara (TPS) terdekat di wilayah Pekalongan dengan rute peta interaktif yang praktis dan akurat.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section bg-white" style="border-top: 1px solid var(--gray-100); border-bottom: 1px solid var(--gray-100);">
    <div class="container">
        <div class="grid grid-4">
            <div class="stat-card">
                <div class="stat-icon-wrap" style="width: 52px; height: 52px; border-radius: 50%; background: var(--primary-50); color: var(--primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-number"><?= $tps_aktif ?? 0 ?></div>
                <div class="stat-label">TPS Aktif Terdata</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-wrap" style="width: 52px; height: 52px; border-radius: 50%; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem;">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-number">100+</div>
                <div class="stat-label">Produk Kerajinan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-wrap" style="width: 52px; height: 52px; border-radius: 50%; background: #E0F2FE; color: #0284C7; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-number">50+</div>
                <div class="stat-label">Artikel Edukasi</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-wrap" style="width: 52px; height: 52px; border-radius: 50%; background: #F3E8FF; color: #7E22CE; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">500+</div>
                <div class="stat-label">Warga Peduli Lingkungan</div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Products -->
<?php if (!empty($produk_unggulan)): ?>
<section class="section" style="background-color: var(--gray-50);">
    <div class="container">
        <div class="section-title">
            <span class="section-tag"><i class="fas fa-shopping-bag"></i> Karya Daur Ulang</span>
            <h2>Produk Unggulan</h2>
            <p>Kerajinan tangan berkualitas tinggi yang dibuat dengan estetika dan dedikasi dari material sampah daur ulang</p>
        </div>
        
        <div class="grid grid-4">
            <?php foreach ($produk_unggulan as $produk): ?>
            <div class="card product-card">
                <div class="product-img-wrapper">
                    <span class="card-category"><?= esc($produk['kategori_nama'] ?? 'Produk') ?></span>
                    <?php if ($produk['gambar']): ?>
                        <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" alt="<?= esc($produk['nama']) ?>" class="card-img" loading="lazy">
                    <?php else: ?>
                        <div class="card-img" style="background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%); display: flex; align-items: center; justify-content: center; height: 100%;">
                            <i class="fas fa-image" style="font-size: 3rem; color: var(--primary); opacity: 0.5;"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <h4 class="card-title" title="<?= esc($produk['nama']) ?>"><?= esc($produk['nama']) ?></h4>
                    <div class="product-info">
                        <span class="card-price">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                        <span class="product-stock <?= $produk['stok'] < 5 ? 'low' : '' ?>">
                            Stok: <?= $produk['stok'] ?>
                        </span>
                    </div>
                    <a href="<?= base_url('/produk/' . $produk['slug']) ?>" class="btn btn-primary btn-block mt-4">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="<?= base_url('/produk') ?>" class="btn btn-outline btn-lg">
                <span>Lihat Semua Produk</span> <i class="fas fa-arrow-right"></i>
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
            <span class="section-tag"><i class="fas fa-book-open"></i> Wawasan & Tips</span>
            <h2>Artikel Edukasi Terbaru</h2>
            <p>Tingkatkan wawasan dan pemahaman Anda tentang pengelolaan sampah mandiri dan solusi gaya hidup ramah lingkungan</p>
        </div>
        
        <div class="grid grid-3">
            <?php foreach ($artikel_terbaru as $artikel): ?>
            <div class="card article-card">
                <div class="article-img-wrapper">
                    <?php if ($artikel['gambar']): ?>
                        <img src="<?= base_url('uploads/artikel/' . $artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>" class="card-img" loading="lazy">
                    <?php else: ?>
                        <div class="card-img" style="background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%); display: flex; align-items: center; justify-content: center; height: 100%;">
                            <i class="fas fa-newspaper" style="font-size: 3rem; color: var(--primary); opacity: 0.5;"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <span class="card-category">
                        <i class="fas fa-tag"></i> <?= esc($artikel['kategori_nama'] ?? 'Edukasi') ?>
                    </span>
                    <h4 class="card-title"><?= esc($artikel['judul']) ?></h4>
                    <p class="card-text"><?= esc(substr($artikel['ringkasan'] ?? '', 0, 110)) ?>...</p>
                    <div class="card-meta">
                        <span><i class="fas fa-eye"></i> <?= $artikel['views'] ?> views</span>
                        <span><i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($artikel['created_at'])) ?></span>
                    </div>
                    <a href="<?= base_url('/edukasi/' . $artikel['slug']) ?>" class="btn btn-outline btn-block mt-4">
                        <span>Baca Selengkapnya</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="<?= base_url('/edukasi') ?>" class="btn btn-outline btn-lg">
                <span>Lihat Semua Artikel</span> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="section cta-section" style="background: linear-gradient(140deg, #0e3b15 0%, #1b5e20 45%, #2e7d32 100%); color: white; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; right: -50px; width: 350px; height: 350px; background: radial-gradient(circle, rgba(105, 240, 174, 0.2) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255, 193, 7, 0.15) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="hero-content" style="max-width: 780px; text-align: center; margin: 0 auto;">
            <div class="hero-badge" style="background: rgba(255, 255, 255, 0.16); border-color: rgba(255, 255, 255, 0.3); margin-bottom: 1.5rem;">
                <i class="fas fa-heart" style="color: #69F0AE;"></i>
                <span>Bergabung Bersama Gerakan Lestari</span>
            </div>
            <h2 style="color: white; font-size: 2.75rem; font-weight: 800; margin-bottom: 1.25rem; line-height: 1.25; letter-spacing: -0.5px;">
                Mari Bersama Jaga Kelestarian Kota Pekalongan!
            </h2>
            <p style="font-size: 1.15rem; color: rgba(255, 255, 255, 0.92); line-height: 1.7; margin-bottom: 2.5rem;">
                Setiap tindakan dalam memilah sampah, menyalurkan ke TPS, dan memilih karya daur ulang lokal adalah kontribusi nyata bagi masa depan lingkungan kita.
            </p>
            <div class="hero-buttons" style="justify-content: center;">
                <a href="<?= base_url('/auth/register') ?>" class="btn btn-hero-primary btn-lg">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="<?= base_url('/tps') ?>" class="btn btn-hero-outline btn-lg">
                    <i class="fas fa-map-marker-alt"></i> Cari TPS Terdekat
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.stat-card {
    text-align: center;
    padding: 2.5rem 1.75rem;
    background: var(--white);
    border-radius: 20px;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
    border: 1px solid rgba(0, 0, 0, 0.04);
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-hover);
}

.stat-number {
    font-size: 2.75rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.35rem;
    line-height: 1.1;
}

.stat-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--gray-600);
}
</style>
