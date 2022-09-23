<!DOCTYPE html>
<html>
<head>
	<title>Admission</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/form_table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/modal.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="assets/logo.png">

</head>
<body>
<form method="POST" action="reg-action.php">
	<div class="body">
		<section class="section-1">
			<div class="container">
				<h1>Admission</h1>
				<div class="container-table">
							<div class="container-form">
								<div class="row">
									<div class="col-1">
									<!--Edit 3 Start-->
									<h3> Note: </h3> <p>Please fill up the form truthfully and accurately, any mistakes or mispelled information may delay your enrollment process. </p>
									<br>
									<span>LRN (OPTIONAL)</span>
									<!--Edit 3 End-->
									</div>
									<div class="col-2">
									<input type="text" name="lrn" value="" class="border" placeholder="Enter LRN">
									</div>
								</div>
								<div class="row">
									<div class="col-1">
									<span>First name</span>
									</div>
									<div class="col-2">
									<input type="text" name="fname" value="" class="border" placeholder="Enter First Name" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Middle name</span>
									</div>
									<div class="col-2">
									<input type="text" name="mname" value="" class="border" placeholder="Enter Middle Name" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Last name</span>
									</div>
									<div class="col-2">
									<input type="text" name="lname" value="" class="border" placeholder="Enter Last Name" required>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span>Gender</span>
									</div>
									<div class="col-2" style="display:flex;flex-direction:row;align-items:center;justify-content:center;width:300px;">
	                <input type="radio" name="gen" value="Male" id="male" class="border" required>
	                <label for="male" style="margin:0 10px;">Male</label>
	                <input type="radio" name="gen" value="Female" id="female" class="border" required>
									<label for="female" style="margin:0 10px;">Female</label>
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
									<span>Birthdate</span>
									</div>
									<div class="col-2">
									<input type="date" name="bdate" value="" class="border" required>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span>Birthplace</span>
									</div>
									<div class="col-2">
									<input type="text" name="bplace" value="" class="border" placeholder="Enter Birthplace" required>
									</div>
								</div>

	              <div class="row">
									<div class="col-1">
									<span>Contact Number</span>
									</div>
									<div class="col-2">
									<input type="text" name="contact" value="" class="border" placeholder="9xxxxxxxxx" maxlength="10" onkeypress="validate(event)" required>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span for="6">Religion</span>
									</div>
									<div class="col-2">
									<input type="text" name="religion" value="" class="border" placeholder="Enter Religion" required>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<input type="checkbox" name="new" value="NEW">
									<span style="margin:0 10px;">New Student?</span>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span for="6">Grade</span>
									</div>
									<div class="col-2">
										<select name="grade" required>
											<option value="">-Select-</option>
											<option value="Grade 1">Grade 1</option>
											<option value="Grade 2">Grade 2</option>
											<option value="Grade 3">Grade 3</option>
											<option value="Grade 4">Grade 4</option>
											<option value="Grade 5">Grade 5</option>
											<option value="Grade 6">Grade 6</option>
											<option value="Grade 7">Grade 7</option>
											<option value="Grade 8">Grade 8</option>
											<option value="Grade 9">Grade 9</option>
											<option value="Grade 10">Grade 10</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-1">
									<span>Summer Class?</span>
									</div>
									<div class="col-2" style="display:flex;flex-direction:row;align-items:center;justify-content:center;width:300px;">
	                <input type="radio" name="summer" value="Yes" id="Male" class="border" required>
	                <label for="Yes" style="margin:0 10px;">Yes</label>

	                <input type="radio" name="summer" value="No" id="No" class="border" required>
									<label for="No" style="margin:0 10px;">No</label>
									</div>
								</div>

							<div class="row">
								<div class="center">
									<input type="submit" name="sub" value="Confirm" class="btn-sub">
									<input type="button" name="can" value="Cancel" class="btn-sub" onclick="window.location.href='progress.php'">
								</div>
							</div>
				</div>
			</div>
		</section>
	</div>
</form>
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
