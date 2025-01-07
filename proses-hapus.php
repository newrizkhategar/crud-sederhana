<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

<?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_GET['id'])) {
    // Ambil dan sanitasi nilai ID
    $nis = intval($_GET['id']);

    // Perintah query untuk menghapus data pada tabel is_siswa
    $query = "DELETE FROM is_siswa WHERE nis = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind parameter dan eksekusi statement
        $stmt->bind_param("i", $nis);
        $execute = $stmt->execute();

        // Cek hasil eksekusi
        if ($execute) {
            // Jika berhasil, tampilkan pesan berhasil delete data
            header('location: index.php?alert=4');
        } else {
            // Jika gagal, tampilkan pesan kesalahan
            header('location: index.php?alert=1');
        }

        // Tutup statement
        $stmt->close();
    } else {
        // Jika gagal mempersiapkan statement
        header('location: index.php?alert=1');
    }

    // Tutup koneksi
    $conn->close();
}
?>
