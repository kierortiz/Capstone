<?php
include '../../conn.php';
session_start();
if(isset($_GET['id']))
{
  $id = $_GET['id'];
  $sql = "UPDATE tbl_tuition SET STATUS='ACTIVE' WHERE ID='$id'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success_recover']=1;
    header("refresh:0;url=../tuition_arc.php");
  }else{
    $_SESSION['success_recover']=0;
    header("refresh:0;url=../tuition_arc.php");
  }
}
?>
