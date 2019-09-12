<section class="content-header">
<h1>
  Laporan
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="?page=index"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Laporan</li>
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
              <th>PENANGANAN</th>
              <th>FOTO</th>
              <th>OPSI</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $no = 1;
            $tmp = $aduan->tampilR2("tb_hasil_aduan", "tb_aduan", "aduan_id", "tb_user", "user_id");
            
            foreach ($tmp as $u) : 
          ?>
            <tr>
              <td class="text-center"><?= $no++; ?></td>
              <td><?= $u['user_nama'] ?></td>
              <td><?= $u['aduan_lokasi'] ?></td>
              <td><?= $u['aduan_keterangan'] ?></td>
              <td><?= $u['hasil_penanganan'] ?></td>
              <td><img width="100px" src="../petugas/hasil/<?= $u['hasil_foto'] ?>" alt=""></td>
              <td>
                <a href='?page=detail&id=<?= $u['hasil_id']; ?>' title='ubah' class='btn btn-info'>detail</a>
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
  
  <!-- /row -->