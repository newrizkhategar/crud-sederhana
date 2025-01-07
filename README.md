 
```markdown
# CRUD Sederhana ✨

Selamat datang di **CRUD Sederhana**! 🚀  
Proyek ini adalah aplikasi web simpel yang memungkinkan Anda melakukan operasi **Create**, **Read**, **Update**, dan **Delete** (CRUD) pada data siswa, dikemas dengan antarmuka yang modern menggunakan **Bootstrap 3**.

---

## 🌟 Fitur

- ✍️ **Tambah Data**: Tambahkan data siswa baru dengan mudah.  
- 👀 **Lihat Data**: Tampilkan daftar siswa secara rapi dan responsif.  
- ✏️ **Edit Data**: Perbarui informasi siswa kapan saja.  
- ❌ **Hapus Data**: Hapus data siswa yang tidak diperlukan.  

---

## 🛠️ Teknologi yang Digunakan

- **PHP** (Versi 5.6 atau lebih baru)  
- **MySQL** (Database Management System)  
- **Bootstrap 3** (Framework CSS untuk antarmuka pengguna)  

---

## ⚙️ Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di lokal Anda:  

1. **Kloning repositori ini**  
   ```bash
   git clone https://github.com/newrizkhategar/crud-sederhana.git
   ```

2. **Siapkan database**  
   - Buat database baru di phpmyadmin.  
   - Impor file `database.sql` yang terdapat di repositori ini ke dalam database tersebut.

3. **Konfigurasi koneksi database**  
   - Buka file `config/koneksi.php`.  
   - Sesuaikan parameter berikut sesuai konfigurasi Anda:  
     ```php
     $host = "localhost";
     $username = "root";
     $password = "";
     $database = "nama_database";
     ```

4. **Jalankan server lokal**  
   - Pastikan Anda menjalankan server lokal seperti **XAMPP**  
   - Akses web melalui browser di:  
     ```
     http://localhost/crud-sederhana/index.php
     ```

---

## 📂 Struktur Proyek

| Direktori/File        | Deskripsi                                              |
|-----------------------|-------------------------------------------------------|
| `assets/`             | Berisi file CSS dan JavaScript untuk antarmuka.       |
| `config/`             | Berisi file konfigurasi, termasuk koneksi database.   |
| `index.php`           | Halaman utama untuk menampilkan daftar siswa.         |
| `form-tambah.php`     | Halaman untuk menambah data siswa baru.               |
| `form-ubah.php`       | Halaman untuk mengubah data siswa.                    |
| `proses-simpan.php`   | Memproses penyimpanan data siswa baru.                |
| `proses-ubah.php`     | Memproses pembaruan data siswa.                       |
| `proses-hapus.php`    | Memproses penghapusan data siswa.                     |

---

💡 **Selamat berkarya dan semoga bermanfaat!**  
```
