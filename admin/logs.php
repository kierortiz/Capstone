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
$sort="";
if(isset($_POST['logout']))
{
  $sort="WHERE LOG_ACTION LIKE '%Logged In%' OR LOG_ACTION LIKE '%Logged out%'";
}else if(isset($_POST['admin'])){
  $sort="WHERE LOG_ACTION LIKE '%ADMIN%'";
}else if(isset($_POST['reg'])){
  $sort="WHERE LOG_ACTION LIKE '%REGISTRAR%'";
}else if(isset($_POST['acc'])){
  $sort="WHERE LOG_ACTION LIKE '%ACCOUNTING%'";
}else if(isset($_POST['student'])){
  $sort="WHERE LOG_ACTION LIKE '%USER%'";
}else if(isset($_POST['sub-search']))
{
  $search = $_POST['search'];
  $sort="WHERE LOG_ACTION LIKE '%$search%'";
}
$sql = "SELECT * FROM tbl_logs ".$sort." ORDER BY LOG_DATE DESC ";
$res = $conn->query($sql);
$logs = array();
$noOfLogs=0;
if($res->num_rows>0)
{
while($row = $res->fetch_assoc())
{
  $logs[$noOfLogs][0]=$row['LOG_NAME'];
  $logs[$noOfLogs][1]=$row['LOG_ACTION'];
  $logs[$noOfLogs][2]=$row['LOG_DATE'];
  $noOfLogs++;
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logs</title>
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
			<h1>Logs</h1>

			<div class="container-table" style="border-top: solid #2c3136 5px;">
				<div class="row-title">

				</div>
        <br>
        <form method="POST" action="logs.php">
          <input type="submit" name="all" value="ALL">
          <input type="submit" name="admin" value="ADMIN">
          <input type="submit" name="reg" value="REGISTRAR">
          <input type="submit" name="acc" value="ACCOUNTING">
          <input type="submit" name="student" value="STUDENT">
          <input type="submit" name="logout" value="LOGIN/LOGOUT"><br><br>
          <span>Search:</span>
          <input type="text" name="search" placeholder="SID,AID,Name, etc">
          <input type="submit" name="sub-search" value="Submit">
        </form>
				<table>
					<tbody>
						<tr>
							<th>Log Name</th>
							<th>Action</th>
							<th>Date</th>
						</tr>
						<?php
						for($i=0;$i<$noOfLogs;$i++)
						{
							?>
							<tr>
								<td><?= $logs[$i][0]?></td>
								<td><?= $logs[$i][1]?></td>
								<td><?= $logs[$i][2]?></td>
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

</body>
</html>

<script>
	function sortLogs(type) {

	var xhttp;
	if (type == "") {
		document.getElementById("table-account").innerHTML = type;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("table-account").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "sortLogs.php?type="+type, true);
	xhttp.send();
	}

</script>
