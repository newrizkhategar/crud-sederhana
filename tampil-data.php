<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

 <?php 
include 'config/database.php'; // Pastikan koneksi menggunakan MySQLi

if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
} else {
    $cari = "";
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h4>
                <i class="glyphicon glyphicon-user"></i> Data Siswa
                
                <div class="pull-right btn-tambah">
                    <form class="form-inline" method="POST" action="index.php">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-search"></i>
                                </div>
                                <input type="text" class="form-control" name="cari" placeholder="Cari ..." autocomplete="off" value="<?php echo $cari; ?>">
                            </div>
                        </div>
                        <a class="btn btn-primary" href="?page=tambah">
                            <i class="glyphicon glyphicon-plus"></i> Tambah
                        </a>
                    </form>
                </div>
                
            </h4>
        </div>

        <?php  
        if (empty($_GET['alert'])) {
            echo "";
        } elseif ($_GET['alert'] == 1) {
            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong><i class='glyphicon glyphicon-alert'></i> Gagal!</strong> Terjadi kesalahan.
                  </div>";
        } elseif ($_GET['alert'] == 2) {
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data siswa berhasil disimpan.
                  </div>";
        } elseif ($_GET['alert'] == 3) {
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data siswa berhasil diubah.
                  </div>";
        } elseif ($_GET['alert'] == 4) {
            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data siswa berhasil dihapus.
                  </div>";
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data Siswa</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>   

                        <tbody>
                        <?php
                        // Pagination setup
                        $batas = 5;

                        if (!empty($cari)) {
                            $sql_count = "SELECT COUNT(*) AS total FROM is_siswa 
                                          WHERE nis LIKE '%$cari%' OR nama LIKE '%$cari%'";
                        } else {
                            $sql_count = "SELECT COUNT(*) AS total FROM is_siswa";
                        }

                        $result_count = $conn->query($sql_count);
                        $data_count = $result_count->fetch_assoc();
                        $jumlah = $data_count['total'];

                        $halaman = ceil($jumlah / $batas);
                        $page = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
                        $mulai = ($page - 1) * $batas;

                        $no = $mulai + 1;

                        if (!empty($cari)) {
                            $sql = "SELECT * FROM is_siswa 
                                    WHERE nis LIKE '%$cari%' OR nama LIKE '%$cari%' 
                                    ORDER BY nis DESC LIMIT $mulai, $batas";
                        } else {
                            $sql = "SELECT * FROM is_siswa 
                                    ORDER BY nis DESC LIMIT $mulai, $batas";
                        }

                        $result = $conn->query($sql);

                        while ($data = $result->fetch_assoc()) {
                            $tanggal = $data['tanggal_lahir'];
                            $tgl = explode('-', $tanggal);
                            $tanggal_lahir = $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];

                            echo "<tr>
                                    <td width='50' class='center'>$no</td>
                                    <td width='60'>{$data['nis']}</td>
                                    <td width='150'>{$data['nama']}</td>
                                    <td width='180'>{$data['tempat_lahir']}, $tanggal_lahir</td>
                                    <td width='120'>{$data['jenis_kelamin']}</td>
                                    <td width='120'>{$data['agama']}</td>
                                    <td width='250'>{$data['alamat']}</td>
                                    <td width='80'>{$data['no_telepon']}</td>
                                    <td width='100'>
                                        <div class=''>
                                            <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?page=ubah&id={$data['nis']}'>
                                                <i class='glyphicon glyphicon-edit'></i>
                                            </a>
                                            <a data-toggle='tooltip' data-placement='top' title='Hapus' class='btn btn-danger btn-sm' href='proses-hapus.php?id={$data['nis']}' onclick=\"return confirm('Anda yakin ingin menghapus siswa {$data['nama']}?');\">
                                                <i class='glyphicon glyphicon-trash'></i>
                                            </a>
                                        </div>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                        ?>
                        </tbody>           
                    </table>
                    <nav>
                        <ul class="pagination pull-right">
                            <!-- Button untuk halaman sebelumnya -->
                            <?php if ($page > 1): ?>
                                <li><a href="?hal=<?= $page - 1 ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <?php else: ?>
                                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <?php endif; ?>

                            <!-- Link halaman -->
                            <?php for ($x = 1; $x <= $halaman; $x++): ?>
                                <li><a href="?hal=<?= $x ?>"><?= $x ?></a></li>
                            <?php endfor; ?>

                            <!-- Button untuk halaman berikutnya -->
                            <?php if ($page < $halaman): ?>
                                <li><a href="?hal=<?= $page + 1 ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                            <?php else: ?>
                                <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
