<div class="page-header-admin">
    <h1><i class="fas fa-shopping-bag"></i> Kelola Pesanan</h1>
</div>

<!-- Filter Tabs -->
<div class="status-tabs mb-6">
    <a href="<?= base_url('/admin/pesanan') ?>" class="status-tab <?= !$current_status ? 'active' : '' ?>">Semua</a>
    <a href="<?= base_url('/admin/pesanan?status=pending') ?>" class="status-tab <?= $current_status == 'pending' ? 'active' : '' ?>">Pending</a>
    <a href="<?= base_url('/admin/pesanan?status=dikonfirmasi') ?>" class="status-tab <?= $current_status == 'dikonfirmasi' ? 'active' : '' ?>">Dikonfirmasi</a>
    <a href="<?= base_url('/admin/pesanan?status=diproses') ?>" class="status-tab <?= $current_status == 'diproses' ? 'active' : '' ?>">Diproses</a>
    <a href="<?= base_url('/admin/pesanan?status=dikirim') ?>" class="status-tab <?= $current_status == 'dikirim' ? 'active' : '' ?>">Dikirim</a>
    <a href="<?= base_url('/admin/pesanan?status=selesai') ?>" class="status-tab <?= $current_status == 'selesai' ? 'active' : '' ?>">Selesai</a>
    <a href="<?= base_url('/admin/pesanan?status=dibatalkan') ?>" class="status-tab <?= $current_status == 'dibatalkan' ? 'active' : '' ?>">Dibatalkan</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <?php if (empty($pesanan)): ?>
        <p class="text-center text-secondary">Tidak ada pesanan</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $order): ?>
                <tr>
                    <td><strong><?= esc($order['kode_pesanan']) ?></strong></td>
                    <td>
                        <?= esc($order['nama_penerima']) ?><br>
                        <small class="text-secondary"><?= esc($order['telepon_penerima']) ?></small>
                    </td>
                    <td><small><?= esc(substr($order['alamat_pengiriman'], 0, 40)) ?>...</small></td>
                    <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                    <td><?= strtoupper($order['metode_pembayaran']) ?></td>
                    <td><span class="status-badge <?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                    <td class="actions">
                        <a href="<?= base_url('/admin/pesanan/detail/' . $order['id']) ?>" class="btn-edit">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<style>
.status-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-2);
    background: var(--white);
    padding: var(--space-4);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.status-tab {
    padding: var(--space-2) var(--space-4);
    color: var(--gray-600);
    border-radius: var(--radius-md);
    font-size: var(--font-size-sm);
}

.status-tab:hover {
    background: var(--gray-100);
}

.status-tab.active {
    background: var(--primary);
    color: var(--white);
}

.mb-6 { margin-bottom: var(--space-6); }
</style>
