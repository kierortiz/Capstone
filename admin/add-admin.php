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
if(isset($_POST['sub-add']))
{
  $name = $_POST['name'];
  $addr = $_POST['addr'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $gen = $_POST['gen'];
  $bdate = $_POST['bdate'];
  $pass = $_POST['pass'];
  $rpass = $_POST['rpass'];
  $position = $_POST['position'];

  $name=stripcslashes($name);
  $addr=stripcslashes($addr);
  $contact=stripcslashes($contact);
  $email=stripcslashes($email);
  $gen=stripcslashes($gen);
  $bdate=stripcslashes($bdate);
	$pass=stripcslashes($pass);
	$rpass=stripcslashes($rpass);
  $position=stripcslashes($position);

  $name = mysqli_real_escape_string($conn, $name);
  $addr = mysqli_real_escape_string($conn, $addr);
	$contact = mysqli_real_escape_string($conn, $contact);
  $user = mysqli_real_escape_string($conn, $user);
  $pass = mysqli_real_escape_string($conn, $pass);
	$rpass = mysqli_real_escape_string($conn, $rpass);
  $position = mysqli_real_escape_string($conn, $position);

  $sql = "SELECT * FROM tbl_account WHERE EMAILADD = '$email'";
  $res = $conn->query($sql);
  if($res->num_rows>0)
  {
    $_SESSION['s_add']=2;
    header("location:add_acc.php");
  }else{
    $sql1 = "SELECT * FROM tbl_admin WHERE ADMIN_EMAIL = '$email'";
    $res1 = $conn->query($sql1);
    if($res1->num_rows>0)
    {
      header("location:add_acc.php?s_add=2");
    }else{
      if($pass == $rpass){
        $sql2 = "INSERT INTO tbl_admin(ADMIN_NAME,ADMIN_ADDRESS,ADMIN_CONTACT,ADMIN_EMAIL,ADMIN_GENDER,ADMIN_BIRTHDAY,ADMIN_PASSWORD,ADMIN_POSITION,ADMIN_STATUS)values('$name','$addr','$contact','$email','$gen','$bdate','$pass','$position','ACTIVE')";
        $res2 = $conn->query($sql2);
        if($res2)
        {
          $_SESSION['s_add']=1;
          header("location:add_acc.php");
        }else{
          $_SESSION['s_add']=0;
          header("location:add_acc.php");
        }
      }else{
        $_SESSION['s_add']=3;
        header("location:add_acc.php");
      }
    }
  }
}
?>
