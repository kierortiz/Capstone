<?php
session_start();
include '../conn.php';
if(isset($_POST['sub-plan']))
{
  $uid = $_SESSION['UID'];
  $plan = $_POST['plan'];
  $studname = $_SESSION['STUD_NAME'];
  $sql = "UPDATE tbl_account SET PLAN='$plan' WHERE UID = '$uid'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['s_plan']=1;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$uid-$studname has Successfully Picked Plan of Payment', NOW())");
    header("location:progress.php");
  }else{
    $_SESSION['s_plan']=0;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$uid-$studname has Error While Picking Plan of Payment', NOW())");
    header("location:progress.php");
  }
}
?>
