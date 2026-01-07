<div class="page-header-admin">
    <h1><i class="fas fa-map-marker-alt"></i> Kelola TPS</h1>
    <a href="<?= base_url('/admin/tps/tambah') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah TPS
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <?php if (empty($tps)): ?>
        <p class="text-center text-secondary">Belum ada TPS terdaftar</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jam Operasional</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tps as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['gambar']): ?>
                            <img src="<?= base_url('uploads/tps/' . $item['gambar']) ?>" width="60" height="40" style="object-fit:cover; border-radius:4px;">
                        <?php else: ?>
                            <div style="width:60px;height:40px;background:var(--gray-200);border-radius:4px;"></div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($item['nama']) ?></strong></td>
                    <td><?= esc(substr($item['alamat'], 0, 50)) ?>...</td>
                    <td><?= $item['jam_buka'] ?> - <?= $item['jam_tutup'] ?></td>
                    <td>
                        <div class="capacity-bar">
                            <div class="capacity-fill" style="width: <?= ($item['terisi'] / max($item['kapasitas'], 1)) * 100 ?>%"></div>
                        </div>
                        <small><?= $item['terisi'] ?>/<?= $item['kapasitas'] ?> kg</small>
                    </td>
                    <td><span class="status-badge <?= $item['status'] ?>"><?= ucfirst($item['status']) ?></span></td>
                    <td class="actions">
                        <a href="<?= base_url('/admin/tps/edit/' . $item['id']) ?>" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('/admin/tps/hapus/' . $item['id']) ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn-delete" data-confirm="Hapus TPS ini?">
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

<style>
.capacity-bar {
    width: 100px;
    height: 8px;
    background: var(--gray-200);
    border-radius: 4px;
    overflow: hidden;
}

.capacity-fill {
    height: 100%;
    background: var(--primary);
    border-radius: 4px;
}
</style>
