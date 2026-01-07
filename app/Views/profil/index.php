<section class="section">
    <div class="container">
        <div class="profile-layout">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <?php if ($user['avatar']): ?>
                            <img src="<?= base_url('uploads/avatar/' . $user['avatar']) ?>" alt="Avatar">
                        <?php else: ?>
                            <i class="fas fa-user-circle"></i>
                        <?php endif; ?>
                    </div>
                    <h3><?= esc($user['nama']) ?></h3>
                    <p><?= esc($user['email']) ?></p>
                    <span class="member-badge">
                        <i class="fas fa-check-circle"></i> Anggota
                    </span>
                </div>
                
                <nav class="profile-nav">
                    <a href="#profil" class="active"><i class="fas fa-user"></i> Profil Saya</a>
                    <a href="<?= base_url('/pesanan') ?>"><i class="fas fa-box"></i> Pesanan Saya</a>
                    <a href="#password"><i class="fas fa-lock"></i> Ubah Password</a>
                    <a href="<?= base_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="profile-content">
                <!-- Edit Profile -->
                <div class="content-card" id="profil">
                    <h3><i class="fas fa-user-edit"></i> Edit Profil</h3>
                    
                    <form action="<?= base_url('/profil/update') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= esc($user['nama']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?= esc($user['email']) ?>" disabled>
                                <span class="form-text">Email tidak dapat diubah</span>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">No. Telepon</label>
                                <input type="tel" name="telepon" class="form-control" value="<?= esc($user['telepon']) ?>" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap Anda"><?= esc($user['alamat']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="content-card" id="password">
                    <h3><i class="fas fa-lock"></i> Ubah Password</h3>
                    
                    <form action="<?= base_url('/profil/ubah-password') ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" required minlength="6">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.profile-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: var(--space-8);
}

.profile-sidebar {
    position: sticky;
    top: 90px;
    height: fit-content;
}

.profile-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    text-align: center;
    box-shadow: var(--shadow);
    margin-bottom: var(--space-6);
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto var(--space-4);
    overflow: hidden;
    background: var(--primary-50);
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-avatar i {
    font-size: 5rem;
    color: var(--primary);
}

.profile-card h3 {
    margin-bottom: var(--space-1);
}

.profile-card p {
    color: var(--gray-600);
    margin-bottom: var(--space-4);
}

.member-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-1) var(--space-3);
    background: var(--primary-50);
    color: var(--primary);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm);
}

.profile-nav {
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.profile-nav a {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4) var(--space-6);
    color: var(--gray-700);
    border-left: 3px solid transparent;
}

.profile-nav a:hover {
    background: var(--gray-50);
}

.profile-nav a.active {
    background: var(--primary-50);
    color: var(--primary);
    border-left-color: var(--primary);
}

.content-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    box-shadow: var(--shadow);
    margin-bottom: var(--space-6);
}

.content-card h3 {
    margin-bottom: var(--space-6);
    padding-bottom: var(--space-4);
    border-bottom: 1px solid var(--gray-200);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-4);
}

@media (max-width: 768px) {
    .profile-layout {
        grid-template-columns: 1fr;
    }
    
    .profile-sidebar {
        position: static;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>
