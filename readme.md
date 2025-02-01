# 🚀 CodeIgniter 3 - Panduan Instalasi dan Menjalankan Aplikasi

Dokumentasi ini berisi panduan lengkap untuk menginstal dan menjalankan aplikasi berbasis **CodeIgniter 3**, termasuk konfigurasi database dan troubleshooting.

---

## 📌 Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan server Anda memenuhi persyaratan berikut:

- ✅ **PHP** versi 7.2 atau lebih tinggi
- ✅ **Database** MySQL/MariaDB
- ✅ **Apache/Nginx** dengan `mod_rewrite` diaktifkan
- ✅ **Composer** (opsional, untuk mengelola dependensi tambahan)

---

## 1. Clone atau Unduh Project

### **a. Menggunakan Git**

```sh
git clone https://github.com/ilhamdika/fastprint.git
cd fastprint
```

Jika Anda mengunduh secara manual, ekstrak file ke direktori server Anda.

## 2. Konfigurasi CodeIgniter

### a. Konfigurasi Base URL

Buka file `application/config/config.php` dan ubah bagian berikut sesuai dengan URL aplikasi Anda:

```php
$config['base_url'] = 'http://localhost/fastprint/';
```

atau bisa disesuaikan dengan nama yang anda berikan

### b. Konfigurasi Database

Buka file `application/config/database.php` dan sesuaikan dengan kredensial database Anda:

```php
$db['default'] = array(
    'dsn'    => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'produk', //sesuaikan dengan nama db yang anda buat
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);
```

## 3. Import Database

Sebelum menjalankan aplikasi, Anda harus mengimpor database dari file `produk.sql`. Ikuti langkah-langkah berikut:

### a. Melalui phpMyAdmin

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Buat database baru dengan nama `produk`
3. Pilih database `produk`, lalu klik **Import**
4. Pilih file `produk.sql` dan klik **Go**

### b. Melalui Terminal (Command Line)

Jika menggunakan terminal, jalankan perintah berikut:

```sh
mysql -u root -p produk < produk.sql
```

Masukkan password MySQL Anda jika diminta.

## 4. Menjalankan Aplikasi

Jika menggunakan **XAMPP**, letakkan project di folder `htdocs/`, lalu akses melalui browser:

```
http://localhost/fastprint/
```

## 5. Troubleshooting

### a. Halaman 404 (Controller Not Found)

- Pastikan nama file controller diawali dengan huruf besar (misalnya: `Home.php` bukan `home.php`).
- Pastikan method dalam controller bersifat **public**.
- Pastikan URL yang diakses sesuai dengan routing yang ada di `application/config/routes.php`.

### b. Database Tidak Ditemukan

- Pastikan Anda sudah mengimpor file `produk.sql`.
- Pastikan konfigurasi database di `application/config/database.php` benar.
- Jika menggunakan MySQL di XAMPP, pastikan Apache dan MySQL sudah berjalan.

### c. Gagal Redirect atau Base URL Salah

- Pastikan `base_url` di `application/config/config.php` sudah sesuai dengan domain atau localhost.
- Jika tidak ingin menggunakan `index.php` di URL, buat file `.htaccess` di root project:
  ```apache
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^(.*)$ index.php/$1 [L]
  ```
- dan ini untuk setup agar tidak kena cors
  ```apache
  <IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    Header set Access-Control-Allow-Headers "Content-Type"
  </IfModule>
  ```
