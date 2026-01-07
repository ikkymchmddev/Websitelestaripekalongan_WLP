<div class="page-header-admin">
    <h1><i class="fas fa-box"></i> <?= isset($produk) ? 'Edit Produk' : 'Tambah Produk' ?></h1>
    <a href="<?= base_url('/admin/produk') ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form action="<?= isset($produk) ? base_url('/admin/produk/update/' . $produk['id']) : base_url('/admin/produk/simpan') ?>" 
              method="POST" enctype="multipart/form-data" class="admin-form">
            
            <div class="form-group">
                <label class="form-label">Nama Produk *</label>
                <input type="text" name="nama" class="form-control" required 
                       value="<?= old('nama', $produk['nama'] ?? '') ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>" <?= old('kategori_id', $produk['kategori_id'] ?? '') == $kat['id'] ? 'selected' : '' ?>>
                            <?= esc($kat['nama']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif" <?= old('status', $produk['status'] ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= old('status', $produk['status'] ?? '') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga *</label>
                    <input type="number" name="harga" class="form-control" required 
                           value="<?= old('harga', $produk['harga'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Stok *</label>
                    <input type="number" name="stok" class="form-control" required 
                           value="<?= old('stok', $produk['stok'] ?? 0) ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Berat (gram)</label>
                <input type="number" name="berat" class="form-control" 
                       value="<?= old('berat', $produk['berat'] ?? 0) ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5"><?= old('deskripsi', $produk['deskripsi'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <?php if (isset($produk['gambar']) && $produk['gambar']): ?>
                    <div class="mb-4">
                        <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" width="200" style="border-radius:8px;">
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
