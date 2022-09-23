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
$ctype = $_GET['cType'];

if($ctype == "REGULAR"){
  //get payment table
  $pdata = array();
  $noOfData = 0;
  $pending = array();
  $count=0;
  $countden=0;
  $sqlpayment = "SELECT * FROM tbl_documents WHERE DOC_STATUS='$type' GROUP BY DOC_STUDID ASC";
  $respayment = $conn->query($sqlpayment);
  if($respayment->num_rows>0)
  {
    while($rowpayment = $respayment->fetch_assoc())
    {
      $sid = $rowpayment['DOC_STUDID'];
      $sqlclass="SELECT * FROM tbl_account WHERE UID='$sid' AND SUMMER='No'";
      $resclass = $conn->query($sqlclass);
      if($resclass->num_rows>0){
        $pdata[$noOfData][0]=$rowpayment['DOC_STUDID'];
        $pdata[$noOfData][1]=$rowpayment['DOC_NAME'];
        $pdata[$noOfData][2]=$rowpayment['DOC_TYPE'];
        $pdata[$noOfData][3]=$rowpayment['DOC_DATE'];
        $pdata[$noOfData][4]=$rowpayment['DOC_STATUS'];
    		$pdata[$noOfData][5]=$rowpayment['DOC_IMAGE'];
    		$pdata[$noOfData][6]=$rowpayment['DOC_STUDID'];
        $resstatus = $conn->query("SELECT * FROM tbl_documents WHERE DOC_STUDID='$sid'");
        if($resstatus->num_rows>0){
          while($rowstatus = $resstatus->fetch_assoc()){
            $status = $rowstatus['DOC_STATUS'];
            if($status=="PENDING"){
              $count++;
            }else if($status=="DENIED"){
              $countden++;
            }
          }
          if($count>0){
            $progressstat[$noOfData]="PENDING";
          }else if($countden>0){
            $progressstat[$noOfData]="DENIED";
          }else{
            $progressstat[$noOfData]="ACCEPTED";
          }
        }
        $count=0;
        $countden=0;
        $noOfData++;
      }
    }
  }else{
  }
  $suid=0;
  //get uses name
  $year = array();
  $section = array();
  $username=array();
  for($i=0;$i<$noOfData;$i++)
  {
    $suid = $pdata[$i][6];
    $resgetname = $conn->query("SELECT * FROM tbl_account WHERE UID ='$suid' AND SUMMER='No'");
    $rowgetname=$resgetname->fetch_assoc();
    $fullname = $rowgetname['FIRSTNAME']." ".$rowgetname['MIDDLENAME']." ".$rowgetname['LASTNAME'];
    $username[$i][0] = $fullname;
    $year[$i] = $rowgetname['YEARLEVEL'];
    $section[$i] = $rowgetname['SECTION'];
  }

  ?>
  <table>
  <tbody>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Grade/Section</th>
      <th>Student Progress</th>
      <th colspan="2">Student Documents</th>
    </tr>
    <?php
      for($i=0;$i<$noOfData;$i++)
      {
        ?>
        <tr>
          <td><?php echo $pdata[$i][0]?></td>
          <td><?php echo $username[$i][0]?></td>
          <td><?php echo $year[$i]." - ".$section[$i]?></td>
          <td><?php echo $progressstat[$i]?></td>
          <td><a href="#"  onclick="showModalDocument(<?=$pdata[$i][0]?>)"><i class="far fa-file"></i>View Documents</a></td>
        </tr>
        <?php
      }
    ?>
  </tbody>
  </table>
  <?php
}else{

  $pdata = array();
  $noOfData = 0;
  $pending = array();
  $count=0;
  $countden=0;
  $sqlpayment = "SELECT * FROM tbl_documents WHERE DOC_STATUS='$type' GROUP BY DOC_STUDID ASC";
  $respayment = $conn->query($sqlpayment);
  if($respayment->num_rows>0)
  {
    while($rowpayment = $respayment->fetch_assoc())
    {
      $sid = $rowpayment['DOC_STUDID'];
      $sqlclass="SELECT * FROM tbl_account WHERE UID='$sid' AND SUMMER='Yes'";
      $resclass = $conn->query($sqlclass);
      if($resclass->num_rows>0){
        $pdata[$noOfData][0]=$rowpayment['DOC_STUDID'];
        $pdata[$noOfData][1]=$rowpayment['DOC_NAME'];
        $pdata[$noOfData][2]=$rowpayment['DOC_TYPE'];
        $pdata[$noOfData][3]=$rowpayment['DOC_DATE'];
        $pdata[$noOfData][4]=$rowpayment['DOC_STATUS'];
    		$pdata[$noOfData][5]=$rowpayment['DOC_IMAGE'];
    		$pdata[$noOfData][6]=$rowpayment['DOC_STUDID'];
        $resstatus = $conn->query("SELECT * FROM tbl_documents WHERE DOC_STUDID='$sid'");
        if($resstatus->num_rows>0){
          while($rowstatus = $resstatus->fetch_assoc()){
            $status = $rowstatus['DOC_STATUS'];
            if($status=="PENDING"){
              $count++;
            }else if($status=="DENIED"){
              $countden++;
            }
          }
          if($count>0){
            $progressstat[$noOfData]="PENDING";
          }else if($countden>0){
            $progressstat[$noOfData]="DENIED";
          }else{
            $progressstat[$noOfData]="ACCEPTED";
          }
        }
        $count=0;
        $countden=0;
        $noOfData++;
      }
    }
  }else{
  }
  $suid=0;
  //get uses name
  $year = array();
  $section = array();
  $username=array();
  for($i=0;$i<$noOfData;$i++)
  {
    $suid = $pdata[$i][6];
    $resgetname = $conn->query("SELECT * FROM tbl_account WHERE UID ='$suid' AND SUMMER='Yes'");
    $rowgetname=$resgetname->fetch_assoc();
    $fullname = $rowgetname['FIRSTNAME']." ".$rowgetname['MIDDLENAME']." ".$rowgetname['LASTNAME'];
    $username[$i][0] = $fullname;
    $year[$i] = $rowgetname['YEARLEVEL'];
    $section[$i] = $rowgetname['SECTION'];
  }



  ?>
  <table>
  <tbody>
    <tr>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Grade/Section</th>
      <th>Student Progress</th>
      <th colspan="2">Student Documents</th>
    </tr>
    <?php
      for($i=0;$i<$noOfData;$i++)
      {
        ?>
        <tr>
          <td><?php echo $pdata[$i][0]?></td>
          <td><?php echo $username[$i][0]?></td>
          <td><?php echo $year[$i]." - ".$section[$i]?></td>
          <td><?php echo $progressstat[$i]?></td>
          <td><a href="#"  onclick="showModalDocument1(<?= $pdata[$i][6]?>)"><i class="far fa-file"></i>View Documents</a></td>
        </tr>
        <?php
      }
    ?>
  </tbody>
  </table>
  <?php
}
?>
