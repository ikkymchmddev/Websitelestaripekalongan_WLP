<div class="page-header-admin">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['pesanan']['total'] ?? 0 ?></h3>
            <p>Total Pesanan</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="stat-info">
            <h3>Rp <?= number_format($stats['pesanan']['revenue'] ?? 0, 0, ',', '.') ?></h3>
            <p>Total Pendapatan</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['produk_aktif'] ?? 0 ?></h3>
            <p>Produk Aktif</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['anggota'] ?? 0 ?></h3>
            <p>Anggota</p>
        </div>
    </div>
</div>

<!-- Order Status Summary -->
<div class="admin-card mb-6">
    <div class="admin-card-header">
        <h3><i class="fas fa-chart-pie"></i> Status Pesanan</h3>
    </div>
    <div class="admin-card-body">
        <div class="status-summary">
            <div class="status-item">
                <span class="status-badge pending">Pending</span>
                <strong><?= $stats['pesanan']['pending'] ?? 0 ?></strong>
            </div>
            <div class="status-item">
                <span class="status-badge dikonfirmasi">Dikonfirmasi</span>
                <strong><?= $stats['pesanan']['dikonfirmasi'] ?? 0 ?></strong>
            </div>
            <div class="status-item">
                <span class="status-badge diproses">Diproses</span>
                <strong><?= $stats['pesanan']['diproses'] ?? 0 ?></strong>
            </div>
            <div class="status-item">
                <span class="status-badge dikirim">Dikirim</span>
                <strong><?= $stats['pesanan']['dikirim'] ?? 0 ?></strong>
            </div>
            <div class="status-item">
                <span class="status-badge selesai">Selesai</span>
                <strong><?= $stats['pesanan']['selesai'] ?? 0 ?></strong>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-3 mb-6">
    <div class="admin-card">
        <div class="admin-card-body text-center">
            <h4><?= $stats['artikel_published'] ?? 0 ?></h4>
            <p>Artikel Terbit</p>
        </div>
    </div>
    <div class="admin-card">
        <div class="admin-card-body text-center">
            <h4><?= $stats['tps_aktif'] ?? 0 ?></h4>
            <p>TPS Aktif</p>
        </div>
    </div>
    <div class="admin-card">
        <div class="admin-card-body text-center">
            <h4><?= $stats['produk_total'] ?? 0 ?></h4>
            <p>Total Produk</p>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fas fa-clock"></i> Pesanan Terbaru</h3>
        <a href="<?= base_url('/admin/pesanan') ?>" class="btn btn-sm btn-outline">Lihat Semua</a>
    </div>
    <div class="admin-card-body">
        <?php if (empty($pesanan_terbaru)): ?>
        <p class="text-center text-secondary">Belum ada pesanan</p>
        <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice($pesanan_terbaru, 0, 5) as $order): ?>
                <tr>
                    <td><strong><?= esc($order['kode_pesanan']) ?></strong></td>
                    <td><?= esc($order['user_nama']) ?></td>
                    <td>Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                    <td><span class="status-badge <?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                    <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                    <td>
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
.status-summary {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.status-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-2);
}

.status-item strong {
    font-size: var(--font-size-2xl);
}

.mb-6 { margin-bottom: var(--space-6); }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-6); }

@media (max-width: 768px) {
    .grid-3 { grid-template-columns: 1fr; }
}
</style>
