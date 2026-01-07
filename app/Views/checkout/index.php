<section class="section">
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-credit-card"></i> Checkout</h1>
        </div>

        <form action="<?= base_url('/checkout/proses') ?>" method="POST" class="checkout-form">
            <div class="checkout-layout">
                <!-- Shipping Info -->
                <div class="checkout-section">
                    <h3><i class="fas fa-truck"></i> Informasi Pengiriman</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Penerima *</label>
                            <input type="text" name="nama_penerima" class="form-control" required 
                                   value="<?= old('nama_penerima', $user['nama']) ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Telepon *</label>
                            <input type="tel" name="telepon_penerima" class="form-control" required 
                                   value="<?= old('telepon_penerima', $user['telepon']) ?>" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Lengkap *</label>
                        <textarea name="alamat_pengiriman" class="form-control" rows="3" required 
                                  placeholder="Nama jalan, nomor rumah, RT/RW, dll"><?= old('alamat_pengiriman', $user['alamat']) ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kota/Kabupaten *</label>
                            <input type="text" name="kota" class="form-control" required 
                                   value="<?= old('kota') ?>" placeholder="Kota Pekalongan">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" 
                                   value="<?= old('kecamatan') ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" 
                                   value="<?= old('provinsi', 'Jawa Tengah') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="kode_pos" class="form-control" 
                                   value="<?= old('kode_pos') ?>" placeholder="51111">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="2" 
                                  placeholder="Catatan khusus untuk pesanan Anda"><?= old('catatan') ?></textarea>
                    </div>

                    <div class="payment-method">
                        <h4>Metode Pembayaran</h4>
                        <div class="payment-option selected">
                            <input type="radio" name="metode_pembayaran" value="COD" checked>
                            <div class="payment-icon"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="payment-info">
                                <strong>Cash on Delivery (COD)</strong>
                                <span>Bayar saat barang sampai</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <h3><i class="fas fa-receipt"></i> Ringkasan Pesanan</h3>
                    
                    <div class="order-items">
                        <?php foreach ($items as $item): ?>
                        <div class="order-item">
                            <div class="item-img">
                                <?php if ($item['gambar']): ?>
                                    <img src="<?= base_url('uploads/produk/' . $item['gambar']) ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="item-info">
                                <span class="item-name"><?= esc($item['nama']) ?></span>
                                <span class="item-qty">x<?= $item['jumlah'] ?></span>
                            </div>
                            <div class="item-price">
                                Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-totals">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                        <div class="total-row">
                            <span>Ongkos Kirim</span>
                            <span class="free">Gratis</span>
                        </div>
                        <hr>
                        <div class="total-row grand-total">
                            <span>Total</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-check"></i> Buat Pesanan
                    </button>
                    
                    <p class="checkout-note">
                        Dengan menekan tombol di atas, Anda menyetujui syarat dan ketentuan yang berlaku.
                    </p>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
.page-header {
    margin-bottom: var(--space-8);
}

.checkout-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: var(--space-8);
}

.checkout-section {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    box-shadow: var(--shadow);
}

.checkout-section h3 {
    margin-bottom: var(--space-6);
    color: var(--gray-800);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-4);
}

.payment-method {
    margin-top: var(--space-8);
    padding-top: var(--space-6);
    border-top: 1px solid var(--gray-200);
}

.payment-method h4 {
    margin-bottom: var(--space-4);
}

.payment-option {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    cursor: pointer;
}

.payment-option.selected {
    border-color: var(--primary);
    background: var(--primary-50);
}

.payment-icon {
    width: 48px;
    height: 48px;
    background: var(--primary-100);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--primary);
}

.payment-info {
    display: flex;
    flex-direction: column;
}

.payment-info span {
    font-size: var(--font-size-sm);
    color: var(--gray-600);
}

.order-summary {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow);
    height: fit-content;
    position: sticky;
    top: 90px;
}

.order-summary h3 {
    margin-bottom: var(--space-6);
}

.order-items {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: var(--space-4);
}

.order-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-100);
}

.item-img {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    background: var(--gray-100);
}

.item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-info {
    flex: 1;
}

.item-name {
    display: block;
    font-weight: 500;
    font-size: var(--font-size-sm);
}

.item-qty {
    font-size: var(--font-size-sm);
    color: var(--gray-500);
}

.item-price {
    font-weight: 500;
}

.order-totals {
    padding: var(--space-4) 0;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: var(--space-2);
}

.total-row .free {
    color: var(--success);
}

.total-row.grand-total {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--primary);
    margin-top: var(--space-4);
}

.order-totals hr {
    border: none;
    border-top: 1px solid var(--gray-200);
    margin: var(--space-4) 0;
}

.checkout-note {
    text-align: center;
    font-size: var(--font-size-sm);
    color: var(--gray-500);
    margin-top: var(--space-4);
    margin-bottom: 0;
}

@media (max-width: 992px) {
    .checkout-layout {
        grid-template-columns: 1fr;
    }
    
    .order-summary {
        position: static;
    }
}

@media (max-width: 576px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>
