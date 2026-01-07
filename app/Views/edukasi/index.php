<section class="section">
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1><i class="fas fa-book-open"></i> Edukasi Lingkungan</h1>
            <p>Pelajari tentang pengelolaan sampah dan gaya hidup ramah lingkungan</p>
        </div>

        <div class="content-wrapper">
            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Search -->
                <div class="sidebar-card">
                    <h4><i class="fas fa-search"></i> Cari Artikel</h4>
                    <form action="<?= base_url('/edukasi') ?>" method="GET">
                        <div class="search-input">
                            <input type="text" name="q" class="form-control" placeholder="Kata kunci..." value="<?= esc($search ?? '') ?>">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <!-- Categories -->
                <div class="sidebar-card">
                    <h4><i class="fas fa-folder"></i> Kategori</h4>
                    <ul class="category-list">
                        <li class="<?= !$current_kategori ? 'active' : '' ?>">
                            <a href="<?= base_url('/edukasi') ?>">Semua Kategori</a>
                        </li>
                        <?php foreach ($kategori as $kat): ?>
                        <li class="<?= $current_kategori == $kat['slug'] ? 'active' : '' ?>">
                            <a href="<?= base_url('/edukasi?kategori=' . $kat['slug']) ?>">
                                <?= esc($kat['nama']) ?>
                                <span class="count"><?= $kat['jumlah_artikel'] ?? 0 ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Popular -->
                <?php if (!empty($popular)): ?>
                <div class="sidebar-card">
                    <h4><i class="fas fa-fire"></i> Populer</h4>
                    <ul class="popular-list">
                        <?php foreach ($popular as $pop): ?>
                        <li>
                            <a href="<?= base_url('/edukasi/' . $pop['slug']) ?>">
                                <?= esc($pop['judul']) ?>
                            </a>
                            <span class="views"><i class="fas fa-eye"></i> <?= $pop['views'] ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <?php if ($search): ?>
                <div class="search-result-info">
                    <p>Hasil pencarian untuk: <strong>"<?= esc($search) ?>"</strong></p>
                </div>
                <?php endif; ?>

                <?php if (empty($artikel)): ?>
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3>Belum Ada Artikel</h3>
                    <p>Artikel belum tersedia untuk saat ini.</p>
                </div>
                <?php else: ?>
                <div class="grid grid-2">
                    <?php foreach ($artikel as $item): ?>
                    <div class="card article-card">
                        <?php if ($item['gambar']): ?>
                            <img src="<?= base_url('uploads/artikel/' . $item['gambar']) ?>" alt="<?= esc($item['judul']) ?>" class="card-img">
                        <?php else: ?>
                            <div class="card-img placeholder-img">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <span class="card-category"><?= esc($item['kategori_nama'] ?? 'Artikel') ?></span>
                            <h4 class="card-title"><?= esc($item['judul']) ?></h4>
                            <p class="card-text"><?= esc(substr($item['ringkasan'] ?? '', 0, 120)) ?>...</p>
                            <div class="card-meta">
                                <span><i class="fas fa-user"></i> <?= esc($item['penulis'] ?? 'Admin') ?></span>
                                <span><i class="fas fa-eye"></i> <?= $item['views'] ?></span>
                            </div>
                            <a href="<?= base_url('/edukasi/' . $item['slug']) ?>" class="btn btn-outline btn-block mt-4">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($pager['total'] > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $pager['total']; $i++): ?>
                    <a href="?page=<?= $i ?><?= $current_kategori ? '&kategori=' . $current_kategori : '' ?>" 
                       class="page-link <?= $pager['current'] == $i ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.page-header {
    text-align: center;
    margin-bottom: var(--space-10);
}

.page-header h1 {
    color: var(--primary);
}

.page-header p {
    color: var(--gray-600);
    margin-bottom: 0;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: var(--space-8);
}

.sidebar {
    position: sticky;
    top: 90px;
    height: fit-content;
}

.sidebar-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-6);
    margin-bottom: var(--space-6);
    box-shadow: var(--shadow);
}

.sidebar-card h4 {
    font-size: var(--font-size-base);
    margin-bottom: var(--space-4);
    color: var(--gray-800);
}

.search-input {
    position: relative;
}

.search-input input {
    padding-right: 40px;
}

.search-input button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-500);
}

.category-list li {
    margin-bottom: var(--space-2);
}

.category-list a {
    display: flex;
    justify-content: space-between;
    padding: var(--space-2) var(--space-3);
    color: var(--gray-700);
    border-radius: var(--radius-md);
}

.category-list a:hover,
.category-list li.active a {
    background: var(--primary-50);
    color: var(--primary);
}

.category-list .count {
    background: var(--gray-200);
    padding: 0 var(--space-2);
    border-radius: var(--radius-full);
    font-size: var(--font-size-xs);
}

.popular-list li {
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-100);
}

.popular-list li:last-child {
    border-bottom: none;
}

.popular-list a {
    color: var(--gray-700);
    display: block;
    margin-bottom: var(--space-1);
}

.popular-list .views {
    font-size: var(--font-size-xs);
    color: var(--gray-500);
}

.placeholder-img {
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
    .content-wrapper {
        grid-template-columns: 1fr;
    }
    
    .sidebar {
        position: static;
    }
}
</style>
