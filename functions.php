<?php
if(isset($_SESSION['success_register']))
{
	if($_SESSION['success_register']==1){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'Successfully created new account!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success_register']);
	}else if($_SESSION['success_register']==2){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'warning',
						title : 'Warning!',
						text : 'Password and repeat password are not match!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success_register']);
	}else if($_SESSION['success_register']==3){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'warning',
						title : 'Warining!',
						text : 'This email is already taken!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success_register']);
	}else if($_SESSION['success_register']==0){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Error while creating account!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success_register']);
	}
}

if(isset($_SESSION['logout']))
{
	if($_SESSION['logout']==1)
	{
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Successfully Logged Out!',
						text : 'You are now logged out!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['logout']);
	}
}

if(isset($_SESSION['change_pass']))
{
	if($_SESSION['change_pass']==1)
	{
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'Successfully Changed Password!'
				})
			},false)
			</script>
		<?php
	}else if($_SESSION['change_pass']==0){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Please contact your admin!'
				})
			},false)
			</script>
		<?php
	}
	unset($_SESSION['change_pass']);
}

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
	}else if($_SESSION['success']==2){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'warning',
						title : 'Warning!',
						text : 'Please verify your account first!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success']);
	}else if($_SESSION['success']==0){
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon: 'error',
						title : 'Error!',
						text : 'Username/Password is incorrect!',
				})
			},false)
			</script>
		<?php
		unset($_SESSION['success']);
	}
}

//message for forgot password error or success
if(isset($_SESSION['success_sent']))
{
	//error
	if($_SESSION['success_sent']==0)
	{
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon: 'error',
						title : 'Email Not Found!',
						text : 'Email is not registered yet!',
				})
			},false)
			</script>
		<?php
	}
	//success
	else if($_SESSION['success_sent']==1)
	{
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon: 'success',
						title : 'Success!',
						text : 'Successfully sent link for changing of password to your email!',
				})
			},false)
			</script>
		<?php
	}else{
		?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon: 'error',
						title : 'System Error!',
						text : 'Please contact our admin for this error!',
				})
			},false)
			</script>
		<?php
	}
	unset($_SESSION['success_sent']);
}
?>
