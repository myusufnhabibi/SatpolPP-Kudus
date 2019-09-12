<?php 
  include_once "../config/class.php";
  error_reporting(0);
  session_start();

  if ($_SESSION['user_level'] == "pet") {
    echo "<script>
      window.location='../petugas/index.php'
    </script>";
  } else if ($_SESSION['user_level'] == "staf") {
    echo "<script>
      window.location='../staff/index.php'
    </script>";
  } else if ($_SESSION['user_level'] == "kep") {
    echo "<script>
      window.location='../kasat/index.php'
    </script>";
  }

  $koneksi = new Database();
  $masy = new CRUD($koneksi);
  $user= new User($koneksi);
  $id = $_SESSION['user_id'];
  $relasi = new Relasi($koneksi);
  $pecah = $masy->tampil("tb_user", "user_id", $id)[0];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Pos Pelayanan Satpol PP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/datatable-bootstrap.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../lib/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../lib/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="../lib/bootstrap-datetimepicker/datertimepicker.css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4QIC1djXcEa0vsnQLODtOiJ4ZtJcKKIk" type="text/javascript"></script>
  </head>
  <body>
    <script src="lib/jquery/jquery.min.js"></script>
    <div class="container">
      <div class="row">
        <div class="tengah">
          <div class="head-depan tengah">
            <div class="row">
              <div class="col-md-1">
                <img class="img-responsive margin-b10" src="img/logo-logo.png" width="100" height="100"/>
              </div>
              <div class="col-md-11">
                <h1 class="judul-head">Sistem Informasi Pos Pelayanan Satpol PP</h1>
                <p><i class="fa fa-map-marker fa-fw"></i> Sistem Informasi yang memuat data pengaduan dan pos - pos pelayanan yang tersebar di Kudus</p>
              </div>
            </div>
            <hr class="hr1 margin-b-10" />
          </div>
        </div>
      </div>
    </div>
    <div class="container margin-b70">
    <nav class="navbar navbar-default navbar-utama" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Status</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="?page=index"><i class="fa fa-home"></i> HALAMAN DEPAN</a></li>
            <li><a href="?page=data" ><i class="fa fa-list-ul"></i> PENGADUAN</a></li>
            <li><a href="?page=pos"><i class="fa fa-map-marker"></i> PETA PERSEBARAN POS</a></li>
            <li><a href="?page=lap"><i class="fa fa-list-alt"></i> LAPORAN</a></li>
            <li><a href="about.php" data-toggle="modal" data-target="#about"><i class="fa fa-user"></i> ABOUT</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
              <?php if (empty($id)) { ?>
       				<li><a href="../index.php"><span><i class="glyphicon glyphicon-user"></i></span> LOGIN</a></li>

              <?php } else { ?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="img/user/<?= $pecah['user_foto'] ?>" class="img-circle" width="25px">
                  <span class="hidden-xs"><?= $pecah['user_nama'] ?></span>
                </a>
              <ul class="dropdown-menu">
                  <a href="?page=keluar" class="btn btn-danger" style="margin-left: 45px">Keluar</a>
              </ul>
            </li>
              <?php } ?>
       		</ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <?php 
        if (@$_GET['page']=='' or @$_GET['page'] == 'index'){
          include "home.php";
        } else if (@$_GET['page']=='data'){
          include "data.php";
        } else if (@$_GET['page']=='keluar'){
          $user->logOut();
          echo "<script>window.location='index.php'</script>";          
        } else if (@$_GET['page']=='daftar'){
          include "daftar.php";
        } else if (@$_GET['page']=='pos'){
          include "pos.php";
        } else if (@$_GET['page']=='lap'){
          include "lap.php";
        } else if (@$_GET['page']=='detailP'){
          include "detailP.php";
        }?>  
      <div class="footer footer1">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <img src="img/logo-logo.png" width="72" height="72" />
            <h4 class="white">Sistem Informasi Pos Pelayanan Satpol PP</h4>
          <h3 class="white">Indonesia</h3>
          <ul class="list-inline">
            <li><a href="?page=index" class="link-footer">Beranda</a></li>
            <li><a href="?page=pos" class="link-footer">Peta</a></li>
            <li><a href="about.php" data-toggle="modal" data-target="#about" class="link-footer">Tentang</a></li>
          </ul>
          <h5 class="white">Copyright &copy; Satpol PP Kudus 2018</h5>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title centered" id="myModalLabel">About</h4>
          </div>
          <div class="modal-body">
            <h4>SISTEM INFORMASI POS PELAYANAN SATPOL PP KUDUS</h4>
            <p>Aplikasi Untuk melihat persebaran Pos-Pos Pelayanan Informasi Satpol PP di Kudus 
              serta terdapat fitur pengaduan ketika terjadi suatu masalah yang ada di kota Kudus</p>
          </div>
          <div class="modal-footer centered">
            <p><b>@SI.UMK 2018</b></p>
          </div>
        </div>
      </div>
    </div>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-hover-dropdown.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/datatable-bootstrap.js"></script>
        <script src="../lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script src="../lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="../lib/advanced-form-components.js"></script>

      </body>
    </html>