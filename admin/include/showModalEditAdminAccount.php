<?php
include '../../conn.php';
if(!empty($_GET['aid']))
{
  $aid = $_GET['aid'];
  echo $aid;
  $sql = "SELECT * FROM tbl_admin WHERE ADMIN_ID=$aid";
  $res = $conn->query($sql);
  if($res->num_rows>0){
    while($row = $res->fetch_assoc())
    {
      ?>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="include/funcEditAdminAccount.php" method="POST">
        <div class="container2">
          <h1>Edit Emloyee Details</h1>

              Employee ID
              <input type="text" class="infocus" value="<?=$row['ADMIN_ID']?>" name="aid" readonly>

              Name
              <input type="text" value="<?=$row['ADMIN_NAME']?>" name="name">

              Address
              <input type="text" value="<?=$row['ADMIN_ADDRESS']?>" name="address">

              Birthday
              <input type="text" value="<?=$row['ADMIN_BIRTHDAY']?>" name="bday">

              Gender
              <input type="text" value="<?=$row['ADMIN_GENDER']?>" name="gender">

              Contact No.
              <input type="text" value="<?=$row['ADMIN_CONTACT']?>" name="contact">

              Position
              <input type="text" value="<?=$row['ADMIN_POSITION']?>" name="pos">

          <center><input type="submit" value="Submit" name="sub_edit_account_admin" class="modalsub"></center>
        </div>
      </form>
      <?php
    }
  }
}
?>
