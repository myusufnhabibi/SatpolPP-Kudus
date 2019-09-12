<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Login - Satpol PP</title>

  <!-- Favicons -->
  <link href="img/satpolpp/fav.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- MAIN CONTENT -->
  <div id="login-page">
  
    <div class="container">
      <form class="form-login" method="POST" action="login/">
        <h2 class="form-login-heading"><img src="img/satpolpp/logo2.png" alt="" width="270px"></h2>
        <br><h5 class="text-center">Masuk untuk memulai sesi</h5>
        <div class="login-wrap">
          <input type="text" name="user" class="form-control" placeholder="Username" autofocus><span class="glyphicon glyphicon-user form-control-feedback"></span>
          <br>
          <input type="password" name="pass" class="form-control" placeholder="Password">
          <br>
          <button class="btn btn-theme btn-block" name="login" href="index.html" type="submit"><i class="fa fa-lock"></i> MASUK</button>
        </div>
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/loginBg.jpg", {
      speed: 500
    });
  </script>
</html>
