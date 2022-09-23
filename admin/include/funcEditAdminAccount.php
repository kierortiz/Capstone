<?php
include '../../conn.php';
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
if(isset($_POST['sub_edit_account_admin']))
{
  $aid = $_POST['aid'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  $bday = $_POST['bday'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $pos = $_POST['pos'];

  $aid=stripcslashes($aid);
  $aid = mysqli_real_escape_string($conn, $aid);
  $name=stripcslashes($name);
  $name = mysqli_real_escape_string($conn, $name);
  $address=stripcslashes($address);
  $address = mysqli_real_escape_string($conn, $address);
  $bday=stripcslashes($bday);
  $bday = mysqli_real_escape_string($conn, $bday);
  $gender=stripcslashes($gender);
  $gender = mysqli_real_escape_string($conn, $gender);
  $contact=stripcslashes($contact);
  $contact = mysqli_real_escape_string($conn, $contact);
  $pos=stripcslashes($pos);
  $pos = mysqli_real_escape_string($conn, $pos);

  $sql = "UPDATE tbl_admin SET ADMIN_NAME = '$name', ADMIN_ADDRESS = '$address',
          ADMIN_BIRTHDAY = '$bday', ADMIN_GENDER = '$gender', ADMIN_CONTACT = '$contact',
          ADMIN_POSITION = '$pos' WHERE ADMIN_ID = $aid";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success1']=1;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Edited Account of AID $aid', NOW())");
    header("refresh:0;url=../accounts.php");
  }else{
    $_SESSION['success1']=0;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed To Edit Account of AID $aid', NOW())");
    header("refresh:0;url=../accounts.php");
  }
}
?>
