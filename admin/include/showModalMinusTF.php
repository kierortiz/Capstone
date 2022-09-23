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
if(!empty($_GET)&&isset($_GET['pid'])){
  $pid = $_GET['pid'];
  $resuser = $conn->query("SELECT * FROM tbl_payment WHERE PAY_ID ='$pid'");
  if($resuser->num_rows>0){
    $rowuser = $resuser->fetch_assoc();
    $user[0] = $rowuser['PAY_NAME'];
    $user[1] = $rowuser['PAY_TYPE'];
    $user[2] = $rowuser['PAY_REMAIN'];
    $user[3] = $rowuser['PAY_UID'];
    ?>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="include/admin-minus-tf-action.php?pid=<?php echo $pid?>" method="POST">
      <div class="container2">
        <h1>Minus Tuition Fee</h1>
        <p>Student ID: <b><?php echo $user[3]?></b></p>
        <p>Student Name: <b><?php echo $user[0]?></b></p>
        <p>Remaining Balance: <b><?=$user[2]?></b></p>
        <br>
        <span>Amount to Minus:</span>
        <input type="number" name="minus_tf" placeholder="Enter Amount" required>
        <br>
        <span>Comment:</span>
        <br>
        <textarea style="height:150px;" name="comment" required></textarea>
        <span>Minus Tuition will deduct the amount to the remaining balance </span>
        <br>
        <span><br>ex. <br>if the student have a remaining balance of 15000 and 2500 is deducted, 12500 will be the final remaining balance of the student. </span>
        <center><input type="submit" name="sub-minus-tf" value="Submit" class="modalsub"></center>
      </div>
    </form>
    <?php
  }
}
?>
