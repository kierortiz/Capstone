<?php
//session_start();
$logout = $_SESSION["loggedin"];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<nav class="side-bar">
			<div class="user-p2">
				<img src="../assets/user-avatar/<?php echo $image?>" alt=""/ class="avatar">
		<h4><?php echo "User ID: ".$UID?></h4>
		  </div>
			<ul id="sidebar">
				<li>
					<a href="../index.php"><i class="fas fa-home" aria-hidden="true"></i><span>Home</span></a>
					<!--<a href="../index.php"><i class="fas fa-home" aria-hidden="true"></i><span><?php echo $logout;?></span></a>-->
				</li>
				<div class="dropdown">
					<button class="dropbtn">
						<i class="fas fa-user-circle" aria-hidden="true"></i>
						<span>Profile</span>
						<i style="float: right;" class="fa fa-caret-down" aria-hidden="true"></i>
					</button>
					<div class="dropdown-content">
						<a href="view_prof.php">View Profile</a>
						<a href="edit_prof.php">Edit Profile</a>
					</div>
				</div>

				<li>
					<a href="progress.php"><i class="fas fa-tasks" aria-hidden="true"></i><span>Enroll</span></a>
				</li>

				<li>
					<a href="view_subj.php"><i class="fas fa-table" aria-hidden="true"></i><span>View Subjects</span></a>
				</li>

				<li>
					<a href="../logout.php?".<?php echo $logout?>><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span>Logout</span></a>
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
