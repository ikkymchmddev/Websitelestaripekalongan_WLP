<div class="page-header-admin">
    <h1><i class="fas fa-shopping-bag"></i> Detail Pesanan</h1>
    <a href="<?= base_url('/admin/pesanan') ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="order-detail-grid">
    <!-- Order Info -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>Info Pesanan</h3>
            <span class="status-badge <?= $pesanan['status'] ?>"><?= ucfirst($pesanan['status']) ?></span>
        </div>
        <div class="admin-card-body">
            <div class="info-row">
                <span class="info-label">Kode Pesanan</span>
                <span class="info-value"><?= esc($pesanan['kode_pesanan']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Order</span>
                <span class="info-value"><?= date('d F Y, H:i', strtotime($pesanan['created_at'])) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran</span>
                <span class="info-value"><?= strtoupper($pesanan['metode_pembayaran']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Total</span>
                <span class="info-value total">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></span>
            </div>
            
            <?php if ($pesanan['catatan']): ?>
            <div class="info-row">
                <span class="info-label">Catatan</span>
                <span class="info-value"><?= esc($pesanan['catatan']) ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Shipping Info -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>Info Pengiriman</h3>
        </div>
        <div class="admin-card-body">
            <div class="info-row">
                <span class="info-label">Penerima</span>
                <span class="info-value"><?= esc($pesanan['nama_penerima']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Telepon</span>
                <span class="info-value"><?= esc($pesanan['telepon_penerima']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat</span>
                <span class="info-value">
                    <?= esc($pesanan['alamat_pengiriman']) ?><br>
                    <?= esc($pesanan['kecamatan']) ?>, <?= esc($pesanan['kota']) ?><br>
                    <?= esc($pesanan['provinsi']) ?> <?= esc($pesanan['kode_pos']) ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Order Items -->
<div class="admin-card mt-6">
    <div class="admin-card-header">
        <h3>Produk Dipesan</h3>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $item): ?>
                <tr>
                    <td><strong><?= esc($item['nama_produk']) ?></strong></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                    <td><strong>Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Update Status -->
<?php if ($pesanan['status'] != 'selesai' && $pesanan['status'] != 'dibatalkan'): ?>
<div class="admin-card mt-6">
    <div class="admin-card-header">
        <h3>Update Status</h3>
    </div>
    <div class="admin-card-body">
        <form action="<?= base_url('/admin/pesanan/status/' . $pesanan['id']) ?>" method="POST" class="d-flex gap-4">
            <select name="status" class="form-control" style="max-width:200px;">
                <option value="pending" <?= $pesanan['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="dikonfirmasi" <?= $pesanan['status'] == 'dikonfirmasi' ? 'selected' : '' ?>>Dikonfirmasi</option>
                <option value="diproses" <?= $pesanan['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="dikirim" <?= $pesanan['status'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                <option value="selesai" <?= $pesanan['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="dibatalkan" <?= $pesanan['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </form>
    </div>
</div>
<?php endif; ?>

<style>
.order-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-6);
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-100);
}

.info-label {
    color: var(--gray-600);
}

.info-value {
    font-weight: 500;
    text-align: right;
}

.info-value.total {
    font-size: var(--font-size-xl);
    color: var(--primary);
}

.mt-6 { margin-top: var(--space-6); }
.d-flex { display: flex; }
.gap-4 { gap: var(--space-4); }

@media (max-width: 768px) {
    .order-detail-grid {
        grid-template-columns: 1fr;
    }
}
</style>
