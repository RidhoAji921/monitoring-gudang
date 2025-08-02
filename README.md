# 📦 Monitoring Gudang

Pantau dan kelola stok barang dengan mudah, cepat, dan akurat dalam satu platform. Dirancang untuk membantu Anda mencatat setiap pergerakan barang secara real-time, mengurangi risiko kesalahan, dan meningkatkan efisiensi operasional gudang secara menyeluruh.

---

## 🛠️ Dependensi
- PHP >= 8.4
- Composer
- Node.js & npm
- Database (default: MySQL, bisa diganti ke database lain dengan mengatur .env)

---

## ⚙️ Setup Project

### 1. Clone repository
```bash
git clone https://github.com/RidhoAji921/monitoring-gudang.git
cd monitoring-gudang
```
### 2. Install dependency
```bash
composer install
npm install
```
### 3. Salin dan konfigurasi file environment
```bash
cp .env.example .env
```
### 4. Atur konfigurasi database di file .env atau atur database sesuai .env yang sudah disediakan
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=monitoring_gudang
DB_USERNAME=root
DB_PASSWORD=
```
### 5. Generate key dan migrasi database
```bash
php artisan key:generate
php artisan migrate
```
### 6. Build asset frontend (Vite)
```bash
npm run build
```
### 7. Jalankan aplikasi
```bash
php artisan serve
```
### 8. Akses aplikasi lewat URL yang muncul di terminal

---

## 🚀 Fitur

- Autentikasi user (login/logout)
- Ubah kata sandi
- Manajemen produk (nama, kode produk, UOM, kuantitas, dll)
- Transaksi keluar/masuk barang
- Perhitungan stok otomatis
- Validasi stok tidak boleh minus
- Pencarian produk
- Sortir tabel transaksi
- Halaman detail & edit produk
- Grafik transaksi (dengan Chart.js)
- Autogenerate kode produk (increment format: `0001`)
- Tampilan modern dengan Tailwind + Flowbite
