<?php

require_once "database.php";

class CRUD {
	public $koneksi;

	function __construct($conn) {
		$this->koneksi = $conn;
	}

	public function tanggal_indo($tanggal) {
		$bulan = array (1 =>
							'Januari',
							'Februari',
							'Maret',
							'April',
							'Mei',
							'Juni',
							'July',
							'Agustus',
							'September',
							'Oktober',
							'November',
							'Desember');
		
		$split = explode('-', $tanggal);
		return $split[2].' '. $bulan[(int)$split[1]].' '. $split[0];
	}

	function kode_otomatis($param, $param2, $param3) {
		$db = $this->koneksi->conn;
		$cari = $db->query("SELECT max($param) as kode FROM $param2");
		$ambil = $cari->fetch_assoc();
		$kode = substr($ambil['kode'],3,3);
		
		$tambah = $kode+1;
		// return $tambah;
		if ($tambah < 10) {
			return $id = "$param3"."00".$tambah;
		} else {
			return $id = "$param3"."0".$tambah;
		}
	}

	function kode_daftar($param, $param2, $param3) {
		$db = $this->koneksi->conn;
		$cari = $db->query("SELECT max($param) as kode FROM $param2 WHERE $param LIKE '%$param3%'");
		$ambil = $cari->fetch_assoc();
		$kode = substr($ambil['kode'],3,3);
		
		$tambah = $kode+1;
		// return $tambah;
		if ($tambah < 10) {
			return $id = "$param3"."00".$tambah;
		} else {
			return $id = "$param3"."0".$tambah;
		}
	}

	function kode_laporan($param, $param2, $param3) {
		$db = $this->koneksi->conn;
		$cari = $db->query("SELECT max($param) as kode FROM $param2");
		$ambil = $cari->fetch_assoc();
		$tahun = date('Y');
		$kode = substr($ambil['kode'],8,3);
		
		$tambah = $kode+1;
		// return $tambah;
		if ($tambah < 10) {
			return $id = "$tahun"."-"."$param3"."00".$tambah;
		} else {
			return $id = "$tahun"."-"."$param3"."0".$tambah;
		}
	}

	public function hitungData($tabel) {
		$db = $this->koneksi->conn;
		$query = "SELECT * FROM $tabel";
		$hsl = $db->query($query);
		return $hsl->num_rows;;
	}

	public function tampil($tabel, $key = null, $where = null) {
		$db = $this->koneksi->conn; 
		$query = "SELECT * FROM $tabel";
		if (($key != null) && ($where != null)) {
			$query .= " WHERE $key = '$where'";
		}
		$ambil = $db->query($query) or die ($db->error);

		$rows = [];
		while ($row = $ambil->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	} 
	
	public function upload($paramTujuan) {
		$nama = $_FILES['foto']['name'];
		$error = $_FILES['foto']['error'];
		$tmpName = $_FILES['foto']['tmp_name'];
		$ukuran = $_FILES['foto']['size'];

		$jenisExtensi = ['jpg', 'png', 'jpeg'];
		$pecah = explode('.', $nama);
		$ekstensi = strtolower(end($pecah));
		if (!in_array($ekstensi, $jenisExtensi)) {
		 	echo "<script>alert('Ekstensi Gambar Salah')</script>";
			return false;
		} 

		 if (($error === 1) && ($ukuran === 0)) {
			echo "<script>alert('Ukuran Gambar Terlalu besar')</script>";
			return false;
		}

		$namaFile = uniqid();
		$namaFile .= ".";
		$namaFile .= $ekstensi;

		$patch = $paramTujuan.$namaFile;
		move_uploaded_file($tmpName, $patch);
		return $namaFile;
	}

	public function tambah($tabel, $param1, $param2) {
		$db = $this->koneksi->conn;

		$sql = "INSERT INTO $tabel VALUES('$param1', '$param2')" or die ($db->error());
		$db->query($sql);
		return $db->affected_rows;
	}

	public function ubah($tabel, $param1, $param2, $param3, $param4) {
		$db = $this->koneksi->conn;

		$sql = "UPDATE $tabel SET $param1 = '$param2' WHERE $param3 = '$param4'";
		$db->query($sql);
		return $db->affected_rows;
	}
	
	public function tambahAduan($id, $id_user, $pos, $lokasi, $keterangan, $tgl, $foto, $status, $cek) {
		$db = $this->koneksi->conn; 

		$foto = $this->upload("../Masyarakat/img/aduan/");

		$sql = "INSERT INTO tb_aduan(aduan_id, user_id, pos_id, aduan_lokasi, aduan_keterangan, aduan_tgl, aduan_foto, aduan_status, aduan_cek) VALUES('$id', '$id_user', '$pos', '$lokasi', '$keterangan', '$tgl', '$foto', '$status', '$cek')" or die ($db->error());
		$db->query($sql);
		return $db->affected_rows;
	}

	public function hapus($table, $key, $id) {
		$db = $this->koneksi->conn; 

		$sql = "DELETE FROM $table WHERE $key = '$id'";
		$db->query($sql);
	}

}

class User extends CRUD {
    public $koneksi;
    
