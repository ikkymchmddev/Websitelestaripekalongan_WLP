<section class="auth-page-section">
    <!-- Ambient Decorative Blobs -->
    <div class="auth-blob auth-blob-1"></div>
    <div class="auth-blob auth-blob-2"></div>

    <div class="container auth-wrapper-container">
        <div class="auth-master-card auth-register-card">
            
            <!-- Left Banner: Brand & Community Impact -->
            <div class="auth-banner-side">
                <div class="banner-overlay-pattern"></div>
                <div class="banner-content">
                    
                    <!-- Brand Pill -->
                    <div class="banner-brand-pill">
                        <i class="fas fa-leaf"></i>
                        <span>Lestari Pekalongan</span>
                    </div>

                    <div class="banner-text-block">
                        <h2 class="banner-title">Satu Langkah Kecil untuk Pekalongan Lebih Hijau</h2>
                        <p class="banner-desc">
                            Bergabunglah bersama ribuan warga Kota Batik yang peduli lingkungan. Mulai aksi nyata pilah sampah, dukung UMKM daur ulang, dan ciptakan kota yang lebih bersih.
                        </p>
                    </div>

                    <!-- Highlight Cards -->
                    <div class="banner-features-list">
                        <div class="banner-feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="feature-info">
                                <h4>Poin & Penghargaan</h4>
                                <p>Dapatkan apresiasi untuk setiap kontribusi pelestarian lingkungan.</p>
                            </div>
                        </div>

                        <div class="banner-feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-store"></i>
                            </div>
                            <div class="feature-info">
                                <h4>Akses Pasar Daur Ulang</h4>
                                <p>Jual beli produk kerajinan ramah lingkungan langsung dari perajin.</p>
                            </div>
                        </div>

                        <div class="banner-feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <div class="feature-info">
                                <h4>Komunitas Peduli Sampah</h4>
                                <p>Terhubung langsung dengan pegiat lingkungan se-Pekalongan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Community Proof Badge -->
                    <div class="banner-community-badge">
                        <div class="community-avatars">
                            <span class="avatar-circle av-1"><i class="fas fa-user"></i></span>
                            <span class="avatar-circle av-2"><i class="fas fa-heart"></i></span>
                            <span class="avatar-circle av-3"><i class="fas fa-seedling"></i></span>
                        </div>
                        <div class="community-text">
                            <strong>5.000+ Pahlawan Lingkungan</strong>
                            <span>Telah berpartisipasi aktif menjaga kebersihan kota</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Side: Register Form -->
            <div class="auth-form-side">
                <div class="form-content-inner">
                    
                    <div class="auth-heading-area">
                        <div class="auth-pill-tag">
                            <i class="fas fa-user-plus"></i> Akun Baru
                        </div>
                        <h1 class="auth-main-title">Daftar Akun Lestari <span class="sparkle-icon">✨</span></h1>
                        <p class="auth-subtitle">Lengkapi formulir singkat di bawah untuk membuat akun baru.</p>
                    </div>

                    <!-- Flash Message Handling -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="auth-alert auth-alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <div><?= session()->getFlashdata('error') ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="auth-alert auth-alert-success">
                            <i class="fas fa-check-circle"></i>
                            <div><?= session()->getFlashdata('success') ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="auth-alert auth-alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <ul class="alert-list">
                                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                        <li><?= esc($err) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/auth/register') ?>" method="POST" class="auth-main-form">
                        
                        <!-- Nama Lengkap Field -->
                        <div class="custom-form-group">
                            <label class="custom-field-label" for="regNama">Nama Lengkap</label>
                            <div class="input-with-icon">
                                <span class="field-icon"><i class="far fa-user"></i></span>
                                <input type="text" 
                                       id="regNama" 
                                       name="nama" 
                                       class="custom-field-input" 
                                       placeholder="Contoh: Budi Santoso" 
                                       required 
                                       value="<?= old('nama') ?>"
                                       autocomplete="name">
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="custom-form-group">
                            <label class="custom-field-label" for="regEmail">Alamat Email</label>
                            <div class="input-with-icon">
                                <span class="field-icon"><i class="far fa-envelope"></i></span>
                                <input type="email" 
                                       id="regEmail" 
                                       name="email" 
                                       class="custom-field-input" 
                                       placeholder="nama@email.com" 
                                       required 
                                       value="<?= old('email') ?>"
                                       autocomplete="email">
                            </div>
                        </div>

                        <!-- No Telepon Field -->
                        <div class="custom-form-group">
                            <label class="custom-field-label" for="regTelepon">Nomor Telepon / WhatsApp <span class="optional-badge">(Opsional)</span></label>
                            <div class="input-with-icon">
                                <span class="field-icon"><i class="fas fa-phone-alt"></i></span>
                                <input type="tel" 
                                       id="regTelepon" 
                                       name="telepon" 
                                       class="custom-field-input" 
                                       placeholder="Contoh: 081234567890" 
                                       value="<?= old('telepon') ?>"
                                       autocomplete="tel">
                            </div>
                        </div>

                        <!-- Two Column Password Row on larger screens -->
                        <div class="password-grid-row">
                            <!-- Password Field -->
                            <div class="custom-form-group">
                                <label class="custom-field-label" for="regPassword">Kata Sandi</label>
                                <div class="input-with-icon">
                                    <span class="field-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" 
                                           id="regPassword" 
                                           name="password" 
                                           class="custom-field-input" 
                                           placeholder="Min. 6 karakter" 
                                           required 
                                           autocomplete="new-password">
                                    <button type="button" 
                                            class="btn-toggle-eye" 
                                            onclick="togglePwVisibility('regPassword', this)" 
                                            aria-label="Lihat password"
                                            title="Tampilkan / Sembunyikan Password">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Konfirmasi Password Field -->
                            <div class="custom-form-group">
                                <label class="custom-field-label" for="regConfirm">Konfirmasi Sandi</label>
                                <div class="input-with-icon">
                                    <span class="field-icon"><i class="fas fa-shield-alt"></i></span>
                                    <input type="password" 
                                           id="regConfirm" 
                                           name="konfirmasi_password" 
                                           class="custom-field-input" 
                                           placeholder="Ulangi sandi" 
                                           required 
                                           autocomplete="new-password">
                                    <button type="button" 
                                            class="btn-toggle-eye" 
                                            onclick="togglePwVisibility('regConfirm', this)" 
                                            aria-label="Lihat password"
                                            title="Tampilkan / Sembunyikan Password">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms Agreement -->
                        <div class="terms-agreement-row">
                            <label class="remember-label">
                                <input type="checkbox" required class="custom-checkbox" checked>
                                <span>Saya menyetujui <a href="<?= base_url('/tentang') ?>" class="terms-link" target="_blank">Syarat & Ketentuan</a> serta Kebijakan Privasi Lestari</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-auth-submit">
                            <span>Daftar Akun Baru</span>
                            <i class="fas fa-user-plus"></i>
                        </button>

                    </form>

                    <!-- Divider -->
                    <div class="auth-or-divider">
                        <span>atau daftar dengan</span>
                    </div>

                    <!-- Google Auth Button -->
                    <a href="<?= base_url('/auth/google-callback') ?>" class="btn-social-google">
                        <svg class="google-svg-icon" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>Daftar dengan Google</span>
                    </a>

                    <!-- Footer Link -->
                    <div class="auth-switch-footer">
                        <p>Sudah memiliki akun? <a href="<?= base_url('/auth/login') ?>" class="switch-link">Masuk sekarang <i class="fas fa-chevron-right"></i></a></p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Page Specific Styles -->
