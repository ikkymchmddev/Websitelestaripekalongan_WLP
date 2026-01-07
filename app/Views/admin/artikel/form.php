<div class="page-header-admin">
    <h1><i class="fas fa-newspaper"></i> <?= isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel' ?></h1>
    <a href="<?= base_url('/admin/artikel') ?>" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form action="<?= isset($artikel) ? base_url('/admin/artikel/update/' . $artikel['id']) : base_url('/admin/artikel/simpan') ?>" 
              method="POST" enctype="multipart/form-data" class="admin-form">
            
            <div class="form-group">
                <label class="form-label">Judul Artikel *</label>
                <input type="text" name="judul" class="form-control" required 
                       value="<?= old('judul', $artikel['judul'] ?? '') ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>" <?= old('kategori_id', $artikel['kategori_id'] ?? '') == $kat['id'] ? 'selected' : '' ?>>
                            <?= esc($kat['nama']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="draft" <?= old('status', $artikel['status'] ?? '') == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= old('status', $artikel['status'] ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Ringkasan</label>
                <textarea name="ringkasan" class="form-control" rows="2"><?= old('ringkasan', $artikel['ringkasan'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Konten *</label>
                <textarea name="konten" class="form-control" rows="10" required><?= old('konten', $artikel['konten'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <?php if (isset($artikel['gambar']) && $artikel['gambar']): ?>
                    <div class="mb-4">
                        <img src="<?= base_url('uploads/artikel/' . $artikel['gambar']) ?>" width="200" style="border-radius:8px;">
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
