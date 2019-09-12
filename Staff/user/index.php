<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  User
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">User</li>
</ol>
</section>
<br>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
        <a href="#" id="tambah" data-toggle="modal" data-target="#userModal" class="btn btn-sm btn-theme04 btn-round"><i class="fa fa-plus-circle"></i> Tambah User </a>
        <a href="?page=user" class="btn btn-sm btn-theme04"><span class="glyphicon glyphicon-refresh"></span></a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="content-panel">
        <div class="adv-table">
          <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
            <thead>
              <tr>
                <th class="text-center">N0</th>
                <th>NAMA</th>
                <th>UERNAME</th>
                <th>LEVEL</th>
                <th>OPSI</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              $user2 = $user->tampil("tb_user");
              $kode = $user->kode_otomatis('user_id', 'tb_user', 'USR');

              foreach ($user2 as $u) : 
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $u['user_nama'] ?></td>
                <td><?= $u['user_username'] ?></td>
                <td>
                  <?php 
                    if ($u['user_level'] == "pet") {
                      echo "Petugas";
                    } else if ($u['user_level'] == "kep") {
                      echo "Kasat";
                    } else if ($u['user_level'] == "staf") {
                      echo "Staff";
                    } else if ($u['user_level'] == "masy") {
                      echo "Masyarakat";
                    }
                    ?>
                </td>
                <td>
                <?php if($u['user_level'] == "masy") { ?> 
                  <a href='#' title='Lihat data' class='btn btn-info tampil_modal' id='<?= $u['user_id']; ?>'><span class='fa fa-eye'></span></a>
                <?php } else {
                  ?>
                  <a href='#' title='ubah' class='btn btn-warning open_modal' id='<?= $u['user_id']; ?>'><span class='glyphicon glyphicon-pencil'></span></a>
                  <a href='?page=hapusUser&id=<?= $u['user_id']; ?>' title='hapus' class='btn btn-danger open_delete' onclick="return confirm('Yakin akan dihapus ?')"><span class='glyphicon glyphicon-trash'></span></a>
                <?php } ?>
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

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
        </div>
        <div class="modal-body">
            <form action="user/proses.php" class="form-horizontal" method="POST" id="user_form">
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">ID User</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" value="<?= $kode ?>"  class="form-control" required type="text" name="id" readonly/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Nama</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" id="nama" required  class="form-control" type="text" name="nama"/>
                    </div>
                </div> 
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Username</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" required id="username"  class="form-control" type="text" name="username"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Password</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" required id="pass" class="form-control" type="password" name="pass"/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Level</label>
                    <div class="col-lg-5">
                        <select name="level" id="level" required class="form-control">
                          <option value="pet">Petugas Satpol PP</option>
                          <option value="staf">Staff Satpol PP</option>
                          <option value="kep">Kepala Satpol PP</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
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

<div id="ModalTampil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script type="text/javascript">
  $(document).ready(function (){
      $(".open_modal").click(function (e){
          var m = $(this).attr("id");
          jQuery.noConflict();
          $.ajax({
              url: "user/modal_edit.php",
              type: "GET",
              data : {user_id: m,},
              success: function (ajaxData){
                  $("#ModalEdit").html(ajaxData);
                  $("#ModalEdit").modal('show',{backdrop: 'true'});
              }
          });
      });

      $(".tampil_modal").click(function (e){
          var m = $(this).attr("id");
          jQuery.noConflict();
          $.ajax({
              url: "user/modal_tampil.php",
              type: "GET",
              data : {user_id: m,},
              success: function (ajaxData){
                  $("#ModalTampil").html(ajaxData);
                  $("#ModalTampil").modal('show',{backdrop: 'true'});
              }
          });
      });
  });
</script>