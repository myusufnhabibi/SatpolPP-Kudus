<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Cek
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="?page=index"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Cek Aduan</li>
</ol>
</section>
<br>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
    </div><!-- /.box-header -->
    <div class="box-body">
    <form action="" class="form-horizontal" method="POST" id="cek_form">
        <div class="form-group">
        <label class="col-lg-3 col-lg-offset-1 control-label">Status Cek</label>
            <div class="col-lg-5">
                <select name="cek" class="form-control" id="cek">
                    <option value=""> -- Pilih -- </option>
                    <option value="tolak">Ditolak</option>
                    <option value="terima">Diterima</option>
                </select>
            </div>
        </div> 
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="tambahD" value="Simpan">
            <a href="?page=aduan" class="btn btn-default">Kembali</a>
        </div>
    </form>
    <?php 
        if (isset($_POST['tambahD'])) {
            $id = $_GET['id'];

            $cek = $_POST['cek'];
            
            $sql = $lapor->cek($cek, $id);
            if ($sql > 0) {
                echo "<script>
                window.location='index.php?page=aduan'</script>";
            } else {
                echo "<script>alert('Gagal');
                window.location='index.php?page=aduan'</script>";
            }
        }
    ?>

    </div>
  </div>
</section>