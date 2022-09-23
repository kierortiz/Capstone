<?php
include '../../conn.php';
session_start();
if(isset($_POST['sub_edit_tuition']))
{
  $id = $_GET['id'];
  $tf = $_POST['tf'];
  $page = $_GET['page'].".php";
  $misc = $_POST['misc'];
  $noOfBooks = $_POST['noOfBooks'];
  $books = $_POST['books'];
  $add = $_POST['add'];

  $tf=stripcslashes($tf);
  $tf = mysqli_real_escape_string($conn, $tf);
  $misc=stripcslashes($misc);
  $misc = mysqli_real_escape_string($conn, $misc);
  $noOfBooks=stripcslashes($noOfBooks);
  $noOfBooks = mysqli_real_escape_string($conn, $noOfBooks);
  $books=stripcslashes($books);
  $books = mysqli_real_escape_string($conn, $books);
  $add=stripcslashes($add);
  $add = mysqli_real_escape_string($conn, $add);

  if(empty($add)){
    $add=0;
  }
  $sql = "UPDATE tbl_tuition SET TUITIONFEE=$tf, MISC = $misc,NO_OF_BOOKS=$noOfBooks,BOOKS = $books,ADDITIONAL=$add WHERE ID='$id'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success']=2;
    header("refresh:0;url=../".$page);
  }else{
    $_SESSION['success']=3;
    header("refresh:0;url=../".$page);
  }
}
?>
