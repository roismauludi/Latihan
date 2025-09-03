# Sistem Informasi Mahasiswa

Sistem CRUD sederhana untuk mengelola data mahasiswa dengan fitur export ke Excel dan PDF.

## 🚀 Fitur

- ✅ CRUD Data Mahasiswa (Create, Read, Update, Delete)
- ✅ Export ke Excel (.xlsx)
- ✅ Export ke PDF (.pdf)
- ✅ Validasi input
- ✅ UI/UX yang menarik dengan Bootstrap
- ✅ Responsive design

## 📋 Prerequisites

Sebelum menjalankan aplikasi, pastikan:

1. **XAMPP** sudah terinstall dan berjalan
2. **Apache** dan **MySQL** service aktif
3. **PHP** versi 7.4 atau lebih tinggi
4. **Composer** untuk mengelola dependencies

## 🛠️ Installation

### 1. Clone/Download Project
```bash
# Letakkan project di folder htdocs XAMPP
C:\xampp\htdocs\Belajar\
```

### 2. Install Dependencies
```bash
# Masuk ke folder project
cd C:\xampp\htdocs\Belajar

# Install dependencies
composer install
```

### 3. Setup Database

#### Opsi A: Import SQL File
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Buat database baru dengan nama `mahasiswa`
3. Import file `database_setup.sql`

#### Opsi B: Manual Setup
```sql
-- Buat database
CREATE DATABASE mahasiswa;

-- Gunakan database
USE mahasiswa;

-- Buat tabel user
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    kelas VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 4. Test Koneksi
```bash
# Buka browser dan akses
http://localhost/Belajar/test_connection.php
```

## 🎯 Cara Penggunaan

### 1. Akses Aplikasi
```
http://localhost/Belajar/view/user_crud.php
```

### 2. Tambah Data Mahasiswa
- Isi form dengan data lengkap
- Pilih jurusan dan program studi
- Klik "Simpan Data"

### 3. Export Data
- Klik tombol "Export Data"
- Pilih format export (Excel atau PDF)
- File akan otomatis terdownload

## 📁 Struktur File

```
Belajar/
├── config/
│   └── config.php          # Konfigurasi database
├── models/
│   └── User.php            # Model untuk operasi database
├── view/
│   ├── user_crud.php       # Halaman utama CRUD
│   ├── export.php          # Halaman export dengan preview
│   ├── export_excel.php    # Export ke Excel
│   └── export_pdf.php      # Export ke PDF
├── vendor/                  # Dependencies Composer
├── composer.json           # Dependencies list
├── database_setup.sql      # Setup database
├── test_connection.php     # Test koneksi database
└── README.md               # Dokumentasi ini
```

## 🔧 Troubleshooting

### Error: "Connection refused"
- Pastikan MySQL service berjalan di XAMPP
- Cek port MySQL (default: 3306)

### Error: "Database not found"
- Buat database `mahasiswa` di phpMyAdmin
- Import file `database_setup.sql`

### Error: "Table not found"
- Jalankan query CREATE TABLE dari `database_setup.sql`
- Atau import file SQL lengkap

### Error: "PhpSpreadsheet not found"
```bash
# Install dependencies
composer install

# Atau install manual
composer require phpoffice/phpspreadsheet
```

## 📱 Screenshots

### Halaman Utama CRUD
- Form input/edit data mahasiswa
- Tabel data dengan aksi edit/hapus
- Tombol export data

### Halaman Export
- Preview data yang akan di-export
- Opsi export Excel dan PDF
- Statistik data

## 🎨 Customization

### Mengubah Konfigurasi Database
Edit file `config/config.php`:
```php
private $host = "localhost";
private $username = "root";
private $password = "";
private $database = "mahasiswa";
```

### Menambah Field Baru
1. Update struktur tabel database
2. Update model `User.php`
3. Update form di `user_crud.php`
4. Update export files

## 📞 Support

Jika mengalami masalah:
1. Cek error log di XAMPP
2. Test koneksi dengan `test_connection.php`
3. Pastikan semua dependencies terinstall
4. Cek versi PHP dan MySQL

## 📄 License

Project ini dibuat untuk pembelajaran. Silakan digunakan dan dimodifikasi sesuai kebutuhan.
