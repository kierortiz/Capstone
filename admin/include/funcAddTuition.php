<?php
session_start();
include '../../conn.php';
if(isset($_POST['sub_add_tuition']))
{
  $page = $_GET['page'].".php";
  $plan = "Plan ".$_POST['plan'];
  $grade = "Grade ".$_POST['grade'];
  $tf = $_POST['tf'];
  $misc = $_POST['misc'];
  $book = $_POST['book'];
  $noOfBooks = $_POST['noOfBooks'];
  $add = $_POST['add'];
  $summer = $_POST['summer']; //Edit 6 Single line
  $sumid = $_POST['sumstudid']; //Edit 6 Single line

  $plan=stripcslashes($plan);
  $plan = mysqli_real_escape_string($conn, $plan);
  $grade=stripcslashes($grade);
  $grade = mysqli_real_escape_string($conn, $grade);
  $tf=stripcslashes($tf);
  $tf = mysqli_real_escape_string($conn, $tf);
  $misc=stripcslashes($misc);
  $misc = mysqli_real_escape_string($conn, $misc);
  $book=stripcslashes($book);
  $book = mysqli_real_escape_string($conn, $book);
  $noOfBooks=stripcslashes($noOfBooks);
  $noOfBooks = mysqli_real_escape_string($conn, $noOfBooks);
  $add=stripcslashes($add);
  $add = mysqli_real_escape_string($conn, $add);
  $summer=stripcslashes($summer);
  $summer = mysqli_real_escape_string($conn, $summer);
  $sumid=stripcslashes($sumid);
  $sumid = mysqli_real_escape_string($conn, $sumid);

  if ($sumid == '')//Edit 6
  {
    $sumid = 0;
  } //edit 6
  if(empty($add)){
    $add=0;
  }
  $sql = "INSERT INTO tbl_tuition(PLAN,YEARLEVEL,TUITIONFEE,MISC,BOOKS,NO_OF_BOOKS,ADDITIONAL,STATUS,SUMMER,SUMSTUD) values('$plan','$grade',$tf,$misc,$book,$noOfBooks,$add,'ACTIVE','$summer','$sumid')"; //Edit 6 Single line add values
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success']=1;
    header("refresh:0;url=../".$page);
  }else{
    $_SESSION['success']=0;
    header("refresh:0;url=../".$page);
  }
}
?>
