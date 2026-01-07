<!-- Hero Section -->
<section class="hero hero-small">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda</p>
    </div>
</section>

<!-- Contact Content -->
<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-card">
                <h3><i class="fas fa-envelope"></i> Kirim Pesan</h3>
                <form action="#" method="POST" class="contact-form">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama Anda">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Subjek *</label>
                        <input type="text" name="subjek" class="form-control" required placeholder="Subjek pesan">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pesan *</label>
                        <textarea name="pesan" class="form-control" rows="5" required placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>Alamat</h4>
                        <p>Jl. Hayam Wuruk No. 123<br>Kota Pekalongan, Jawa Tengah<br>51111</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>Telepon</h4>
                        <p>(0285) 123-4567<br>+62 812-3456-7890</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h4>Email</h4>
                        <p>info@lestaripekalongan.id<br>support@lestaripekalongan.id</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-content">
                        <h4>Jam Operasional</h4>
                        <p>Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 12:00</p>
                    </div>
                </div>
                
                <div class="social-links">
                    <h4>Ikuti Kami</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section bg-light">
    <div class="container">
        <div class="text-center mb-8">
            <h2>Lokasi Kami</h2>
            <p>Kunjungi kantor kami di Pekalongan</p>
        </div>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63324.18694986847!2d109.62464499158807!3d-6.888983048082879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70202be969dff5%3A0x3027a76e352be40!2sPekalongan%2C%20Pekalongan%20City%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1704567890123!5m2!1sen!2sid" 
                width="100%" 
                height="400" 
                style="border:0; border-radius: var(--radius-xl);" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<style>
.hero-small {
    padding: var(--space-16) 0;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    text-align: center;
}

.hero-small h1 {
    font-size: var(--font-size-4xl);
    margin-bottom: var(--space-2);
}

.hero-small p {
    opacity: 0.9;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: var(--space-12);
}

.contact-form-card {
    background: var(--white);
    padding: var(--space-8);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
}

.contact-form-card h3 {
    margin-bottom: var(--space-6);
    color: var(--primary);
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.info-card {
    display: flex;
    gap: var(--space-4);
    padding: var(--space-4);
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.info-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-100);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.info-content h4 {
    margin-bottom: var(--space-1);
    font-size: var(--font-size-base);
}

.info-content p {
    margin: 0;
    color: var(--gray-600);
    font-size: var(--font-size-sm);
    line-height: 1.6;
}

.social-links {
    padding: var(--space-6);
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.social-links h4 {
    margin-bottom: var(--space-4);
}

.social-icons {
    display: flex;
    gap: var(--space-3);
}

.social-icon {
    width: 45px;
    height: 45px;
    background: var(--primary-100);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    transition: all var(--transition-fast);
}

.social-icon:hover {
    background: var(--primary);
    color: var(--white);
    transform: translateY(-3px);
}

.bg-light {
    background: var(--gray-50);
}

.mb-8 {
    margin-bottom: var(--space-8);
}

.map-container {
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

@media (max-width: 992px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}
</style>
