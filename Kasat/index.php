<?php 
session_start();

if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../admin.php'
  </script>";
} else if ($_SESSION['user_level'] == "masy") {
  echo "<script>
    window.location='../masyarakat/index.php'
  </script>";
} else if ($_SESSION['user_level'] == "staf") {
  echo "<script>
    window.location='../staff/index.php'
  </script>";
} else if ($_SESSION['user_level'] == "pet") {
  echo "<script>
    window.location='../petugas/index.php'
  </script>";
}

require_once "../config/class.php";
$koneksi = new Database();
$user = new User($koneksi);
$aduan = new Relasi($koneksi);
$lapor = new Lapor($koneksi);
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
  <script src="../lib/jquery/jquery.min.js"></script>
  <link href="../lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link rel="stylesheet" href="../lib/advanced-datatable/css/DT_bootstrap.css" />

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>

  <section id="container">
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <!--  TOP BAR CONTENT & NOTIFICATIONS -->
    <!--header start-->
    <header class="header kasat-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>SATPOL<span>PP</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- inbox dropdown start-->
          <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-theme count"></span>
            </a>
            <ul class="dropdown-menu extended inbox"></ul>
          </li>
          <!-- inbox dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
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
            <a href="?page=index">
              <i class="fa fa-dashboard"></i>
              <span>Beranda</span>
              </a>
          </li>
          <li>
            <a href="?page=hasil">
              <i class="fa fa-envelope"></i>
              <span>Hasil Laporan </span>
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
          } elseif(@$_GET['page'] == "logOut") {
            $user->logOut();
            echo "<script>window.location='index.php'</script>"; 
          } elseif(@$_GET['page'] == "lapor") {
            include "lapor.php";
          } elseif(@$_GET['page'] == "hasil") {
            include "hasil_laporan.php";
          } elseif(@$_GET['page'] == "detail") {
            include "detail.php";
          }
        ?>
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
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="../lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="../lib/jquery.scrollTo.min.js"></script>
  <script src="../lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="../lib/common-scripts.js"></script>
  <!--script for this page-->
 

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