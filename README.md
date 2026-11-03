# 🌿 Lestari Pekalongan - Proyek Terpadu

[![Website](https://img.shields.io/badge/Website-Live%20Demo-brightgreen?style=for-the-badge&logo=google-chrome)](https://websitelestaripekalongan.freehosting.dev/)
[![Framework](https://img.shields.io/badge/Framework-CodeIgniter%204-orange?style=for-the-badge&logo=codeigniter)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-%5E7.4%20%7C%7C%20%5E8.0-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-MySQL-00758F?style=for-the-badge&logo=mysql)](https://www.mysql.com/)

> 🌐 **Kunjungi Website Publik (Live Demo):**  
> 👉 **[https://websitelestaripekalongan.freehosting.dev/](https://websitelestaripekalongan.freehosting.dev/)**

---

## 📖 Tentang Proyek

**Lestari Pekalongan** adalah platform digital terpadu yang dirancang untuk mendorong kesadaran dan partisipasi aktif masyarakat Pekalongan dalam menjaga kelestarian lingkungan. Platform ini mengintegrasikan **edukasi pengelolaan sampah**, informasi sebaran **Tempat Penampungan Sementara (TPS)**, serta **e-commerce kerajinan daur ulang** untuk mendukung ekonomi sirkular lokal.

---

## ✨ Fitur Utama

- 📚 **Edukasi Lingkungan & 3R**: Artikel informatif dan edukatif mengenai pemilahan sampah, daur ulang kreatif, dan tips menjaga kelestarian lingkungan.
- 🛍️ **Marketplace Kerajinan Daur Ulang**: Katalog produk hasil daur ulang limbah yang ramah lingkungan dengan informasi detail dan harga.
- 🛒 **Sistem E-Commerce Terpadu**: Fitur keranjang belanja (*cart*), proses *checkout*, dan pelacakan status pesanan.
- 📍 **Informasi & Lokasi TPS**: Direktori titik lokasi Tempat Penampungan Sementara (TPS) di wilayah Pekalongan untuk memudahkan pembuangan sampah yang bertanggung jawab.
- 👤 **Manajemen Akun & Autentikasi**: Registrasi dan login pengguna dengan sistem proteksi sesi yang aman.
- ⚙️ **Dashboard Administrator**: Pengelolaan produk, kategori, data edukasi, daftar TPS, dan pemantauan transaksi pesanan.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: [CodeIgniter 4](https://codeigniter.com/) (PHP)
- **Frontend**: HTML5, CSS3, JavaScript
- **Icons & Typography**: [Font Awesome](https://fontawesome.com/), Google Fonts (Poppins & Inter)
- **Database**: MySQL / MariaDB
- **Web Server**: Apache / XAMPP / Cloud Hosting

---

## 💻 Panduan Instalasi Lokal (Local Development)

Bagi pengembang yang ingin menjalankan proyek ini di lingkungan lokal:

### 1. Prasyarat Sistem
- PHP >= 7.4 atau PHP 8.x
- Composer terinstall
- Web Server (Apache/Nginx) & MySQL (misal: XAMPP)

### 2. Langkah Instalasi

1. **Clone repositori:**
   ```bash
   git clone https://github.com/maometanoikky/ProyekTerpadu_Websitesampah.git
   cd ProyekTerpadu_Websitesampah
   ```

2. **Install dependensi Composer:**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment (`.env`):**
   Salin file `env` menjadi `.env`:
   ```bash
   cp env .env
   ```
   Buka file `.env` dan sesuaikan pengaturan basis data serta URL dasar:
   ```ini
   CI_ENVIRONMENT = development

   app.baseURL = 'http://localhost:8080/'

   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```

4. **Jalankan Aplikasi:**
   ```bash
   php spark serve
   ```
   Buka browser dan akses `http://localhost:8080`.

---

## 👥 Tim Pengembang

Proyek ini dikembangkan oleh:

| Nama | NIM |
| :--- | :--- |
| **Rizqi Muchamad Anafis Tontowi** | `102220049` |
| **Umar Syarief** | `102220019` |
| **Ricky Dwi Febriyant** | `102220036` |

---

## 📄 Lisensi

Proyek ini dikembangkan sebagai bagian dari **Proyek Terpadu** dan didistribusikan di bawah lisensi [MIT](LICENSE).
