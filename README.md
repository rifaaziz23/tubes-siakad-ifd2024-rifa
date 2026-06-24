# SIAKAD — Sistem Informasi Akademik

**Link Hosting : https://github.com/rifaaziz23/tubes-siakad-ifd2024-rifa**

SIAKAD (Sistem Informasi Akademik) adalah platform web berbasis Laravel yang dirancang untuk mendigitalisasi dan menyederhanakan manajemen administrasi akademik di perguruan tinggi. Aplikasi ini memfasilitasi interaksi yang efisien dan real-time antara mahasiswa, dosen, dan administrator (admin) dalam mengelola katalog mata kuliah, penjadwalan kelas, serta pengisian Kartu Rencana Studi (KRS).

Seluruh antarmuka aplikasi ini dibangun menggunakan **Tailwind CSS murni** secara utility-first untuk menyajikan tampilan yang responsif, modern, minimalis, dan berkinerja tinggi.

---

## Fitur Utama Berdasarkan Hak Akses (Role)

Aplikasi ini mengelompokkan otorisasi dan fungsionalitas halaman ke dalam tiga kategori utama:

### 1. Sistem Autentikasi (Umum)

- **Halaman Login (`/login`)**: Gerbang masuk terpadu bagi Admin, Dosen, dan Mahasiswa. Dilengkapi dengan validasi pesan kesalahan (error handling) berbahasa Indonesia langsung di bawah input field, serta opsi interaktif untuk menampilkan/menyembunyikan kata sandi (password toggle).

### 2. Panel Admin & Dosen Pembimbing

Dosen Pembimbing dan Administrator berbagi panel kontrol dengan hak akses penuh guna mengelola jalannya kegiatan akademik:

- **Dashboard Utama (`/admin/dashboard`)**: Menyajikan ringkasan metrik global (Jumlah Dosen, Mahasiswa, Mata Kuliah, Jadwal Kuliah, dan Total Pengambilan KRS) serta log visual berisi 5 transaksi KRS mahasiswa paling akhir.
- **Manajemen Dosen (`/admin/dosen`)**: Daftar direktori dosen yang memuat informasi nama dan Nomor Induk Dosen Nasional (NIDN). Mendukung fitur pencarian dan operasi CRUD lengkap (Create, Read, Update, Delete) beserta pengelolaan kredensial akun dosen.
- **Manajemen Mahasiswa (`/admin/mahasiswa`)**: Daftar mahasiswa aktif beserta NPM dan Dosen Pembimbing Akademik masing-masing. Menyediakan kontrol CRUD lengkap serta tombol akses cepat untuk memeriksa KRS mahasiswa bersangkutan.
- **Katalog Mata Kuliah (`/admin/matakuliah`)**: Mengelola modul pengajaran kampus, mencakup Kode Mata Kuliah, Nama, dan bobot Satuan Kredit Semester (SKS).
- **Penjadwalan Kelas (`/admin/jadwal`)**: Halaman pengelolaan waktu kuliah. Admin dapat menjadwalkan kelas dengan menentukan relasi Mata Kuliah, Dosen Pengajar, Hari, Kelas (A/B/C), serta **rentang waktu pelaksanaan (Jam Mulai hingga Jam Selesai)**.
- **Rekap KRS Mahasiswa (`/admin/krs`)**: Pusat monitoring pengisian KRS mahasiswa secara global. Admin/Dosen dapat memfilter daftar berdasarkan nama/NPM mahasiswa tertentu untuk melihat kartu rekapitulasi SKS, serta mengekspor berkas KRS ke format PDF resmi.

### 3. Panel Mahasiswa

Area mandiri bagi mahasiswa untuk merencanakan studi akademik mereka:

- **Dashboard Mahasiswa (`/mahasiswa/dashboard`)**: Menyajikan greeting personal, ringkasan profil akademik (Nama, NPM, Dosen Pembimbing), serta statistik jumlah SKS terkumpul di semester aktif berjalan.
- **Jadwal Kuliah (`/mahasiswa/jadwal`)**: Akses cepat (_read-only_) untuk melihat jadwal perkuliahan yang ditawarkan oleh kampus lengkap dengan informasi kelas, hari, dan rentang waktu (Jam Mulai - Selesai).
- **Pengisian KRS Mandiri (`/mahasiswa/krs`)**: Ruang kerja bagi mahasiswa untuk merancang semester aktif. Fitur yang didukung antara lain:
    - Melihat daftar mata kuliah yang telah disetujui dalam KRS beserta akumulasi SKS.
    - Memilih dan mendaftarkan diri pada mata kuliah baru (_Ambil MK_).
    - Membatalkan/menghapus mata kuliah yang telah terdaftar (_Drop MK_).
    - Mengunduh / mengekspor dokumen resmi Kartu Rencana Studi (KRS) ke file PDF dengan layout profesional yang menyediakan kolom tanda tangan sejajar antara Mahasiswa dan Dosen Pembimbing Akademik.

---

## Dokumentasi Visual

Tangkapan layar antarmuka dari setiap halaman aplikasi disimpan secara terstruktur pada direktori:

```
/screenshots
```

_(Catatan: Anda dapat menaruh gambar hasil demonstrasi fitur atau UI web di dalam folder tersebut secara mandiri.)_
