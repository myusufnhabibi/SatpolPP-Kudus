<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Desa
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Desa</li>
</ol>
</section>
<br>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
        <a href="?page=tDesa" id="tambah" class="btn btn-sm btn-theme04 btn-round"><i class="fa fa-plus-circle"></i> Tambah Desa </a>
        <a href="?page=desa" class="btn btn-sm btn-theme04"><span class="glyphicon glyphicon-refresh"></span></a>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="content-panel">
        <div class="adv-table">
          <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
            <thead>
              <tr>
                <th class="text-center">N0</th>
                <th>DESA</th>
                <th>KECAMATAN</th>
                <th>OPSI</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              $hasil = $relasi->tampilR("tb_desa", "tb_kecamatan", "kecamatan_id");
              foreach ($hasil as $u) : 
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $u['desa_nama'] ?></td>
                <td><?= $u['kecamatan_nama'] ?></td>
                <td>
                  <a href='?page=uDesa&id=<?= $u['desa_id']; ?>' title='ubah' class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span></a>
                  <a href='?page=hDesa&id=<?= $u['desa_id']; ?>' title='hapus' class='btn btn-danger' onclick="return confirm('Yakin akan dihapus ?')"><span class='glyphicon glyphicon-trash'></span></a>
                  <!-- <a href='?page=lihat' title='lihat' class='btn btn-info'><span class='fa fa-map-marker'></span></a> -->
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