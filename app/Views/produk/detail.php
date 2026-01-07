<section class="section">
    <div class="container">
        <a href="<?= base_url('/produk') ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Katalog
        </a>

        <div class="product-detail">
            <!-- Product Images -->
            <div class="product-gallery">
                <div class="main-image">
                    <?php if ($produk['gambar']): ?>
                        <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" alt="<?= esc($produk['nama']) ?>" id="mainImage">
                    <?php else: ?>
                        <div class="placeholder-img">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($produk['galeri_array'])): ?>
                <div class="thumbnail-list">
                    <div class="thumbnail active" onclick="changeImage('<?= base_url('uploads/produk/' . $produk['gambar']) ?>')">
                        <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" alt="Main">
                    </div>
                    <?php foreach ($produk['galeri_array'] as $img): ?>
                    <div class="thumbnail" onclick="changeImage('<?= base_url('uploads/produk/' . $img) ?>')">
                        <img src="<?= base_url('uploads/produk/' . $img) ?>" alt="Gallery">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Info -->
            <div class="product-info-detail">
                <span class="product-category"><?= esc($produk['kategori_nama']) ?></span>
                <h1><?= esc($produk['nama']) ?></h1>
                
                <div class="product-stats">
                    <span><i class="fas fa-shopping-bag"></i> Terjual <?= $produk['terjual'] ?></span>
                    <span><i class="fas fa-box"></i> Stok: <?= $produk['stok'] ?></span>
                    <span><i class="fas fa-weight-hanging"></i> <?= $produk['berat'] ?> gram</span>
                </div>

                <div class="product-price-box">
                    <span class="price-label">Harga</span>
                    <span class="price-value">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></span>
                </div>

                <div class="product-description">
                    <h4>Deskripsi Produk</h4>
                    <p><?= nl2br(esc($produk['deskripsi'])) ?></p>
                </div>

                <?php if ($produk['stok'] > 0): ?>
                <form action="<?= base_url('/keranjang/add') ?>" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
                    
                    <div class="quantity-selector">
                        <label>Jumlah</label>
                        <div class="quantity-control">
                            <button type="button" class="qty-minus"><i class="fas fa-minus"></i></button>
                            <input type="number" name="jumlah" value="1" min="1" max="<?= $produk['stok'] ?>">
                            <button type="button" class="qty-plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                        <button type="button" class="btn btn-outline btn-lg" onclick="buyNow()">
                            <i class="fas fa-bolt"></i> Beli Sekarang
                        </button>
                    </div>
                </form>
                <?php else: ?>
                <div class="out-of-stock-notice">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Maaf, stok produk ini sedang habis</span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Related Products -->
        <?php if (!empty($related)): ?>
        <section class="related-section">
            <h3>Produk Terkait</h3>
            <div class="grid grid-4">
                <?php foreach ($related as $item): ?>
                <div class="card product-card">
                    <?php if ($item['gambar']): ?>
                        <img src="<?= base_url('uploads/produk/' . $item['gambar']) ?>" alt="<?= esc($item['nama']) ?>" class="card-img">
                    <?php else: ?>
                        <div class="card-img placeholder-img">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?= esc($item['nama']) ?></h4>
                        <span class="card-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                        <a href="<?= base_url('/produk/' . $item['slug']) ?>" class="btn btn-outline btn-sm btn-block mt-4">
                            Lihat
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
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

.product-detail {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-10);
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    box-shadow: var(--shadow);
}

.main-image {
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.main-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.thumbnail-list {
    display: flex;
    gap: var(--space-2);
    margin-top: var(--space-4);
}

.thumbnail {
    width: 80px;
    height: 80px;
    border-radius: var(--radius-md);
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
}

.thumbnail.active {
    border-color: var(--primary);
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-category {
    color: var(--primary);
    font-size: var(--font-size-sm);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-info-detail h1 {
    font-size: var(--font-size-2xl);
    margin: var(--space-2) 0 var(--space-4);
}

.product-stats {
    display: flex;
    gap: var(--space-6);
    color: var(--gray-500);
    font-size: var(--font-size-sm);
    margin-bottom: var(--space-6);
}

.product-price-box {
    background: var(--primary-50);
    padding: var(--space-6);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-6);
}

.price-label {
    display: block;
    font-size: var(--font-size-sm);
    color: var(--gray-600);
    margin-bottom: var(--space-1);
}

.price-value {
    font-size: var(--font-size-3xl);
    font-weight: 700;
    color: var(--primary);
}

.product-description h4 {
    margin-bottom: var(--space-3);
}

.product-description p {
    color: var(--gray-600);
    line-height: 1.7;
}

.quantity-selector {
    margin: var(--space-6) 0;
}

.quantity-selector label {
    display: block;
    margin-bottom: var(--space-2);
    font-weight: 500;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    width: fit-content;
}

.quantity-control button {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gray-100);
    border-radius: var(--radius-md);
    color: var(--gray-700);
}

.quantity-control button:hover {
    background: var(--gray-200);
}

.quantity-control input {
    width: 60px;
    text-align: center;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: var(--space-2);
}

.action-buttons {
    display: flex;
    gap: var(--space-4);
}

.out-of-stock-notice {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4);
    background: #FFEBEE;
    color: var(--danger);
    border-radius: var(--radius-lg);
    margin-top: var(--space-6);
}

.related-section {
    margin-top: var(--space-16);
}

.related-section h3 {
    margin-bottom: var(--space-8);
}

.placeholder-img {
    height: 400px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    font-size: 4rem;
}

@media (max-width: 768px) {
    .product-detail {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    event.currentTarget.classList.add('active');
}

function buyNow() {
    document.querySelector('.add-to-cart-form').submit();
    // After adding to cart, redirect to checkout
    setTimeout(() => {
        window.location.href = '<?= base_url('/checkout') ?>';
    }, 500);
}

// Quantity controls
document.querySelectorAll('.quantity-control').forEach(control => {
    const input = control.querySelector('input');
    const max = parseInt(input.max);
    
    control.querySelector('.qty-minus').addEventListener('click', () => {
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    });
    
    control.querySelector('.qty-plus').addEventListener('click', () => {
        if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
    });
});
</script>
