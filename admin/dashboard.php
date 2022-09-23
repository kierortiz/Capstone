<?php
session_start();

if(isset($_SESSION['success']))
{
  if($_SESSION['success']==1)
  {
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'Successfully Logged In!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success']);
  }
}

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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Home</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
  <script src="../JS/sweetalert2@10.js">//script for sweet alert</script>
  <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include('include/header.php');?>
	<div class="body">
	<?php include('include/nav.php');?>
		<section class="section-1">

		</section>
	</div>

</body>
</html>
