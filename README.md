# PKM KAMONING

PKM Kamoning adalah aplikasi web berbasis Laravel untuk pengelolaan rekam medik di Puskesmas Kamoning Sampang. Aplikasi ini dirancang untuk memudahkan pengelolaan data pasien, rekam medis, obat, dan administrasi di puskesmas.

## Fitur Utama

- Manajemen data pasien dan rekam medik
- Pendaftaran pasien dan antrian
- Pengelolaan pemeriksaan medis
- Manajemen obat dan resep
- Pembayaran dan administrasi
- Laporan medis dan keuangan
- Manajemen pengguna dengan berbagai peran (Kepala Rekam Medik, Dokter, Petugas Loket, Kasir, Farmasi)

## Teknologi

Aplikasi ini dikembangkan menggunakan:
- Framework Laravel - untuk back-end dan struktur aplikasi
- Bootstrap - untuk tampilan responsif
- MySQL - untuk database
- DataTables - untuk tampilan tabel yang interaktif
- JavaScript dan jQuery - untuk interaksi di sisi klien

## Manfaat

- Mempercepat pelayanan pasien
- Meminimalisir kesalahan dalam pencatatan data
- Memudahkan penelusuran riwayat medis pasien
- Efisiensi pengelolaan obat dan persediaan
- Pelaporan yang terintegrasi dan akurat
- Keamanan data terjamin

## Persyaratan Sistem

- PHP >= 8.0
- Composer
- MySQL / MariaDB
- Web Server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Safari, Edge)

## Instalasi

1. Clone repositori
2. Jalankan `composer install`
3. Salin file `.env.example` menjadi `.env`
4. Konfigurasi database pada file `.env`
5. Jalankan `php artisan key:generate`
6. Jalankan `php artisan migrate --seed`
7. Jalankan `php artisan serve`

## Lisensi

Hak cipta © 2025 PKM Kamoning Sampang. Seluruh hak dilindungi.