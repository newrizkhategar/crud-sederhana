<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

 <?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_POST['simpan'])) {
    // Gunakan real_escape_string untuk mengamankan input
    $nis           = $conn->real_escape_string(trim($_POST['nis']));
    $nama          = $conn->real_escape_string(trim($_POST['nama']));
    $tempat_lahir  = $conn->real_escape_string(trim($_POST['tempat_lahir']));

    $tanggal       = $_POST['tanggal_lahir'];
    $tgl           = explode('-', $tanggal);
    $tanggal_lahir = $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];

    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $agama         = $conn->real_escape_string($_POST['agama']);
    $alamat        = $conn->real_escape_string(trim($_POST['alamat']));
    $no_telepon    = $conn->real_escape_string($_POST['no_telepon']);

    // Perintah query untuk menyimpan data ke tabel is_siswa
    $query = "INSERT INTO is_siswa (
                nis, 
                nama, 
                tempat_lahir, 
                tanggal_lahir, 
                jenis_kelamin, 
                agama, 
                alamat, 
                no_telepon
              ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind parameter ke statement
        $stmt->bind_param(
            "ssssssss",
            $nis,
            $nama,
            $tempat_lahir,
            $tanggal_lahir,
            $jenis_kelamin,
            $agama,
            $alamat,
            $no_telepon
        );

        // Eksekusi query
        if ($stmt->execute()) {
            // Jika berhasil, arahkan ke halaman utama dengan alert sukses
            header('location: index.php?alert=2');
        } else {
            // Jika gagal, arahkan ke halaman utama dengan alert error
            header('location: index.php?alert=1');
        }

        $stmt->close();
    } else {
        echo "Gagal mempersiapkan query: " . $conn->error;
    }
}
?>
