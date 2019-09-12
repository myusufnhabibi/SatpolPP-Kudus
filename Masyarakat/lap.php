<div class="row">
    <div class="col-md-12">
      <div class="panel panel-info panel-dashboard">
        <div class="panel-heading centered">
          <h2 class="panel-title"><strong> - Laporan - </strong></h2>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-admin">
            <thead>
              <tr>
                <th class="text-center">N0</th>
                <th>LOKASI</th>
                <th>KETERANGAN</th>
                <th>FOTO</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              $tmp = $user->tampil("tb_aduan");
              
              foreach ($tmp as $u) : 
            ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $u['aduan_lokasi'] ?></td>
                <td><?= $u['aduan_keterangan'] ?></td>
                <td><img width="100px" src="img/aduan/<?= $u['aduan_foto'] ?>" alt=""></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>