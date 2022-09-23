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
//sweetalert page
include "include/sweetalert.php";
$UID = $_SESSION['UID'];
//users data
$sql = "SELECT * FROM tbl_account WHERE UID='$UID'";
$res = $conn->query($sql);
if($res->num_rows>0)
{
	$row = $res->fetch_assoc();
	$email = $row['EMAILADD'];
	$fname = $row['FIRSTNAME'];
	$grade = $row['YEARLEVEL'];
	$image = $row['IMAGE'];
	$reg = $row['REGISTER'];
	$plan = $row['PLAN'];
	$oON = $row['OLDORNEW'];
  $summer = $row['SUMMER'];
}
// $docuItems = array(array("EMPTY","EMPTY"),array("EMPTY","EMPTY"));

if($oON == "OLD")
{
  $btnname = "sub-docu1";
	$mStep5 = "id04";
}else if($oON == "NEW"){
	$mStep5 = "id03";
  $btnname = "sub-docu";
}

//get plan depending on Grade
//Edit 4 Start part 1
if ($summer == "Yes")
{
	$sqlplan = "SELECT * FROM tbl_tuition WHERE YEARLEVEL = '$grade' AND SUMMER = 'Yes' AND SUMSTUD = '$UID'";
}
else{
	$sqlplan = "SELECT * FROM tbl_tuition WHERE YEARLEVEL = '$grade' AND SUMMER = 'No'";
}
//Edit 4 End Part 1
$listOfPlans = array();
$totalPlans = 0;
$resplans = $conn->query($sqlplan);
if($resplans->num_rows>0)
{
  while($rowplan = $resplans->fetch_assoc()){
    $listOfPlans[$totalPlans][0]=$rowplan['PLAN'];
    $listOfPlans[$totalPlans][1]=$rowplan['TUITIONFEE'];
    $listOfPlans[$totalPlans][2]=$rowplan['MISC'];
    $listOfPlans[$totalPlans][3]=$rowplan['NO_OF_BOOKS'];
    $listOfPlans[$totalPlans][4]=$rowplan['BOOKS'];
    $totalPlans++;
  }
}

//user's data in proof of payment
$sqlproof = "SELECT * FROM tbl_payment WHERE PAY_UID = '$UID' ORDER BY PAY_DATE DESC";
$resproof = $conn->query($sqlproof);
if($resproof->num_rows>0)
{
	$rowproof = $resproof->fetch_assoc();
	$proofstatus = $rowproof['PAY_STATUS'];
	$proofchecker=1;
}else{
	$proofstatus = "EMPTY";
	$proofchecker=0;
}

if($oON=="NEW"){
  //check docu
  $docuItems = array();
  $docuFindDenied = array();
  $totalDocu = 0;
  $docuaccepted=0;
  $sqldocu = "SELECT * FROM tbl_documents WHERE DOC_STUDID='$UID'";
  $resdocu = $conn->query($sqldocu);
  if($resdocu->num_rows>0)
  {
  	while($rowdocu = $resdocu->fetch_assoc())
  	{
  		$docuItems[$totalDocu][0]=$rowdocu['DOC_TYPE'];
  		$docuItems[$totalDocu][1]=$rowdocu['DOC_STATUS'];
  		$docuItems[$totalDocu][2]=$rowdocu['DOC_IMAGE'];
  		$docuItems[$totalDocu][3]=$rowdocu['DOC_COMMENT'];
  		if($docuItems[$totalDocu][1]=="DENIED"){
  			$docuFindDenied[$totalDocu]=1;
  		}else if($docuItems[$totalDocu][1]==""||empty($docuItems[$totalDocu][1])){
  			$docuFindDenied[$totalDocu]=2;
  		}else{
  			$docuFindDenied[$totalDocu]=0;
  		}
  		if($rowdocu['DOC_STATUS']=="ACCEPTED")
  		{
  			$docuaccepted++;
  		}
  		$totalDocu++;
  	}
  	$docuchecker=1;
  }else{
  	$docuFindDenied[0]=1;
  	$docuFindDenied[1]=1;
  	$docuFindDenied[2]=1;
  	$docuFindDenied[3]=1;
  	$docuItems = "EMPTY";
  	$docuchecker=0;
  }
}else if($oON=="OLD"){

  $docuFindDenied = 0;
  $totalDocu = 0;
  $docuaccepted=0;
  $sqldocu = "SELECT * FROM tbl_documents WHERE DOC_STUDID='$UID'";
  $resdocu = $conn->query($sqldocu);
  if($resdocu->num_rows>0)
  {
  	while($rowdocu = $resdocu->fetch_assoc())
  	{
  		$docuItems[$totalDocu][0]=$rowdocu['DOC_TYPE'];
  		$docuItems[$totalDocu][1]=$rowdocu['DOC_STATUS'];
  		$docuItems[$totalDocu][2]=$rowdocu['DOC_IMAGE'];
  		$docuItems[$totalDocu][3]=$rowdocu['DOC_COMMENT'];

  		if($docuItems[$totalDocu][1]=="DENIED"){
  			$docuFindDenied=1;
  		}else if($docuItems[$totalDocu][1]==""||empty($docuItems[$totalDocu][1])){
  			$docuFindDenied=2;
  		}else{
  			$docuFindDenied=0;
  		}
  		if($rowdocu['DOC_STATUS']=="ACCEPTED")
  		{
  			$docuaccepted=1;
  		}
  	}
  	$docuchecker=1;
    $totalDocu=1;
  }else{
  	$docuFindDenied=0;
  	$docuItems = "EMPTY";
  	$docuchecker=0;
  }
}else{
  $docuaccepted=0;
  $docuFindDenied=0;
  $docuItems = "EMPTY";
  $docuchecker=0;
}

