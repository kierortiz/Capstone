
<?php
session_start();
include 'conn.php';
if(!empty($_GET))
{
  $email = $_GET['email'];
}
if(isset($_POST['sub_change_pass']))
{
  $npass = $_POST['npass'];
  $rpass = $_POST['rpass'];
  if($npass == $rpass)
  {
    $sql = "UPDATE tbl_account SET PASSWORD='$npass' WHERE EMAILADD='$email'";
    if($conn->query($sql)){
      //success
      $_SESSION['change_pass']=1;
      header("refresh:0;url=index.php");
    }else{
      //error
      $_SESSION['change_pass']=0;
      header("refresh:0;url=index.php");
    }
  }else{
    ?>
    <script>
      alert("Password and Re-enter New Password does not match!");
    </script>
    <?php
  }

}
?>
<html>

<body>
  <form method="POST" action="forgot.php?email=<?=$email?>">
    <input type="password" name="npass" placeholder="Enter New Password" maxlength="16" minlength="8" required><br>
    <input type="password" name="rpass" placeholder="Re-enter New Password" maxlength="16" minlength="8" required><br>
    <input type="submit" name="sub_change_pass">
  </form>
</body>
</html>
