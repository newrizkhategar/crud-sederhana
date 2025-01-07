<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

 <?php
// Panggil koneksi database
require_once "config/database.php";

if (isset($_POST['simpan'])) {
    if (isset($_POST['nis'])) {
        // Gunakan fungsi MySQLi untuk sanitasi data
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

        // Perintah query untuk mengubah data pada tabel is_siswa
        $query = "UPDATE is_siswa 
                  SET nama = ?, 
                      tempat_lahir = ?, 
                      tanggal_lahir = ?, 
                      jenis_kelamin = ?, 
                      agama = ?, 
                      alamat = ?, 
                      no_telepon = ? 
                  WHERE nis = ?";

        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sssssssi", $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $no_telepon, $nis);
            $result = $stmt->execute();

            // Cek hasil eksekusi query
            if ($result) {
                // Jika berhasil, tampilkan pesan berhasil update data
                header('location: index.php?alert=3');
            } else {
                // Jika gagal, tampilkan pesan kesalahan
                header('location: index.php?alert=1');
            }
            $stmt->close();
        } else {
            echo "Gagal mempersiapkan statement.";
        }
    }
}
?>
