<?php
include '../../conn.php';
if(!empty($_GET['uid']))
{
  $uid = $_GET['uid'];
  $sql = "SELECT * FROM tbl_account WHERE UID=$uid";
  $res = $conn->query($sql);
  if($res->num_rows>0){
    while($row = $res->fetch_assoc())
    {
      ?>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="include/funcEditStudAccount.php" method="POST">
        <div class="container2">
          <h1>Edit Student Details</h1>

              <label>Student ID:</label>
              <input type="text" class="infocus" name="uid" value="<?=$row['UID']?>" readonly>

              <label>LRN:</label>
              <input type="text" name="lrn" value="<?=$row['LRN']?>">

              <label>First Name:</label>
              <input type="text" name="fname" value="<?=$row['FIRSTNAME']?>" >

              <label>Middle Name:</label>
              <input type="text" name="mname" value="<?=$row['MIDDLENAME']?>" >

              <label>Last Name:</label>
              <input type="text" name="lname" value="<?=$row['LASTNAME']?>" >

              <label>Address:</label>
              <input type="text" name="address" value="<?=$row['ADDRESS']?>" >

              <label>Gender:</label>
              <input type="text" name="gender" value="<?=$row['GENDER']?>" >

              <label>Contact No:</label>
              <input type="text" name="contact" value="<?=$row['CONTACTNO']?>" >

              <label>Birthdate:</label>
              <input type="text" name="bdate" value="<?=$row['BIRTHDATE']?>" >

              <label>Birth Place:</label>
              <input type="text" name="bplace" value="<?=$row['BIRTHPLACE']?>" >

              <label>Religion:</label>
              <input type="text" name="religion" value="<?=$row['RELIGION']?>" >

              <label>Year Level:</label>
              <input type="text" name="year" value="<?=$row['YEARLEVEL']?>" >

              <label>Plan Payment:</label>
              <input type="text" name="plan" value="<?=$row['PLAN']?>" >

              <label>Section:</label>
              <input type="text" name="section" value="<?=$row['SECTION']?>" >

          <center><input type="submit" value="Submit" name="sub_edit_account_student" class="modalsub"></center>
        </div>
      </form>
      <?php
    }
  }
}
?>
