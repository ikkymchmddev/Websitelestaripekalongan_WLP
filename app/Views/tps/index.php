<section class="section">
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1><i class="fas fa-map-marked-alt"></i> Lokasi TPS</h1>
            <p>Temukan Tempat Pengumpulan Sampah terdekat dengan lokasi Anda</p>
        </div>

        <div class="tps-layout">
            <!-- Map Container -->
            <div class="map-container">
                <div id="map"></div>
            </div>

            <!-- TPS List -->
            <div class="tps-list">
                <h4><i class="fas fa-list"></i> Daftar TPS</h4>
                
                <?php if (empty($tps)): ?>
                <div class="empty-state-small">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Belum ada lokasi TPS terdaftar</p>
                </div>
                <?php else: ?>
                <div class="tps-cards">
                    <?php foreach ($tps as $item): ?>
                    <div class="tps-card" data-lat="<?= $item['latitude'] ?>" data-lng="<?= $item['longitude'] ?>">
                        <div class="tps-status <?= $item['status'] ?>">
                            <?= $item['status'] == 'aktif' ? 'Buka' : ($item['status'] == 'penuh' ? 'Penuh' : 'Tutup') ?>
                        </div>
                        <h5><?= esc($item['nama']) ?></h5>
                        <p class="tps-address"><i class="fas fa-map-marker-alt"></i> <?= esc($item['alamat']) ?></p>
                        <?php if ($item['jam_buka'] && $item['jam_tutup']): ?>
                        <p class="tps-hours"><i class="fas fa-clock"></i> <?= $item['jam_buka'] ?> - <?= $item['jam_tutup'] ?></p>
                        <?php endif; ?>
                        <div class="tps-actions">
                            <a href="<?= base_url('/tps/detail/' . $item['id']) ?>" class="btn btn-outline btn-sm">
                                Detail
                            </a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $item['latitude'] ?>,<?= $item['longitude'] ?>" 
                               target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-directions"></i> Rute
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
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

.tps-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: var(--space-6);
    min-height: 600px;
}

.map-container {
    background: var(--white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow);
}

#map {
    width: 100%;
    height: 100%;
    min-height: 500px;
}

.tps-list {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    box-shadow: var(--shadow);
    max-height: 600px;
    overflow-y: auto;
}

.tps-list h4 {
    margin-bottom: var(--space-6);
    color: var(--gray-800);
}

.tps-cards {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.tps-card {
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    position: relative;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.tps-card:hover {
    background: var(--primary-50);
}

.tps-status {
    position: absolute;
    top: var(--space-3);
    right: var(--space-3);
    padding: var(--space-1) var(--space-2);
    border-radius: var(--radius-full);
    font-size: var(--font-size-xs);
    font-weight: 600;
}

.tps-status.aktif {
    background: #E8F5E9;
    color: var(--success);
}

.tps-status.penuh {
    background: #FFF3E0;
    color: var(--warning);
}

.tps-status.nonaktif {
    background: #FFEBEE;
    color: var(--danger);
}

.tps-card h5 {
    margin-bottom: var(--space-2);
    font-size: var(--font-size-base);
    padding-right: 60px;
}

.tps-address, .tps-hours {
    font-size: var(--font-size-sm);
    color: var(--gray-600);
    margin-bottom: var(--space-1);
}

.tps-address i, .tps-hours i {
    width: 16px;
    margin-right: var(--space-1);
    color: var(--gray-400);
}

.tps-actions {
    display: flex;
    gap: var(--space-2);
    margin-top: var(--space-3);
}

.empty-state-small {
    text-align: center;
    padding: var(--space-8);
    color: var(--gray-500);
}

.empty-state-small i {
    font-size: 2rem;
    margin-bottom: var(--space-2);
}

/* Leaflet Popup Styling */
.leaflet-popup-content-wrapper {
    border-radius: 12px;
}

.tps-popup {
    padding: 5px;
}

.tps-popup h4 {
    margin: 0 0 8px;
    color: #2E7D32;
}

.tps-popup p {
    margin: 0 0 5px;
    color: #666;
    font-size: 13px;
}

.tps-popup a {
    display: inline-block;
    margin-top: 8px;
    color: #2E7D32;
    font-weight: 500;
}

@media (max-width: 992px) {
    .tps-layout {
        grid-template-columns: 1fr;
    }
    
    .map-container {
        min-height: 400px;
    }
    
    .tps-list {
        max-height: none;
    }
}
</style>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tpsData = <?= $tps_json ?>;
    
    // Initialize map centered on Pekalongan
    const map = L.map('map').setView([-6.8897, 109.6746], 13);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Custom marker icons
    const greenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    
    const yellowIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    
    const redIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    
    // Store markers for reference
    const markers = {};
    
    // Add markers for each TPS
    tpsData.forEach(tps => {
        const icon = tps.status === 'aktif' ? greenIcon : 
                     tps.status === 'penuh' ? yellowIcon : redIcon;
        
        const marker = L.marker([parseFloat(tps.latitude), parseFloat(tps.longitude)], { icon: icon })
            .addTo(map);
        
        const popupContent = `
            <div class="tps-popup">
                <h4>${tps.nama}</h4>
                <p><i class="fas fa-map-marker-alt"></i> ${tps.alamat}</p>
                ${tps.jam_buka ? `<p><i class="fas fa-clock"></i> ${tps.jam_buka} - ${tps.jam_tutup}</p>` : ''}
                <a href="/tps/detail/${tps.id}">Lihat Detail →</a>
            </div>
        `;
        
        marker.bindPopup(popupContent);
        markers[tps.id] = marker;
    });
    
    // Click on TPS card to center map and open popup
    document.querySelectorAll('.tps-card').forEach(card => {
        card.addEventListener('click', (e) => {
            // Don't trigger if clicking on buttons
            if (e.target.closest('.tps-actions')) return;
            
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            map.setView([lat, lng], 16);
            
            // Find and open the marker popup
            const tpsId = card.querySelector('a[href*="detail"]')?.href.split('/').pop();
            if (tpsId && markers[tpsId]) {
                markers[tpsId].openPopup();
            }
        });
    });
    
    // Fit bounds to show all markers if there are any
    if (tpsData.length > 0) {
        const bounds = L.latLngBounds(tpsData.map(t => [parseFloat(t.latitude), parseFloat(t.longitude)]));
        map.fitBounds(bounds, { padding: [50, 50] });
    }
});
</script>
