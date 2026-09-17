# TugasWeb-Pertemuan7-LoginRegister

## Tugas Rutin 7 — Pemrograman Web

Aplikasi autentikasi sederhana berbasis **PHP Native** yang menerapkan konsep server-side programming, form handling, superglobals, session, password hashing, validasi input, dan penyimpanan data menggunakan JSON.

---

## 👨‍💻 Teknologi yang Digunakan

- PHP Native
- HTML5
- CSS3
- JavaScript
- JSON
- PHP Session
- `password_hash()`
- `password_verify()`
- `filter_var()`
- `htmlspecialchars()`
- Laragon
- Visual Studio Code

---

## ✨ Fitur

### 1. Register

Pengguna dapat membuat akun baru dengan memasukkan:

- Nama lengkap
- Email
- Password

Sistem melakukan validasi terhadap data yang dimasukkan.

### 2. Validasi Email

Format email diperiksa menggunakan:

```php
filter_var($email, FILTER_VALIDATE_EMAIL)

3. Password Hashing

Password tidak disimpan dalam bentuk teks biasa.

Password diproses menggunakan:
password_hash($password, PASSWORD_DEFAULT)

4. JSON Storage

Data pengguna disimpan ke dalam:

users.json

5. Duplicate Email Check

Sistem memeriksa apakah email sudah pernah digunakan sebelum akun baru dibuat.

6. Login

Pengguna dapat melakukan login menggunakan email dan password yang telah terdaftar.

Password diverifikasi menggunakan:

password_verify()

7. Session Protection

Setelah login berhasil, sistem membuat session pengguna.

Dashboard hanya dapat diakses oleh pengguna yang telah login.

8. Logout

Pengguna dapat logout menggunakan:

session_destroy()

Setelah logout, pengguna tidak dapat mengakses dashboard tanpa login kembali.

9. Input Sanitization

Output pengguna ditampilkan menggunakan:

htmlspecialchars()

untuk membantu mencegah output HTML yang tidak diinginkan.

10. Dark Mode

Website memiliki fitur Light Mode dan Dark Mode yang dapat diganti melalui tombol tema.