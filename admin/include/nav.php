<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
$position = $_SESSION['POSITION'];
if($position == "ACCOUNTING"){
	$hidemenusaccounting="hidden";
	$hidemenusregistrar="";
	$hideboth="hidden";
}else if($position=="REGISTRAR"){
	$hidemenusregistrar="hidden";
	$hidemenusaccounting="";
	$hideboth="hidden";
}else{
	$hidemenusregistrar="";
	$hidemenusaccounting="";
	$hideboth="";
}
$logout = $_SESSION["loggedin"];
?>
<nav class="side-bar">
			<div class="user-p">
				<img src="../assets/img/logo.png" alt=""/>
		<h4>ST. ANDREW'S CLEVERLAND SCHOOL</h4>
		  </div>
			<ul id="sidebar">

				<div class="dropdown" <?php echo $hidemenusaccounting?>>
			    <button class="dropbtn" <?php echo $hidemenusaccounting?>>
						<i class="far fa-user-circle" aria-hidden="true" <?php echo $hidemenusaccounting?>></i>
						<span <?php echo $hidemenusaccounting?>>Student Documents</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true" <?php echo $hidemenusaccounting?>></i>
			    </button>
			    <div class="dropdown-content">
				    <a href="students.php">Regular Class</a>
				    <a href="students1.php">Summer Class</a>
			    </div>
				</div>

				<li <?php echo $hidemenusregistrar?>>
					<a href="payment.php"><i class="fas fa-table" aria-hidden="true" <?php echo $hidemenusregistrar?>></i><span>Payments</span></a>
				</li>

				<div class="dropdown" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>
			    <button class="dropbtn" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>
						<i class="far fa-user-circle" aria-hidden="true" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>></i>
						<span <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>Sections</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>></i>
			    </button>
			    <div class="dropdown-content">
				    <a href="section.php">Regular Class</a>
				    <a href="section1.php">Summer Class</a>
			    </div>
				</div>


				<div class="dropdown" <?php echo $hideboth?>>
			    <button class="dropbtn" <?php echo $hideboth?>>
						<i class="far fa-user-circle" aria-hidden="true" <?php echo $hideboth?>></i>
						<span <?php echo $hideboth?>>Accounts</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true" <?php echo $hideboth?>></i>
			    </button>
			    <div class="dropdown-content">
				    <a href="accounts.php">Manage Accounts</a>
				    <a href="add_acc.php">Add Account</a>
			    </div>
				</div>

				<div class="dropdown" <?php echo $hidemenusregistrar?>>
			    <button class="dropbtn" <?php echo $hidemenusregistrar?>>
						<i class="far fa-user-circle" aria-hidden="true" <?php echo $hidemenusregistrar?>></i>
						<span <?php echo $hidemenusregistrar?>>Manage Tuition Fees</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true" <?php echo $hidemenusregistrar?>></i>
			    </button>
			    <div class="dropdown-content">
				    <a href="tuition.php">Regular Class</a>
				    <a href="tuition1.php">Summer Class</a>
			    </div>
				</div>


				<div class="dropdown" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>
			    <button class="dropbtn" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>
						<i class="fas fa-history" aria-hidden="true" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>></i>
						<span <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>>Archives</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true" <?php echo $hidemenusaccounting." ".$hidemenusregistrar?>></i>
			    </button>
			    <div class="dropdown-content">
						<a href="acc_arc.php">Accounts Archived</a>
				    <a href="subj_arc.php">Subjects Archived</a>
						<a href="tuition_arc.php">Tuition Archived</a>
			    </div>
				</div>
				<li <?php echo $hideboth?>>
					<a href="logs.php" <?php echo $hideboth?>><i class="fas fa-book" aria-hidden="true"></i><span>Logs</span></a>
				</li>

				<li>
					<a href="../logout.php?".<?php echo $logout?>><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span>Logout</span></a>
				<!--<a href="../index.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span>Logout</span></a>-->
				</li>

			</ul>
		</nav>


		<script>
		setInterval(function(){
			var $sidebar = $("#sidebar");

			if($sidebar.is(":hover")) {
				 $( "#checkbox" ).prop( "checked", false );
			}

			}, 200);

		</script>
