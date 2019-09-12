<section class="content-header">
<h1>
  Beranda
  <small>Satpol PP</small>
</h1>
<ol class="breadcrumb">
  <li><a href="?page=index"><i class="fa fa-dashboard"></i> Satpol PP</a></li>
  <li class="active">Beranda</li>
</ol>
</section>
<br>
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <h1>Selamat Datang <span><?= $tampil['user_nama']; ?><span></h1>
          <div class="row">
          <?php
            $aduan = $user->hitungData("tb_aduan");
            $hasil = $user->hitungData("tb_hasil_aduan");
          ?>
          <div class="col-lg-4 col-md-4 col-sm-4 mb">
            <div class="content-panel pn">
              <div id="profile-02">
                <div class="user">
                  <h4><?= $aduan ?> Aduan</h4>
                </div>
              </div>
              <div class="pr2-social centered">
                <a href="?page=aduan">Selengkapnya <i class="fa fa-arrow-circle-o-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 mb">
            <div class="content-panel pn">
              <div id="profile-02">
                <div class="user">
                  <h4><?= $hasil ?> Hasil Laporan Aduan</h4>
                </div>
              </div>
              <div class="pr2-social centered">
                <a href="?page=hasil">Selengkapnya <i class="fa fa-arrow-circle-o-right"></i></a>
              </div>
            </div>
          </div>
          </div>
        </div><!-- /.box-header -->
    </div><!-- /.row -->    
</section><!-- /.content -->
<!-- /row -->
  
  <!-- /row -->