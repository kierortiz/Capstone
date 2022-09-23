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
$UID = $_SESSION['UID'];
//get user's data
$sql = "SELECT * FROM tbl_account WHERE UID='$UID'";
$res = $conn->query($sql);
if($res->num_rows>0)
{
	$row = $res->fetch_assoc();
  $lrn = $row['LRN'];
	$email = $row['EMAILADD'];
	$fname = $row['FIRSTNAME'];
	$mname = $row['MIDDLENAME'];
	$lname = $row['LASTNAME'];
	$addr = $row['ADDRESS'];
	$gen = $row['GENDER'];
	$contact = $row['CONTACTNO'];
	$bdate = $row['BIRTHDATE'];
	$oldornew = $row['OLDORNEW'];
	$image = $row['IMAGE'];
	$religion = $row['RELIGION'];
	$grade = $row['YEARLEVEL'];
	$bplace = $row['BIRTHPLACE'];
	$plan = $row['PLAN'];
	$reg = $row['REGISTER'];
  $summer = $row['SUMMER'];
  if($summer=="Yes")
  {
    $summer="SUMMER CLASS";
  }else{
    $summer="REGULAR CLASS";
  }
}else{
  $lrn = "";
	$fname="";
	$mname="";
	$lname="";
	$addr="";
	$fname="";
	$gen="";
	$contact="";
	$oldornew="";
	$image="";
	$religion="";
	$grade="";
	$bplace="";
	$plan="";
	$reg="";
  $summer="";
}

if(empty($image) || $image == "")
{
		$image = "temp.png";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/form_table.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="assets/logo.png">
	</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include('include/header.php');?>
	<div class="body">
	<?php include('include/nav.php');?>
		<section class="section-1">
			<div class="container">
				<h1>View Profile</h1>
				<div class="container-table">
          <div class="row-title">
            <p>My Details</p>
          </div>

          <div class="container">

              <label>LRN</label>
              <input type="text" value="<?php echo $lrn?>" class="infocus" readonly="">

              <label>Student ID</label>
              <input type="text" value="<?php echo $UID?>" class="infocus" readonly="">

              <label>First Name</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $fname?>">

              <label>Middle Name</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $mname?>">

              <label>Last Name</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $lname?>">

              <label>Address</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $addr?>">

              <label>Gender</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $gen?>">

              <label>Contact No</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $contact?>">

              <label>Birthdate:</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $bdate?>">

              <label>Email</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $email?>">

              <label>Religion:</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $religion?>">

              <label>Grade Level</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $grade?>">

              <label>Plan Payment</label>
              <input type="text" class="infocus" readonly="" value="<?php echo $plan?>">

              <label>Student Classification</label>
              <input type="text" class="infocus" readonly="" value="<?php echo strtolower($oldornew)?>" style="text-transform:capitalize;">

              <label>Enrollment Status</label>
              <input type="text" class="infocus" readonly="" value="<?php echo strtolower($reg)."(".$summer.")"?>" style="text-transform:capitalize;">

            </div>
									</div>
								</div>

			</div>
		</section>
	</div>
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