<style>
/* Page Layout & Background */
.auth-page-section {
    position: relative;
    min-height: calc(100vh - 72px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-12) 0;
    background: radial-gradient(circle at 10% 20%, rgba(46, 125, 50, 0.08) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(76, 175, 80, 0.09) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255, 193, 7, 0.02) 0%, transparent 60%),
                #f8faf9;
    overflow: hidden;
}

/* Ambient Blobs */
.auth-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
    z-index: 0;
    opacity: 0.6;
}

.auth-blob-1 {
    width: 420px;
    height: 420px;
    background: rgba(76, 175, 80, 0.18);
    top: -90px;
    right: -80px;
}

.auth-blob-2 {
    width: 360px;
    height: 360px;
    background: rgba(46, 125, 50, 0.14);
    bottom: -80px;
    left: -60px;
}

.auth-wrapper-container {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
}

/* Unified Split Master Card */
.auth-master-card {
    display: grid;
    grid-template-columns: 1.05fr 1.1fr;
    width: 100%;
    max-width: 1060px;
    background: var(--white);
    border-radius: 28px;
    box-shadow: 0 25px 60px -15px rgba(27, 94, 32, 0.16), 0 10px 25px -5px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(229, 231, 235, 0.85);
    overflow: hidden;
    transition: transform 0.3s ease;
}

