<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Hasil
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="?page=index"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Tambah Hasil</li>
</ol>
</section>
<br>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
    </div><!-- /.box-header -->
    <div class="box-body">
    <form action="" class="form-horizontal" enctype="multipart/form-data" method="POST" id="desa_form">
        <?php
            $idAduan = $_GET['id'];

            // $tmp = $aduan->tampilR2("tb_hasil_aduan", "tb_aduan", "aduan_id", "tb_user", "user_id", "aduan_id", $id);
            $kode = $user->kode_laporan('hasil_id', 'tb_hasil_aduan', 'HSL');
        ?>

        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">ID Hasil</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $kode ?>" readonly class="form-control" required type="text" name="id"/>
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Pelapor</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required value="<?= $tmp['user_nama'] ?>"  class="form-control" type="text" name="nama"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Lokasi</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required  class="form-control" value="<?= $tmp['aduan_lokasi'] ?>" type="text" name="lokasi"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Keterangan</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required  class="form-control" value="<?= $tmp['aduan_keterangan'] ?>" type="text" name="lokasi"/>
            </div>
        </div> -->
        <div class="form-group">
        <label class="col-lg-3 col-lg-offset-1 control-label">Jenis Pelanggaran</label>
          <div class="col-lg-5">
              <select name="pel" required class="form-control">
                <option value="">-- Pilih Pelanggaran --</option>
                <?php
                  
                  $hasilK = $user->tampil("tb_pelanggaran");
                  foreach ($hasilK as $k) { ?>
                    <option style="width: 210px;" value="<?= $k['pelanggaran_id']?>"><?= $k['pelanggaran_nama'] ?></option>
                  <?php } ?>
                ?>
              </select>
          </div>
      </div>  
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Penanganan</label>
            <div class="col-lg-5">
                <textarea cols="60" rows="3" id="pen" required  class="form-control" name="pen"></textarea>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Hasil</label>
            <div class="col-lg-5">
            <textarea cols="60" rows="3" id="hasil" required  class="form-control" name="hasil"></textarea>
            </div>
        </div>
        <div class="form-group">
        <label class="col-lg-3 col-lg-offset-1 control-label">Hasil Foto</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="foto" required  class="form-control" type="file" name="foto"/>
            </div>
        </div>
        <input type="hidden" name="cek" value="sukses"> 
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="tambahD" value="Simpan">
            <a href="?page=aduan" class="btn btn-default">Kembali</a>
        </div>
    </form>
    <?php 
        if (isset($_POST['tambahD'])) {
            $id = $_POST['id'];

            $pel = $_POST['pel'];
            $pen = $koneksi->conn->real_escape_string($_POST['pen']);
            $hasil = $koneksi->conn->real_escape_string($_POST['hasil']);
            $foto = $_FILES['foto'];
            $cek = $_POST['cek'];
            
            $sql = $lapor->tambahL($id, $idAduan, $pel, $pen, $hasil, $foto);
            $sql1 = $lapor->cek($cek, $idAduan);
            if ($sql > 0) {
                echo "<script>alert('Laporan Berhasil');
                window.location='index.php?page=aduan'</script>";
            } else {
                echo "<script>alert('Laporan gagal');
                window.location='index.php?page=aduan'</script>";
            }
        }
    ?>

    </div>
  </div>
</section>