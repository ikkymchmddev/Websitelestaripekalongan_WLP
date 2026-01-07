<div class="page-header-admin">
    <h1><i class="fas fa-users"></i> Kelola Anggota</h1>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <?php if (empty($anggota)): ?>
        <p class="text-center text-secondary">Belum ada anggota terdaftar</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Terdaftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggota as $user): ?>
                <tr>
                    <td>
                        <?php if ($user['avatar']): ?>
                            <img src="<?= base_url('uploads/avatar/' . $user['avatar']) ?>" width="40" height="40" style="border-radius:50%; object-fit:cover;">
                        <?php else: ?>
                            <div style="width:40px;height:40px;background:var(--primary-100);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--primary);">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($user['nama']) ?></strong></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['telepon'] ?? '-') ?></td>
                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                    <td><span class="status-badge <?= $user['status'] ?>"><?= ucfirst($user['status']) ?></span></td>
                    <td class="actions">
                        <a href="<?= base_url('/admin/anggota/detail/' . $user['id']) ?>" class="btn-edit">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="<?= base_url('/admin/anggota/hapus/' . $user['id']) ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn-delete" data-confirm="Hapus anggota ini?">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
