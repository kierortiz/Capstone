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
  $grade = $rowgetname['YEARLEVEL'];
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

    //get subjects
    $subjectList=array();
    $totalSub=0;
    $sqlsubject = "SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' AND SUB_SUMMER='Yes' GROUP BY SUB_NAME";
    $ressub = $conn->query($sqlsubject);
    if($ressub->num_rows>0)
    {
      while($rowsub = $ressub->fetch_assoc())
      {
        $subjectList[$totalSub][0]=$rowsub['SUB_NAME'];
        $totalSub++;
      }
    }

    ?>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="admin-docu-action.php?uid='<?php echo $uid?>'" method="POST">
      <div class="container2">
        <h1>Summer Documents</h1>

        <input type="text" name="totalSub" value="<?=$totalSub?>" style="display:none;">

        <input type="text" name="lrn" value="<?=$lrn?>" style="display:none;"hidden>
        <p>LRN: <b><?=$lrn?></b> </p>
        <p>Student ID: <b><?php echo $uid?></b></p>
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
              <br>
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
                  <input name="inp-grade" id="inp-grade" type="number" placeholder="Enter Average" max="100" min="50" required>
                  <?php
                }
                ?>
                <p>Comment</p>
                <textarea disabled id="<?php echo $commentname?>" name="<?php echo $commentname?>" style="resize:none;" minlength="10" maxlength="200"></textarea>

                <div class="container-table">
                  <table>
                    <tbody>
                      <tr>
                        <th colspan="2">Select Subjects</th>
                      </tr>
        <?php
        for($i=0;$i<$totalSub;$i++)
        {
          $subName = "subject".$i;
          ?>

              <tr>
                <td style="width:30%;"><input type="checkbox" name="<?=$subName?>" value="<?=$subjectList[$i][0]?>"></td>
                <td style="text-align:left;">  <?=$subjectList[$i][0]?></td>
              </tr>


          <?php
        }
        ?>
      </tbody>
    </table>
        <?php
          }
    }
    ?>
    </div>
    <center><input type="submit" name="sub-docu-summer" value="Submit" class="modalsub"></center>
  </div>
  </form>
  <?php
}else{

  //get subjects
  $subjectList = array();
  $totalSub=0;
  $sqlsummer = "SELECT * FROM tbl_summer WHERE SUID='$uid'";
  $ressummer = $conn->query($sqlsummer);
  if($ressummer->num_rows>0){
    while($rowsummer = $ressummer->fetch_assoc())
    {
      $subjectList[$totalSub][0]=$rowsummer['SUBJECT'];
      $totalSub++;
    }
  }

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
    <br>
    <div class="container-table">
      <table>
        <tbody>
          <tr>
            <th colspan="2">Subject Currently Taking</th>
          </tr>
    <?php
    for($i=0;$i<$totalSub;$i++)
    {
      ?>
      <tr>
        <td><?=$subjectList[$i][0]?></td>
      </tr>
      <?php
    }
    ?>
      </tbody>
    </table>
    </div>
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
