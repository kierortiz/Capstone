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
$sql = "SELECT * FROM tbl_account WHERE UID='$UID'";
$res = $conn->query($sql);
if($res->num_rows>0)
{
	$row = $res->fetch_assoc();
	$email = $row['EMAILADD'];
	$fname = $row['FIRSTNAME'];
	$image = $row['IMAGE'];
	$section = $row['SECTION'];
	$grade = $row['YEARLEVEL'];
  $summer = $row['SUMMER'];
}

if($summer == "Yes"){

  $subjects = array();
  $totalsub = 0;
  $summerSub = "SELECT * FROM tbl_summer WHERE SUID = '$UID'";
  $ressummer = $conn->query($summerSub);
  if($ressummer->num_rows>0){
    while($rowsummer = $ressummer->fetch_assoc())
    {
      $subjectName = $rowsummer['SUBJECT'];
      $ressub = $conn->query("SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' AND SUB_SECTION='$section' AND SUB_NAME='$subjectName' AND SUB_SUMMER='Yes'");
      if($ressub->num_rows>0){
        $rowsub = $ressub->fetch_assoc();
      	$subjects[$totalsub][0]=$rowsub['SUB_TAG'];
        $subjects[$totalsub][1]=$rowsub['SUB_NAME'];
        $subjects[$totalsub][2]=$rowsub['SUB_DAY'];
        $subjects[$totalsub][3]=$rowsub['SUB_TIME'];
        $subjects[$totalsub][4]=$rowsub['SUB_ROOM'];
        $totalsub++;
      }
    }
  }else{
    echo "No Summer Subject/s Found!";
  }
}else{
  $subjects = array();
  $totalsub=0;
  $ressub = $conn->query("SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' AND SUB_SECTION='$section' AND SUB_SUMMER='No'");
  if($ressub->num_rows>0){
  	while($rowsub = $ressub->fetch_assoc())
  	{
  		$subjects[$totalsub][0]=$rowsub['SUB_TAG'];
  		$subjects[$totalsub][1]=$rowsub['SUB_NAME'];
  		$subjects[$totalsub][2]=$rowsub['SUB_DAY'];
  		$subjects[$totalsub][3]=$rowsub['SUB_TIME'];
  		$subjects[$totalsub][4]=$rowsub['SUB_ROOM'];
  		$totalsub++;
  	}
  }else{
  	echo "No Subject/s Found";
  }
}

if(empty($image) || $image == "")
{
		$image = "temp.png";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Subjects</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/admin_account.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="assets/logo.png">
	</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include('include/header.php');?>
	<div class="body">
	<?php include('include/nav.php');?>
	<section class="section-1">
		<div class="container">
			<h1>My Subjects</h1>
			<div class="container-table">
						<table>
							<tbody>
								<tr>
									<th>Tag</th>
									<th>Subject Name</th>
									<th>Subject Schedule</th>
									<th>Year</th>
									<th>Room</th>
								</tr>
								<?php
								for($i=0;$i<$totalsub;$i++)
								{
									?>
									<tr>
										<td><?php echo $subjects[$i][0]?></td>
										<td><?php echo $subjects[$i][1]?></td>
										<td><?php echo $subjects[$i][2]?></td>
										<td><?php echo $subjects[$i][3]?></td>
										<td><?php echo $subjects[$i][4]?></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
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

<script>
	var addclass = 'highlight';
	var $cols = $('.selected').click(function(e) {
		$cols.removeClass(addclass);
		$(this).addClass(addclass);
	});
</script>
