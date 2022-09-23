<?php
session_start();
include '../conn.php';
$uid = $_SESSION['UID'];
$lrn = "";
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$studname=$fname." ".$mname." ".$lname;
$gen = $_POST['gen'];
$addr = $_POST['addr'];
$bdate = $_POST['bdate'];
$bplace = $_POST['bplace'];
$contact = "+63".$_POST['contact'];
$religion = $_POST['religion'];
$grade = $_POST['grade'];
$summer = $_POST['summer'];

if(!empty($_POST['lrn']))
{
  $lrn = $_POST['lrn'];
}

if(isset($_POST['new']))
{
  $new = "NEW";
}else{
  $new = "OLD";
}

//student is counted as old if he/she is taking a summer class
if($summer == "Yes"){
  $new = "OLD";
}

$sql = "UPDATE tbl_account SET LRN='$lrn', FIRSTNAME = '$fname',MIDDLENAME='$mname',LASTNAME='$lname',
GENDER='$gen',ADDRESS='$addr',CONTACTNO='$contact',BIRTHDATE='$bdate',OLDORNEW='$new',
RELIGION='$religion',YEARLEVEL='$grade',REGISTER='ENROLLING',BIRTHPLACE='$bplace',SUMMER = '$summer' WHERE UID = '$uid'";

$res=$conn->query($sql);
if($res){
  $_SESSION['s_enroll']=1;
  $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname-$uid has Successfully Fill up Registration Form.', NOW())");
  header("location:progress.php");
}else{
  $_SESSION['s_enroll']=0;
  $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname-$uid has Error While Sending Registration Form.', NOW())");
  header("location:progress.php");
}

?>
