<?php 

require_once "../../config/class.php";
$koneksi = new Database();
$user2 = new User($koneksi);

$id = $_POST['id'];
$nama = $koneksi->conn->real_escape_string($_POST['nama']);
$username = $koneksi->conn->real_escape_string($_POST['username']);
$pass = $koneksi->conn->real_escape_string(md5($_POST['pass']));
$level = $koneksi->conn->real_escape_string($_POST['level']);
$tempat = "";
$tgl = "";
$jk = "";
$telp= "";
$alamat ="";
$foto = "";

if (isset($_POST['tambah'])) {

    $sql = $user2->tambahUser2($id, $nama, $tempat, $tgl, $jk, $telp, $alamat, $username, $pass, $level, $foto);
    
    if ($sql > 0) {
        echo "<script>alert('Simpan Berhasil');
        window.location='../index.php?page=user'</script>";
    } else {
        echo "<script>alert('Simpan gagal');
        window.location='../index.php?page=user'</script>";
    }
}

if (isset($_POST['ubah'])) {
    $sql = $user2->ubahUser($id, $nama, $username, $pass, $level);
    if ($sql > 0) {
        echo "<script>alert('Ubah Berhasil');
        window.location='../index.php?page=user'</script>";
    } else {
        echo "<script>alert('Ubah gagal');
        window.location='../index.php?page=user'</script>";
    } 
}



