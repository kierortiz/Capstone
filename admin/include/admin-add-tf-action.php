<?php
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
include '../../conn.php';
if(isset($_POST['sub-add-tf']))
{
  $uid = $_GET['uid'];
  $amount = $_POST['add_tf'];
  $comment = $_POST['comment'];
  $amount=stripcslashes($amount);
  $amount = mysqli_real_escape_string($conn, $amount);
  $comment=stripcslashes($comment);
  $comment = mysqli_real_escape_string($conn, $comment);
  if(!isset($_POST['action']))
  {
    $sql = "SELECT * FROM tbl_payment WHERE PAY_UID = '$uid'";
    $res = $conn->query($sql);
    if($res->num_rows>0){
      $row = $res->fetch_assoc();
      $remaining = $row['PAY_REMAIN'];
      $newRemaining=$remaining+$amount;
      $res1=$conn->query("UPDATE tbl_payment SET PAY_REMAIN='$newRemaining' WHERE PAY_UID='$uid'");
      $res2=$conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Add Tuition Fee to PAY_UID=$uid for an Amount:$amount, Comment: $comment', NOW())");
      if($res1&&$res2){
        $_SESSION['payment_message']="Successfully Added Tuition Fee!";
        $_SESSION['payment_title']="Success!";
        $_SESSION['payment_icon']="success";
        header("location:../payment.php");
      }else{
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed to Add Tuition Fee', NOW())");
        $_SESSION['payment_message']="Failed To Add Tuition Fee!";
        $_SESSION['payment_title']="Error!";
        $_SESSION['payment_icon']="error";
        header("location:../payment.php");
      }
    }else{
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE PAY_ID NOT FOUND', NOW())");
      $_SESSION['payment_message']="Pay ID not found!";
      $_SESSION['payment_title']="Error!";
      $_SESSION['payment_icon']="error";
      header("location:../payment.php");
    }
  }else{
    $sql = "SELECT * FROM tbl_payment WHERE PAY_UID = '$uid'";
    $res = $conn->query($sql);
    if($res->num_rows>0){
      $row = $res->fetch_assoc();
      $remaining = $row['PAY_REMAIN'];
      $totalpaid = $row['PAY_AMOUNT'];
      $newTotalPayment = $totalpaid + $amount;
      $newRemaining=$remaining-$amount;
      $res1=$conn->query("UPDATE tbl_payment SET PAY_AMOUNT='$newTotalPayment',PAY_REMAIN='$newRemaining' WHERE PAY_UID='$uid'");
      if($res1){
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Minus Tuition Fee for $amount, Total Paid Amout:$totalpaid, Remaining Balance:$newRemaining,Comment:$comment', NOW())");
        $_SESSION['payment_message']="Successfully Minus Tuition Fee!";
        $_SESSION['payment_title']="Success!";
        $_SESSION['payment_icon']="success";
        header("location:../payment.php");
      }else{
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed to Minus Tuition Fee', NOW())");
        $_SESSION['payment_message']="Failed To Minus Tuition Fee!";
        $_SESSION['payment_title']="Error!";
        $_SESSION['payment_icon']="error";
        header("location:../payment.php");
      }
    }else{
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE PAY_ID NOT FOUND', NOW())");
      $_SESSION['payment_message']="Pay ID not found!";
      $_SESSION['payment_title']="Error!";
      $_SESSION['payment_icon']="error";
      header("location:../payment.php");
    }
  }


}
?>