if($docuFindDenied[0]==1||$docuFindDenied[0]==2){
	$hideDocu1="";
	$disableDocu1="";
}else{
	$hideDocu1="hidden";
	$disableDocu1="disabled";
}

if($oON=="NEW")
{
  if($docuFindDenied[1]==1||$docuFindDenied[1]==2){
  	$hideDocu2="";
  	$disableDocu2="";
  }else{
  	$hideDocu2="hidden";
  	$disableDocu2="disabled";
  }

  if($docuFindDenied[2]==1||$docuFindDenied[2]==2){
  	$hideDocu3="";
  	$disableDocu3="";
  }else{
  	$hideDocu3="hidden";
  	$disableDocu3="disabled";
  }

  if($docuFindDenied[3]==1||$docuFindDenied[3]==2){
  	$hideDocu4="";
  	$disableDocu4="";
  }else{
  	$hideDocu4="hidden";
  	$disableDocu4="disabled";
  }

  if($docuFindDenied[1]!=1||$docuFindDenied[2]!=1||$docuFindDenied[3]!=1&&$docuItems!="EMPTY")
  {
  	$btnname = "sub-docu-update";
  }
}else if($oON=="OLD"){
  if($docuFindDenied==1){
    $btnname = "sub-docu-update";
  }
}


//image temp if no image
if(empty($image) || $image == "")
{
		$image = "temp.png";
}

//initialize of progress
$hideIcon2="hidden";
$hideIcon3="hidden";
$hideIcon4="hidden";
$hideIcon5="hidden";
$hideIcon6="hidden";
// $hideIcon7="hidden";
$hideButton2="";
$hideButton3="hidden";
$hideButton4="hidden";
$hideButton5="hidden";
$hideButton6="hidden";
// $hideButton7="hidden";
$steptwo="is-active";
$stepthree="";
$stepfour="";
$stepfive="";
$stepsix="";
$pending = "none";
$pending2="none";
$denied = "none";
$denied2 = "none";
$viewDocu = "hidden";
$hideIfNotSummer="none";

//for progress
//step 2
if($reg == "ENROLLING" || $reg == "ENROLLED")
{
	$hideIcon2="";
	$hideButton2="hidden";
	$hideButton5="";
	$steptwo="is-complete";
	$stepthree="is-active";
}
//step 3
//get subjects for summer

