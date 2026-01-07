<section class="section">
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h1>
        </div>

        <?php if (empty($items)): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Keranjang Kosong</h3>
            <p>Anda belum menambahkan produk ke keranjang</p>
            <a href="<?= base_url('/produk') ?>" class="btn btn-primary">
                <i class="fas fa-store"></i> Belanja Sekarang
            </a>
        </div>
        <?php else: ?>
        <div class="cart-layout">
            <div class="cart-items">
                <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <div class="item-image">
                        <?php if ($item['gambar']): ?>
                            <img src="<?= base_url('uploads/produk/' . $item['gambar']) ?>" alt="<?= esc($item['nama']) ?>">
                        <?php else: ?>
                            <div class="placeholder"><i class="fas fa-image"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="item-details">
                        <h4><a href="<?= base_url('/produk/' . $item['slug']) ?>"><?= esc($item['nama']) ?></a></h4>
                        <span class="stock">Stok: <?= $item['stok'] ?></span>
                    </div>
                    <div class="item-price">
                        Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                    </div>
                    <div class="item-quantity">
                        <form action="<?= base_url('/keranjang/update') ?>" method="POST" class="qty-form">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <div class="quantity-control">
                                <button type="button" class="qty-minus"><i class="fas fa-minus"></i></button>
                                <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" max="<?= $item['stok'] ?>">
                                <button type="button" class="qty-plus"><i class="fas fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="item-subtotal">
                        Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?>
                    </div>
                    <form action="<?= base_url('/keranjang/remove') ?>" method="POST" class="remove-form">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn-remove" data-confirm="Hapus produk ini dari keranjang?">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h4>Ringkasan Pesanan</h4>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
                <div class="summary-row">
                    <span>Ongkos Kirim</span>
                    <span>Dihitung saat checkout</span>
                </div>
                <hr>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
                <a href="<?= base_url('/checkout') ?>" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-credit-card"></i> Lanjut ke Checkout
                </a>
                <a href="<?= base_url('/produk') ?>" class="btn btn-outline btn-block mt-4">
                    <i class="fas fa-arrow-left"></i> Lanjut Belanja
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
.page-header {
    margin-bottom: var(--space-8);
}

.empty-cart {
    text-align: center;
    padding: var(--space-16);
    background: var(--white);
    border-radius: var(--radius-xl);
}

.empty-cart i {
    font-size: 5rem;
    color: var(--gray-300);
    margin-bottom: var(--space-6);
}

.empty-cart h3 {
    margin-bottom: var(--space-2);
}

.empty-cart p {
    color: var(--gray-600);
    margin-bottom: var(--space-6);
}

.cart-layout {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: var(--space-8);
}

.cart-items {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.cart-item {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4);
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.item-image {
    width: 100px;
    height: 100px;
    border-radius: var(--radius-md);
    overflow: hidden;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-image .placeholder {
    width: 100%;
    height: 100%;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    font-size: 2rem;
}

.item-details {
    flex: 1;
}

.item-details h4 {
    margin-bottom: var(--space-1);
}

.item-details .stock {
    font-size: var(--font-size-sm);
    color: var(--gray-500);
}

.item-price {
    font-weight: 500;
    color: var(--gray-700);
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: var(--space-1);
}

.quantity-control button {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gray-100);
    border-radius: var(--radius-sm);
}

.quantity-control input {
    width: 50px;
    text-align: center;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-sm);
    padding: var(--space-1);
}

.item-subtotal {
    font-weight: 700;
    color: var(--primary);
    min-width: 120px;
    text-align: right;
}

.btn-remove {
    color: var(--danger);
    padding: var(--space-2);
}

.cart-summary {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow);
    height: fit-content;
    position: sticky;
    top: 90px;
}

.cart-summary h4 {
    margin-bottom: var(--space-6);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: var(--space-3);
}

.summary-row.total {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--primary);
    margin-top: var(--space-4);
}

.cart-summary hr {
    border: none;
    border-top: 1px solid var(--gray-200);
    margin: var(--space-4) 0;
}

@media (max-width: 768px) {
    .cart-layout {
        grid-template-columns: 1fr;
    }
    
    .cart-item {
        flex-wrap: wrap;
    }
    
    .cart-summary {
        position: static;
    }
}
</style>

<script>
document.querySelectorAll('.quantity-control').forEach(control => {
    const input = control.querySelector('input');
    const form = control.closest('.qty-form');
    
    control.querySelector('.qty-minus').addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            form.submit();
        }
    });
    
    control.querySelector('.qty-plus').addEventListener('click', () => {
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
            form.submit();
        }
    });
});
</script>
