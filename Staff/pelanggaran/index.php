<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Pelanggaran
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Data Pelanggaran</li>
</ol>
</section>
<br>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
        <a href="#" id="tambah" data-toggle="modal" data-target="#pelModal" class="btn btn-sm btn-theme04 btn-round"><i class="fa fa-plus-circle"></i> Tambah Data Pelanggaran </a>
        <a href="?page=pel" class="btn btn-sm btn-theme04"><span class="glyphicon glyphicon-refresh"></span></a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="content-panel">
        <div class="adv-table">
          <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
            <thead>
              <tr>
                <th class="text-center">N0</th>
                <th>NAMA PELANGGARAN</th>
                <th>OPSI</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              $user2 = $user->tampil("tb_pelanggaran");
              $kode = $user->kode_otomatis('pelanggaran_id', 'tb_pelanggaran', 'PEL');

              foreach ($user2 as $u) : 
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $u['pelanggaran_nama'] ?></td>
                <td>
                  <a href='#' title='ubah' class='btn btn-warning open_modal' id='<?= $u['pelanggaran_id']; ?>'><span class='glyphicon glyphicon-pencil'></span></a>
                  <a href='?page=hapusPelanggaran&id=<?= $u['pelanggaran_id']; ?>' title='hapus' class='btn btn-danger open_delete' onclick="return confirm('Yakin akan dihapus ?')"><span class='glyphicon glyphicon-trash'></span></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
     </div>
    </div>
  </div>
</section>

<div class="modal fade" id="pelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah Data Pelanggaran</h4>
        </div>
        <div class="modal-body">
            <form action="pelanggaran/proses.php" class="form-horizontal" method="POST" id="pelanggaran_form">
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">ID Pelanggaran</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" value="<?= $kode ?>"  class="form-control" required type="text" name="id" readonly/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Nama Pelanggaran</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" id="nama" required  class="form-control" type="text" name="nama"/>
                    </div>
                </div> 
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script type="text/javascript">
  $(document).ready(function (){
      $(".open_modal").click(function (e){
          var m = $(this).attr("id");
          jQuery.noConflict();
          $.ajax({
              url: "pelanggaran/modal_edit.php",
              type: "GET",
              data : {pelanggaran_id: m,},
              success: function (ajaxData){
                  $("#ModalEdit").html(ajaxData);
                  $("#ModalEdit").modal('show',{backdrop: 'true'});
              }
          });
      });
  });
</script>