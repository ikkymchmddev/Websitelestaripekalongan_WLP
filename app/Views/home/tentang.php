<!-- Hero Section -->
<section class="hero hero-small">
    <div class="container">
        <h1>Tentang Kami</h1>
        <p>Mengenal lebih dekat Lestari Pekalongan</p>
    </div>
</section>

<!-- About Content -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <div class="about-content">
                <h2>Siapa Kami?</h2>
                <p><strong>Lestari Pekalongan</strong> adalah platform digital yang berdedikasi untuk mewujudkan pengelolaan sampah berkelanjutan dan memberdayakan ekonomi kreatif berbasis daur ulang di Kota Pekalongan.</p>
                
                <p>Kami memadukan edukasi lingkungan, e-commerce produk kerajinan daur ulang, dan sistem informasi Tempat Pembuangan Sampah (TPS) dalam satu platform terintegrasi.</p>

                <div class="about-features">
                    <div class="about-feature">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Edukasi Lingkungan</h4>
                            <p>Artikel dan panduan lengkap tentang pengelolaan sampah, daur ulang, dan gaya hidup ramah lingkungan.</p>
                        </div>
                    </div>
                    
                    <div class="about-feature">
                        <div class="feature-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="feature-text">
                            <h4>E-Commerce Ramah Lingkungan</h4>
                            <p>Marketplace produk kerajinan unik yang dibuat dari bahan daur ulang oleh pengrajin lokal Pekalongan.</p>
                        </div>
                    </div>
                    
                    <div class="about-feature">
                        <div class="feature-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Peta TPS Interaktif</h4>
                            <p>Temukan lokasi TPS terdekat dengan informasi real-time tentang status dan jam operasional.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="about-image">
                <div class="image-placeholder">
                    <i class="fas fa-leaf"></i>
                    <span>Lestari Pekalongan</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-12">
            <h2>Visi & Misi</h2>
        </div>
        
        <div class="vm-grid">
            <div class="vm-card">
                <div class="vm-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Visi</h3>
                <p>Menjadi platform terdepan dalam mendukung pengelolaan sampah berkelanjutan dan ekonomi sirkular di Kota Pekalongan, menciptakan lingkungan yang bersih dan masyarakat yang sejahtera.</p>
            </div>
            
            <div class="vm-card">
                <div class="vm-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <ul>
                    <li>Meningkatkan kesadaran masyarakat tentang pentingnya pengelolaan sampah</li>
                    <li>Memberdayakan pengrajin lokal melalui pemasaran produk daur ulang</li>
                    <li>Menyediakan informasi TPS yang akurat dan mudah diakses</li>
                    <li>Membangun komunitas peduli lingkungan di Pekalongan</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Team / Stats -->
<section class="section">
    <div class="container">
        <div class="text-center mb-12">
            <h2>Dampak Kami</h2>
            <p>Kontribusi nyata untuk lingkungan dan masyarakat</p>
        </div>
        
        <div class="impact-grid">
            <div class="impact-card">
                <i class="fas fa-recycle"></i>
                <h3>500+ kg</h3>
                <p>Sampah Terdaur Ulang</p>
            </div>
            <div class="impact-card">
                <i class="fas fa-users"></i>
                <h3>50+</h3>
                <p>Pengrajin Lokal Terberdayakan</p>
            </div>
            <div class="impact-card">
                <i class="fas fa-book-open"></i>
                <h3>1000+</h3>
                <p>Pembaca Artikel Edukasi</p>
            </div>
            <div class="impact-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>10+</h3>
                <p>TPS Terpetakan</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section bg-primary-gradient text-white">
    <div class="container text-center">
        <h2>Bergabung Bersama Kami</h2>
        <p class="mb-8">Jadilah bagian dari gerakan peduli lingkungan di Pekalongan</p>
        <div class="cta-buttons">
            <a href="<?= base_url('/auth/register') ?>" class="btn btn-white btn-lg">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </a>
            <a href="<?= base_url('/kontak') ?>" class="btn btn-outline-white btn-lg">
                <i class="fas fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<style>
.hero-small {
    padding: var(--space-16) 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    text-align: center;
}

.hero-small h1 {
    font-size: var(--font-size-4xl);
    margin-bottom: var(--space-2);
}

.hero-small p {
    opacity: 0.9;
}

.about-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: var(--space-12);
    align-items: center;
}

.about-content h2 {
    margin-bottom: var(--space-6);
    color: var(--primary);
}

.about-content p {
    color: var(--gray-700);
    line-height: 1.8;
    margin-bottom: var(--space-4);
}

.about-features {
    margin-top: var(--space-8);
}

.about-feature {
    display: flex;
    gap: var(--space-4);
    margin-bottom: var(--space-6);
}

.about-feature .feature-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-100);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.about-feature h4 {
    margin-bottom: var(--space-1);
}

.about-feature p {
    font-size: var(--font-size-sm);
    margin: 0;
}

.about-image .image-placeholder {
    background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-50) 100%);
    border-radius: var(--radius-2xl);
    padding: var(--space-16);
    text-align: center;
}

.about-image .image-placeholder i {
    font-size: 6rem;
    color: var(--primary);
    margin-bottom: var(--space-4);
    display: block;
}

.about-image .image-placeholder span {
    font-size: var(--font-size-2xl);
    font-weight: 700;
    color: var(--primary);
}

.bg-light {
    background: var(--gray-50);
}

.mb-12 {
    margin-bottom: var(--space-12);
}

.vm-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-8);
}

.vm-card {
    background: var(--white);
    padding: var(--space-8);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
}

.vm-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-100);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.5rem;
    margin-bottom: var(--space-4);
}

.vm-card h3 {
    margin-bottom: var(--space-4);
}

.vm-card ul {
    padding-left: var(--space-6);
}

.vm-card li {
    margin-bottom: var(--space-2);
    color: var(--gray-700);
}

.impact-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-6);
}

.impact-card {
    text-align: center;
    padding: var(--space-8);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
}

.impact-card i {
    font-size: 2.5rem;
    color: var(--primary);
    margin-bottom: var(--space-4);
}

.impact-card h3 {
    font-size: var(--font-size-3xl);
    color: var(--primary);
    margin-bottom: var(--space-2);
}

.impact-card p {
    color: var(--gray-600);
    margin: 0;
}

.bg-primary-gradient {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
}

.text-white {
    color: var(--white);
}

.text-white h2 {
    color: var(--white);
}

.mb-8 {
    margin-bottom: var(--space-8);
}

.cta-buttons {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
}

.btn-white {
    background: var(--white);
    color: var(--primary);
}

.btn-outline-white {
    border: 2px solid var(--white);
    color: var(--white);
}

.btn-outline-white:hover {
    background: var(--white);
    color: var(--primary);
}

@media (max-width: 992px) {
    .about-grid {
        grid-template-columns: 1fr;
    }
    
    .about-image {
        order: -1;
    }
    
    .vm-grid {
        grid-template-columns: 1fr;
    }
    
    .impact-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .impact-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
}
</style>
