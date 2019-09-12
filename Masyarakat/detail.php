<?php
  include_once "../config/class.php";
    session_start();
    $id = $_SESSION['user_id'];
    $koneksi = new Database();
    $masy = new CRUD($koneksi);
?>

<div class="table-responsive">
<table class="table table-bordered table-striped table-admin">
  <thead>
    <tr>
      <th width="7%">No.</th>
      <th width="16%">Tanggal</th>
      <th width="10%">Lokasi</th>
      <th width="30%">Keterangan</th>
      <th width="20%">Foto</th>
      <th width="14%">Status</th>
      <th width="13%">Hasil</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;

      $tampil = $masy->tampil("tb_aduan", "user_id", $id);
        foreach ($tampil as $a) : ?>

    <tr>
      <td><?= $no++; ?></td>
      <td>
        <?= $masy->tanggal_indo($a['aduan_tgl']) ?>
      </td>
      <td><?= $a['aduan_lokasi'] ?></td>
      <td><?= $a['aduan_keterangan'] ?></td>
      <td>
        <img width="90px" src="img/aduan/<?= $a['aduan_foto'] ?>" alt="">
      </td>
      <td>
        <?php 
          $status = $a['aduan_status'];
          if ($status == "0") {
            echo "<span class='label label-info'>Dalam Proses</span>";
          } else {
              echo "<span class='label label-success'>Ditindaklanjuti</span>";
          }
        ?>
      </td>
      <td>
        <?php 
          $cek = $a['aduan_cek'];
          if (($cek == "") || ($cek == "null" )) {
            echo "<span class='label label-info' id='belum'>Belum Dicek</span>";
          } elseif ($cek == "tolak") { 
            echo "<span class='label label-danger' id='tolak'>Ditolak</span>";
          } else if ($cek == "terima"){
            echo "<span class='label label-warning' id='terima'>Diterima</span>";
          } else {
            echo "<span class='label label-success' id='terima'>Sukses</span>";
          }
        ?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>

