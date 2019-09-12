<?php
error_reporting(0);
require_once "../config/class.php";
$koneksi = new Database();
$kec = new Kecamatan($koneksi);
$rel = new Relasi($koneksi);
$pos = new Pos($koneksi);

if (isset($_POST['tambahK'])) {
    $id = $_POST['id'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);

    $sql = $kec->tambahK($id, $nama, $lat, $lng);
    if ($sql > 0) {
        echo "<script>alert('Simpan Berhasil');
        window.location='index.php?page=kec'</script>";
    } else {
        echo "<script>alert('Simpan gagal');
        window.location='index.php?page=kec'</script>";
    }
} else if (isset($_POST['ubahK'])) {
    $id = $_POST['id'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);

    $sql = $kec->ubahK($nama, $lat, $lng, $id);
    if ($sql > 0) {
        echo "<script>alert('Ubah Berhasil');
        window.location='index.php?page=kec'</script>";
    } else {
        echo "<script>alert('Ubah gagal');
        window.location='index.php?page=kec'</script>";
    }
} else if (isset($_POST['tambahD'])) {
    $id = $_POST['id'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $kec = $_POST['kec'];
    $array    	= $kec;
    $newarray 	= explode("|", $array);
    $kec2		= $newarray[2];
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);

    $sql = $rel->tambahR($id, $kec2, $nama, $lat, $lng);
    if ($sql > 0) {
        echo "<script>alert('Simpan Berhasil');
        window.location='index.php?page=desa'</script>";
    } else {
        echo "<script>alert('Simpan gagal');
        window.location='index.php?page=desa'</script>";
    }
} else if (isset($_POST['ubahR'])) {
    $id = $_POST['id'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $kec = $_POST['kec'];
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);

    $sql = $rel->ubahR($nama, $lat, $lng, $kec, $id);
    if ($sql > 0) {
        echo "<script>alert('Ubah Berhasil');
        window.location='index.php?page=desa'</script>";
    } else {
        echo "<script>alert('Ubah gagal');
        window.location='index.php?page=desa'</script>";
    }
} else if (isset($_POST['tambahP'])) {
    $id = $_POST['id'];
    $desa = $_POST['desa'];
    $array    	= $desa;
    $newarray 	= explode("|", $array);
    $pet        = $_POST['pet_id'];
    $desa2		= $newarray[2];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $telp = $koneksi->conn->real_escape_string($_POST['telp']);
    $alamat = $koneksi->conn->real_escape_string($_POST['alamat']);
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);
    $foto = $_FILES['foto'];

    $sql = $pos->tambahP($id, $desa2, $pet, $nama, $telp, $alamat, $lat, $lng, $foto);
    if ($sql > 0) {
        echo "<script>alert('Simpan Berhasil');
        window.location='index.php?page=pos'</script>";
    } else {
        echo "<script>alert('Simpan gagal');
        window.location='index.php?page=pos'</script>";
    }
} else if (isset($_POST['ubahP'])) {
    $id = $_POST['id'];
    $desa = $_POST['desa'];
    $array    	= $desa;
    $newarray 	= explode("|", $array);
    $desa2		= $newarray[2];
    $pet  = $_POST['pet_id'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $telp = $koneksi->conn->real_escape_string($_POST['telp']);
    $alamat = $koneksi->conn->real_escape_string($_POST['alamat']);
    $lat = $koneksi->conn->real_escape_string($_POST['lat']);
    $lng = $koneksi->conn->real_escape_string($_POST['lng']);
    $foto = $_FILES['foto'];

    // $sql = "UPDATE tb_pos SET desa_id = '$desa2', user_id = '$pet', pos_nama = '$nama', pos_telp = '$telp', pos_alamat = '$alamat', pos_lat = '$lat', pos_long = '$lng', pos_foto ='$foto' WHERE pos_id = '$id'";

    // print_r($sql);
    $sql = $pos->ubahP($desa2, $pet, $nama, $telp, $alamat, $lat, $lng, $foto, $id);
    if ($sql > 0) {
        echo "<script>alert('Ubah Berhasil');
        window.location='index.php?page=pos'</script>";
    } else {
        echo "<script>alert('Ubah gagal');
        window.location='index.php?page=pos'</script>";
    }
}


?>