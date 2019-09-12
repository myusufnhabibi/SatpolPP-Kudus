<?php 

require_once "../../config/class.php";
$koneksi = new Database();
$pelanggaran = new User($koneksi);
$id = $_GET['pelanggaran_id'];
$tampil2 = $pelanggaran->tampil("tb_pelanggaran", "pelanggaran_id", $id)[0];

?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Edit Pelanggaran</h4>
        </div>
        <div class="modal-body">
            <form action="pelanggaran/proses.php" class="form-horizontal" method="POST">
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">ID Pelanggaran</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" value="<?= $tampil2['pelanggaran_id'] ?>"  class="form-control" required type="text" name="id" readonly/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Nama</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" id="nama" value="<?= $tampil2['pelanggaran_nama'] ?>"  required  class="form-control" type="text" name="nama"/>
                    </div>
                </div> 
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="ubah" value="Ubah">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>