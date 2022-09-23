<?php
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
include '../../conn.php';
if(isset($_POST['sub-minus-tf']))
{
  $pid = $_GET['pid'];
  $amount = $_POST['minus_tf'];
  $comment = $_POST['comment'];

}
?>
