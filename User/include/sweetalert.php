<?php
if(isset($_SESSION['s_enroll']))
{
	if($_SESSION['s_enroll']==1){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'Successfully sent admission form!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['s_enroll']);
	}else if($_SESSION['s_enroll']==0){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Failed sending admission form!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_enroll']);
	}
}

if(isset($_SESSION['s_docu']))
//for proof of payment
{
	if($_SESSION['s_docu']==1){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'You have successfully sent your document! Your documents is now on pending status'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['s_docu']);
	}else if($_SESSION['s_docu']==0){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Failed to send your document!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_docu']);
	}
}

if(isset($_SESSION['s_plan']))
//for plan payment
{
	if($_SESSION['s_plan']==1){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'You have successfully pick your plan payment!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['s_plan']);
	}else if($_SESSION['s_plan']==0){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Failed to pick your plan payment!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_plan']);
	}
}else if(isset($_SESSION['s_proof']))
//for proof of payment
{
	if($_SESSION['s_proof']==1){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'success',
						title : 'Success!',
						text : 'You have successfully sent your proof of payment!'
				})
			},false)
			</script>
		<?php
		unset($_SESSION['s_proof']);
	}else if($_SESSION['s_proof']==0){
    ?>
		<script>
			window.addEventListener("load",function(){
				swal.fire({
						icon : 'error',
						title : 'Error!',
						text : 'Failed to send your proof of payment!'
				})
			},false)
			</script>
		<?php
    unset($_SESSION['s_proof']);
	}
}
?>
