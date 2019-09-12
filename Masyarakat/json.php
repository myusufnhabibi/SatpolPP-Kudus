<?php

include_once "../config/class.php";
$koneksi = new Database();
$masy = new CRUD($koneksi);
$user= new User($koneksi);

// jika ada parameter yang dilempar dari script index.php
// maka lakukan pencarian
if (isset($_GET['kab'])) {
	$id = $_GET['kab'];
	$sql = "SELECT * from 'tb_pos' WHERE kecamatan_id = '".$id."'";
} else {
	// kalo ga, tampilkan semua lokasi
	$sql = "SELECT * from 'tb_pos'";
}

$data = $koneksi->query($sql);
$json = '{"kec": {';
$json .= '"pos":[ ';
while($x = $data->fetch_assoc()){
	$json .= '{';
	$json .= '"pos_id":"'.$x['id'].'",
		"pos_nama":"'.htmlspecialchars($x['pos_nama']).'",
		"x":"'.$x['pos_lat'].'",
		"y":"'.$x['pos_long'].'"
	},';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';
$json .= '}}';

echo $json;

?>
