<?php
require_once "../../config/class.php";
$koneksi = new Database();
$user = new User($koneksi);
$aduan = new Relasi($koneksi);
$lapor = new Lapor($koneksi);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>GIS Satpol PP Kudus</title>

  <!-- Favicons -->
  <link href="../../img/satpolpp/fav.png" rel="icon">
  <link href="../../img/apple-touch-icon.png" rel="apple-touch-icon">
  
  <!-- Bootstrap core CSS -->
  <link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="../../lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  <script src="../../lib/jquery/jquery.min.js"></script>
  <link href="../../lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../lib/advanced-datatable/css/DT_bootstrap.css" />

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>

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
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <img src="../../img/satpolpp/logo.png" style="float:left; padding-top:12px" width="100px" alt="">
            <center style="padding-right:10px">
              <h3>PEMERINTAH KABUPATEN KUDUS</h3>
              <h4>SATUAN POLISI PAMONG PRAJA</h4>
              <p>Jl. Sosrokartono No.39, Barongan, Bae, Kabupaten Kudus, Jawa Tengah 59326</p>
            </center>
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
                        <td><img src="../hasil/<?= $data['hasil_foto'] ?>" width="200px" alt=""></td>
                      </tr>
                    </table>
                  </div>			
                </div>      
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-md-offset-9" style="float:right; margin-top:20px">
                Kudus, <?= $user->tanggal_indo($data['aduan_tgl']) ?><br>
                Kepala Satpol PP Kudus
                <p style="margin-top:85px"><b>Djati Solechah, S.Sos, MM</b></p>
              </div>
            </div>      
        </div><!-- /.box-body -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
window.print();
</script>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer" id="a">
      <div class="text-center">
        <p>
          &copy; <strong>Satpol PP 2018</strong> Hak Cipta Dilindungi 
        </p>
        <div class="credits">
          Kabupaten Kudus, Jawa Tengah, Indonesia 
        </div>

      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  
  <script src="../../lib/fancybox/jquery.fancybox.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../lib/jquery.scrollTo.min.js"></script>
  <script src="../lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="../../lib/common-scripts.js"></script>
  <!--script for this page-->
 

</body>

</html>
