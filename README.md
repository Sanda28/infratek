# Infratek - Sistem Pengajuan dan Manajemen Menara BTS

**Infratek** adalah sistem informasi berbasis Laravel yang digunakan untuk mengelola proses pengajuan, verifikasi, dan pemetaan menara telekomunikasi di Kabupaten Bogor. Sistem ini ditujukan untuk admin pemerintah dan pengguna dari pihak perusahaan.

## 🔧 Fitur Utama

### Untuk Admin
- Manajemen Data Menara (CRUD)
- Verifikasi Pengajuan (Setujui / Tolak)
- Peta Interaktif dengan Leaflet.js
- Statistik & Grafik Pengajuan
- Manajemen Pengguna

### Untuk Pengguna
- Pengajuan Menara Baru atau Eksisting
- Upload Dokumen Pendukung
- Riwayat Pengajuan & Status
- Visualisasi Lokasi Menara

## 📁 Struktur Folder Penting

infratek/
├── app/
├── database/
│ └── migrations/
├── resources/
│ └── views/
│ └── admin/
│ └── user/
├── routes/
│ └── web.php

bash
Copy
Edit

## 🌐 Tampilan Antarmuka (HTML Statis)

UI dari sistem ini juga dikembangkan dalam versi **statis** untuk kebutuhan demo atau pengembangan frontend secara terpisah:

🔗 **Live Demo UI (HTML Static)**  
👉 [https://sanda28.github.io/infratek-ui/](https://sanda28.github.io/infratek-ui/)

📦 Repository UI Statis:  
👉 [https://github.com/sanda28/infratek-ui](https://github.com/sanda28/infratek-ui)

## 🚀 Cara Instalasi (Local)

```bash
git clone https://github.com/sanda28/infratek.git
cd infratek
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
