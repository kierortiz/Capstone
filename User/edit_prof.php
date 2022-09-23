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

if(isset($_POST['sub-upload'])){
	$directory = "../assets/user-avatar/";
	$target_file = $directory . basename($_FILES["insertedImage"]["name"]);
	$checkerUpload = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


	$check = getimagesize($_FILES["insertedImage"]["tmp_name"]);
	if($check !== false)
	{
		$checkerUpload = 1;
	}
	else
	{
		echo " <br> File is not an image.";
		$checkerUpload = 0;
	}

	if($fileType != "gif" && $fileType != "png" && $fileType
	!= "jpeg"
	&&  $fileType != "jpg")
	{
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload = 0;
	}

	if ($checkerUpload == 0)
	{
		echo "<br>Sorry, your file was not uploaded.";
	}
	else
	{
		if (move_uploaded_file($_FILES["insertedImage"]["tmp_name"],
		$target_file))
		{
			$iname = $_FILES['insertedImage']['name'];
      $nname=$UID."-"."profile.".$fileType;
      rename($directory.$iname,$directory.$nname);
			$sqlupd = "UPDATE tbl_account SET IMAGE = '$nname' WHERE UID ='$UID'";
			$res=$conn->query($sqlupd);
			if($res){
        ?>
    		<script>
    			window.addEventListener("load",function(){
    				swal.fire({
    						icon : 'success',
    						title : 'Success!',
    						text : 'Successfully Uploaded Profile Picture!'
    				})
    			},false)
    			</script>
    		<?php
			}else{
        ?>
    		<script>
    			window.addEventListener("load",function(){
    				swal.fire({
    						icon : 'error',
    						title : 'Error!',
    						text : 'Failed to Upload Profile Picture!'
    				})
    			},false)
    			</script>
    		<?php
			}
		}else{
			echo "Error In Uploading File!";
		}
	}
}

$sql = "SELECT * FROM tbl_account WHERE UID='$UID'";
$res = $conn->query($sql);
if($res->num_rows>0)
{
	$row = $res->fetch_assoc();
	$email = $row['EMAILADD'];
	$fname = $row['FIRSTNAME'];
	$image = $row['IMAGE'];
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
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
  <link href="../assets/CSS/form_table.css" rel="stylesheet" type="text/css">
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
				<h1>Edit Profile</h1>
				<div class="container-table">
							<div class="row-title">
									<p>Upload Profile Picture</p>
							</div>

							<div class="container-form">
								<div class="row center">
									<form method = "POST" action="edit_prof.php" enctype="multipart/form-data">
										<div class="IsertImage">
											<input type="file" required name="insertedImage" accept="image/*" onchange="loadFile(event)">
											<div class="empty-text">
													<img id="output" style="width:500px;height:500px;"/>
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
									</div>
											<input type="submit" value="Upload Picture" name="sub-upload" class="modalsub">
									</form>
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
