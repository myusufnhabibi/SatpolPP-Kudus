<?php 

if (empty($_SESSION['user_id'])) {
  echo "<script>alert('Login dulu! Sebelum melaporkan aduan')
    window.location='../index.php'
  </script>";
}

$koneksi = new Database();
$masy = new CRUD($koneksi);

$kode = $masy->kode_otomatis('aduan_id', 'tb_aduan', 'ADU');
?>
  <div class="row">
    <div class="col-md-5">
      <div class="panel panel-info panel-dashboard">
        <div class="panel-heading centered">
          <h2 class="panel-title"><strong> - Pengaduan - </strong></h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="../config/tambahAduan.php" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?= $kode; ?>">
            <input type="hidden" name="id_user" id="id_user" value="<?= $id; ?>">
            <div class="form-group">
              <label for="">Lokasi</label>
              <input type="text" name="lokasi" id="lokasi" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Keterangan</label>
              <textarea name="keterangan" id="keterangan" class="form-control" cols="20" rows="5"></textarea>
            </div>
            <input type="hidden" name="tgl" id="tgl" value="<?= date('Y-m-d');?>">
            <div class="form-group">
              <select name="pos" id="pos" required class="form-control">
                <option value="">-- Pilih Pos --</option>
                <?php
                  
                  $hasilK = $user->tampil("tb_pos");
                  foreach ($hasilK as $k) { ?>
                    <option style="width: 210px;" value="<?= $k['pos_id']?>"><?= $k['pos_nama'] ?></option>
                  <?php } ?>
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Foto</label>
              <input type="file" name="foto" id="foto">
              <p class="text-danger" style="font-style: italic;">* Boleh diisi boleh tidak</p>
            </div>
            <div class="form-group">
              <input type="submit" id="laporkan" name="submit" class="btnn btn-primary" value="Laporkan">
            </div>

            <!-- <p class="text-info" style="font-style: italic; font-weight: bold">NB: Tekan F5/Refresh untuk input aduan lagi</p> -->
          </form>
        </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="panel panel-info panel-dashboard">
          <div class="panel-heading centered">
            <h2 class="panel-title"><strong> - Data Aduan - </strong></h4>
          </div>
          <div class="panel-body">
            <div class="tampilData"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<script>
  $(document).ready(function(){
    loadData();

    $('form').on('submit', function(e){
      e.preventDefault();
      var data = new FormData(this);
      data.append('id', $('#id').val());
      data.append('id_user', $('#id_user').val());
      data.append('lokasi', $('#lokasi').val());
      data.append('keterangan', $('#keterangan').val());
      data.append('pos', $('#pos').val());
      data.append('tgl', $('#tgl').val());
      data.append('foto', $('#foto')[0].files[0]);

      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: data,
        processData: false,
        contentType: false,
        success: function(result){
          console.log(result.yes);
          loadData();
          resetForm();
        }
      });
    })
  })

    function loadData() {
      $.get('detail.php', function(data){
        $('.tampilData').html(data);
      })
    }

    function resetForm() {
      $('[type=text]').val('');
      $('[name=keterangan]').val('');
      $('[name=foto]').val('');
      $('[name=pos]').val('');
      $('[name=lokasi]').focus();
      $('form').attr('action', '../config/tambahAduan.php');
    }
</script>