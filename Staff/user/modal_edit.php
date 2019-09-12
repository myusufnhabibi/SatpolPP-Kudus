<?php 

require_once "../../config/class.php";
$koneksi = new Database();
$user = new User($koneksi);
$id = $_GET['user_id'];
$tampil2 = $user->tampil("tb_user", "user_id", $id)[0];

?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
        </div>
        <div class="modal-body">
            <form action="user/proses.php" class="form-horizontal" method="POST" id="user_form">
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">ID User</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" value="<?= $tampil2['user_id'] ?>"  class="form-control" required type="text" name="id" readonly/>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Nama</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" id="nama" value="<?= $tampil2['user_nama'] ?>"  required  class="form-control" type="text" name="nama"/>
                    </div>
                </div> 
                <div class="form-group">
                  <label class="col-lg-3 col-lg-offset-1 control-label">Username</label>
                    <div class="col-lg-5">
                        <input style="width: 210px;" value="<?= $tampil2['user_username'] ?>"  required id="username"  class="form-control" type="text" name="username"/>
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
                          <?php if($tampil2['user_level'] == 'pet') {
                            echo "<option value='pet' selected>Petugas Satpol PP</option>";
                          } else if($tampil2['user_level'] == 'staf') {
                            echo "<option value='staf' selected>Staff Satpol PP</option>";
                          } else {
                            echo "<option value='kep' selected>Kepala Satpol PP</option>";
                          }
                          ?>
                        </select>
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