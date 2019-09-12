<?php 
if (!isset($_SESSION['login'])) {
  echo "<script>
    window.location='../index.php'
  </script>";
}
?>
<section class="content-header">
<h1>
  Desa
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Ubah Data pos</li>
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
            $id = $_GET['id'];
            $hasil = $relasi->tampilR4('tb_pos', 'tb_user', 'user_id', 'tb_desa', 'desa_id', 'tb_kecamatan', 'kecamatan_id', 'pos_id', $id)[0];
        ?>

        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">ID Pos</label>
            <div class="col-lg-5">
                <input style="width: 210px;" value="<?= $hasil['pos_id']; ?>" readonly class="form-control" required type="text" name="id"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Pos</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="nama" required value="<?= $hasil['pos_nama']; ?>" class="form-control" type="text" name="nama"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Telepon</label>
            <div class="col-lg-5">
                <input style="width: 210px;" required value="<?= $hasil['pos_telp']?>" class="form-control" type="number" name="telp"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Alamat</label>
            <div class="col-lg-5">
                <textarea required class="form-control" name="alamat" cols="30" rows="3"><?= $hasil['pos_alamat']?></textarea>
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
                        if ($hasil['user_id'] == $k['user_id']) { 
                            echo '<option value="'.$k['user_id'].'" selected>'.$k['user_nama'].'</option>';
                        } else {
                            echo '<option value="'.$k['user_id'].'">'.$k['user_nama'].'</option>';
                        } }?>
                </select>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Kecamatan</label>
            <div class="col-lg-5">
                <select name="kecamatan_id" id="kec" required class="form-control">
                    <option value="">-- Pilih Kecamatan --</option>
                    <?php
                    
                    $hasilK = $user->tampil("tb_kecamatan");
                    foreach ($hasilK as $k) { 
                        if ($hasil['kecamatan_id'] == $k['kecamatan_id']) {?>
                        <option style="width: 210px;" value="<?= $k['kecamatan_id']?>" selected><?= $k['kecamatan_nama'] ?></option>
                    <?php } else { ?>
                        <option style="width: 210px;" value="<?= $k['kecamatan_id']?>"><?= $k['kecamatan_nama'] ?></option>
                    <?php } }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Nama Desa</label>
            <div class="col-lg-5">
                <select name="desa" id="desa" required class="form-control">
                <option value="">-- Pilih Desa --</option>
                    <?php
                    $hasilK = $user->tampil("tb_desa");
                    foreach ($hasilK as $k) { 
                        if ($hasil['desa_id'] == $k['desa_id']) {?>
                        <option style="width: 210px;" value="<?= $k['desa_id']?>" selected><?= $k['desa_nama'] ?></option>
                    <?php } else { ?>
                        <option style="width: 210px;" value="<?= $k['desa_id']?>"><?= $k['desa_nama'] ?></option>
                    <?php } }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div id="map" class="col-lg-8 col-lg-offset-4"></div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Latitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lat" value="<?= $hasil['pos_lat']?>" required  class="form-control" type="text" name="lat"/>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Longtitude</label>
            <div class="col-lg-5">
                <input style="width: 210px;" id="lng" value="<?= $hasil['pos_long']?>" required  class="form-control" type="text" name="lng"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 col-lg-offset-1 control-label">Foto</label>
            <div class="col-lg-5">
                <img src="pos/img/<?= $hasil['pos_foto'] ?>" width="90px" alt="">
                <input type="hidden" value="<?= $hasil['pos_foto'] ?>" name="fotoLama">
                <input style="width: 210px;" id="lat" class="form-control" type="file" name="foto"/>
            </div>
        </div> 
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="ubahP" value="Ubah">
            <a type="?page=pos" class="btn btn-default">Kembali</a>
        </div>
    </form>
</div>
</div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $("#kec").change(function() {
        var kec = $(this).val();
        $.ajax({
            type : 'POST',
            url : "../config/ambil_desa.php",
            data : "kecamatan_id=" + kec,
            success : function(data) {
                // jika data sukses diambil dari server, tampilkan di <select id=kota>
                $("#desa").html(data);
            }
        });
    });
});
</script>
 
<script type="text/javascript">
  var lat = document.getElementById("lat").value;
  var lng = document.getElementById("lng").value;
  var nama = document.getElementById("nama").value;
   
   function updateMarkerPosition(latLng) {
    document.getElementById('lat').value = [latLng.lat()];
    document.getElementById('lng').value = [latLng.lng()];
    }

  var myOptions = {
    zoom: 14,
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