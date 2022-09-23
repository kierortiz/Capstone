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
if(!empty($_GET)&&isset($_GET['pid'])){
  $pid = $_GET['pid'];
  $hideBalance="hidden";//for show tuition balance
  $hide="";
  $resuser = $conn->query("SELECT * FROM tbl_payment WHERE PAY_ID ='$pid'");
  if($resuser->num_rows>0){
    $rowuser = $resuser->fetch_assoc();
    $user[0] = $rowuser['PAY_NAME'];
    $user[1] = $rowuser['PAY_TYPE'];
    $user[2] = $rowuser['PAY_DATE'];
    $user[3] = $rowuser['PAY_IMAGE'];
    $user[4] = $rowuser['PAY_STATUS'];
    $user[5] = $rowuser['PAY_UID'];
    $user[6] = $rowuser['PAY_REMAIN'];
    $user[7] = $rowuser['PAY_COMMENT'];
    if($user[7] == ""){
      //for enrolling
      $action = "admin-proof-action";
    }else{
      //for enrolled
      $action = "admin-proof-action1";
    }
    $status = $rowuser['PAY_STATUS'];
    if($status=="ACCEPTED"){
      $hide="none";
    }else if($status=="DENIED"){
      $hide="none";
    }
    ?>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="<?=$action?>.php?pid=<?php echo $pid?>" method="POST">
      <div class="container2">
        <h1>Proof Of Payment</h1>
        <p>Student ID: <b><?php echo $user[5]?></b></p>
				<p>Student Name: <b><?php echo $user[0]?></b></p>
				<p>Plan: <b><?php echo $user[1]?></b></p>
				<p>Date Sent: <b><?php echo $user[2]?></b></p>
				<p>Status: <b><?php echo $user[4]?></b></p>
        <p>Balance: <b><?php echo $user[6]?></b></p>
        <p>Message: <b><?php echo $user[7]?></b></p>
        <!-- <a href="#"<?=$hideBalance?>>Show Tuition Balance</a><br> -->
        <br>
        <center>
        <div class="clearfix">
          <img src="../assets/proofOfPayment/<?php echo $user[3]?>" style="width:80%;height:auto;cursor:pointer;" onclick="window.open(this.src, '_blank');"/>
        </div>
        <br>
        </center>
        <input type="number" placeholder="Enter Payment" id="inppay"required name="payment" max="<?=$user[6]?>" min="0" style="display:<?=$hide?>">

        <select name="options" id="options" onchange="removeReq()" style="display:<?=$hide?>">
          <option value="Accept">Accept</option>
          <option value="Deny">Deny</option>
        </select>
        <center><input type="submit" name="sub-proof" value="Submit" class="modalsub" style="display:<?=$hide?>"></center>
      </div>
    </form>
    <?php
  }
}
?>