// if($summer == "Yes"){
//   $hideIfNotSummer="";
//   $subjectList = array();
//   $totalSubject = 0;
//   $hideSummer="";
//   $stepseven="";
//   $sqlsubject = "SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' GROUP BY SUB_NAME";
//   $ressub = $conn->query($sqlsubject);
//   if($ressub->num_rows>0)
//   {
//     while($rowsub=$ressub->fetch_assoc())
//     {
//       $subjectList[$totalSubject][0] = $rowsub['SUB_TAG'];
//       $subjectList[$totalSubject][1] = $rowsub['SUB_NAME'];
//       $totalSubject++;
//     }
//   }
//
//   //checker if done
//   $sqlsubject1 = "SELECT * FROM tbl_summer WHERE SUID = '$UID'";
//   $ressubject1 = $conn->query($sqlsubject1);
//   if($ressubject1->num_rows>0){
//     $stepseven="is-complete";
//     $hideIcon7="";
//     $hideButton7="hidden";
//     $hideButton5="";
//   }
// }else{
//   $stepseven="is-complete";
//   $hideButton5="";
// }


//step 4
if($oON=="NEW")
{
  for($i=0;$i<$totalDocu;$i++)
  {
  	if($docuItems[$i][1]=="DENIED")
  	{
  		$denied2="contents";
  		$hideButton5="";
  		$viewDocu="";
  	}else if($docuItems[$i][1]=="PENDING")
  	{
  		$hideButton3="hidden";
  		$i = $totalDocu;
  		$pending2="contents";
  		$hideButton5="hidden";
  	}else if($docuaccepted==4){
  		$hideIcon5="";
  		$hideButton5="hidden";
  		$hideButton3="";
      $denied2="none";
      $viewDocu="hidden";
  		$stepthree="is-complete";
  		$stepfour="is-active";
  	}
  }
}else if($oON=="OLD"){
  if($docuItems=="EMPTY"){

  }else if($docuItems[0][1]=="DENIED")
  {
    $denied2="contents";
    $hideButton5="";
    $viewDocu="";
  }else if($docuItems[0][1]=="PENDING")
  {
    $hideButton3="hidden";
    $pending2="contents";
    $hideButton5="hidden";
  }else if($docuaccepted==1){
    $hideIcon5="";
    $hideButton5="hidden";
    $hideButton3="";
    $stepthree="is-complete";
    $stepfour="is-active";
  }
}

