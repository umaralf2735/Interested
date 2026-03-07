# Antrian Online Layanan Publik 🎫

Aplikasi tiket antrian online yang sederhana, cantik, dan siap pakai.

## Cara Paling Gampang Menjalankan Aplikasi

Aplikasi ini sudah di set up agar gampang dijalankan, terutama kalau kamu pakai **Laragon**. Ikuti langkah ini:

1. **Nyalakan Laragon:** Buka aplikasi Laragon, lalu klik tombol **Start All** (Pastikan Apache dan MySQL berjalan).
2. **Setup Database:** Buka Terminal/PowerShell di folder project ini (`d:\Semester 6\Antigravity\antrian-online`).
3. **Jalankan Perintah Ini:**
   Ketik perintah berikut di terminal lalu tekan Enter:
   ```bash
   php artisan migrate:fresh --seed
   ```
   *(Perintah di atas otomatis membuat database, tabel, sekaligus mengisi data **Layanan** awal agar langsung bisa dipakai).*

4. **Jalankan Aplikasi:**
   Ketik perintah berikut untuk menyalakan server lokal:
   ```bash
   php artisan serve
   ```

5. **Buka di Browser:**
   - Halaman Utama (Publik mengambil tiket): [http://localhost:8000](http://localhost:8000)
   - Halaman Admin (Memanggil tiket): [http://localhost:8000/admin](http://localhost:8000/admin)

Sekarang kamu bisa mencoba mengambil antrian di halaman publik, dan memanggilnya di halaman admin! 🎉

## Fitur Utama ✨
- **Antarmuka Publik:** Pengguna dapat memilih layanan dan mengambil tiket antrian.
- **Tampilan Real-time:** Menampilkan nomor antrian yang sedang dipanggil otomatis tanpa reload layar, lengkap dengan suara bell.
- **Admin Dashboard:** Panel untuk memanggil nomor antrian berikutnya dari setiap loket.

## Teknologi yang Digunakan 🛠️
- **Backend:** Laravel 10
- **Frontend:** HTML5, Vanilla CSS, JS (Fetch API AJAX)
- **Database:** MySQL
