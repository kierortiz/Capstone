<?php
session_start();
include 'conn.php';
$uid = $_SESSION['UID'];
//get user details
$sql = "SELECT * FROM tbl_account WHERE UID = '$uid'";
$res = $conn->query($sql);
$userDetails=array();
if($res->num_rows>0)
{
  $row = $res->fetch_assoc();
  $userDetails[0]=$row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
  $userDetails[1]=$row['OLDORNEW'];
  $userDetails[2]=$row['YEARLEVEL'];
  $level = $row['YEARLEVEL'];
  $section = $row['SECTION'];
  $userDetails[4]=$row['PLAN'];
  $userDetails[5]=$row['REGISTER'];
  $summer = $row['SUMMER'];
}

if($summer == "Yes"){
  $subjects = array();
  $noOfSubjects = 0;
  $summerSub = "SELECT * FROM tbl_summer WHERE SUID = '$uid'";
  $ressummer = $conn->query($summerSub);
  if($ressummer->num_rows>0){
    while($rowsummer = $ressummer->fetch_assoc())
    {
      $subjectName = $rowsummer['SUBJECT'];
      $ressub = $conn->query("SELECT * FROM tbl_subjects WHERE SUB_YEAR='$level' AND SUB_SECTION='$section' AND SUB_NAME='$subjectName' AND SUB_SUMMER='Yes'");
      if($ressub->num_rows>0){
        $rowsub = $ressub->fetch_assoc();
      	$subjects[$noOfSubjects][0]=$rowsub['SUB_TAG'];
        $subjects[$noOfSubjects][1]=$rowsub['SUB_NAME'];
        $subjects[$noOfSubjects][2]=$rowsub['SUB_DAY'];
        $subjects[$noOfSubjects][3]=$rowsub['SUB_TIME'];
        $subjects[$noOfSubjects][4]=$rowsub['SUB_ROOM'];
        $noOfSubjects++;
      }
    }
  }else{
    echo "No Summer Subject/s Found!";
  }

  //get plan details
  $sqlplan = "SELECT * FROM tbl_tuition WHERE SUMSTUD='$uid'";
  $resplan = $conn->query($sqlplan);
  if($resplan->num_rows>0){
    $rowplan = $resplan->fetch_assoc();
    $tf = $rowplan['TUITIONFEE'];
    $misc = $rowplan['MISC'];
    $noOfBooks = $rowplan['NO_OF_BOOKS'];
    $books = $rowplan['BOOKS'];
    $add = $rowplan['ADDITIONAL'];
    $totaltf = $tf + $misc + ($noOfBooks*$books) + $add;
  }

  //get payment details
  $paid = 0;
  $sqlpayment="SELECT * FROM tbl_payment WHERE PAY_UID='$uid' AND PAY_STATUS='ACCEPTED'";
  $respayment = $conn->query($sqlpayment);
  if($respayment->num_rows>0)
  {
    while($rowpayment = $respayment->fetch_assoc())
    {
      $paid = $paid+$rowpayment['PAY_AMOUNT'];
    }
  }

  //get balance
  $balance = $totaltf - $paid;
}else{
  //regular class
  $subjects = array();
  $noOfSubjects=0;
  $sqlsection = "SELECT * FROM tbl_subjects WHERE SUB_YEAR='$level' AND SUB_SECTION='$section' AND SUB_SUMMER='No'";
  $ressection = $conn->query($sqlsection);
  if($ressection->num_rows>0){
    while($rowsection = $ressection->fetch_assoc())
    {
      $subjects[$noOfSubjects][0]=$rowsection['SUB_TAG'];
      $subjects[$noOfSubjects][1]=$rowsection['SUB_NAME'];
      $subjects[$noOfSubjects][2]=$rowsection['SUB_DAY'];
      $subjects[$noOfSubjects][3]=$rowsection['SUB_TIME'];
      $subjects[$noOfSubjects][4]=$rowsection['SUB_ROOM'];
      $noOfSubjects++;
    }
  }else{
    echo "not enrolled";
  }

  //get plan details
  $sqlplan = "SELECT * FROM tbl_tuition WHERE YEARLEVEL = '$level' AND PLAN='$userDetails[4]'";
  $resplan = $conn->query($sqlplan);
  if($resplan->num_rows>0){
    $rowplan = $resplan->fetch_assoc();
    $tf = $rowplan['TUITIONFEE'];
    $misc = $rowplan['MISC'];
    $noOfBooks = $rowplan['NO_OF_BOOKS'];
    $books = $rowplan['BOOKS'];
    $add = $rowplan['ADDITIONAL'];
    $totaltf = $tf + $misc + ($noOfBooks*$books) + $add;
  }

  //get payment details
  $paid = 0;
  $sqlpayment="SELECT * FROM tbl_payment WHERE PAY_UID='$uid' AND PAY_STATUS='ACCEPTED'";
  $respayment = $conn->query($sqlpayment);
  if($respayment->num_rows>0)
  {
    while($rowpayment = $respayment->fetch_assoc())
    {
      $paid = $paid+$rowpayment['PAY_AMOUNT'];
    }
  }

  //get balance
  $balance = $totaltf - $paid;
}



