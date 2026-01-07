<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Admin User
        $this->db->table('users')->insert([
            'nama' => 'Admin Lestari',
            'email' => 'admin@lestaripekalongan.id',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'telepon' => '081234567890',
            'alamat' => 'Pekalongan, Jawa Tengah',
            'role' => 'admin',
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Seed Kategori Artikel
        $kategoriArtikel = [
            ['nama' => 'Pengelolaan Sampah', 'slug' => 'pengelolaan-sampah', 'deskripsi' => 'Artikel tentang cara mengelola sampah'],
            ['nama' => 'Daur Ulang', 'slug' => 'daur-ulang', 'deskripsi' => 'Panduan daur ulang sampah'],
            ['nama' => 'Lingkungan Hidup', 'slug' => 'lingkungan-hidup', 'deskripsi' => 'Artikel tentang lingkungan hidup'],
            ['nama' => 'Tips & Trik', 'slug' => 'tips-trik', 'deskripsi' => 'Tips dan trik ramah lingkungan'],
        ];

        foreach ($kategoriArtikel as $kat) {
            $kat['created_at'] = date('Y-m-d H:i:s');
            $kat['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('kategori_artikel')->insert($kat);
        }

        // Seed Kategori Produk
        $kategoriProduk = [
            ['nama' => 'Tas & Dompet', 'slug' => 'tas-dompet', 'deskripsi' => 'Tas dan dompet dari bahan daur ulang'],
            ['nama' => 'Aksesoris', 'slug' => 'aksesoris', 'deskripsi' => 'Aksesoris unik dari sampah daur ulang'],
            ['nama' => 'Dekorasi Rumah', 'slug' => 'dekorasi-rumah', 'deskripsi' => 'Dekorasi rumah dari bahan daur ulang'],
            ['nama' => 'Kerajinan Tangan', 'slug' => 'kerajinan-tangan', 'deskripsi' => 'Berbagai kerajinan tangan unik'],
        ];

        foreach ($kategoriProduk as $kat) {
            $kat['created_at'] = date('Y-m-d H:i:s');
            $kat['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('kategori_produk')->insert($kat);
        }

        // Seed Artikel
        $artikel = [
            [
                'kategori_id' => 1,
                'user_id' => 1,
                'judul' => 'Panduan Lengkap Memilah Sampah di Rumah',
                'slug' => 'panduan-lengkap-memilah-sampah-di-rumah',
                'ringkasan' => 'Pelajari cara memilah sampah dengan benar untuk membantu menjaga lingkungan.',
                'konten' => '<p>Memilah sampah adalah langkah awal yang sangat penting dalam pengelolaan sampah yang baik. Dengan memilah sampah, kita membantu mempermudah proses daur ulang dan mengurangi jumlah sampah yang berakhir di tempat pembuangan akhir.</p><h3>Jenis-jenis Sampah</h3><p>1. <strong>Sampah Organik</strong> - Sisa makanan, daun, dan bahan yang mudah terurai.</p><p>2. <strong>Sampah Anorganik</strong> - Plastik, kertas, logam, kaca.</p><p>3. <strong>Sampah B3</strong> - Baterai, lampu, obat kadaluarsa.</p><h3>Tips Memilah Sampah</h3><ul><li>Sediakan minimal 3 tempat sampah berbeda</li><li>Beri label yang jelas pada setiap tempat sampah</li><li>Biasakan memilah sejak di dapur</li><li>Libatkan seluruh anggota keluarga</li></ul>',
                'status' => 'published',
                'views' => 125,
            ],
            [
                'kategori_id' => 2,
                'user_id' => 1,
                'judul' => 'Cara Membuat Kompos dari Sampah Dapur',
                'slug' => 'cara-membuat-kompos-dari-sampah-dapur',
                'ringkasan' => 'Tutorial lengkap membuat kompos organik dari sisa makanan di rumah.',
                'konten' => '<p>Kompos adalah pupuk alami yang sangat bermanfaat untuk tanaman. Anda bisa membuatnya sendiri dari sampah dapur!</p><h3>Bahan yang Diperlukan</h3><ul><li>Sisa sayuran dan buah</li><li>Daun kering</li><li>Tanah</li><li>Wadah atau lubang kompos</li></ul><h3>Langkah Pembuatan</h3><p>1. Siapkan wadah dengan lubang drainase</p><p>2. Masukkan lapisan daun kering di dasar</p><p>3. Tambahkan sampah dapur secara berkala</p><p>4. Tutup dengan tanah atau daun kering</p><p>5. Aduk setiap minggu</p><p>6. Tunggu 2-3 bulan hingga menjadi kompos</p>',
                'status' => 'published',
                'views' => 89,
            ],
            [
                'kategori_id' => 3,
                'user_id' => 1,
                'judul' => 'Dampak Sampah Plastik terhadap Lingkungan',
                'slug' => 'dampak-sampah-plastik-terhadap-lingkungan',
                'ringkasan' => 'Memahami bahaya sampah plastik dan cara mengurangi penggunaannya.',
                'konten' => '<p>Sampah plastik menjadi salah satu masalah lingkungan terbesar saat ini. Plastik membutuhkan ratusan tahun untuk terurai dan mencemari tanah serta lautan.</p><h3>Dampak Negatif</h3><ul><li>Mencemari lautan dan membahayakan biota laut</li><li>Mikroplastik masuk ke rantai makanan</li><li>Merusak ekosistem tanah</li><li>Meningkatkan emisi gas rumah kaca</li></ul><h3>Solusi</h3><p>Kita bisa mulai dari hal sederhana seperti membawa tas belanja sendiri, menggunakan botol minum reusable, dan menghindari produk sekali pakai.</p>',
                'status' => 'published',
                'views' => 156,
            ],
        ];

        foreach ($artikel as $art) {
            $art['created_at'] = date('Y-m-d H:i:s');
            $art['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('artikel')->insert($art);
        }

        // Seed Produk
        $produk = [
            [
                'kategori_id' => 1,
                'nama' => 'Tas Tote Premium dari Kain Perca',
                'slug' => 'tas-tote-premium-kain-perca',
                'deskripsi' => 'Tas tote cantik dan kuat yang dibuat dari kain perca sisa konveksi. Cocok untuk belanja atau kegiatan sehari-hari.',
                'harga' => 85000,
                'stok' => 20,
                'berat' => 250,
                'status' => 'aktif',
                'terjual' => 15,
            ],
            [
                'kategori_id' => 1,
                'nama' => 'Dompet Lipat dari Bungkus Kopi',
                'slug' => 'dompet-lipat-bungkus-kopi',
                'deskripsi' => 'Dompet unik yang terbuat dari anyaman bungkus kopi. Tahan lama dan anti air.',
                'harga' => 45000,
                'stok' => 35,
                'berat' => 100,
                'status' => 'aktif',
                'terjual' => 28,
            ],
            [
                'kategori_id' => 2,
                'nama' => 'Kalung Cantik dari Botol Plastik',
                'slug' => 'kalung-botol-plastik',
                'deskripsi' => 'Kalung cantik dengan liontin dari potongan botol plastik yang diubah menjadi bunga.',
                'harga' => 35000,
                'stok' => 50,
                'berat' => 50,
                'status' => 'aktif',
                'terjual' => 42,
            ],
            [
                'kategori_id' => 3,
                'nama' => 'Vas Bunga dari Botol Kaca',
                'slug' => 'vas-bunga-botol-kaca',
                'deskripsi' => 'Vas bunga artistik yang dibuat dari botol kaca bekas dengan cat dekoratif.',
                'harga' => 65000,
                'stok' => 15,
                'berat' => 400,
                'status' => 'aktif',
                'terjual' => 12,
            ],
            [
                'kategori_id' => 4,
                'nama' => 'Keranjang Anyaman dari Koran Bekas',
                'slug' => 'keranjang-anyaman-koran',
                'deskripsi' => 'Keranjang serbaguna yang dibuat dari anyaman koran bekas. Kuat dan estetik.',
                'harga' => 55000,
                'stok' => 25,
                'berat' => 200,
                'status' => 'aktif',
                'terjual' => 19,
            ],
            [
                'kategori_id' => 2,
                'nama' => 'Gelang Eco-Friendly dari Tutup Botol',
                'slug' => 'gelang-tutup-botol',
                'deskripsi' => 'Gelang trendy yang terbuat dari tutup botol plastik daur ulang.',
                'harga' => 25000,
                'stok' => 60,
                'berat' => 30,
                'status' => 'aktif',
                'terjual' => 55,
            ],
        ];

        foreach ($produk as $prod) {
            $prod['created_at'] = date('Y-m-d H:i:s');
            $prod['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('produk')->insert($prod);
        }

        // Seed TPS
        $tps = [
            [
                'nama' => 'TPS Kauman',
                'alamat' => 'Jl. Kauman No. 15, Pekalongan Timur',
                'latitude' => '-6.8892',
                'longitude' => '109.6753',
                'telepon' => '0285412345',
                'jam_buka' => '07:00',
                'jam_tutup' => '17:00',
                'hari_operasional' => 'Senin - Sabtu',
                'jenis_sampah' => 'Plastik, Kertas, Logam, Organik',
                'kapasitas' => 1000,
                'terisi' => 450,
                'status' => 'aktif',
            ],
            [
                'nama' => 'TPS Bendan',
                'alamat' => 'Jl. Bendan Raya No. 25, Pekalongan Barat',
                'latitude' => '-6.8845',
                'longitude' => '109.6612',
                'telepon' => '0285423456',
                'jam_buka' => '06:00',
                'jam_tutup' => '16:00',
                'hari_operasional' => 'Senin - Minggu',
                'jenis_sampah' => 'Plastik, Kertas, Kaca, Elektronik',
                'kapasitas' => 800,
                'terisi' => 620,
                'status' => 'aktif',
            ],
            [
                'nama' => 'TPS Tirto',
                'alamat' => 'Jl. Tirto No. 8, Pekalongan Selatan',
                'latitude' => '-6.9012',
                'longitude' => '109.6821',
                'telepon' => '0285434567',
                'jam_buka' => '08:00',
                'jam_tutup' => '18:00',
                'hari_operasional' => 'Senin - Jumat',
                'jenis_sampah' => 'Semua Jenis Sampah',
                'kapasitas' => 1200,
                'terisi' => 350,
                'status' => 'aktif',
            ],
            [
                'nama' => 'TPS Medono',
                'alamat' => 'Jl. Medono Indah No. 32, Pekalongan Utara',
                'latitude' => '-6.8756',
                'longitude' => '109.6598',
                'telepon' => '0285445678',
                'jam_buka' => '07:30',
                'jam_tutup' => '16:30',
                'hari_operasional' => 'Senin - Sabtu',
                'jenis_sampah' => 'Plastik, Kertas, Organik',
                'kapasitas' => 600,
                'terisi' => 580,
                'status' => 'penuh',
            ],
        ];

        foreach ($tps as $t) {
            $t['created_at'] = date('Y-m-d H:i:s');
            $t['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('tps')->insert($t);
        }

        // Create ci_sessions table
        $this->db->query("
            CREATE TABLE IF NOT EXISTS ci_sessions (
                id VARCHAR(128) NOT NULL,
                ip_address VARCHAR(45) NOT NULL,
                timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                data BLOB NOT NULL,
                PRIMARY KEY (id),
                KEY ci_sessions_timestamp (timestamp)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");

        echo "Database seeded successfully!\n";
    }
}
