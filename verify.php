<?php
include 'conn.php';
if(!empty($_GET))
{
  if(isset($_GET['v_code']))
  {
    $vcode = $_GET['v_code'];
    $sqluid="SELECT * FROM tbl_account WHERE VCODE = '$vcode'";
    $resuid = $conn->query($sqluid);
    if($resuid->num_rows>0){
      $rowuid = $resuid->fetch_assoc();
      $uid = $rowuid['UID'];
      $sqlupd="UPDATE tbl_account SET STATUS = 'ACTIVE' WHERE UID ='$uid'";
      $resupd = $conn->query($sqlupd);
      if($resupd)
      {
        ?>
          <script>
          alert("Successfully Verified Account!");
          </script>
        <?php
        header("refresh:0;url=index.php");
      }else{
        ?>
          <script>
          alert("Query Error!");
          </script>
        <?php
        header("refresh:0;url=index.php");
      }
    }else{
      // ?>
      //   <script>
      //   alert("2!");
      //   </script>
      // <?php
      // header('refresh:0;url=home.php');
    }
  }
}else{
  ?>
    <script>
    alert("1!");
    </script>
  <?php
  header('refresh:0;url=index.php');
}
?>
