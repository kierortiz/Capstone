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

$type = $_GET['type'];
//get payment table
$pdata = array();
$noOfData = 0;
if($type == "PENDING"){
  $sqlpayment = "SELECT * FROM tbl_payment WHERE PAY_STATUS='$type' ORDER BY PAY_DATE ASC";
}else{
  $sqlpayment = "SELECT * FROM tbl_payment WHERE PAY_STATUS='$type' ORDER BY PAY_DATE DESC";
}

$respayment = $conn->query($sqlpayment);
if($respayment->num_rows>0)
{
  while($rowpayment = $respayment->fetch_assoc())
  {
    $pdata[$noOfData][0]=$rowpayment['PAY_UID'];
    $pdata[$noOfData][1]=$rowpayment['PAY_NAME'];
    $pdata[$noOfData][2]=$rowpayment['PAY_STATUS'];
    $pdata[$noOfData][3]=$rowpayment['PAY_IMAGE'];
    $pdata[$noOfData][4]=$rowpayment['PAY_ID'];
    $noOfData++;
  }
}
?>

<table>
  <tbody>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Progress</th>
      <th>Action</th>
      <?php if($type=="ACCEPTED"){
        ?>
        <th>Adjust Tuition</th>
        <?php
      }
      ?>
    </tr>

    <?php
      for($i=0;$i<$noOfData;$i++)
      {
        ?>
        <tr>
          <td><?php echo $pdata[$i][0]?></td>
          <td><?php echo $pdata[$i][1]?></td>
          <td><?php echo $pdata[$i][2]?></td>
          <td><a href="#"  onclick="showModal(<?php echo $pdata[$i][4]?>)"><i class="far fa-file"></i>View Documents</a></td>

            <?php if($pdata[$i][2]=="ACCEPTED"){
              ?>
              <td>
              <a href="#" onclick="showModalAddTF(<?php echo $pdata[$i][4]?>)" style="color:green;"><i class="far fa-plus-square"></i> Manage Tuition</a>
              </td>
              <?php
            }
            ?>

          <!-- <td>
            <?php if($pdata[$i][2]=="ACCEPTED"){
              ?>
              <a href="#" onclick="showModalMinusTF(<?php echo $pdata[$i][4]?>)" style="color:red;"><i class="far fa-minus-square"></i> Minus Tuition</a>
              <?php
            }?>
        </td> -->
        </tr>
        <?php
      }
    ?>
  </tbody>
</table>