/* Left Banner Side */
.auth-banner-side {
    position: relative;
    background: linear-gradient(145deg, #092c13 0%, #164e23 45%, #236c32 100%);
    padding: 50px 45px;
    color: var(--white);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
}

.banner-overlay-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.5;
    pointer-events: none;
}

.banner-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.banner-brand-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.14);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 8px 16px;
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    font-weight: 600;
    color: #bbf7d0;
    margin-bottom: 28px;
    width: fit-content;
}

.banner-text-block {
    margin-bottom: 28px;
}

.banner-title {
    font-size: 1.85rem;
    font-weight: 800;
    line-height: 1.28;
    color: var(--white);
    margin-bottom: 14px;
    letter-spacing: -0.5px;
}

.banner-desc {
    font-size: 0.95rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 0;
}

/* Banner Features List */
.banner-features-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 30px;
}

.banner-feature-item {
    display: flex;
    align-items: center;
    gap: 14px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 16px;
    padding: 12px 16px;
    transition: transform 0.25s ease, background 0.25s ease;
}

.banner-feature-item:hover {
    transform: translateX(4px);
    background: rgba(255, 255, 255, 0.13);
}

.feature-icon-box {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: #4ade80;
    flex-shrink: 0;
}

.feature-info h4 {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 2px;
}

.feature-info p {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 0;
    line-height: 1.4;
}

/* Community Badge */
.banner-community-badge {
    margin-top: auto;
    display: flex;
    align-items: center;
    gap: 14px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
}

.community-avatars {
    display: flex;
    align-items: center;
}

.avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    color: var(--white);
    border: 2px solid #164e23;
    margin-left: -8px;
}

.avatar-circle:first-child { margin-left: 0; }
.av-1 { background: #10b981; }
.av-2 { background: #ec4899; }
.av-3 { background: #3b82f6; }

.community-text {
    display: flex;
    flex-direction: column;
}

.community-text strong {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--white);
}

.community-text span {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Right Form Side */
.auth-form-side {
    background: var(--white);
    padding: 44px 46px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-content-inner {
    width: 100%;
}

.auth-heading-area {
    margin-bottom: 22px;
}

.auth-pill-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #e8f5e9;
    color: var(--primary);
    padding: 5px 12px;
    border-radius: var(--radius-full);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.4px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.auth-main-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 6px;
    letter-spacing: -0.4px;
}

.sparkle-icon {
    display: inline-block;
    animation: sparkleGlow 2s infinite ease-in-out;
}

@keyframes sparkleGlow {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.15); opacity: 0.85; }
}

.auth-subtitle {
    font-size: 0.9rem;
    color: var(--gray-600);
    margin-bottom: 0;
}

/* Alerts */
.auth-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 0.88rem;
    margin-bottom: 18px;
    line-height: 1.5;
}

.auth-alert i {
    font-size: 1.1rem;
    margin-top: 2px;
    flex-shrink: 0;
}

.auth-alert-danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
}

.auth-alert-success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
}

.alert-list {
    margin: 0;
    padding-left: 18px;
}

/* Custom Form Groups */
.custom-form-group {
    margin-bottom: 16px;
}

.custom-field-label {
    display: block;
    font-size: 0.86rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 5px;
}

.optional-badge {
    font-weight: 400;
    font-size: 0.76rem;
    color: var(--gray-500);
}

.input-with-icon {
    position: relative;
    display: flex;
    align-items: center;
}

