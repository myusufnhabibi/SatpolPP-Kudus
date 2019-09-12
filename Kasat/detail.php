<style>
    hr { 
    display: block;
    margin-top: 0.1em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: double;
    border-width: 2px;
} 
</style>
<section class="content-header">
    <h1>
    Detail Laporan 
    <small>Satpol PP</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="?page=index"><i class="fa fa-home"></i> Satpol PP</a></li>
    <li class="active"> Detail</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <div class="row">
              <div class="col-md-2">
                <img src="../img/satpolpp/logo.png" style="padding-top:12px" width="100px" alt="">
              </div>
              <div class="col-md-10 col-md-pull-1">
                <center>
                    <h3>PEMERINTAH KABUPATEN KUDUS</h3>
                    <h4>SATUAN POLISI PAMONG PRAJA</h4>
                    <p>Jl. Sosrokartono No.39, Barongan, Bae, Kabupaten Kudus, Jawa Tengah 59326</p>
                </center>
              </div>
            </div>
        </div><!-- /.box-header -->
        <hr>
        <?php 
            $id = $_GET['id'];
            $tmp = $aduan->tampilR3("tb_hasil_aduan", "tb_aduan", "aduan_id", "tb_user", "user_id", "tb_pos", "pos_id", "hasil_id", $id)[0];
            ?>
        <div class="box-body">
        <div class="row">
            <div class="col-md-6" style="width: 46%; float: left">
            <div class="table-responsive">
                <table class="table table-condensed">
                <tr>
                    <th>Kode Hasil</th> <td><?= $tmp['hasil_id']; ?></td>
                </tr>
                <tr>
                    <th>Nama Pelapor</th> <td><?= $tmp['user_nama']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th> <td><?php echo $tmp['aduan_tgl'] ?></td>
                </tr>
                </table>
                </div>
            </div>
            <div class="col-md-4" style="width: 46%; float: left; margin-left: 8%;">
                <table class="table table-condensed">
                <tr>
                    <th>Id Pos</th> <td><?= $tmp['pos_id']; ?></td>
                </tr>
                <tr>
                    <th>Nama Pos</th> <td><?= $tmp['pos_nama']; ?></td>
                </tr>
                </table>
            </div>
            </div>
            
            <!-- <div class="table-responsive">
                <table id="example1" class="table">
                <thead>
                    <tr>
                        <td>Lokasi</td>
                        <td>Keterangan</td>
                        <td>Penanganan</td>
                        <td>Jenis Pelanggaran</td>
                        <td>Hasil</td>
                        <td>Foto</td>
                    </tr>
                </thead> -->
                <?php 
                    $no = 1;
                    $tmp = $aduan->tampilR2("tb_pelanggaran", "tb_hasil_aduan", "pelanggaran_id", "tb_aduan", "aduan_id", "hasil_id", $id);
                    foreach ($tmp as $data) {
                    ?>
                <!-- <tbody>
                    <tr>
                        <td><?php echo $data['aduan_lokasi']; ?></td>
                        <td><?php echo $data['aduan_keterangan']; ?></td>
                        <td><?php echo $data['hasil_penanganan']; ?></td>
                        <td><?php echo $data['pelanggaran_nama']; ?></td>
                        <td><?php echo $data['hasil_hasil']; ?></td>
                        <td><img width="100px" src="hasil/<?= $data['hasil_foto'] ?>" alt=""></td>
                    </tr> -->
                    <?php } ?>
                <!-- </tbody>
                </table>
            </div> -->
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h5><b><?php echo $data['pelanggaran_nama']; ?></b></h5>
                  </div>
                  <div class="panel-body">
                    <table class="table table-striped">
                      <tr>
                        <td><h5><b>Lokasi</b></h5></td>
                        <td><h5><?php echo $data['aduan_lokasi']; ?></h5></td>
                      </tr>
                      <tr>
                        <td><h5><b>Keterangan</b></h5></td>
                        <td><h5><?php echo $data['aduan_keterangan']; ?></h5></td>
                      </tr>
                      <tr>
                        <td><h5><b>Penanganan</b></h5></td>
                        <td><h5><?php echo $data['hasil_penanganan']; ?></h5></td>
                      </tr>
                      <tr>
                        <td><h5><b>Hasil</b></h5></td>
                        <td><h5><?php echo $data['hasil_hasil']; ?></h5></td>
                      </tr>
                      <tr>
                        <td><h5><b>Foto</b></h5></td>
                        <td><img src="../petugas/hasil/<?= $data['hasil_foto'] ?>" width="200px" alt=""></td>
                      </tr>
                    </table>
                  </div>			
                </div>      
              </div>
            </div>
            
            <center>
                <a href="?page=hasil" class="btn btn-info">Kembali</a>
                <a href="cetak.php?id=<?php echo $id ?>" target="_blank" class="btn btn-primary" title="Cetak"><span class="glyphicon glyphicon-print"></span></a>
            </center>        
        </div><!-- /.box-body -->
    </div><!-- /.row -->
</section><!-- /.content -->