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
if(isset($_GET['uid']))
{
  $uid = $_GET['uid'];
  $sqlgetuserdata = "SELECT * FROM tbl_documents WHERE DOC_STUDID = '$uid' AND DOC_STATUS = 'PENDING'";
  $resgetuserdata = $conn->query($sqlgetuserdata);
  $userDocuDetails=array();
  $userTotalDocu=0;
  $sqlgetname = "SELECT * FROM tbl_account WHERE UID ='$uid'";
  $resgetname = $conn->query($sqlgetname);
  $rowgetname=$resgetname->fetch_assoc();
  $lrn = $rowgetname['LRN'];
  $username = $rowgetname['FIRSTNAME']." ".$rowgetname['MIDDLENAME']." ".$rowgetname['LASTNAME'];
  $statusUser=$rowgetname['STATUS'];
  $registerStat=$rowgetname['REGISTER'];
  $summer = $rowgetname['SUMMER'];
  if($summer == "Yes"){
    $summer = "SUMMER CLASS";
  }else{
    $summer = "REGULAR CLASS";
  }
  if($resgetuserdata->num_rows>0)
  {
    while($rowgetuserdata = $resgetuserdata->fetch_assoc())
    {
      $userDocuDetails[$userTotalDocu][0]=$rowgetuserdata['DOC_TYPE'];
      $userDocuDetails[$userTotalDocu][1]=$rowgetuserdata['DOC_DATE'];
      $userDocuDetails[$userTotalDocu][2]=$rowgetuserdata['DOC_STATUS'];
      $userDocuDetails[$userTotalDocu][3]=$rowgetuserdata['DOC_IMAGE'];
      $userTotalDocu++;
    }
    ?>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="admin-docu-action.php?uid='<?php echo $uid?>'" method="POST">
      <div class="container2">
        <h1>Document</h1>
        <input type="text" name="lrn" value="<?=$lrn?>" style="display:none;"hidden>
        <p>LRN: <b><?=$lrn?></b></p>
        <p>Student ID:  <b><?php echo $uid?></b></p>
        <p>Student Name: <b><?php echo $username?></b></p>
        <p>Status: <b><?=$statusUser.", ".$registerStat?></b></p>
        <p>Class: <b><?=$summer?></b></p>
    <?php

    for($i=0;$i<$userTotalDocu;$i++)
    {
      $commentname = "comment".$i;
      $optionname="options".$i;
      $docuname = "document".$i;
      ?>
        <center>
          <input type="text" style="visibility:hidden;" name="<?php echo $docuname?>" value="<?php echo $userDocuDetails[$i][0]?>" >
          <p>Document Name: <b><?php echo $userDocuDetails[$i][0]." (".$userDocuDetails[$i][2].")"?></b></p>
          <br>
          <div class="clearfix">
            <img src="../assets/document/<?php echo $userDocuDetails[$i][3]?>" style="width:80%;height:auto;cursor:pointer;" onclick="window.open(this.src, '_blank');"/></div>
          <br>
        </center>
          <?php
          if($userDocuDetails[$i][2]=="ACCEPTED"||$userDocuDetails[$i][2]=="DENIED")
          {
          }else if($userDocuDetails[$i][2]=="PENDING"){
            ?>
            <select name="<?php echo $optionname?>" id="<?php echo $optionname?>" onchange="removeReq(<?php echo $i?>)">
              <option value="Accept">Accept</option>
              <option value="Deny">Deny</option>
            </select>
            <?php
            if($userDocuDetails[$i][0]=="Grade")
            {
              ?>
              <p>Average</p>
              <input name="inp-grade" id="inp-grade" type="number" placeholder="Enter Average" max="100" min="75" required>
              <?php
            }
            ?>
            <p>Comment</p>
            <textarea disabled id="<?php echo $commentname?>" name="<?php echo $commentname?>" style="resize:none;" minlength="10" maxlength="200"></textarea>
            <?php
          }
    }
    ?>
    <center><input type="submit" name="sub-docu" value="Submit" class="modalsub"></center>
  </div>
  </form>
  <?php
}else{
  $sqlgetallaccepted="SELECT * FROM tbl_documents WHERE DOC_STUDID = '$uid' AND DOC_STATUS = 'ACCEPTED'";
  $resaccepted = $conn->query($sqlgetallaccepted);
  if($resaccepted->num_rows>0)
  {
    ?>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="admin-docu-action.php?uid='<?php echo $uid?>'" method="POST">
      <div class="container2">
        <h1>Document</h1>
        <p>Student ID: <b><?php echo $uid?></b></p>
        <p>Student Name: <b><?php echo $username?></b></p>
        <p>Status: <b><?=$statusUser.", ".$registerStat?></b></p>
        <p>Class: <b><?=$summer?></b></p>
        <br>
        <center>
    <?php
    while($rowaccepted = $resaccepted->fetch_assoc())
    {
      ?>
      <br>
      <br>
      <p>Document Name: <b><?php echo $rowaccepted['DOC_TYPE']." (".$rowaccepted['DOC_STATUS'].")"?></b></p>
      <br>
      <img src="../assets/document/<?php echo $rowaccepted['DOC_IMAGE']?>" style="width:80%;height:auto;cursor:pointer;" onclick="window.open(this.src, '_blank');"/>
      <br>
      <?php
    }
    ?>
    </div>
    </form>
    <?php
  }
}
}else{
  echo "Try";
}
?>

</center>
