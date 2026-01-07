<section class="section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h2><i class="fas fa-user-plus"></i> Daftar</h2>
                    <p>Buat akun baru untuk bergabung bersama kami</p>
                </div>
                
                <form action="<?= base_url('/auth/register') ?>" method="POST" class="auth-form">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required value="<?= old('nama') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required value="<?= old('email') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" name="telepon" class="form-control" placeholder="Contoh: 08123456789" value="<?= old('telepon') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>
                </form>
                
                <div class="auth-divider">
                    <span>atau</span>
                </div>
                
                <a href="<?= base_url('/auth/google-callback') ?>" class="btn btn-google btn-block">
                    <i class="fab fa-google"></i> Daftar dengan Google
                </a>
                
                <div class="auth-footer">
                    <p>Sudah punya akun? <a href="<?= base_url('/auth/login') ?>">Login sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.auth-container {
    display: flex;
    justify-content: center;
    padding: var(--space-8) 0;
}

.auth-card {
    width: 100%;
    max-width: 450px;
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-lg);
    padding: var(--space-10);
}

.auth-header {
    text-align: center;
    margin-bottom: var(--space-8);
}

.auth-header h2 {
    margin-bottom: var(--space-2);
    color: var(--primary);
}

.auth-header p {
    color: var(--gray-600);
    margin-bottom: 0;
}

.auth-form {
    margin-bottom: var(--space-6);
}

.auth-divider {
    text-align: center;
    margin: var(--space-6) 0;
    position: relative;
}

.auth-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gray-300);
}

.auth-divider span {
    background: var(--white);
    padding: 0 var(--space-4);
    color: var(--gray-500);
    position: relative;
}

.btn-google {
    background: #fff;
    color: var(--gray-700);
    border: 2px solid var(--gray-300);
    font-weight: 500;
}

.btn-google:hover {
    background: var(--gray-50);
    border-color: var(--gray-400);
    color: var(--gray-800);
}

.btn-google i {
    color: #DB4437;
}

.auth-footer {
    text-align: center;
    margin-top: var(--space-6);
    padding-top: var(--space-6);
    border-top: 1px solid var(--gray-200);
}

.auth-footer p {
    margin: 0;
    color: var(--gray-600);
}
</style>
