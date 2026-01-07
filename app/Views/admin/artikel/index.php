<div class="page-header-admin">
    <h1><i class="fas fa-newspaper"></i> Kelola Artikel</h1>
    <a href="<?= base_url('/admin/artikel/tambah') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Artikel
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <?php if (empty($artikel)): ?>
        <p class="text-center text-secondary">Belum ada artikel</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artikel as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['gambar']): ?>
                            <img src="<?= base_url('uploads/artikel/' . $item['gambar']) ?>" width="60" height="40" style="object-fit:cover; border-radius:4px;">
                        <?php else: ?>
                            <div style="width:60px;height:40px;background:var(--gray-200);border-radius:4px;"></div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($item['judul']) ?></strong></td>
                    <td><?= esc($item['kategori_nama']) ?></td>
                    <td><span class="status-badge <?= $item['status'] ?>"><?= ucfirst($item['status']) ?></span></td>
                    <td><?= $item['views'] ?></td>
                    <td><?= date('d/m/Y', strtotime($item['created_at'])) ?></td>
                    <td class="actions">
                        <a href="<?= base_url('/admin/artikel/edit/' . $item['id']) ?>" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('/admin/artikel/hapus/' . $item['id']) ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn-delete" data-confirm="Hapus artikel ini?">
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
