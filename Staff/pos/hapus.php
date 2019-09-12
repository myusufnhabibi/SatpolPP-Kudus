<?php 

 $id = $_GET['id'];
 $gb = $user->tampil('tb_pos', 'pos_id', $id);
 $namafoto = $gb[0]['pos_foto'];
 if (file_exists("pos/img/$namafoto")) {
    unlink("pos/img/$namafoto");
}

 $user->hapus('tb_pos', 'pos_id', $id); 
 echo "<script>window.location='?page=pos'</script>"; 

?>