<tr>
  <th>Account Name</th>
  <th>Email</th>
  <th>Position</th>
  <th>Account Status</th>
  <th colspan="3">Action</th>
</tr>
<?php
include '../conn.php';
if(isset($_GET['type']))
{
  $type = $_GET['type'];
  if($type=="Registrar"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='REGISTRAR' AND ADMIN_STATUS!='ARCHIVED'";
  }else if($type == "Accounting"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='ACCOUNTING' AND ADMIN_STATUS!='ARCHIVED'";
  }else if($type == "Admin"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='ADMIN' AND ADMIN_STATUS!='ARCHIVED'";
  }else if($type == "Student"){
    $sql = "SELECT * FROM tbl_account WHERE STATUS ='ACTIVE' AND REGISTER !='UNENROLLED'";
  }
  $res = $conn->query($sql);
  $accounts = array();
  $noOfAccounts=0;
  $link=array();
  if($res->num_rows>0){
    while($row = $res->fetch_assoc())
    {
      if($type == "Student"){
        $accounts[$noOfAccounts][0]=$row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
        $accounts[$noOfAccounts][1]=$row['EMAILADD'];
        $accounts[$noOfAccounts][2]='STUDENT';
        $accounts[$noOfAccounts][3]=$row['STATUS'];
        $accounts[$noOfAccounts][4]=$row['UID'];
        $link[$noOfAccounts] = "remove-student.php?sid=".$row['UID'];
      }else{
        $accounts[$noOfAccounts][0]=$row['ADMIN_NAME'];
        $accounts[$noOfAccounts][1]=$row['ADMIN_EMAIL'];
        $accounts[$noOfAccounts][2]=$row['ADMIN_POSITION'];
        $accounts[$noOfAccounts][3]=$row['ADMIN_STATUS'];
        $accounts[$noOfAccounts][4]=$row['ADMIN_ID'];
        $link[$noOfAccounts] = "remove-admin.php?aid=".$row['ADMIN_ID'];
      }
      $noOfAccounts++;
    }
  }
}

for($i=0;$i<$noOfAccounts;$i++)
{

  ?>
  <tr>
    <td><?php echo $accounts[$i][0]?></td>
    <td><?php echo $accounts[$i][1]?></td>
    <td><?php echo $accounts[$i][2]?></td>
    <td><?php echo $accounts[$i][3]?></td>
    <?php if($type=="Student")
    {
      $uid = $accounts[$i][4];
      ?>
      <td><a href="#" style="color:blue;" onclick="showModalDocumentButton('<?php echo $uid?>')"><i class="far fa-file"></i>Add Documents</a></td>
      <td><a href="#" style="color:green;" onclick="showModalEditStudentAccount('<?php echo $uid?>')"><i class="far fa-edit"></i>Edit Account</a></td> <td><a href="#" onclick="sweetalertdelete('<?=$link[$i]?>')" style="color:red;"><i class="fas fa-trash-alt"></i>Remove Account</a></td>
      <?php
    }else{
      $uid = $accounts[$i][4];
      ?>
      <td><a href="#" style="color:green;" onclick="showModalEditAdminAccount('<?php echo $uid?>')"><i class="far fa-edit"></i>Edit Account</a></td> <td><a href="#" onclick="sweetalertdelete('<?=$link[$i]?>')" style="color:red;"><i class="fas fa-trash-alt"></i>Remove Account</a></td>
      <?php
    }
    ?>
  </tr>
  <?php
}
?>
