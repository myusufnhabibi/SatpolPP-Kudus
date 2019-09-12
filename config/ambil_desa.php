<?php

require_once "class.php";
$idKec = $_POST['kecamatan_id'];
$conn = new Database();
$data = new CRUD($conn);

$hasil = $data->tampil("tb_desa", "kecamatan_id", $idKec);

echo "<option>-- Pilih Desa --</option>";

foreach ($hasil as $a) { ?>
    <option value="<?= $a['desa_lat']."|".$a['desa_long']."|".$a['desa_id'] ?>"><?= $a['desa_nama'] ?></option>
<?php } ?>

?>