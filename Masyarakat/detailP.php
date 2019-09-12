<?php 
$id = $_GET['id'];
$pos = $relasi->tampilR2("tb_pos", "tb_desa", "desa_id", "tb_kecamatan", "kecamatan_id", "pos_id", $id)[0];
?>

<script>

function initialize() {
  var myLatlng = new google.maps.LatLng(<?= $pos['pos_lat'] ?>,<?= $pos['pos_long'] ?>);
  var mapOptions = {
    zoom: 15,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?= $pos[pos_nama] ?></h1>'+
      '<div id="bodyContent">'+
      '<p><?= $pos[pos_alamat] ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Maps Info',
      icon:'../img/logo2.png',
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
      <div class="row">
      <div class="col-md-5">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Lokasi - </strong></h4>
            </div>
            <div class="panel-body">
              <div id="map-canvas" style="width:100%;height:380px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Detail - </strong></h4>
            </div>
            <div class="panel-body">
             <table class="table">
               <tr>
                 <th>Item</th>
                 <th>Detail</th>
               </tr>
               <tr>
                 <td>Nama Pos</td>
                 <td><h4><?= $pos['pos_nama'] ?></h4></td>
               </tr>
               <tr>
                 <td>Desa</td>
                 <td><h4><?= $pos['desa_nama'] ?></h4></td>
               </tr>
               <tr>
                 <td>Kecamatan</td>
                 <td><h4><?= $pos['kecamatan_nama'] ?></h4></td>
               </tr>
               <tr>
                 <td>Alamat</td>
                 <td><h4><?= $pos['pos_alamat'] ?></h4></td>
               </tr>
               <tr>
                 <td>No HP</td>
                 <td><h4><?= $pos['pos_telp'] ?></h4></td>
               </tr>
               <tr>
                  <td>Foto</td>
                  <td><img src="../staff/pos/img/<?= $pos['pos_foto'] ?>" width="120px" alt=""></td>
                </tr>
             </table>

            
              </div>
              </div>
            </div>

        
        </div>
      </div>
    </div>