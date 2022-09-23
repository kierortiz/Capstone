<?php
session_start();

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
if(isset($_GET['grade'])&&isset($_GET['section'])&&$_GET['summer']){
  $grade = $_GET['grade'];
  $section = $_GET['section'];
  $summer = $_GET['summer'];
  $sql = "UPDATE tbl_subjects SET SUB_STATUS='ACTIVE' WHERE SUB_YEAR='$grade' AND SUB_SECTION='$section' AND SUB_SUMMER='$summer'";
  $res = $conn->query($sql);
  if($res){
    $_SESSION['s_recover_subject']=1;
    header("location:subj_arc.php");
  }else{
    $_SESSION['s_recover_subject']=0;
    header("location:subj_arc.php");
  }
}
?>
