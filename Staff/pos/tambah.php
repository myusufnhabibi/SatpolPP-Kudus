<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Tambah Pos
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Tambah Pos</li>
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
    <form action="proses.php" class="form-horizontal" enctype="multipart/form-data" method="POST" id="pos_form">
        <?php
            $kode = $user->kode_otomatis('pos_id', 'tb_pos', 'POS');
        ?>

        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">ID Pos</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $kode ?>" readonly class="form-control" required type="text" name="id"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Pos</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required  class="form-control" type="text" name="nama"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Telepon</label>
            <div class="col-lg-5">
                <input style="width: 210px;" required  class="form-control" type="number" name="telp"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Petugas</label>
            <div class="col-lg-5">
                <select name="pet_id" id="pet_id" required class="form-control">
                    <option value="">-- Pilih Petugas --</option>
                    <?php  
                    $hasilK = $user->tampil("tb_user", "user_level", "pet");
                    foreach ($hasilK as $k) { 
                        echo '<option value="'.$k['user_id'].'">'.$k['user_nama'].'</option>';
                    } ?>
                </select>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Alamat</label>
            <div class="col-lg-5">
                <textarea required class="form-control" name="alamat" cols="30" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Kecamatan</label>
            <div class="col-lg-5">
                <select name="kecamatan_id" id="kec" onchange="setKecamatan(this.options[this.selectedIndex].value)" required class="form-control">
                    <option value="">-- Pilih Kecamatan --</option>
                    <?php
                    
                    $hasilK = $user->tampil("tb_kecamatan");
                    foreach ($hasilK as $k) { 
                        echo '<option value="'.$k['kecamatan_lat']."|".$k['kecamatan_long']."|".$k['kecamatan_id'].'">'.$k['kecamatan_nama'].'</option>';
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Desa</label>
            <div class="col-lg-5">
                <select name="desa" id="desa" onchange="setDesa(this.options[this.selectedIndex].value)" required class="form-control"></select>
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
                <input style="width: 210px;" id="long" required  class="form-control" type="text" name="lng"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Foto</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lat" required  class="form-control" type="file" name="foto"/>
            </div>
        </div> 
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="tambahP" value="Simpan">
            <a type="?page=pos" class="btn btn-default">Kembali</a>
        </div>
    </form>
    </div>
  </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
		$("#kec").change(function() {
			var a = $('#kec option:selected').val();
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

<script type="text/javascript">
    document.getElementById('reset').onclick= function() {
    var field1= document.getElementById('long');
    var field2= document.getElementById('lat');
    field1.value= field1.defaultValue;
    field2.value= field2.defaultValue;
    };

    var peta;
	var gambar_tanda;
	gambar_tanda = 'assets/img/marker.png';
	
	function peta_awal(){
		// posisi default peta saat diload
	    var lokasibaru = new google.maps.LatLng(-6.815344, 110.846005);
    	var petaoption = {
			zoom: 12,
			center: lokasibaru,
			mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
	    peta = new google.maps.Map(document.getElementById("map"),petaoption);
	    
	    // ngasih fungsi marker buat generate koordinat latitude & longitude
	    tanda = new google.maps.Marker({
	        position: lokasibaru,
	        map: peta, 
	        icon: gambar_tanda,
	        draggable : true
	    });
	    
	    // ketika markernya didrag, koordinatnya langsung di selipin di textfield
	    google.maps.event.addListener(tanda, 'dragend', function(event){
				document.getElementById('lat').value = this.getPosition().lat();
				document.getElementById('long').value = this.getPosition().lng();
		});
	}

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
		
		peta = new google.maps.Map(document.getElementById("map"),petaoption);

		 // ngasih fungsi marker buat generate koordinat latitude & longitude
		tanda = new google.maps.Marker({
			position: lokasibaru,
			icon: gambar_tanda,
			map: peta, draggable : true
		});
		
		google.maps.event.addListener(tanda, 'dragend', function(event){
				document.getElementById('lat').value = this.getPosition().lat();
				document.getElementById('long').value = this.getPosition().lng();
		});
	} 

    function setDesa(lokasi){
		// mengambil koordinat dari database
		var koordinat = lokasi.split('|');
		var x = koordinat[0];
		var y = koordinat[1];
		var id = koordinat[2];
		
		var lokasibaru = new google.maps.LatLng(x, y);
		var petaoption = {
			zoom: 15,
			center: lokasibaru,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		peta = new google.maps.Map(document.getElementById("map"),petaoption);

		 // ngasih fungsi marker buat generate koordinat latitude & longitude
		tanda = new google.maps.Marker({
			position: lokasibaru,
			icon: gambar_tanda,
			map: peta, draggable : true
		});
		
		google.maps.event.addListener(tanda, 'dragend', function(event){
				document.getElementById('lat').value = this.getPosition().lat();
				document.getElementById('long').value = this.getPosition().lng();
		});
	}
</script>