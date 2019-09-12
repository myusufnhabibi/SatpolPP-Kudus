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
  <li class="active">Kecamatan</li>
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

            $user2 = $user->tampil("tb_kecamatan");
            $kode = $user->kode_otomatis('kecamatan_id', 'tb_kecamatan', 'KEC');
        ?>

        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">ID Kecamatan</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $kode ?>" readonly  class="form-control" required type="text" name="id"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Kecamatan</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required  class="form-control" type="text" name="nama"/>
            </div>
        </div>
        <div class="form-group">
            <div id="map" class="col-lg-8 col-lg-offset-4"></div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Latitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lat" required  class="form-control" type="text" name="lat"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Longtitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lng" required  class="form-control" type="text" name="lng"/>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="tambahK" value="Simpan">
            <a href="?page=kec" type="button" class="btn btn-default">Kembali</a>
        </div>
    </form>
    </div>
  </div>
</section>

<script type="text/javascript">
    document.getElementById('reset').onclick= function() {
        var field1= document.getElementById('lng');
 var field2= document.getElementById('lat');
        field1.value= field1.defaultValue;
 field2.value= field2.defaultValue;
    };
</script>    
<script type="text/javascript">
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
    position : new google.maps.LatLng(-6.815344, 110.846005),
    title : 'lokasi',
    map : map,
    draggable : true
    });
 
 //updateMarkerPosition(latLng);

  google.maps.event.addListener(marker1, 'drag', function() {
    updateMarkerPosition(marker1.getPosition());
  });
</script>