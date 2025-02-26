<!-- CRUD Sederhana
 ************************************************
 * Developer    : New Rizkha Tegar
 * E-mail       : newrizkhategar@gmail.com
 -->

 <div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <h4>
        <i class="glyphicon glyphicon-edit"></i> 
        Ubah data siswa
      </h4>
    </div> <!-- /.page-header -->
    <?php
    // Panggil koneksi database
    require_once "config/database.php";

    if (isset($_GET['id'])) {
        $nis = $conn->real_escape_string($_GET['id']); // Gunakan MySQLi untuk sanitasi input

        // Query untuk mendapatkan data siswa
        $sql  = "SELECT * FROM is_siswa WHERE nis = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $nis);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            // Konversi format tanggal
            $tanggal        = $data['tanggal_lahir'];
            $tgl            = explode('-', $tanggal);
            $tanggal_lahir  = $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];

            $stmt->close();
        } else {
            echo "Gagal mempersiapkan statement.";
        }
    }
    ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="proses-ubah.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">NIS</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="nis" value="<?php echo $data['nis']; ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Siswa</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $data['nama']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Tempat Lahir</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="tempat_lahir" autocomplete="off" value="<?php echo $data['tempat_lahir']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_lahir" autocomplete="off" value="<?php echo $tanggal_lahir; ?>" required>
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-4">
              <?php if ($data['jenis_kelamin'] == 'Laki-laki') { ?>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki" checked> Laki-laki
                </label>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                </label>
              <?php } else { ?>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                </label>
                <label class="radio-inline">
                  <input type="radio" name="jenis_kelamin" value="Perempuan" checked> Perempuan
                </label>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Agama</label>
            <div class="col-sm-3">
              <select class="form-control" name="agama" required>
                <option value="<?php echo $data['agama']; ?>"><?php echo $data['agama']; ?></option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-3">
              <textarea class="form-control" name="alamat" rows="3" required><?php echo $data['alamat']; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">No. Telepon</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="no_telepon" autocomplete="off" maxlength="12" value="<?php echo $data['no_telepon']; ?>" required>
            </div>
          </div>

          <hr/>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
              <a href="index.php" class="btn btn-default btn-reset">Batal</a>
            </div>
          </div>
        </form>
      </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->
  </div> <!-- /.col -->
</div> <!-- /.row -->
