<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info panel-dashboard">
      <div class="panel-heading centered">
        <h2 class="panel-title"><strong>  Pos - Pos Satpol PP Kudus  </strong></h2>
      </div>
      <div class="panel-body">
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
                  echo "['".$h['pos_id']."','".$h['pos_nama']."',".$h['pos_lat'].",".$h['pos_long']."],";
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
                      '<h5 id="firstHeading" class="firstHeading">'+ locations[i][1] + '</h5>'+
                      '<div id="bodyContent">'+ 
                      '<a href=?page=detailP&id='+locations[i][0]+'>Info Detail</a>'+
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
        
        function setKecamatan(lokasi){
          // mengambil koordinat dari database
          var koordinat = lokasi.split('|');
          var x = koordinat[0];
          var y = koordinat[1];
          var id = koordinat[2];
          
          var lokasibaru = new google.maps.LatLng(x, y);
          var petaoption = {
            zoom: 13,
            center: lokasibaru,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          
          map = new google.maps.Map(document.getElementById("map-canvas"),petaoption);
          
          setMarkers(map, locations);
        }

        function setDesa(lokasi){
          // mengambil koordinat dari database
          var koordinat = lokasi.split('|');
          var x = koordinat[0];
          var y = koordinat[1];
          var id = koordinat[2];
          
          var lokasibaru = new google.maps.LatLng(x, y);
          var petaoption = {
            zoom: 16,
            center: lokasibaru,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          
          map = new google.maps.Map(document.getElementById("map-canvas"),petaoption);
          
          setMarkers(map, locations);
        }
        
          
      </script>
      <form action="" class="form-inline">
        <div class="form-group">
          <label class="col-lg-3 control-label" for="input01">Kecamatan</label>
            <select name="kecamatan" class="form-control" id="kecamatan" onchange="setKecamatan(this.options[this.selectedIndex].value)" style="width:280px;" tabindex="2">
            <?php

            /* menampilkan data kecamatan */
            $kecamatan = $user->tampil("tb_kecamatan");
              echo '<option value=""> -Pilih kecamatan- </option>';
              foreach($kecamatan as $k) {
                echo '<option value="'.$k['kecamatan_lat']."|".$k['kecamatan_long']."|".$k['kecamatan_id'].'">'.$k['kecamatan_nama'].'</option>';
              }
          
            ?>
            </select>
        </div>
        <div class="form-group">
            <label class="col-lg-5 control-label">Nama Desa</label>
                <select name="desa" id="desa" onchange="setDesa(this.options[this.selectedIndex].value)" required class="form-control"></select>
        </div>
      </form>
        <div id="map-canvas" style="width:1098px;height:500px; margin-top:20px"></div>
      </div>
      </div>
    </div>
  
  </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

      $("#kecamatan").change(function() {
        var a = $('#kecamatan option:selected').val();
        var koordinat = a.split('|');
        var id = koordinat[2];
        $("#desa").hide();
        $.ajax({
          type : 'POST',
          url : "../config/ambil_desa.php",
          data : "kecamatan_id=" + id,
          success : function(data) {
            // jika data sukses diambil dari server, tampilkan di <select id=kota>
            if(data == ''){
                          alert('Tidak ada data Desa');
                      } else {
                          $("#desa").html(data).show();
                      }
                  }
        });
		  });
	});
</script>
