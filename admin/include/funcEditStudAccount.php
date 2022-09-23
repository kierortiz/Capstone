<?php
include '../../conn.php';
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
if(isset($_POST['sub_edit_account_student']))
{
  $uid = $_POST['uid'];
  $lrn = $_POST['lrn'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $bdate = $_POST['bdate'];
  $bplace = $_POST['bplace'];
  $religion = $_POST['religion'];
  $year = $_POST['year'];
  $plan = $_POST['plan'];
  $section = $_POST['section'];

  $uid=stripcslashes($uid);
  $uid = mysqli_real_escape_string($conn, $uid);
  $lrn=stripcslashes($lrn);
  $lrn = mysqli_real_escape_string($conn, $lrn);
  $fname=stripcslashes($fname);
  $fname = mysqli_real_escape_string($conn, $fname);
  $mname=stripcslashes($mname);
  $mname = mysqli_real_escape_string($conn, $mname);
  $lname=stripcslashes($lname);
  $lname = mysqli_real_escape_string($conn, $lname);
  $address=stripcslashes($address);
  $address = mysqli_real_escape_string($conn, $address);
  $gender=stripcslashes($gender);
  $gender = mysqli_real_escape_string($conn, $gender);
  $contact=stripcslashes($contact);
  $contact = mysqli_real_escape_string($conn, $contact);
  $bdate=stripcslashes($bdate);
  $bdate = mysqli_real_escape_string($conn, $bdate);
  $bplace=stripcslashes($bplace);
  $bplace = mysqli_real_escape_string($conn, $bplace);
  $religion=stripcslashes($religion);
  $religion = mysqli_real_escape_string($conn, $religion);
  $year=stripcslashes($year);
  $year = mysqli_real_escape_string($conn, $year);
  $plan=stripcslashes($plan);
  $plan = mysqli_real_escape_string($conn, $plan);
  $section=stripcslashes($section);
  $section = mysqli_real_escape_string($conn, $section);

  $sql = "UPDATE tbl_account SET LRN = '$lrn',FIRSTNAME = '$fname', MIDDLENAME = '$mname', LASTNAME = '$lname',
          ADDRESS = '$address', GENDER = '$gender', CONTACTNO = '$contact', BIRTHDATE = '$bdate',
          BIRTHPLACE = '$bplace', RELIGION = '$religion', YEARLEVEL = '$year', PLAN = '$plan',
          SECTION = '$section' WHERE UID = '$uid'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success']=1;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Edited Account of SID $sid', NOW())");
    header("refresh:0;url=../accounts.php");
  }else{
    $_SESSION['success']=0;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed To Edit Account of SID $sid', NOW())");
    header("refresh:0;url=../accounts.php");
  }
}
?>
