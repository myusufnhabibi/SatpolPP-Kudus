<?php
  include_once "../config/class.php";
  $koneksi = new Database();
  $masy = new CRUD($koneksi);
$Q = mysqli_query($koneksi, "SELECT * FROM tb_pos")or die(mysqli_error());
if($Q){
 $posts = array();
      if(mysqli_num_rows($Q))
      {
             while($post = mysqli_fetch_assoc($Q)){
                     $posts[] = $post;
             }
      }  
      $data = json_encode(array('results'=>$posts));
      echo $data;                     
}

?>