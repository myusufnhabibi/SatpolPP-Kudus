<section class="content-header">
<h1>
  Beranda
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Beranda</li>
</ol>
</section>
<br>
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <h1>Selamat Datang <span><?= $tampil['user_nama']; ?><span></h1>
          <div class="row">
            <div class="col-md-10 mb">
              <script>
                var map;
                function initMap() {
                  map = new google.maps.Map(document.getElementById('map-canvas'),{
                      center: {lat: -6.815344, lng: 110.846005},
                      zoom: 12,
                      mapTypeId : google.maps.MapTypeId.ROADMAP
                  });

                  setMarkers(map, locations);

                }
                  <?php
                    $hasil = $user->tampil("tb_pos");
                  ?>
                  
                  var locations = [
                    <?php
                      foreach ($hasil as $h) :
                        echo "['".$h['pos_id']."','".$h['pos_nama']."',".$h['pos_lat'].",".$h['pos_long'].",'".$h['pos_alamat']."','".$h['pos_foto']."'],";
                      endforeach;
                    ?>
                  ];

                  function setMarkers(map, locations) {

                    var titik, i;
                  
                    for (i=0; i < locations.length; i++) {

                        //membuat markers
                        pos = new google.maps.LatLng(locations[i][2],locations[i][3]);
                        var info = new google.maps.InfoWindow({content: contentString});

                        var contentString = 
                            '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h3 id="firstHeading" class="firstHeading">'+ locations[i][1] + '</h3>'+
                            '<div id="bodyContent">'+ 
                            '<img width="100px" src="pos/img/'+ locations[i][5] + '">'+
                            '<h5 id="firstHeading" class="firstHeading">'+ locations[i][4] + '</h5>'+
                            '</div>'+
                            '</div>';
                           
                        titik = new google.maps.Marker({
                            position : pos,
                            icon:'../img/logo2.png',
                            title: locations[i][1],
                            map : map
                        });
                
                        google.maps.event.addListener(titik, 'click', getInfoCallback(map, contentString));
                    }
                  }

                  function getInfoCallback(map, content) {
                      var info = new google.maps.InfoWindow({content: content});
                      return function() {
                              info.setContent(content); 
                              info.open(map, this);
                      };
                  }

                google.maps.event.addDomListener(window, 'load', initMap);
              </script>
              <div id="map-canvas" style="width:1070px;height:500px;"></div>
            </div>
          </div>
        </div><!-- /.box-header -->
    </div><!-- /.row -->    
</section><!-- /.content -->
<!-- /row -->
  
  <!-- /row -->