<?php 

require_once "../../config/class.php";
$koneksi = new Database();
$user2 = new User($koneksi);

$id = $_POST['id'];
$nama = $koneksi->conn->real_escape_string($_POST['nama']);

if (isset($_POST['tambah'])) {

    $sql = $user2->tambah("tb_pelanggaran", $id, $nama);
    
    if ($sql > 0) {
        echo "<script>alert('Simpan Berhasil');
        window.location='../index.php?page=pel'</script>";
    } else {
        echo "<script>alert('Simpan gagal');
        window.location='../index.php?page=pel'</script>";
    }
}

if (isset($_POST['ubah'])) {
    $sql = $user2->ubah("tb_pelanggaran", "pelanggaran_nama", $nama, "pelanggaran_id", $id);
    if ($sql > 0) {
        echo "<script>alert('Ubah Berhasil');
        window.location='../index.php?page=pel'</script>";
    } else {
        echo "<script>alert('Ubah gagal');
        window.location='../index.php?page=pel'</script>";
    } 
}



