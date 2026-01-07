<section class="section">
    <div class="container">
        <div class="success-page">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Pesanan Berhasil!</h1>
            <p>Terima kasih telah berbelanja di Lestari Pekalongan</p>
            
            <div class="order-info-card">
                <div class="order-code">
                    <span>Kode Pesanan</span>
                    <strong><?= esc($pesanan['kode_pesanan']) ?></strong>
                </div>
                
                <div class="order-details">
                    <div class="detail-row">
                        <span>Status</span>
                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                    </div>
                    <div class="detail-row">
                        <span>Tanggal</span>
                        <span><?= date('d F Y, H:i', strtotime($pesanan['created_at'])) ?></span>
                    </div>
                    <div class="detail-row">
                        <span>Metode Pembayaran</span>
                        <span>COD (Bayar di Tempat)</span>
                    </div>
                    <div class="detail-row">
                        <span>Total Pembayaran</span>
                        <span class="total">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></span>
                    </div>
                </div>

                <div class="shipping-info">
                    <h4>Alamat Pengiriman</h4>
                    <p>
                        <strong><?= esc($pesanan['nama_penerima']) ?></strong><br>
                        <?= esc($pesanan['telepon_penerima']) ?><br>
                        <?= esc($pesanan['alamat_pengiriman']) ?><br>
                        <?= esc($pesanan['kecamatan']) ?>, <?= esc($pesanan['kota']) ?><br>
                        <?= esc($pesanan['provinsi']) ?> <?= esc($pesanan['kode_pos']) ?>
                    </p>
                </div>

                <div class="order-items-list">
                    <h4>Produk yang Dipesan</h4>
                    <?php foreach ($details as $item): ?>
                    <div class="order-item">
                        <span class="item-name"><?= esc($item['nama_produk']) ?></span>
                        <span class="item-qty">x<?= $item['jumlah'] ?></span>
                        <span class="item-price">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url('/pesanan/' . $pesanan['kode_pesanan']) ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-eye"></i> Lihat Detail Pesanan
                </a>
                <a href="<?= base_url('/produk') ?>" class="btn btn-outline btn-lg">
                    <i class="fas fa-shopping-bag"></i> Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.success-page {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.success-icon {
    font-size: 6rem;
    color: var(--success);
    margin-bottom: var(--space-6);
    animation: scaleIn 0.5s ease;
}

@keyframes scaleIn {
    0% { transform: scale(0); opacity: 0; }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

.success-page h1 {
    color: var(--success);
    margin-bottom: var(--space-2);
}

.success-page > p {
    color: var(--gray-600);
    margin-bottom: var(--space-8);
}

.order-info-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    box-shadow: var(--shadow);
    text-align: left;
    margin-bottom: var(--space-8);
}

.order-code {
    text-align: center;
    padding-bottom: var(--space-6);
    border-bottom: 2px dashed var(--gray-200);
    margin-bottom: var(--space-6);
}

.order-code span {
    display: block;
    color: var(--gray-600);
    margin-bottom: var(--space-2);
}

.order-code strong {
    font-size: var(--font-size-2xl);
    color: var(--primary);
    letter-spacing: 2px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-100);
}

.detail-row .total {
    font-weight: 700;
    color: var(--primary);
    font-size: var(--font-size-lg);
}

.badge {
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm);
}

.badge-warning {
    background: #FFF3E0;
    color: var(--warning);
}

.shipping-info, .order-items-list {
    margin-top: var(--space-6);
    padding-top: var(--space-6);
    border-top: 1px solid var(--gray-200);
}

.shipping-info h4, .order-items-list h4 {
    margin-bottom: var(--space-4);
    font-size: var(--font-size-base);
}

.shipping-info p {
    color: var(--gray-600);
    line-height: 1.8;
}

.order-item {
    display: flex;
    padding: var(--space-2) 0;
    font-size: var(--font-size-sm);
}

.order-item .item-name {
    flex: 1;
}

.order-item .item-qty {
    color: var(--gray-500);
    margin: 0 var(--space-4);
}

.action-buttons {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
}

@media (max-width: 576px) {
    .action-buttons {
        flex-direction: column;
    }
}
</style>
