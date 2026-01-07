<section class="section">
    <div class="container">
        <article class="article-detail">
            <!-- Article Header -->
            <header class="article-header">
                <a href="<?= base_url('/edukasi') ?>" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Edukasi
                </a>
                <span class="article-category"><?= esc($artikel['kategori_nama']) ?></span>
                <h1><?= esc($artikel['judul']) ?></h1>
                <div class="article-meta">
                    <span><i class="fas fa-user"></i> <?= esc($artikel['penulis']) ?></span>
                    <span><i class="fas fa-calendar"></i> <?= date('d F Y', strtotime($artikel['created_at'])) ?></span>
                    <span><i class="fas fa-eye"></i> <?= $artikel['views'] ?> views</span>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if ($artikel['gambar']): ?>
            <div class="article-image">
                <img src="<?= base_url('uploads/artikel/' . $artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>">
            </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="article-content">
                <?= $artikel['konten'] ?>
            </div>

            <!-- Share -->
            <div class="article-share">
                <span>Bagikan:</span>
                <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="share-btn facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($artikel['judul']) ?>" target="_blank" class="share-btn twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text=<?= urlencode($artikel['judul'] . ' ' . current_url()) ?>" target="_blank" class="share-btn whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </article>

        <!-- Related Articles -->
        <?php if (!empty($related)): ?>
        <section class="related-section">
            <h3>Artikel Terkait</h3>
            <div class="grid grid-3">
                <?php foreach ($related as $item): ?>
                <div class="card article-card">
                    <?php if ($item['gambar']): ?>
                        <img src="<?= base_url('uploads/artikel/' . $item['gambar']) ?>" alt="<?= esc($item['judul']) ?>" class="card-img">
                    <?php else: ?>
                        <div class="card-img placeholder-img">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?= esc($item['judul']) ?></h4>
                        <a href="<?= base_url('/edukasi/' . $item['slug']) ?>" class="btn btn-outline btn-sm">
                            Baca
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
.article-detail {
    max-width: 800px;
    margin: 0 auto;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--gray-600);
    margin-bottom: var(--space-6);
}

.back-link:hover {
    color: var(--primary);
}

.article-header {
    margin-bottom: var(--space-8);
}

.article-category {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    background: var(--primary-50);
    color: var(--primary);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm);
    margin-bottom: var(--space-4);
}

.article-header h1 {
    font-size: var(--font-size-3xl);
    margin-bottom: var(--space-4);
}

.article-meta {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-6);
    color: var(--gray-500);
}

.article-meta span {
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.article-image {
    margin-bottom: var(--space-8);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.article-image img {
    width: 100%;
    height: auto;
}

.article-content {
    font-size: var(--font-size-lg);
    line-height: 1.8;
    color: var(--gray-800);
}

.article-content p {
    margin-bottom: var(--space-6);
}

.article-content h2, .article-content h3 {
    margin-top: var(--space-8);
    margin-bottom: var(--space-4);
}

.article-content img {
    border-radius: var(--radius-lg);
    margin: var(--space-6) 0;
}

.article-content ul, .article-content ol {
    margin-left: var(--space-6);
    margin-bottom: var(--space-6);
}

.article-content li {
    margin-bottom: var(--space-2);
    list-style: disc;
}

.article-share {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-6);
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    margin-top: var(--space-8);
}

.share-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-full);
    color: var(--white);
}

.share-btn.facebook { background: #1877F2; }
.share-btn.twitter { background: #1DA1F2; }
.share-btn.whatsapp { background: #25D366; }

.related-section {
    margin-top: var(--space-16);
}

.related-section h3 {
    margin-bottom: var(--space-8);
}

.placeholder-img {
    height: 160px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
    font-size: 2rem;
}
</style>
