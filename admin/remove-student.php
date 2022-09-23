<?php
session_start();
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //When Not Login Return to this Page
    // header("refresh:0; Home.php#open-login");
    ?>
    <script>
        // alert("No Item Selected");
    window.location.href = '../index.php#loginmodal';
    </script>
<?php
    exit;
}
include '../conn.php';
if(isset($_GET['sid'])){
  $sid = $_GET['sid'];
  $sql = "UPDATE tbl_account SET STATUS='ARCHIVED' WHERE UID='$sid'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['success2']=1;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Successfully Removed Account of SID $sid', NOW())");
    header("location:accounts.php");
  }else{
    $_SESSION['success2']=0;
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Failed To Remove Account of SID $sid', NOW())");
    header("location:accounts.php");
  }
}
?>
