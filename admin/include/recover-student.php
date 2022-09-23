<?php
include '../../conn.php';
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
if(!empty($_GET['sid']))
{
  $sid = $_GET['sid'];
  $sql = "UPDATE tbl_account SET STATUS='ACTIVE' WHERE UID=$sid";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success']=1;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Recovered Account of SID $sid', NOW())");
    header("refresh:0;url=../acc_arc.php");
  }else{
    $_SESSION['success']=0;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed To Recover Account of SID $sid', NOW())");
    header("refresh:0;url=../acc_arc.php");
  }
}
?>
