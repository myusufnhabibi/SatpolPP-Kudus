<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Kecamatan
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Ubah Data Kecamatan</li>
</ol>
</section>
<br>

<style type="text/css"> 
    #map {
    width: 600px;
    height: 500px;
    }
 </style>
<section class="content">
  <div class="box box-default">
    <div class="box-header">
    </div><!-- /.box-header -->
    <div class="box-body">
    <form action="proses.php" class="form-horizontal" method="POST" id="kecamatan_form">
        <?php
            $id = $_GET['id'];
            $u = $user->tampil("tb_kecamatan", "kecamatan_id", $id)[0];

        ?>

        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">ID Kecamatan</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $u['kecamatan_id'] ?>" readonly class="form-control" required type="text" name="id"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Kecamatan</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $u['kecamatan_nama'] ?>" id="nama" required  class="form-control" type="text" name="nama"/>
            </div>
        </div>
        <div class="form-group">
            <div id="map" class="col-lg-8 col-lg-offset-4"></div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Latitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $u['kecamatan_lat'] ?>" id="lat" required  class="form-control" type="text" name="lat"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Longtitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lng" required value="<?= $u['kecamatan_long'] ?>" class="form-control" type="text" name="lng"/>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="ubahK" value="Ubah">
            <a href="?page=kec" type="button" class="btn btn-default">Kembali</a>
        </div>
    </form>
    </div>
  </div>
</section>
  
<script type="text/javascript">

    var lat = document.getElementById("lat").value;
    var lng = document.getElementById("lng").value;
    var nama = document.getElementById("nama").value;
     
     function updateMarkerPosition(latLng) {
      document.getElementById('lat').value = [latLng.lat()];
      document.getElementById('lng').value = [latLng.lng()];
      }

    var myOptions = {
      zoom: 12,
      scaleControl: true,
      center:  new google.maps.LatLng(-6.815344, 110.846005),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);


      var marker1 = new google.maps.Marker({
        position : new google.maps.LatLng(lat, lng),
        title : nama,
        map : map,
        draggable : true
      });
 
 //updateMarkerPosition(latLng);

  google.maps.event.addListener(marker1, 'drag', function() {
    updateMarkerPosition(marker1.getPosition());
  });
</script>