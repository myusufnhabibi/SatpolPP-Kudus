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
            <h4 class="modal-title" id="myModalLabel">Data User</h4>
        </div>
        <div class="modal-body">
            <table class="table">
              <tr>
                <td><b>Nama</b></td>
                <td><h5><?= $tampil2['user_nama']?></h5></td>
              </tr>
              <tr>
                <td><b>Tempat, Tanggal Lahir</b></td>
                <td><h5><?= $tampil2['user_tmp_lahir'].", ".$tampil2['user_tgl_lahir']?></h5></td>
              </tr>
              <tr>
                <td><b>Jenis Kelamin</b></td>
                <td>
                  <h5>
                    <?php 
                      $status = $tampil2['user_jk'];
                      if ($status == "lk") {
                        echo "Laki-laki";
                      } else {
                        echo "Perempuan";
                      }
                    ?>
                    </h5>
                </td>
              </tr>
              <tr>
                <td><b>Telepon</b></td>
                <td><h5><?= $tampil2['user_telp']?></h5></td>
              </tr>
              <tr>
                <td><b>Alamat</b></td>
                <td><h5><?= $tampil2['user_alamat']?></h5></td>
              </tr>
              <tr>
                <td><b>Username</b></td>
                <td><h5><?= $tampil2['user_username']?></h5></td>
              </tr>
                <td><b>Level</b></td>
                <td>
                  <h5>
                    <?php if($tampil2['user_level'] == 'masy') {
                      echo "Masyarakat";
                    }
                    ?>
                  </h5>
                </td>
              </tr>
              <tr>
                <td><b>Foto</b></td>
                <td>
                  <h5></h5>
                  <img width="90px" src="../Masyarakat/img/user/<?= $tampil2['user_foto']?>" alt="">
                </td>
              </tr>
            </table>
        </div>
    </div>
</div>