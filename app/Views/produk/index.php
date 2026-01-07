<section class="section">
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1><i class="fas fa-store"></i> Produk Kerajinan</h1>
            <p>Produk kerajinan tangan berkualitas dari sampah daur ulang</p>
        </div>

        <!-- Filters -->
        <div class="filter-bar">
            <div class="filter-categories">
                <a href="<?= base_url('/produk') ?>" class="filter-chip <?= !$current_kategori ? 'active' : '' ?>">
                    Semua
                </a>
                <?php foreach ($kategori as $kat): ?>
                <a href="<?= base_url('/produk?kategori=' . $kat['slug']) ?>" 
                   class="filter-chip <?= $current_kategori == $kat['slug'] ? 'active' : '' ?>">
                    <?= esc($kat['nama']) ?>
                </a>
                <?php endforeach; ?>
            </div>
            
            <div class="filter-actions">
                <form action="<?= base_url('/produk') ?>" method="GET" class="search-form">
                    <input type="text" name="q" placeholder="Cari produk..." value="<?= esc($search ?? '') ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                
                <select class="form-control sort-select" onchange="window.location.href='?sort='+this.value">
                    <option value="terbaru" <?= $sort == 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
                    <option value="termurah" <?= $sort == 'termurah' ? 'selected' : '' ?>>Termurah</option>
                    <option value="termahal" <?= $sort == 'termahal' ? 'selected' : '' ?>>Termahal</option>
                    <option value="terlaris" <?= $sort == 'terlaris' ? 'selected' : '' ?>>Terlaris</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <?php if (empty($produk)): ?>
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>Belum Ada Produk</h3>
            <p>Produk belum tersedia untuk saat ini.</p>
        </div>
        <?php else: ?>
        <div class="grid grid-4">
            <?php foreach ($produk as $item): ?>
            <div class="card product-card">
                <?php if ($item['stok'] < 1): ?>
                    <span class="card-badge out-stock">Habis</span>
                <?php elseif ($item['terjual'] > 10): ?>
                    <span class="card-badge">Terlaris</span>
                <?php endif; ?>
                
                <?php if ($item['gambar']): ?>
                    <img src="<?= base_url('uploads/produk/' . $item['gambar']) ?>" alt="<?= esc($item['nama']) ?>" class="card-img">
                <?php else: ?>
                    <div class="card-img placeholder-img">
                        <i class="fas fa-image"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <span class="product-category"><?= esc($item['kategori_nama'] ?? 'Produk') ?></span>
                    <h4 class="card-title"><?= esc($item['nama']) ?></h4>
                    <div class="product-info">
                        <span class="card-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                        <span class="product-stock <?= $item['stok'] < 5 ? ($item['stok'] < 1 ? 'out' : 'low') : '' ?>">
                            <?php if ($item['stok'] < 1): ?>
                                Stok Habis
                            <?php else: ?>
                                Stok: <?= $item['stok'] ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="product-sold">
                        <i class="fas fa-shopping-bag"></i> Terjual <?= $item['terjual'] ?>
                    </div>
                    <a href="<?= base_url('/produk/' . $item['slug']) ?>" class="btn btn-primary btn-block mt-4">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pager['total'] > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $pager['total']; $i++): ?>
            <a href="?page=<?= $i ?><?= $current_kategori ? '&kategori=' . $current_kategori : '' ?><?= $sort ? '&sort=' . $sort : '' ?>" 
               class="page-link <?= $pager['current'] == $i ? 'active' : '' ?>">
                <?= $i ?>
            </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<style>
.page-header {
    text-align: center;
    margin-bottom: var(--space-8);
}

.page-header h1 {
    color: var(--primary);
}

.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
    margin-bottom: var(--space-8);
    padding: var(--space-4);
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.filter-categories {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-2);
}

.filter-chip {
    padding: var(--space-2) var(--space-4);
    background: var(--gray-100);
    color: var(--gray-700);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm);
    transition: all var(--transition-fast);
}

.filter-chip:hover,
.filter-chip.active {
    background: var(--primary);
    color: var(--white);
}

.filter-actions {
    display: flex;
    gap: var(--space-4);
}

.search-form {
    position: relative;
}

.search-form input {
    padding: var(--space-2) var(--space-10) var(--space-2) var(--space-4);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-full);
    width: 200px;
}

.search-form button {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-500);
}

.sort-select {
    width: 150px;
    padding: var(--space-2) var(--space-4);
}

.product-category {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-sold {
    font-size: var(--font-size-sm);
    color: var(--gray-500);
    margin-top: var(--space-2);
}

.card-badge.out-stock {
    background: var(--danger);
    color: var(--white);
}

.placeholder-img {
    height: 220px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    font-size: 3rem;
}

.empty-state {
    text-align: center;
    padding: var(--space-16);
    background: var(--white);
    border-radius: var(--radius-xl);
}

.empty-state i {
    font-size: 4rem;
    color: var(--gray-300);
    margin-bottom: var(--space-4);
}

.pagination {
    display: flex;
    justify-content: center;
    gap: var(--space-2);
    margin-top: var(--space-8);
}

.page-link {
    padding: var(--space-2) var(--space-4);
    background: var(--white);
    color: var(--gray-700);
    border-radius: var(--radius-md);
}

.page-link.active,
.page-link:hover {
    background: var(--primary);
    color: var(--white);
}

@media (max-width: 768px) {
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-actions {
        flex-direction: column;
    }
    
    .search-form input {
        width: 100%;
    }
}
</style>