//step 4
if(!empty($plan))
{
	$hideIcon3="";
	$hideButton3="hidden";
	$hideButton4="";
	$stepfour="is-complete";
	$stepfive="is-active";
}
// //step 5
if($proofchecker==1)
{
	if($proofstatus=="PENDING"){
		$hideButton4="hidden";
		$pending = "contents";
	}else if($proofstatus=="ACCEPTED"){
		$hideButton4="hidden";
		$hideIcon4="";
		$stepsix="is-active";
		$stepfive="is-complete";
		$hideButton6="";
	}else if($proofstatus=="DENIED"){
		$denied = "contents";
		$hideButton4="";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Enrollment</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/progress.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/modal2.css" rel="stylesheet" type="text/css">
  <script src="../JS/sweetalert2@10.js">//script for sweet alert</script>
  <script src="../JS/jquery-2.2.4.min.js"></script>
  <link rel="icon" type="image/png" href="assets/logo.png">
	</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include('include/header.php');?>
	<div class="body">
	<?php include('include/nav.php');?>
	<section class="section-1">
		<div class="container">
			<h1>Enrollment Progress</h1>

			<div class="container-table">
			<a href="../instruction.html" target="_blank" title="Instructions on how to Enroll"><i class="far fa-question-circle"></i></a>
					<ol class="progress progress--medium" style="z-index: 1;">
						<li class="is-complete" data-step="1">
					    Register or Login
					  </li>
						<li class="<?php echo $steptwo?>" data-step="2">
							Admission Form
					  </li>

            <li class="<?php echo $stepseven?>" data-step="3" style="display:<?=$hideIfNotSummer?>;">
              Subject/s (For Summer Class Only)
            </li>

						<li class="<?php echo $stepthree?>" data-step="4">
					    Required Documents
					  </li>

						<li class="<?php echo $stepfour?>" data-step="5">
					    Pick Plan
					  </li>
					  <li class="<?php echo $stepfive?>" data-step="6">
					    Proof of Payment (via BDO/BPI bank transfer)
					  </li>

					  <li class="<?php echo $stepsix?>" data-step="7" class="progress__last	">
					   	Print Register Card
					  </li>
					</ol>
            <ul>

              <span>Step 1</span>
						  <li><i class="fas fa-check"></i> Register or Login.</li>

              <span>Step 2</span>
  						<li>
                <i class="fas fa-check" style="visibility:<?php echo $hideIcon2?>"></i> Fill up Admission Form. <a href="admission.php" <?php echo $hideButton2?>>Click Here</a>
              </li>

              <span>Step 3</span>
              <p class="warning" style="display:<?php echo $pending2?>;">*Documents for Verification</p>
              <p class="warning" style="display:<?php echo $denied2?>;">*Uploaded Documents Denied</p>

              <li>
                <i class="fas fa-check" style="visibility:<?php echo $hideIcon5?>"></i> Upload the Required Documents.
                <a href="#" onclick="document.getElementById('id05').style.display='block'"<?php echo $viewDocu?>>View Documents</a>
                <a href="#" onclick="document.getElementById('<?php echo $mStep5?>').style.display='block'"<?php echo $hideButton5?>>Click Here</a>
              </li>


              <p>Step 4</p>
  						<li>
                <i class="fas fa-check" style="visibility:<?php echo $hideIcon3?>"></i> Pick Plan Payment.
                <a href="#" onclick="document.getElementById('id01').style.display='block'"  <?php echo $hideButton3?>>Here</a>
              </li>

              <span>Step 5</span>
              <p class="warning" style="display:<?php echo $pending?>">*Payment Pending</p>
              <p class="warning" style="display:<?php echo $denied?>">*Uploaded Payment Denied</p>

              <li>
                <i class="fas fa-check" style="visibility:<?php echo $hideIcon4?>"></i>  Payment via BDO,BPI Upload Proof of Payment.
                <a href="#" onclick="document.getElementById('id02').style.display='block'" <?php echo $hideButton4?>>Here</a>
              </li>

  						<p>Step 6</p>
  						<li>
                <i class="fas fa-check" style="visibility:<?php echo $hideIcon6?>"></i> Print Registration Card. <a href="../regcard.php" <?php echo $hideButton6?> >Click Here</a>
              </li>
  					</ul>
			</div>
		</div>
	</section>
	</div>

  <div id="id01" class="modal">
  	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  	<form class="modal-content" action="plan-action.php" method="POST">
  		<div class="container2">
  			<h1>Payment</h1>
        <!--edit 7 start-->
        <?php
        if($summer == "Yes")
        {
        ?>
          <p><b>Note:</b> If you are taking summer class, please wait for the Administrator to process your enrollment, you might not see a Plan available for you in the mean time. </p>
        <?php
        }
        ?>
        <br>
        <!--edit 7 end-->
  					<select name="plan" class="cb" id="plan" onchange="showPlan(this.value,'<?=$grade?>')" required>
  						<option value="">Please select your payment plan.</option>

              <?php
              for($i=0;$i<$totalPlans;$i++)
              {
                ?>
                <option value="<?=$listOfPlans[$i][0]?>"><?=$listOfPlans[$i][0]?></option>
                <?php
              }
              ?>
  					</select>
  			<div id="framePlan" class="clearfix" hidden>
        </div>
  			<center><input type="submit" name="sub-plan" value="Submit" class="modalsub"></center>
  		</div>
  	</form>
  </div>

<div id="id02" class="modal">
	<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="proof-action.php" method="POST" enctype="multipart/form-data">
		<div class="container2">
			<h1>Proof Of Payment</h1>
      <div class="container-table">
        <div class="tbl-rowtitle">
          <p>Upload Your Proof of Payment</p>
        </div>

			<div id="frameProof" class="clearfix">
				<img id="output" style="width:100%;height:400px;"/>
			</div>
				<script>
					var loadFile = function(event) {
						var output = document.getElementById('output');
						output.src = URL.createObjectURL(event.target.files[0]);
						output.onload = function() {
						URL.revokeObjectURL(output.src) // free memory
						}
				};
				</script>
			<br>
			   <center><input type="file" required name="insertedImage" accept="image/*" onchange="loadFile(event)"></center><br>
      </div>
			<center><input type="submit" name="sub-proof" value="Submit" class="modalsub"></center>
		</div>
	</form>
</div>

<div id="id03" class="modal">
	<span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="docu-action.php" method="POST" enctype="multipart/form-data">
		<div class="container2">
      <!--edit 2 start  Notes-->
			<?php
		     echo "Note: Please make sure to upload only the Original photocopy of the required documents, failure to do so may delay your enrollment process. upon submitting the documents, it will be reviewed by the administrator.";
			?>
			<br>
			<br>
			<p><b>Upload Your Document.</b></p>
			<br>

			<!--//edit 2 end-->
      <center>
			<div <?php echo $hideDocu1." "?><?php echo $disableDocu1?>>
        <div class="container-table">
          <div class="tbl-rowtitle">
            <p>Grade</p>
          </div>
				<div id="frameDocu" class="clearfix">
					<img id="output1" style="width:100%;height:400px;"/>
				</div>
				<br>
				<input type="file" <?php echo $disableDocu1?> required name="insertedImage1" accept="image/*" onchange="loadFile1(event)"><br><br>
        </div>
			</div>

			<div <?php echo $hideDocu2." "?><?php echo $disableDocu2?>>
        <div class="container-table">
          <div class="tbl-rowtitle">
            <p>Birth Certificate</p>
          </div>
				<div id="frameDocu" class="clearfix">
					<img id="output2" style="width:100%;height:400px;"/>
				</div>
				<br>
				<input type="file" <?php echo $disableDocu2?> required id="upload1" name="insertedImage2" accept="image/*" onchange="loadFile2(event)"><br><br>
        </div>
			</div>

			<div <?php echo $hideDocu3." "?><?php echo $disableDocu3?>>
        <div class="container-table">
          <div class="tbl-rowtitle">
            <p>Good Moral</p>
          </div>
				<div id="frameDocu" class="clearfix">
					<img id="output3" style="width:100%;height:400px;"/>
				</div>
				<br>
				<input type="file" <?php echo $disableDocu3?> required id="upload2" name="insertedImage3" accept="image/*" onchange="loadFile3(event)"><br><br>
        </div>
			</div>

			<div <?php echo $hideDocu4." "?><?php echo $disableDocu4?>>
        <div class="container-table">
          <div class="tbl-rowtitle">
            <p>Medical Certificate</p>
          </div>
				<div id="frameDocu" class="clearfix">
					<img id="output4" style="width:100%;height:400px;"/>
				</div>
				<br>
				<input type="file" <?php echo $disableDocu4?> required id="upload3" name="insertedImage4" accept="image/*" onchange="loadFile4(event)"><br><br>
        </div>
			</div>

    </center>

    <div class="terms">

      <div class="recent-link">
        <input type="checkbox" style="margin:0 5px;" required> <p>I Agree to</p>
        <p class="link" style="text-decoration:underline; cursor:pointer; margin: 0 5px;">Terms</p> <p>and Conditions</p>
        <span class="hovercard">
          <div class="tooltiptext">
            <b>Terms and Conditions </b>
            <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
            <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
            <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
            <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
          </div>
        </span>
      </div>
    </div>

			<script>
				var loadFile1 = function(event) {
					var output1 = document.getElementById('output1');
					output1.src = URL.createObjectURL(event.target.files[0]);
					output1.onload = function() {
					URL.revokeObjectURL(output1.src) // free memory
					}
			};
			</script>

			<script>
				var loadFile2 = function(event) {
					var output2 = document.getElementById('output2');
					output2.src = URL.createObjectURL(event.target.files[0]);
					output2.onload = function() {
					URL.revokeObjectURL(output2.src) // free memory
					}
			};
			</script>

			<script>
				var loadFile3 = function(event) {
					var output3 = document.getElementById('output3');
					output3.src = URL.createObjectURL(event.target.files[0]);
					output3.onload = function() {
					URL.revokeObjectURL(output3.src) // free memory
					}
			};
			</script>

			<script>
				var loadFile4 = function(event) {
					var output4 = document.getElementById('output4');
					output4.src = URL.createObjectURL(event.target.files[0]);
					output4.onload = function() {
					URL.revokeObjectURL(output4.src) // free memory
					}
			};
			</script>
			<center><input type="submit" name="<?php echo $btnname?>" value="Submit" class="modalsub"></center>
		</div>
	</form>
</div>

<div id="id04" class="modal">
	<span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="docu-action.php" method="POST" enctype="multipart/form-data">
		<div class="container2">
      <!--edit 1 start  Notes-->
			<?php
			if ($summer == "Yes")
			{
		     echo "Note: If you are taking summer class, Please coordinate with the Admin to ensure that you enroll the right subjects. Please E-mail at (standrewcleverlandschool@gmail.com) for subjects you would like to take for summer class";
			}
			else{
				echo "Note: Please upload only the original photo of your grade and the grades visible, failure to submit the original or obscure photo may delay your enrollment process";
			}
			?>
			<br>
			<br>
			<p><b>Upload Your Document.</b></p>
			<br>

			<!--//edit 1 end-->
      <center>
        <div class="container-table">
          <div class="tbl-rowtitle">
            <p>Grade</p>
          </div>

    			<div id="frameProof" class="clearfix">
    				<img id="output5" style="width:100%;height:400px;"/>
    			</div>
  				<script>
  					var loadFile5 = function(event) {
  						var output5 = document.getElementById('output5');
  						output5.src = URL.createObjectURL(event.target.files[0]);
  						output5.onload = function() {
  						URL.revokeObjectURL(output5.src) // free memory
  						}
  				};
  				</script>
			       <br>
    			<input type="file" required name="insertedImage1" accept="image/*" onchange="loadFile5(event)"><br><br>
          <div class="terms">

            <div class="recent-link">
              <input type="checkbox" style="margin:0 5px;" required> <p>I Agree to</p>
              <p class="link" style="text-decoration:underline; cursor:pointer; margin: 0 5px;">Terms</p> <p>and Conditions</p>
              <span class="hovercard">
                <div class="tooltiptext">
                  <b>Terms and Conditions </b>
                  <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
                  <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
                  <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
                  <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
                </div>
              </span>
            </div>
          </div>
    		  <input type="submit" name="<?=$btnname?>" value="Submit" class="modalsub">
          </div>
        </center>
		</div>
	</form>
</div>

<div id="id06" class="modal">
	<span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="docu-action.php" method="POST" enctype="multipart/form-data">
		<div class="container2">
			<h1>Subject</h1>
			<p>Choose Subject/s to Retake.</p><br>
      <input type="text" name="totalSub" value="<?=$totalSubject?>" style="display :none;">
      <?php
      for($i=0;$i<$totalSubject;$i++)
      {
        $subName = "subject".$i;
        ?>
        <input type="checkbox" name="<?=$subName?>" value="<?=$subjectList[$i][1]?>"> <?=$subjectList[$i][1]."(".$subjectList[$i][0].")"?><br>
        <?php
      }
      ?>
      <center><input type="submit" name="sub-subject" value="Submit" class="modalsub"></center>
		</div>
	</form>
</div>

<script>
	function removeReq(cb,inputfile){

		 var cb1 = document.getElementById(cb);
		 var upload1 = document.getElementById(inputfile);

		if(cb1.checked==1 || cb1.checked == 'true'){
			// upload1.removeAttribute("required");
			upload1.setAttribute('disabled','disabled');
		}else if(cb1.checked == 0 || cb1.checked == 'false'){
			// upload1.setAttribute("required","required");
			upload1.removeAttribute("disabled");
		}
	}
</script>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');
var modal4 = document.getElementById('id04');
var modal5 = document.getElementById('id05');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }

	if (event.target == modal2) {
    modal2.style.display = "none";
  }

	if (event.target == modal3) {
    modal3.style.display = "none";
  }

	if (event.target == modal4) {
    modal4.style.display = "none";
  }

	if (event.target == modal5) {
    modal5.style.display = "none";
  }
}
</script>


<script>
function showPlan(plan,grade){
  var framePlan = document.getElementById('framePlan');
  framePlan.removeAttribute("hidden");
  var xhttp;
  if (plan == "") {
    framePlan.innerHTML = plan;
    return;
  }

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    framePlan.innerHTML = this.responseText;
  }
  };

  xhttp.open("GET", "include/getPlanDetails.php?plan="+plan+"&grade="+grade, true);
  xhttp.send();
}
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60ab35cdbbd5354c0fdbb7c7/1f6eckb68';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>

<script>
$(document).ready(function() {
        $('.link').hover(
          function() {
          $('.hovercard').css('display', 'block')
        },

        function() {
        $('.hovercard').css('display', 'none')
      },
    );
});
</script>
