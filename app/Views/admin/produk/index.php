<div class="page-header-admin">
    <h1><i class="fas fa-box"></i> Kelola Produk</h1>
    <a href="<?= base_url('/admin/produk/tambah') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <?php if (empty($produk)): ?>
        <p class="text-center text-secondary">Belum ada produk</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Terjual</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['gambar']): ?>
                            <img src="<?= base_url('uploads/produk/' . $item['gambar']) ?>" width="60" height="60" style="object-fit:cover; border-radius:4px;">
                        <?php else: ?>
                            <div style="width:60px;height:60px;background:var(--gray-200);border-radius:4px;"></div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($item['nama']) ?></strong></td>
                    <td><?= esc($item['kategori_nama']) ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['stok'] ?></td>
                    <td><?= $item['terjual'] ?></td>
                    <td><span class="status-badge <?= $item['status'] ?>"><?= ucfirst($item['status']) ?></span></td>
                    <td class="actions">
                        <a href="<?= base_url('/admin/produk/edit/' . $item['id']) ?>" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('/admin/produk/hapus/' . $item['id']) ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn-delete" data-confirm="Hapus produk ini?">
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
