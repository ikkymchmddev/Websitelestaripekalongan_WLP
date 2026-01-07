<section class="section">
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-box"></i> Pesanan Saya</h1>
        </div>

        <?php if (empty($pesanan)): ?>
        <div class="empty-state">
            <i class="fas fa-shopping-bag"></i>
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum membuat pesanan. Mulai belanja sekarang!</p>
            <a href="<?= base_url('/produk') ?>" class="btn btn-primary">
                <i class="fas fa-store"></i> Lihat Produk
            </a>
        </div>
        <?php else: ?>
        <div class="orders-list">
            <?php foreach ($pesanan as $order): ?>
            <div class="order-card">
                <div class="order-header">
                    <div class="order-info">
                        <span class="order-code"><?= esc($order['kode_pesanan']) ?></span>
                        <span class="order-date"><?= date('d F Y', strtotime($order['created_at'])) ?></span>
                    </div>
                    <span class="status-badge <?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
                </div>
                
                <div class="order-body">
                    <div class="order-summary">
                        <span class="label">Total:</span>
                        <span class="value">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
                    </div>
                    <div class="order-summary">
                        <span class="label">Pembayaran:</span>
                        <span class="value"><?= strtoupper($order['metode_pembayaran']) ?></span>
                    </div>
                </div>
                
                <div class="order-footer">
                    <a href="<?= base_url('/pesanan/' . $order['kode_pesanan']) ?>" class="btn btn-outline btn-sm">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <?php if ($order['status'] == 'pending'): ?>
                    <form action="<?= base_url('/pesanan/batal/' . $order['kode_pesanan']) ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm" data-confirm="Batalkan pesanan ini?">
                            <i class="fas fa-times"></i> Batalkan
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
.page-header {
    margin-bottom: var(--space-8);
}

.empty-state {
    text-align: center;
    padding: var(--space-16);
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
}

.empty-state i {
    font-size: 5rem;
    color: var(--gray-300);
    margin-bottom: var(--space-6);
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.order-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-4) var(--space-6);
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-100);
}

.order-code {
    font-weight: 700;
    color: var(--primary);
    margin-right: var(--space-4);
}

.order-date {
    color: var(--gray-500);
    font-size: var(--font-size-sm);
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

.order-body {
    padding: var(--space-6);
    display: flex;
    gap: var(--space-8);
}

.order-summary {
    display: flex;
    flex-direction: column;
}

.order-summary .label {
    font-size: var(--font-size-sm);
    color: var(--gray-500);
}

.order-summary .value {
    font-weight: 600;
}

.order-footer {
    padding: var(--space-4) var(--space-6);
    border-top: 1px solid var(--gray-100);
    display: flex;
    gap: var(--space-2);
}
</style>
