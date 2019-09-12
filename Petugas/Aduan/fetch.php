<?php
//fetch.php;
if(isset($_POST["view"]))
{
$connect = mysqli_connect("localhost", "root", "", "pkl_satpolpp");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE tb_aduan SET aduan_status=1 WHERE aduan_status=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM tb_aduan INNER JOIN tb_user ON tb_aduan.user_id=tb_user.user_id ORDER BY aduan_id DESC LIMIT 5";
 $result = mysqli_query($connect, $query);
 $output = '<li>
 <p class="green"></p>
</li';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <div class="notify-arrow notify-arrow-green"></div>
   <li>
      <a href="?page=aduan">
        <span class="photo"><img alt="avatar" src="../masyarakat/img/user/'.$row["user_foto"].'"></span>      
        <span class="subject">
        <span class="from">'.$row["user_nama"].'</span>
        </span>
        <span class="message">
        '.substr($row["aduan_keterangan"], 0,29).'...
        </span>
      </a>
    </li>

   ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM tb_aduan WHERE aduan_status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>