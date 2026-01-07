<div class="page-header-admin">
    <h1><i class="fas fa-map-marker-alt"></i> <?= isset($tps) ? 'Edit TPS' : 'Tambah TPS' ?></h1>
    <a href="<?= base_url('/admin/tps') ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form action="<?= isset($tps) ? base_url('/admin/tps/update/' . $tps['id']) : base_url('/admin/tps/simpan') ?>" 
              method="POST" enctype="multipart/form-data" class="admin-form">
            
            <div class="form-group">
                <label class="form-label">Nama TPS *</label>
                <input type="text" name="nama" class="form-control" required 
                       value="<?= old('nama', $tps['nama'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap *</label>
                <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat', $tps['alamat'] ?? '') ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Latitude *</label>
                    <input type="text" name="latitude" class="form-control" required 
                           value="<?= old('latitude', $tps['latitude'] ?? '') ?>" placeholder="-6.8897">
                </div>
                <div class="form-group">
                    <label class="form-label">Longitude *</label>
                    <input type="text" name="longitude" class="form-control" required 
                           value="<?= old('longitude', $tps['longitude'] ?? '') ?>" placeholder="109.6746">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jam Buka</label>
                    <input type="time" name="jam_buka" class="form-control" 
                           value="<?= old('jam_buka', $tps['jam_buka'] ?? '08:00') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Tutup</label>
                    <input type="time" name="jam_tutup" class="form-control" 
                           value="<?= old('jam_tutup', $tps['jam_tutup'] ?? '17:00') ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Hari Operasional</label>
                <input type="text" name="hari_operasional" class="form-control" 
                       value="<?= old('hari_operasional', $tps['hari_operasional'] ?? 'Senin - Sabtu') ?>" 
                       placeholder="Senin - Sabtu">
            </div>

            <div class="form-group">
                <label class="form-label">No. Telepon</label>
                <input type="tel" name="telepon" class="form-control" 
                       value="<?= old('telepon', $tps['telepon'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Sampah yang Diterima</label>
                <input type="text" name="jenis_sampah" class="form-control" 
                       value="<?= old('jenis_sampah', $tps['jenis_sampah'] ?? '') ?>" 
                       placeholder="Plastik, Kertas, Logam, Organik">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kapasitas (kg)</label>
                    <input type="number" name="kapasitas" class="form-control" 
                           value="<?= old('kapasitas', $tps['kapasitas'] ?? 1000) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Terisi (kg)</label>
                    <input type="number" name="terisi" class="form-control" 
                           value="<?= old('terisi', $tps['terisi'] ?? 0) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="aktif" <?= old('status', $tps['status'] ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="penuh" <?= old('status', $tps['status'] ?? '') == 'penuh' ? 'selected' : '' ?>>Penuh</option>
                    <option value="nonaktif" <?= old('status', $tps['status'] ?? '') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <?php if (isset($tps['gambar']) && $tps['gambar']): ?>
                    <div class="mb-4">
                        <img src="<?= base_url('uploads/tps/' . $tps['gambar']) ?>" width="200" style="border-radius:8px;">
                    </div>
                <?php endif; ?>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</div>
