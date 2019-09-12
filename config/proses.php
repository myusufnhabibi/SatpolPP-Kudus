<?php 

session_start();
include_once "class.php";

$koneksi = new Database();
$aduan = new CRUD($koneksi);
$Cuser = new User($koneksi);

$page = @$_GET['page'];
if  ($page == 'login') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $Cuser->loginUser($_POST['user'], $_POST['pass']);
        if ($login) {
            if ($_SESSION['user_level'] == "staf") {
                echo "<script>window.location='../staff/index.php'</script>";
            } else if ($_SESSION['user_level'] == "pet") {
                echo "<script>window.location='../petugas/index.php'</script>";
            } else if ($_SESSION['user_level'] == "kep") {
                echo "<script>window.location='../kasat/index.php'</script>";
            } else if ($_SESSION['user_level'] == "masy") {
                echo "<script>window.location='../masyarakat/index.php'</script>";
            }
        } else {
            echo "<script>window.location='../login_error.php'</script>";
        }
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $id_user = $_POST['id_user'];
    $lokasi = $koneksi->conn->real_escape_string($_POST['lokasi']);
    $keterangan = $koneksi->conn->real_escape_string($_POST['keterangan']);
    $pos = $_POST['pos'];
    $tgl = $_POST['tgl'];
    $foto = $_FILES['foto'];
    $status = 0;
    $cek = null;
    $sql = $aduan->tambahAduan($id, $id_user, $pos, $lokasi, $keterangan, $tgl, $foto, $status, $cek);
} 

if (isset($_POST['submit'])) {
    $id = $_POST['id_user'];
    $nama = $koneksi->conn->real_escape_string($_POST['nama']);
    $tempat = $koneksi->conn->real_escape_string($_POST['tempat']);
    $tgl = $koneksi->conn->real_escape_string($_POST['tgl']);
    $jk = $koneksi->conn->real_escape_string(@$_POST['jk']);
    $telp = $koneksi->conn->real_escape_string($_POST['telp']);
    $alamat = $koneksi->conn->real_escape_string($_POST['alamat']);
    $user = $koneksi->conn->real_escape_string($_POST['user']);
    $pass = $koneksi->conn->real_escape_string(md5($_POST['pass']));
    $level = $koneksi->conn->real_escape_string($_POST['level']);
    $foto = $_FILES['foto'];

    $query = "SELECT * FROM tb_user WHERE user_username = '$user'";
    $cek = $koneksi->conn->query($query);
    $cek2 = $cek->num_rows;

    if ($cek2 == 1 ) {
        echo "<script>alert('Pendaftaran gagal, Username sudah dipake');
        window.location='../masyarakat/index.php?page=daftar'</script>";
        return false;
    } else {
        $sql = $Cuser->tambahUser($id, $nama, $tempat, $tgl, $jk, $telp, $alamat, $user, $pass, $level, $foto);

        if ($sql > 0) {
            echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');
            window.location='../index.php'</script>";
        } else {
            echo "<script>alert('Pendaftaran gagal');
            window.location='../masyarakat/index.php?page=daftar'</script>";
        }
    }
}