$StartingYear = date('Y');
$oneyear = date("Y", strtotime($StartingYear."+1 year"));
?>

<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Reg Card</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>
    <link href="assets/CSS/regcard.css" rel="stylesheet" type="text/css">
</head>
<body class='snippet-body' oncontextmenu='return false'>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
         <div class="card-header p-4">
             <div class="d-flex justify-content-center align-items-center" style="flex-direction: column">
                  <img src="assets/img/logo.png" style="border-radius:100%;height:100px;width:100px;">
                 <h2 class="mb-0">St. Andrew’s Cleverland School</h2>
                 <p>518 M.H DEL PILAR STREET BARANGAY SAN ISIDRO ANTIPOLO CITY</p>
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-4">
                 <div class="col-sm">
                     <div>Student ID: <b><?php echo $uid?></b></div>
                     <div>Student Name: <b><?php echo $userDetails[0]?></b></div>
                     <div>Student Type: <b><?php echo $userDetails[1]?></b></div>
                 </div>

        				 <div class="col-sm">
                      <div>Grade: <b><?php echo $userDetails[2]?></b></div>
                      <div>Section: <b><?php echo $section?></b></div>
                      <div>SY: <b><?php echo $StartingYear."-".$oneyear?></b></div>
                </div>

                <div class="col-sm">
                     <div>Date Enrolled: <b><?php echo date('Y')?></b></div>
                     <div>Date Printed: <b><?php echo date('m-d-Y')?></b></div>
               </div>
             </div>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr class="red">
                             <th class="center">Subject Code</th>
                             <th>Subject Title</th>
                             <th>Schedule</th>
                             <th class="right">Room</th>
                         </tr>
                     </thead>
                     <tbody>
                       <?php
                       for($i=0;$i<$noOfSubjects;$i++)
                       {
                         ?>
                         <tr>
                             <td class="center"><?php echo $subjects[$i][0]?></td>
                             <td class="left strong"><?php echo $subjects[$i][1]?></td>
                             <td class="left"><?php echo $subjects[$i][3]." ".$subjects[$i][2]?></td>
                             <td class="right"><?php echo $subjects[$i][4]?></td>
                         </tr>
                         <?php
                       }
                      ?>
                     </tbody>
                 </table>
             </div>
             <div class="row mb-4">
                 <div class="col-sm-6">
                     <div>Tuition Fee: <b><?php echo $tf?></b></div>
                     <div>Total Misc: <b><?php echo $misc?></b></div>
                     <div>Books: <b><?php echo $noOfBooks."(P".$books." each)"?></b></div>
                     <div>Student Type: <b><?php echo $userDetails[1]?></b></div>
                 </div>

        				 <div class="col-sm-6 ">
                   <h3 class="text-dark mb-1"><?php echo $userDetails[4]?></h3>
                      <div>Amount Paid: <b><?php echo $paid?></b></div>
                      <div>Total Amount: <b><?php echo $totaltf?></b></div>
                      <div>Total Balance: <b><?php echo $balance?></b></div>
                </div>
             </div>
         </div>
         <button id="btn-print" onclick="PrintPage()">Print</button>
     </div>
 </div>
</body>
</html>

<script type="text/javascript">
	function PrintPage() {
    document.getElementById('btn-print').setAttribute('hidden','hidden');
		window.print();

    window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
	}
</script>
