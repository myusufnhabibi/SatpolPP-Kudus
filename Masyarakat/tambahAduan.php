<?php 
	session_start();
	include_once "../config/class.php";

	$koneksi = new Database();
	$aduan = new CRUD($koneksi);
	$Cuser = new User($koneksi);

	$pesan = array();
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
 ?>