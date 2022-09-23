<?php
include "../../conn.php";
if(!empty($_GET))
{
  $tfid = $_GET['tfid'];
  $page = $_GET['page'];
  $sql = "SELECT * FROM tbl_tuition WHERE ID = '$tfid'";
  $res = $conn->query($sql);
  $dataTuition=array();
  if($res->num_rows>0){
    $row = $res->fetch_assoc();
    $dataTuition[0] = $row['YEARLEVEL'];
    $dataTuition[1] = $row['TUITIONFEE'];
    $dataTuition[2] = $row['MISC'];
    $dataTuition[3] = $row['NO_OF_BOOKS'];
    $dataTuition[4] = $row['BOOKS'];
    $dataTuition[5] = $row['PLAN'];
    $dataTuition[6] = $row['ADDITIONAL'];
  }
  ?>
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="include/funcEditTuition.php?id=<?=$tfid?>&page=<?=$page?>" method="POST">
    <div class="container2">
      <h1>Edit Tuition Fee</h1>
        <p>Grade:</p>
        <input type="text" value="<?=$dataTuition[0]?>" name="grade" readonly>
        <p>Plan:</p>
        <input type="text" value="<?=$dataTuition[5]?>" name="plan" readonly>
        <p>Tuition Fee:</p>
        <input type="number" placeholder="Enter Tuition Fee" value="<?=$dataTuition[1]?>" name="tf" min="0">
        <p>Miscellaneous:</p>
        <input type="number" placeholder="Enter Miscellaneous Fee" value="<?=$dataTuition[2]?>" name="misc" min="0">
        <p>Books:</p>
        <input type="number" placeholder="Enter Number of Books" value="<?=$dataTuition[3]?>" name="noOfBooks" min="0">
        <p>Books:</p>
        <input type="number" placeholder="Enter Books Fee" value="<?=$dataTuition[4]?>" name="books" min="0">
        <p>Additional Fee:</p>
        <input type="number" placeholder="Enter Additional Fee" value="<?=$dataTuition[6]?>" name="add" min="0">
        <center><input type="submit" value="Submit" name="sub_edit_tuition" class="modalsub"></center>
    </div>
  </form>
  <?php
}
?>
