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
if(isset($_GET['uid'])&&isset($_GET['type']))
{
  $uid = $_GET['uid'];
  $type = $_GET['type'];
  $inp="";
  $hidden="hidden";
  $src = "";
  if($type=="grade")
  {
    $inp = "Grade";
    $hidden="";
  }else if($type=="payment")
  {
    $inp = "Payment";
    $hidden="";
  }else if($type=="birth")
  {
    $inp = "Birth Certificate";
  }else if($type=="good")
  {
    $inp = "Good Moral";
  }else if($type=="med")
  {
    $inp = "Medical Certificate";
  }

  $sql = "SELECT * FROM tbl_documents WHERE DOC_STUDID='$uid' AND DOC_TYPE='$inp'";
  $res=$conn->query($sql);
  if($res->num_rows>0)
  {
    $row = $res->fetch_assoc();
    if($type=="payment")
    {
      $src="proofOfPayment/".$row['DOC_IMAGE'];
    }else{
      $src="document/".$row['DOC_IMAGE'];
    }

    ?>
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="accounts.php" method="POST" enctype="multipart/form-data">
        <div class="container2">
          <h1>Add Document</h1><br>
          <label>Type of document:</label><br>
          <input type="text" name="type" value="<?php echo $inp?>" readonly>
          <label>Student ID:</label><input type="text" value="<?php echo $uid?>" name="uid" readonly>
          <img src="../assets/<?php echo $src?>"  style="width:100%;height:400px;">
        </div>
      </form>
      <?php
  }else{
    ?>
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="accounts.php" method="POST" enctype="multipart/form-data">
        <div class="container2">
          <h1>Add Document</h1><br>
          <label>Type of document:</label><br>
          <input type="text" class="infocus" name="type" value="<?php echo $inp?>" readonly>
          <label>Student ID:</label><input type="text" class="infocus" value="<?php echo $uid?>" name="uid" readonly>
          <img src="../assets/document/<?php echo $src?>" id="output" style="width:100%;height:400px;">
          <center> <input type="file" required id="upload2" name="image" accept="image/*" onchange="loadFile(event)"> </center>

          <?php
          if($type=="grade" || $type=="payment")
          {
            ?>
            <label id="detail" style="visibility:<?php echo $hidden?>"><?php echo $inp?>:</label>
            <input type="text" name="inp-admin" style="visibility:<?php echo $hidden?>" required>
            <?php
          }
          ?>
          <center><input type="submit" value="Submit" name="sub-document" class="modalsub"></center>
        </div>
      </form>
      <?php
  }
}
?>
