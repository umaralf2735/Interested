# Antrian Online Layanan Publik 🎫

Aplikasi tiket antrian online yang sederhana, cantik, dan siap pakai. Dibangun menggunakan **Laravel 10** sebagai Backend dan **Vanilla HTML/CSS/JS** untuk interaktivitas real-time di Frontend.

![Screenshots/Demo](https://via.placeholder.com/800x400?text=Antrian+Online) <!-- Ganti dengan screenshot aslimu -->

## Fitur Utama ✨
- **Antarmuka Publik:** Pengguna dapat memilih layanan dan mengambil tiket antrian dengan feedback visual yang instan dan menarik.
- **Tampilan Real-time:** Menampilkan nomor antrian yang sedang dipanggil langsung di layar utama dengan animasi dan suara notifikasi (*bell*).
- **Admin Dashboard:** Panel admin sederhana untuk memanggil nomor antrian berikutnya dari setiap loket/layanan. Statistik antrian yang menunggu diperbarui secara dinamis.
- **Vanilla CSS:** Desain modern (gradients, bayangan yang mulus, kartu yang interaktif) tanpa ketergantungan framework CSS seperti Bootstrap atau Tailwind.
- **Full API-driven:** Proses pengambilan dan pemanggilan antrian dilakukan tanpa me-reload halaman (*AJAX/Fetch API*).

## Teknologi yang Digunakan 🛠️
- **Backend:** Laravel 10, PHP 8.1+, MySQL (Laragon)
- **Frontend:** HTML5, CSS3, JavaScript (Fetch API)
- **Database:** MySQL relational DB

## Prasyarat
- PHP >= 8.1
- Composer
- MySQL Desktop Environment (misal: Laragon, XAMPP, dsb)

## Instalasi & Cara Menjalankan Aplikasi 🚀

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal.

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/umaralf2735/Interested.git
   ```

2. **Instal dependensi Composer:**
   ```bash
   composer install
   ```

3. **Salin file konfirgurasi environment:**
   ```bash
   cp .env.example .env
   ```
   **Kalo di CMD:**
   ```bash
   copy .env.example .env
   ```
   **Kalo di PowerShell:**
   ```bash
   Copy-Item .env.example .env
   ```


4. **Konfigurasi Database:**
   Buka file `.env` di text editor dan sesuaikan kredensial databasemu (secara default sudah diconfigure untuk Laragon localhost):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=antrian_online
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Buat Database "antrian_online" di MySQL:**
   Pastikan Laragon/XAMPP kamu sudah berjalan. Kamu dapat membuat database dengan GUI (HeidiSQL/phpMyAdmin) atau menjalankan perintah:
   ```bash
   mysql -u root -e "CREATE DATABASE IF NOT EXISTS antrian_online;"
   ```

6. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

7. **Migrasi Tabel & Buat Data Dummy:**
   Jalankan file migrasi untuk membuat tabel `services` dan `queue_tickets`:
   ```bash
   php artisan migrate
   ```
   **Penting:** Tambahkan data Layanan (Services) ke database tabel `services` agar bisa muncul di halaman web!
   Contoh Insert Manual SQL:
   ```sql
   INSERT INTO services (name, code, description, created_at, updated_at) VALUES 
   ('Pendaftaran', 'A', 'Loket Pendaftaran Ulang', NOW(), NOW()),
   ('Pembayaran', 'B', 'Loket Pembayaran / Kasir', NOW(), NOW()),
   ('Customer Service', 'C', 'Layanan Pengaduan & Informasi', NOW(), NOW());
   ```

8. **Jalankan Development Server:**
   ```bash
   php artisan serve
   ```
   Aplikasi publik bisa diakses di: `http://localhost:8000`
   Admin Dashboard bisa diakses di: `http://localhost:8000/admin`

## Penggunaan (Manual Testing) 🧪
1. Buka `http://localhost:8000` di satu tab browser (sebagai User/Display Utama).
2. Buka `http://localhost:8000/admin` di tab browser lain (sebagai Admin).
3. Sebagai User: Klik **"Ambil Tiket"** pada layanan yang diinginkan.
4. Sebagai Admin: Kamu akan melihat jumlah *Menunggu* bertambah secara otomatis pada dashboard admin.
5. Sebagai Admin: Klik **"Panggil Antrian Berikutnya"**.
6. Kembali ke User (Display Utama): Layar "Antrian Berjalan" otomatis mem-pulsa dan menampilkan nomor kamu dibarengi suara *bell* (Ting-Tong~).

## License
MIT License. Silakan kustomisasi dan kembangkan untuk kebutuhan publik.
