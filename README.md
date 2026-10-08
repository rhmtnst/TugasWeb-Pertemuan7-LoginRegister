# Tugas Rutin 7 — Sistem Login/Register PHP Native

## Identitas

- **Nama:** Rahmat Hamonangan Nasution
- **NIM:** 4253250053
- **Kelas:** PSIK 25B
- **Mata Kuliah:** Pemrograman Web
- **Pertemuan:** 7

## Deskripsi

Tugas Rutin 7 merupakan implementasi sistem Login/Register sederhana menggunakan PHP Native.

Project ini dibuat untuk menerapkan konsep server-side programming, form handling, validasi dan sanitasi input, session, password hashing, serta penyimpanan data menggunakan file JSON.

Sistem memiliki alur utama:

```text
Register
   ↓
Validasi Data
   ↓
Simpan Data ke JSON
   ↓
Login
   ↓
Session
   ↓
Dashboard
   ↓
Logout
```

## Teknologi

- PHP Native
- HTML5
- CSS3
- JavaScript
- JSON
- PHP Session
- Laragon / Apache
- Visual Studio Code

## Fitur Utama

### 1. Form Registrasi

Pengguna dapat membuat akun baru melalui halaman registrasi.

Data yang digunakan:

- Nama
- Email
- Password

Form menggunakan metode `POST` untuk mengirim data ke server.

### 2. Validasi Input

Sistem melakukan validasi terhadap data yang dimasukkan pengguna sebelum data disimpan.

Validasi dilakukan untuk memastikan:

- Nama tidak kosong
- Email tidak kosong
- Format email valid
- Password tidak kosong
- Data yang diperlukan telah diisi

### 3. Validasi Email dengan `filter_var()`

Format email diperiksa menggunakan fungsi bawaan PHP:

```php
filter_var($email, FILTER_VALIDATE_EMAIL)
```

Dengan validasi ini, sistem dapat memastikan email yang dimasukkan memiliki format yang benar.

### 4. Password Hashing

Password pengguna tidak disimpan dalam bentuk plaintext.

Sistem menggunakan:

```php
password_hash()
```

untuk menghasilkan password hash sebelum data disimpan.

Contoh:

```php
$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);
```

Dengan demikian, password asli pengguna tidak disimpan secara langsung di file JSON.

### 5. Penyimpanan Data Menggunakan JSON

Data pengguna disimpan menggunakan file JSON sebagai media penyimpanan.

Pendekatan ini digunakan sesuai dengan materi Tugas Rutin 7 sehingga project tidak menggunakan database MySQL.

Data pengguna disimpan dalam struktur JSON dan dapat dibaca kembali oleh PHP ketika proses login dilakukan.

### 6. Cek Duplikasi Email

Sebelum pengguna didaftarkan, sistem memeriksa apakah email tersebut sudah pernah digunakan.

Jika email sudah terdaftar, proses registrasi dihentikan dan sistem menampilkan pesan error.

Contoh pesan:

```text
Email sudah terdaftar.
```

### 7. Sistem Login

Pengguna yang telah memiliki akun dapat melakukan login menggunakan email dan password yang telah didaftarkan.

Pada proses login, sistem:

1. Membaca data pengguna dari JSON.
2. Mencari email yang sesuai.
3. Memeriksa password.
4. Membuat session apabila login berhasil.
5. Mengarahkan pengguna ke dashboard.

### 8. Password Verification

Password yang dimasukkan ketika login dibandingkan dengan password hash yang tersimpan menggunakan:

```php
password_verify()
```

Contoh:

```php
password_verify($password, $user['password'])
```

### 9. Session Management

Setelah login berhasil, sistem menggunakan PHP Session untuk menyimpan status login pengguna.

Contoh:

```php
session_start();
```

Session digunakan untuk mengetahui apakah pengguna sudah login atau belum.

### 10. Dashboard Terproteksi

Dashboard hanya dapat diakses oleh pengguna yang telah login.

Jika pengguna mencoba membuka dashboard tanpa session login, pengguna akan diarahkan kembali ke halaman login.

Konsep ini digunakan untuk menerapkan protected page.

Alurnya:

```text
Belum Login
     ↓
Akses Dashboard
     ↓
Redirect ke Login
```

Sedangkan:

```text
Sudah Login
     ↓
Akses Dashboard
     ↓
Dashboard dapat dibuka
```

### 11. Logout

Sistem menyediakan fitur logout untuk mengakhiri session pengguna.

Logout menggunakan:

```php
session_destroy();
```

Setelah logout, pengguna tidak lagi memiliki status login dan tidak dapat mengakses dashboard yang diproteksi.

### 12. Sanitasi Input

Data dari pengguna disanitasi sebelum ditampilkan kembali pada halaman.

Salah satu fungsi yang digunakan adalah:

```php
htmlspecialchars()
```

Contoh:

```php
htmlspecialchars($nama)
```

Sanitasi digunakan untuk mengurangi risiko output HTML yang tidak diinginkan.

### 13. Pesan Error dan Sukses

Sistem memberikan feedback kepada pengguna berdasarkan hasil proses.

Contohnya:

```text
Registrasi berhasil.
```

atau:

