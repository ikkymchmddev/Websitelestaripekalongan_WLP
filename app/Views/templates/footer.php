    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3><i class="fas fa-leaf"></i> Lestari Pekalongan</h3>
                    <p>Platform edukasi pengelolaan sampah dan e-commerce kerajinan daur ulang untuk mewujudkan lingkungan yang lebih bersih dan berkelanjutan.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="<?= base_url('/') ?>">Beranda</a></li>
                        <li><a href="<?= base_url('/edukasi') ?>">Edukasi</a></li>
                        <li><a href="<?= base_url('/produk') ?>">Produk</a></li>
                        <li><a href="<?= base_url('/tps') ?>">Lokasi TPS</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="<?= base_url('/tentang') ?>">Tentang Kami</a></li>
                        <li><a href="<?= base_url('/kontak') ?>">Hubungi Kami</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Kontak</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> Pekalongan, Jawa Tengah</li>
                        <li><i class="fas fa-phone"></i> (0285) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@lestaripekalongan.id</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Lestari Pekalongan. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    
    <?php if (session()->get('logged_in')): ?>
    <script>
        // Update cart badge
        fetch('<?= base_url('/api/keranjang/count') ?>')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('cartBadge');
                if (badge) badge.textContent = data.count || 0;
            });
    </script>
    <?php endif; ?>
</body>
</html>
