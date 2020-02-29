<?php session_start(); ?>
<?php
  require_once('libs/functions.php');
?>
<?php

  $loggedin_user_id=$_SESSION['loggedin_user_id'];?>

<?php
//fetch.php;
if(isset($_POST["view"]))
{
$connect = mysqli_connect("localhost", "root", "", "pizza");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE `orders` SET admin_view=1 WHERE admin_view=0";
  mysqli_query($connect, $update_query);
 }
 
 $query_1 = "SELECT * FROM `orders` WHERE admin_view=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>