```text
Email sudah terdaftar.
```

atau:

```text
Email atau password salah.
```

Pesan tersebut membantu pengguna mengetahui apakah proses yang dilakukan berhasil atau mengalami kesalahan.

## Alur Registrasi

Proses registrasi pada aplikasi:

```text
User mengisi form
        ↓
Data dikirim menggunakan POST
        ↓
Validasi nama
        ↓
Validasi email
        ↓
Validasi password
        ↓
Cek duplikasi email
        ↓
Password di-hash
        ↓
Data disimpan ke JSON
        ↓
Pesan registrasi berhasil
```

## Alur Login

```text
User memasukkan email & password
              ↓
        Data divalidasi
              ↓
       Baca data JSON
              ↓
      Cari email pengguna
              ↓
     Verifikasi password
              ↓
        Login berhasil
              ↓
       Session dibuat
              ↓
         Dashboard
```

## Alur Logout

```text
User berada di Dashboard
          ↓
      Klik Logout
          ↓
   Session dihancurkan
          ↓
  Status login dihapus
          ↓
 Redirect ke halaman login
```

## Keamanan yang Diterapkan

Project menerapkan beberapa konsep dasar keamanan:

### Password Hashing

Password menggunakan:

```php
password_hash()
```

sehingga password tidak disimpan dalam bentuk plaintext.

### Password Verification

Ketika login, password diverifikasi menggunakan:

```php
password_verify()
```

### Input Validation

Input pengguna divalidasi sebelum diproses.

### Email Validation

Format email diperiksa menggunakan:

```php
filter_var()
```

### Input Sanitization

Output pengguna disanitasi menggunakan:

```php
htmlspecialchars()
```

### Session Authentication

Status login disimpan menggunakan PHP Session.

### Protected Dashboard

Halaman dashboard hanya dapat diakses ketika session login tersedia.


## Struktur Project

```text
TugasWeb-Pertemuan7-LoginRegister/
│
├── ...
│
├── index.php
├── login.php
├── register.php
├── logout.php
├── dashboard.php
├── users.json
├── style.css
└── README.md
```

> Struktur file di atas dapat disesuaikan dengan file yang terdapat pada repository project.

## Cara Menjalankan

### 1. Menyiapkan Laragon

Pastikan Apache sudah aktif pada Laragon.

### 2. Menempatkan Project

Letakkan project pada folder:

```text
C:\laragon\www\
```

Contoh:

```text
C:\laragon\www\TugasWeb-Pertemuan7-LoginRegister
```

### 3. Menjalankan Project

Buka browser dan akses:

```text
http://localhost/TugasWeb-Pertemuan7-LoginRegister
```

### 4. Melakukan Registrasi

Buka halaman Register kemudian masukkan:

- Nama
- Email
- Password

Jika data valid, akun akan disimpan ke file JSON.

### 5. Melakukan Login

Gunakan email dan password yang telah didaftarkan.

Jika login berhasil, sistem akan membuat session dan mengarahkan pengguna ke dashboard.

### 6. Melakukan Logout

Klik tombol Logout untuk mengakhiri session.

Setelah logout, dashboard tidak dapat diakses tanpa login kembali.

## Pengujian Fitur

Pengujian dilakukan terhadap fitur utama aplikasi:

| No | Fitur | Hasil yang Diharapkan |
|---:|---|---|
| 1 | Register | Pengguna berhasil membuat akun |
| 2 | Validasi nama | Nama wajib diisi |
| 3 | Validasi email | Email harus memiliki format valid |
| 4 | Validasi password | Password wajib diisi |
| 5 | Duplicate email | Email yang sudah digunakan ditolak |
| 6 | Password hashing | Password disimpan dalam bentuk hash |
| 7 | Login | User dapat masuk menggunakan akun yang valid |
| 8 | Login gagal | Pesan error ditampilkan |
| 9 | Session | Status login tersimpan |
| 10 | Dashboard | Hanya dapat diakses setelah login |
| 11 | Logout | Session dihancurkan |
| 12 | Protected page | User yang logout tidak dapat membuka dashboard |

## Konsep yang Dipelajari

Melalui Tugas Rutin 7, konsep yang dipelajari meliputi:

- Client-side dan server-side programming
- PHP Native
- HTTP request dan response
- PHP variables
- Control structure
- `$_POST`
- `$_SESSION`
- Form handling
- Input validation
- Input sanitization
- `filter_var()`
- `htmlspecialchars()`
- `password_hash()`
- `password_verify()`
- Session management
- JSON read/write
- Authentication
- Protected page
- Logout

## Kesimpulan

Tugas Rutin 7 berhasil mengimplementasikan sistem autentikasi sederhana menggunakan PHP Native dengan file JSON sebagai media penyimpanan.

Project menerapkan proses registrasi, validasi input, password hashing, pengecekan email duplikat, login menggunakan session, dashboard yang diproteksi, serta logout.

Implementasi ini menjadi dasar untuk memahami konsep authentication dan pengelolaan state pada aplikasi web sebelum menggunakan database dan framework pada tugas berikutnya.

## Repository

GitHub:

https://github.com/rhmtnst/TugasWeb-Pertemuan7-LoginRegister


