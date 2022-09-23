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

if(isset($_SESSION['s_add']))
{
  if($_SESSION['s_add']==1){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'Successfully Created Account!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_add']);
  }else if($_SESSION['s_add']==2){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Email is already taken!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_add']);
  }else if($_SESSION['s_add']==3){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'warning',
						title : 'Error!',
						text : 'Password and Repeat Password are not match!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_add']);
  }else{
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Error!',
            text : 'Failed creating account!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_add']);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admission</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
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
				<h1>Add Account</h1>
				<div class="container-table">
							<div class="row-title">
									<p>Enter Info</p>
							</div>

							<div class="container-form">
								<form method="POST" action="add-admin.php">
								<div class="row">
									<div class="col-1">
									<span>Name</span>
									</div>
									<div class="col-2">
									<input type="text" name="name" value="" class="border" placeholder="Enter Name" required>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span>Address</span>
									</div>
									<div class="col-2">
									<input type="text" name="addr" value="" class="border" placeholder="Enter Address" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span for="5">Contact Number</span>
									</div>
									<div class="col-2">
									<input type="text" maxlength="10" onkeypress="validate(event)" name="contact" value="" class="border" placeholder="9xxxxxxxxx" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span for="6">Email</span>
									</div>
									<div class="col-2">
									<input type="text" name="email" value="" class="border" placeholder="Enter Email" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Gender</span>
									</div>
									<div class="col-2" style="display:flex;flex-direction:row;align-items:center;justify-content:center;width:300px;">
	                <input type="radio" name="gen" value="Male" id="7.1" class="border" required>
	                <label for="7.1" style="margin:0 10px;">Male</label>
	                <input type="radio" name="gen" value="Female" id="7.2" class="border" required>
									<label for="7.2" style="margin:0 10px;">Female</label>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span>Birthday</span>
									</div>
									<div class="col-2">
									<input type="date" name="bdate" value="" class="border" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Password</span>
									</div>
									<div class="col-2">
									<input type="password" name="pass" value="" class="border" placeholder="Password" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Repeat Password</span>
									</div>
									<div class="col-2">
									<input type="password" name="rpass" value="" class="border" placeholder="Repeat your Password" required>
									</div>
								</div>


	              <div class="row">
	                <div class="col-1">
	                <span>Position</span>
	                </div>
	                <div class="col-2">
	                  <select name="position" class="cb" required>
	                    <option value=""></option>
	                    <option value="REGISTRAR">Registrar</option>
	                    <option value="ACCOUNTING">Accounting</option>
	                    <option value="ADMIN">Admin</option>
	                  </select>
	                </div>
	              </div>
							</div>

							<div class="row">
								<div class="center">
									<input type="submit" name="sub-add" value="Create Account" class="btn-sub">
								</div>
							</div>
						</form>
				</div>
			</div>
		</section>
	</div>

</body>
</html>

<script type="text/javascript">
//limit input in mobile number to numbers only
  function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
