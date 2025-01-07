<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "database";

// Membuat koneksi
$conn = new mysqli($server, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi MySQL Gagal: " . $conn->connect_error);
}
?>
