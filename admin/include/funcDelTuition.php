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
include '../../conn.php';
if(isset($_GET['id'])&&isset($_GET['page'])){
  $id = $_GET['id'];
  $page = $_GET['page'].".php";
  $sql = "UPDATE tbl_tuition SET STATUS='ARCHIVED' WHERE ID='$id'";
  if($conn->query($sql)){
    $_SESSION['success']=4;
    header("location:../".$page);
  }else{
    $_SESSION['success']=5;
    header("location:../".$page);
  }
}else{
  header("location:../students.php");
}
?>