.field-icon {
    position: absolute;
    left: 16px;
    color: var(--gray-400);
    font-size: 0.95rem;
    pointer-events: none;
    transition: color 0.2s ease;
}

.custom-field-input {
    width: 100%;
    height: 46px;
    padding: 10px 16px 10px 44px;
    font-size: 0.9rem;
    color: var(--gray-900);
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    outline: none;
    transition: all 0.25s ease;
}

.custom-field-input:focus {
    background: var(--white);
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.12);
}

.input-with-icon:focus-within .field-icon {
    color: var(--primary);
}

.btn-toggle-eye {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: var(--gray-500);
    font-size: 0.95rem;
    padding: 6px;
    cursor: pointer;
    transition: color 0.2s ease;
}

.btn-toggle-eye:hover {
    color: var(--primary);
}

/* Password Grid Row */
.password-grid-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

/* Terms Agreement Row */
.terms-agreement-row {
    margin-top: 4px;
    margin-bottom: 18px;
    font-size: 0.82rem;
}

.remember-label {
    display: inline-flex;
    align-items: flex-start;
    gap: 8px;
    color: var(--gray-700);
    cursor: pointer;
    user-select: none;
    line-height: 1.4;
}

.custom-checkbox {
    width: 16px;
    height: 16px;
    accent-color: var(--primary);
    cursor: pointer;
    margin-top: 2px;
    flex-shrink: 0;
}

.terms-link {
    color: var(--primary);
    font-weight: 600;
    text-decoration: underline;
}

.terms-link:hover {
    color: var(--primary-dark);
}

/* Main Submit Button */
.btn-auth-submit {
    width: 100%;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
    color: var(--white);
    font-size: 0.95rem;
    font-weight: 700;
    border: none;
    border-radius: var(--radius-full);
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(46, 125, 50, 0.28);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.btn-auth-submit:hover {
    background: linear-gradient(135deg, #388e3c 0%, #2e7d32 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(46, 125, 50, 0.38);
}

.btn-auth-submit:active {
    transform: translateY(0);
}

/* Divider */
.auth-or-divider {
    position: relative;
    text-align: center;
    margin: 18px 0;
}

.auth-or-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e2e8f0;
}

.auth-or-divider span {
    position: relative;
    background: var(--white);
    padding: 0 14px;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--gray-500);
}

/* Social Google Button */
.btn-social-google {
    width: 100%;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: var(--white);
    color: var(--gray-700);
    border: 1.5px solid #e2e8f0;
    border-radius: var(--radius-full);
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-social-google:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: var(--gray-900);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transform: translateY(-1px);
}

/* Switcher Footer */
.auth-switch-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
}

.auth-switch-footer p {
    font-size: 0.86rem;
    color: var(--gray-600);
    margin: 0;
}

.switch-link {
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
    margin-left: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
}

.switch-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.switch-link i {
    font-size: 0.75rem;
    transition: transform 0.2s ease;
}

.switch-link:hover i {
    transform: translateX(2px);
}

/* Responsive Breakpoints */
@media (max-width: 991px) {
    .auth-master-card {
        grid-template-columns: 1fr;
        max-width: 600px;
        margin: 0 16px;
    }

    .auth-banner-side {
        padding: 36px 30px;
    }

    .banner-features-list {
        display: none;
    }

    .banner-title {
        font-size: 1.5rem;
    }

    .auth-form-side {
        padding: 36px 30px;
    }
}

@media (max-width: 576px) {
    .password-grid-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
}

@media (max-width: 480px) {
    .auth-page-section {
        padding: var(--space-6) 0;
    }

    .auth-master-card {
        border-radius: 20px;
        margin: 0 8px;
    }

    .auth-banner-side {
        padding: 28px 20px;
    }

    .auth-form-side {
        padding: 28px 20px;
    }

    .auth-main-title {
        font-size: 1.35rem;
    }
}
</style>

<!-- Toggle Password Visibility Script -->
<script>
function togglePwVisibility(fieldId, btn) {
    const input = document.getElementById(fieldId);
    if (!input) return;
    const icon = btn.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
