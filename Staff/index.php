<?php 
error_reporting(0);
session_start();

if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../admin.php'
  </script>";
} else if ($_SESSION['user_level'] == "masy") {
  echo "<script>
    window.location='../masyarakat/index.php'
  </script>";
} else if ($_SESSION['user_level'] == "pet") {
  echo "<script>
    window.location='../petugas/index.php'
  </script>";
} else if ($_SESSION['user_level'] == "kep") {
  echo "<script>
    window.location='../kasat/index.php'
  </script>";
}
$page = $_GET['page'];
require_once "../config/class.php";
$koneksi = new Database();
$user = new User($koneksi);
$kec = new Kecamatan($koneksi);
$relasi = new Relasi($koneksi);
$user_id = $_SESSION['user_id'];
$tampil = $user->tampil('tb_user', 'user_id', $user_id)[0];
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
  <link href="../img/satpolpp/fav.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="../lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet">
  <link href="../lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link rel="stylesheet" href="../lib/advanced-datatable/css/DT_bootstrap.css" />
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4QIC1djXcEa0vsnQLODtOiJ4ZtJcKKIk" type="text/javascript"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body onload="peta_awal()">
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <section id="container">
    <!--  TOP BAR CONTENT & NOTIFICATIONS -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>SATPOL<span>PP</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="?page=logOut">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- MAIN SIDEBAR MENU-->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered">
            <img src="../img/logo.png" class="img-circle" width="80">
          </p>
          <h5 class="centered"><?= $tampil['user_nama']; ?></h5>
          <li class="mt">
            <a <?php if($page == "index") { echo"class='active'";} ?> href="?page=index">
              <i class="fa fa-dashboard"></i>
              <span>Beranda</span>
              </a>
          </li>
          <li>
            <a <?php if($page == "user") { echo"class='active'";} ?> href="?page=user">
              <i class="fa fa-user"></i>
              <span>User</span>
              </a>
          </li>
          <li class="sub-menu">
            <a <?php if(($page == "desa") || ($page == "kec") || ($page == "tDesa") || ($page == "uDesa") || ($page == "tKec") || ($page == "uKec") || ($page == "pos")  || ($page == "tPos") || ($page == "uPos")) { echo"class='active'";} ?>  href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Kelola Data</span>
              </a>
            <ul class="sub">
              <li <?php if(($page == "desa") || ($page == "tDesa") || ($page == "uDesa")) { echo"class='active'";} ?>><a href="?page=desa">Desa</a></li>
              <li <?php if(($page == "kec") || ($page == "tKec") || ($page == "uKec")) { echo"class='active'";} ?>><a href="?page=kec">Kecamatan</a></li>
              <li <?php if(($page == "pos")  || ($page == "tPos") || ($page == "uPos")) { echo"class='active'";} ?>><a href="?page=pos">Pos</a></li>
            </ul>
          </li>
          <li>
            <a <?php if($page == "pel") { echo"class='active'";} ?> href="?page=pel">
              <i class="fa fa-envelope"></i>
              <span>Pelanggaran </span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- MAIN CONTENT -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <?php 
          if (@$_GET['page'] == "" || @$_GET['page'] == "index") {
              include "beranda.php";
          } elseif(@$_GET['page'] == "user") {
              include "user/index.php";
          } elseif(@$_GET['page'] == "logOut") {
            $user->logOut();
            echo "<script>window.location='index.php'</script>"; 
          } elseif(@$_GET['page'] == "hapusUser") {
            $id = $_GET['id'];
            $user->hapus('tb_user', 'user_id', $id); 
            echo "<script>window.location='?page=user'</script>"; 
          } elseif(@$_GET['page'] == "kec") {
              include "kecamatan/index.php";
          } elseif(@$_GET['page'] == "tKec") {
            include "kecamatan/tambah.php";
          } elseif(@$_GET['page'] == "uKec") {
            include "kecamatan/ubah.php";
          } elseif(@$_GET['page'] == "hKec") {
            $id = $_GET['id'];
            $user->hapus('tb_kecamatan', 'kecamatan_id', $id); 
            echo "<script>window.location='?page=kec'</script>"; 
          } elseif(@$_GET['page'] == "pel") {
              include "pelanggaran/index.php";
          } elseif(@$_GET['page'] == "hapusPelanggaran") {
            $id = $_GET['id'];
            $user->hapus('tb_pelanggaran', 'pelanggaran_id', $id); 
            echo "<script>window.location='?page=pel'</script>"; 
          } elseif(@$_GET['page'] == "desa") {
            include "desa/index.php";
          } elseif(@$_GET['page'] == "tDesa") {
            include "desa/tambah.php";
          } elseif(@$_GET['page'] == "uDesa") {
            include "desa/ubah.php";
          } elseif(@$_GET['page'] == "hDesa") {
            $id = $_GET['id'];
            $user->hapus('tb_desa', 'desa_id', $id); 
            echo "<script>window.location='?page=desa'</script>"; 
          } elseif(@$_GET['page'] == "pos") {
            include "pos/index.php";
          } elseif(@$_GET['page'] == "tPos") {
            include "pos/tambah.php";
          } elseif(@$_GET['page'] == "uPos") {
            include "pos/ubah.php";
          } elseif(@$_GET['page'] == "hPos") {
            include "pos/hapus.php";
          }
          
        ?>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; <strong>Satpol PP 2018</strong> Hak Cipta Dilindungi 
        </p>
        <div class="credits">
          Kabupaten Kudus, Jawa Tengah, Indonesia 
        </div>
        <a href="gallery.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script type="text/javascript" language="javascript" src="../lib/advanced-datatable/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="../lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <script src="../lib/fancybox/jquery.fancybox.js"></script>
  <script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../lib/jquery.scrollTo.min.js"></script>
  <script src="../lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="../lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });
  </script>

</body>

</html>
<script type="text/javascript">

    $(document).ready(function() {

      $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'dsc']
        ]
      });
    });

</script>