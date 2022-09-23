<div class="container-table">
<?php

include '../../conn.php';
session_start();
$summer = $_SESSION['SUMMER'];
$uid = $_SESSION['UID'];
if(!empty($_GET))
{
  $plan = $_GET['plan'];
  $grade = $_GET['grade'];
  $title = "Partial Payment";
  $min = 1500; //edit 7
  if($plan == "Plan A"){
    $title = "Full Payment";
    $min = 15000;
  }
  else if($plan == "Plan B")
  {
    $title = "Partial Payment";
    $min = 5000;
  }

  if($summer == "Yes")
  {
    $sql="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan' AND SUMSTUD = '$uid'";
    $res=$conn->query($sql);
  }else{
    $sql="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan'";
    $res=$conn->query($sql);
  }

  if($res->num_rows>0)
  {
    $row = $res->fetch_assoc();
    $tf = $row['TUITIONFEE'];
    $misc = $row['MISC'];
    $noOfBooks = $row['NO_OF_BOOKS'];
    $books = $row['BOOKS'];
    $add = $row['ADDITIONAL'];
    $total = $tf + $misc + ($books*$noOfBooks)+$add;
    ?>

    <div class="tbl-rowtitle">
        <p><?=$title?></p>
      </div>

      <div class="container">
        <table class="tbl-payment" style="width:-webkit-fill-available; margin:0;">
          <tbody>
            <tr>
              <td>Tuition</td>
              <td><?=$tf?></td>
            </tr>

            <tr>
              <td>Miscellaneous</td>
              <td><?=$misc?></td>
            </tr>

            <tr>
              <td>Books</td>
              <td><?=$books."(".$noOfBooks." books * (".$books."))"?></td>
            </tr>

            <tr>
              <td>Total</td>
              <td><?=$total?></td>
            </tr>

            <tr>
              <td>Minimum Down Payment:</td>
              <td><?=$min?></td>
            </tr>

          </tbody>
        </table>
    </div>
    <?php
  }
}
?>
</div>
