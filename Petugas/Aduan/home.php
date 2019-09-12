<section class="content-header">
<h1>
  Aduan
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="?page=index"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Aduan</li>
</ol>
</section>
<br>
<section class="content">
<div class="box box-default">
  <div class="box-header">
      <a href="?page=kec" class="btn btn-sm btn-theme04"><span class="glyphicon glyphicon-refresh"></span></a>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="content-panel">
      <div class="adv-table">
        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
          <thead>
            <tr>
              <th class="text-center">N0</th>
              <th>NAMA PELAPOR</th>
              <th>LOKASI</th>
              <th>KETERANGAN</th>
              <th>TANGGAL</th>
              <th>STATUS CEK</th>
              <th>OPSI</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $no = 1;
            $tmp = $aduan->tampilR("tb_aduan", "tb_user", "user_id");
            
            foreach ($tmp as $u) : 
          ?>
            <tr>
              <td class="text-center"><?= $no++; ?></td>
              <td><?= $u['user_nama'] ?></td>
              <td><?= $u['aduan_lokasi'] ?></td>
              <td><?= $u['aduan_keterangan'] ?></td>
              <td><?= $user->tanggal_indo($u['aduan_tgl']) ?></td>
              <td id="status">
                <?php 
                  $cek = $u['aduan_cek'];
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
              <td>
                <?php 
                   if (($cek == "") || ($cek == "null" )) { ?>
                    <a href="?page=cek&id=<?= $u['aduan_id'] ?>" class="btn btn-xs btn-warning">Cek</a>
                  <?php } else if ($cek == "terima" ) { ?>
                    <a href="?page=lapor&id=<?= $u['aduan_id'] ?>" id="lapor" class="btn btn-xs btn-primary">Lapor</a>
                  <?php } else if ($cek == "sukses" ) { ?>

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
<script>
$(document).ready(function) {
  $('#lapor').on('click', function() {
    $(this).hide();
  })
}
</script>
