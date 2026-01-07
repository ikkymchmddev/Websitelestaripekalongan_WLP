<section class="section">
    <div class="container">
        <a href="<?= base_url('/pesanan') ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Pesanan
        </a>

        <div class="order-detail-page">
            <!-- Order Header -->
            <div class="order-header-card">
                <div class="order-code-badge">
                    <span class="code"><?= esc($pesanan['kode_pesanan']) ?></span>
                    <span class="status-badge <?= $pesanan['status'] ?>"><?= ucfirst($pesanan['status']) ?></span>
                </div>
                <div class="order-date">
                    <i class="fas fa-calendar"></i> <?= date('d F Y, H:i', strtotime($pesanan['created_at'])) ?>
                </div>
            </div>

            <div class="order-detail-grid">
                <!-- Shipping Info -->
                <div class="detail-card">
                    <h4><i class="fas fa-truck"></i> Informasi Pengiriman</h4>
                    <div class="detail-content">
                        <p><strong><?= esc($pesanan['nama_penerima']) ?></strong></p>
                        <p><?= esc($pesanan['telepon_penerima']) ?></p>
                        <p><?= esc($pesanan['alamat_pengiriman']) ?></p>
                        <p><?= esc($pesanan['kecamatan']) ?>, <?= esc($pesanan['kota']) ?></p>
                        <p><?= esc($pesanan['provinsi']) ?> <?= esc($pesanan['kode_pos']) ?></p>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="detail-card">
                    <h4><i class="fas fa-credit-card"></i> Pembayaran</h4>
                    <div class="detail-content">
                        <div class="payment-method">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>COD (Bayar di Tempat)</span>
                        </div>
                        <div class="payment-total">
                            <span>Total Pembayaran</span>
                            <strong>Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="detail-card">
                <h4><i class="fas fa-box"></i> Produk Dipesan</h4>
                <div class="order-items-table">
                    <table>
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
                                <td><?= esc($item['nama_produk']) ?></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td><?= $item['jumlah'] ?>x</td>
                                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total</strong></td>
                                <td><strong>Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <?php if ($pesanan['catatan']): ?>
            <div class="detail-card">
                <h4><i class="fas fa-sticky-note"></i> Catatan</h4>
                <p><?= esc($pesanan['catatan']) ?></p>
            </div>
            <?php endif; ?>

            <!-- Actions -->
            <?php if ($pesanan['status'] == 'pending'): ?>
            <div class="order-actions">
                <form action="<?= base_url('/pesanan/batal/' . $pesanan['kode_pesanan']) ?>" method="POST">
                    <button type="submit" class="btn btn-danger" data-confirm="Batalkan pesanan ini?">
                        <i class="fas fa-times"></i> Batalkan Pesanan
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.back-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--gray-600);
    margin-bottom: var(--space-6);
}

.order-detail-page {
    max-width: 900px;
}

.order-header-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    margin-bottom: var(--space-6);
    box-shadow: var(--shadow);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-code-badge .code {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--primary);
    margin-right: var(--space-4);
}

.order-date {
    color: var(--gray-600);
}

.order-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-6);
    margin-bottom: var(--space-6);
}

.detail-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow);
    margin-bottom: var(--space-6);
}

.detail-card h4 {
    margin-bottom: var(--space-4);
    padding-bottom: var(--space-3);
    border-bottom: 1px solid var(--gray-100);
}

.detail-content p {
    margin-bottom: var(--space-1);
    color: var(--gray-700);
}

.payment-method {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-4);
}

.payment-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--space-4);
    border-top: 1px solid var(--gray-200);
}

.payment-total strong {
    font-size: var(--font-size-xl);
    color: var(--primary);
}

.order-items-table table {
    width: 100%;
    border-collapse: collapse;
}

.order-items-table th, 
.order-items-table td {
    padding: var(--space-3);
    text-align: left;
    border-bottom: 1px solid var(--gray-100);
}

.order-items-table th {
    background: var(--gray-50);
    font-weight: 600;
}

.text-right { text-align: right; }

.order-actions {
    padding: var(--space-6);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
}

.status-badge {
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: var(--font-size-xs);
    font-weight: 600;
}

.status-badge.pending { background: #FFF3E0; color: var(--warning); }
.status-badge.dikonfirmasi { background: #E3F2FD; color: var(--info); }
.status-badge.diproses { background: #F3E5F5; color: #7B1FA2; }
.status-badge.dikirim { background: #E0F7FA; color: #00838F; }
.status-badge.selesai { background: #E8F5E9; color: var(--success); }
.status-badge.dibatalkan { background: #FFEBEE; color: var(--danger); }

@media (max-width: 768px) {
    .order-detail-grid {
        grid-template-columns: 1fr;
    }
    
    .order-header-card {
        flex-direction: column;
        gap: var(--space-4);
        text-align: center;
    }
}
</style>