    function __construct($conn) {
        $this->koneksi = $conn;
    }

    public function loginUser($user, $pass) {
        $db = $this->koneksi->conn;
        $pass = md5($pass);
        $cek = $db->query("SELECT * FROM tb_user WHERE user_username = '$user' AND user_password = '$pass'") or die ($db->error);
        $pecah = $cek->fetch_assoc();
        $cek2 = $cek->num_rows;

        if ($cek2 == 1) {
			$_SESSION['login'] = TRUE;
            $_SESSION['user_id'] = $pecah['user_id'];
            $_SESSION['user_level']= $pecah['user_level'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
    }

    public function getLevel() {
        return $_SESSION['user_level'];
    }

    public function getSes() {
        return $_SESSION['login'];
	}
	
	public function logOut() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	} 

	public function tambahUser($id, $nama, $tempat, $tgl, $jk, $telp, $alamat, $user, $pass, $level, $foto) {
		$db = $this->koneksi->conn; 

		$foto = $this->upload("../Masyarakat/img/user/");

		$sql = "INSERT INTO tb_user VALUES('$id', '$nama', '$tempat', '$tgl', '$jk', '$telp', '$alamat', '$user', '$pass', '$level', '$foto')" or die ($db->error());
		
		$db->query($sql);
		return $db->affected_rows;		
	}

	public function tambahUser2($id, $nama, $tempat, $tgl, $jk, $telp, $alamat, $user, $pass, $level, $foto) {
		$db = $this->koneksi->conn; 

		$sql = "INSERT INTO tb_user VALUES('$id', '$nama', '$tempat', '$tgl', '$jk', '$telp', '$alamat', '$user', '$pass', '$level', '$foto')" or die ($db->error());
		
		$db->query($sql);
		return $db->affected_rows;		
	}

	public function ubahUser($id, $nama, $username, $pass, $level) {
		$db = $this->koneksi->conn;

		$sql = "UPDATE tb_user SET user_nama='$nama', user_username='$username', user_password='$pass', user_level = '$level' WHERE user_id ='$id'"; 
		$db->query($sql);
		return $db->affected_rows;
	}

}

class Relasi extends CRUD {
	public function tampilR($tabel, $tabel2, $param, $key = null, $param2 = null) {
		$db = $this->koneksi->conn;

		$sql = "SELECT * FROM $tabel INNER JOIN $tabel2 ON $tabel.$param = $tabel2.$param";
		
		if (($key != null) && ($param2 != null)) {
			$sql .= " WHERE $key = '$param2'";
		}
		$ambil = $db->query($sql) or die ($db->error);
		
		$rows = [];
		while ($row = $ambil->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function tampilR2($tabel, $tabel2, $param, $tabel3, $param2, $key = null, $param4 = null) {
		$db = $this->koneksi->conn;

		$sql = "SELECT * FROM $tabel INNER JOIN $tabel2 ON $tabel.$param = $tabel2.$param INNER JOIN $tabel3 ON $tabel3.$param2=$tabel2.$param2";
		
		if (($key != null) && ($param4 != null)) {
			$sql .= " WHERE $key = '$param4'";
		}
		$ambil = $db->query($sql) or die ($db->error);
		
		$rows = [];
		while ($row = $ambil->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function tampilR3($tabel, $tabel2, $param, $tabel3, $param2, $tabel4, $param3, $key = null, $param4 = null) {
		$db = $this->koneksi->conn;

		$sql = "SELECT * FROM $tabel INNER JOIN $tabel2 ON $tabel.$param = $tabel2.$param INNER JOIN $tabel3 ON $tabel3.$param2=$tabel2.$param2 INNER JOIN $tabel4 ON $tabel4.$param3=$tabel2.$param3";
		
		if (($key != null) && ($param4 != null)) {
			$sql .= " WHERE $key = '$param4'";
		}
		$ambil = $db->query($sql) or die ($db->error);
		
		$rows = []; 
		while ($row = $ambil->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function tampilR4($tabel, $tabel2, $param, $tabel3, $param2, $tabel4, $param3, $key = null, $param4 = null) {
		$db = $this->koneksi->conn;

		$sql = "SELECT * FROM $tabel INNER JOIN $tabel2 ON $tabel.$param = $tabel2.$param INNER JOIN $tabel3 ON $tabel3.$param2=$tabel.$param2 INNER JOIN $tabel4 ON $tabel4.$param3=$tabel3.$param3";
		
		if (($key != null) && ($param4 != null)) {
			$sql .= " WHERE $key = '$param4'";
		}
		$ambil = $db->query($sql) or die ($db->error);
		
		$rows = []; 
		while ($row = $ambil->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function tambahR($id, $kecamatan, $nama, $lat, $lng) {
		$db = $this->koneksi->conn;
		$sql = "INSERT INTO tb_desa VALUES('$id', '$kecamatan', '$nama', '$lat', '$lng')";
		$db->query($sql);
		return $db->affected_rows;
	}

	public function ubahR($param, $param0, $param1, $param2, $param3) {
		$db = $this->koneksi->conn;

		$sql = "UPDATE tb_desa SET desa_nama = '$param', desa_lat = '$param0', desa_long = '$param1', kecamatan_id = '$param2' WHERE desa_id = '$param3'";
		$db->query($sql);
		return $db->affected_rows;
	}
}

class Kecamatan extends CRUD {
	
	public function tambahK($p, $q, $r, $f) {
		$db = $this->koneksi->conn;
		$sql = "INSERT INTO tb_kecamatan VALUES('$p', '$q', '$r', '$f')";

		$db->query($sql);
		return $db->affected_rows;
	}

	public function ubahK($param1, $param2, $param3, $param4) {
		$db = $this->koneksi->conn;

		$sql = "UPDATE tb_kecamatan SET kecamatan_nama = '$param1', kecamatan_lat = '$param2', kecamatan_long = '$param3' WHERE kecamatan_id = '$param4'";
		$db->query($sql);
		return $db->affected_rows;
	}
}

class Pos extends CRUD {
	public function tambahP($id, $desa_id, $pet_id, $nama, $telp, $alamat, $lat, $long, $foto) {
		$db = $this->koneksi->conn; 
		
		$foto = $this->upload("pos/img/");
		if (!$foto) {
			return false;
		}

		$sql = "INSERT INTO tb_pos VALUES('$id', '$desa_id', '$pet_id', '$nama', '$telp', '$alamat', '$lat', '$long', '$foto')" or die ($db->error());
		$db->query($sql);
		return $db->affected_rows;	
	}

	public function ubahP($param0, $pet, $param1, $param2, $param3, $param4, $param5, $foto, $param7) {
		$db = $this->koneksi->conn;
		$fotoLama = $_POST['fotoLama'];
		$gb = $this->tampil('tb_pos', 'pos_id', $param7);
		$namafoto = $gb[0]['pos_foto'];

		if ($_FILES['foto']['error'] === 4) {
			$foto = $fotoLama;
		} else {
			$foto = $this->upload("pos/img/");

			if (!$foto) {
				return false;
			} 
			
			if (file_exists("pos/img/$namafoto")) {
		 		unlink("pos/img/$namafoto");
		 	}
		}

		$sql = "UPDATE tb_pos SET desa_id = '$param0', user_id = '$pet', pos_nama = '$param1', pos_telp = '$param2', pos_alamat = '$param3', pos_lat = '$param4', pos_long = '$param5', pos_foto ='$foto' WHERE pos_id = '$param7'";
		$db->query($sql);
		return $db->affected_rows;
	}
}

class Lapor extends CRUD {
	public function tambahL($id, $aduan_id, $pel, $pen, $hasil, $foto) {
		$db = $this->koneksi->conn; 
		
		$foto = $this->upload("hasil/");
		if (!$foto) {
			return false;
		}

		$sql = "INSERT INTO tb_hasil_aduan VALUES('$id', '$aduan_id', '$pel', '$pen', '$hasil', '$foto')" or die ($db->error());
		$db->query($sql);
		return $db->affected_rows;	
	}

	public function cek($cek, $id) {
		$db = $this->koneksi->conn;

		$sql = "UPDATE tb_aduan SET aduan_cek ='$cek' WHERE aduan_id = '$id'";
		$db->query($sql);
		return $db->affected_rows;
	} 
}