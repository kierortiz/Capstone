<tr>
  <th>Account Name</th>
  <th>Username</th>
  <th>Position</th>
  <th>Account Status</th>
  <th colspan="2">Action</th>
</tr>
<?php
include '../conn.php';
if(isset($_GET['type']))
{
  $type = $_GET['type'];
  if($type=="Registrar"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='REGISTRAR' AND ADMIN_STATUS='ARCHIVED'";
  }else if($type == "Accounting"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='ACCOUNTING' AND ADMIN_STATUS='ARCHIVED'";
  }else if($type == "Admin"){
    $sql = "SELECT * FROM tbl_admin WHERE ADMIN_POSITION='ADMIN' AND ADMIN_STATUS='ARCHIVED'";
  }else if($type == "Student"){
    $sql = "SELECT * FROM tbl_account WHERE STATUS ='ARCHIVED'";
  }
  $res = $conn->query($sql);
  $accounts = array();
  $noOfAccounts=0;
  $link=array();
  $link1=array();
  if($res->num_rows>0){
    while($row = $res->fetch_assoc())
    {
      if($type == "Student"){
        $accounts[$noOfAccounts][0]=$row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
        $accounts[$noOfAccounts][1]=$row['EMAILADD'];
        $accounts[$noOfAccounts][2]='STUDENT';
        $accounts[$noOfAccounts][3]=$row['STATUS'];
        $link1[$noOfAccounts] = "include/recover-student.php?sid=".$row['UID'];
        $link[$noOfAccounts] = "include/delete-perma-student.php?sid=".$row['UID'];
      }else{
        $accounts[$noOfAccounts][0]=$row['ADMIN_NAME'];
        $accounts[$noOfAccounts][1]=$row['ADMIN_EMAIL'];
        $accounts[$noOfAccounts][2]=$row['ADMIN_POSITION'];
        $accounts[$noOfAccounts][3]=$row['ADMIN_STATUS'];
        $link1[$noOfAccounts] = "include/recover-admin.php?aid=".$row['ADMIN_ID'];
        $link[$noOfAccounts] = "include/delete-perma-admin.php?aid=".$row['ADMIN_ID'];
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
    <td><a href="#" style="color:green;" onclick="sweetalertrecover('<?=$link1[$i]?>')"><i class="far fa-edit"></i>Recover</a></td>
    <td><a href="#" onclick="sweetalertdelete('<?=$link[$i]?>')" style="color:red;"><i class="fas fa-trash-alt"></i>Permanent Delete</a></td>
  </tr>
  <?php
}
?>
