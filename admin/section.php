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
include 'include/section-sweet.php';

$sections = array();
$totalsec=0;
$sqlsec = "SELECT * from tbl_subjects WHERE SUB_STATUS='ACTIVE' AND SUB_SUMMER='No' GROUP BY SUB_YEAR, SUB_SECTION ORDER BY SUB_SECTION,SUB_YEAR";
$ressec = $conn->query($sqlsec);
if($ressec->num_rows>0){
	while($rowsec = $ressec->fetch_assoc()){
		$sections[$totalsec][0]=$rowsec['SUB_YEAR'];
		$sections[$totalsec][1]=$rowsec['SUB_SECTION'];
    $sections[$totalsec][2]=$rowsec['SUB_ID'];
		$totalsec++;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sections</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/modal3(long).css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/admin_account.css" rel="stylesheet" type="text/css">
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
			<h1>Sections(Regular Class)</h1>
			<div class="container-table">
				<button type="button" class="btn" style="width:150px; margin: auto; margin-top: 30px;" onclick="document.getElementById('id01').style.display='block'">Add Section</button>
						<table>
							<tbody>
								<tr>
									<th>Grade</th>
									<th>Section</th>
									<th colspan="3">Action</th>
								</tr>
								<?php
								for($i=0;$i<$totalsec;$i++)
								{
                  $grade = $sections[$i][0];
                  $section = $sections[$i][1];

									?>
									<tr>
										<td><?php echo $sections[$i][0]?></td>
										<td><?php echo $sections[$i][1]?></td>

                    <td><a href="#" onclick="showModalSubjects(<?php echo "'".$grade."','".$section."'"?>,'section')"><i class="fas fa-table" aria-hidden="true"></i>View Subjects</a></td>
                    <td><a href="#" onclick="editSection(<?php echo "'".$grade."','".$section."'"?>,'section')" style="color:green"><i class="far fa-edit"></i>Edit Section</a></td>
										<td><a onclick="sweetalertdelete('remove-section.php?grade=<?php echo $grade?>&section=<?php echo $section?>&summer=No')" href="#" style="color:red;"><i class="fas fa-trash-alt"></i>Remove</a></td>
									</tr>

                  <script>
                  	function showModalSubjects(grade,section,page_from) {
                  	document.getElementById('id03').style.display='block';

                  	var xhttp;
                  	if (grade == "") {
                  		document.getElementById("id03").innerHTML = grade;
                  		return;
                  	}

                  	xhttp = new XMLHttpRequest();
                  	xhttp.onreadystatechange = function() {
                  	if (this.readyState == 4 && this.status == 200) {
                  	  document.getElementById("id03").innerHTML = this.responseText;
                  	}
                  	};

                  	xhttp.open("GET", "showModalSubjects.php?grade="+grade+"&section="+section+"&page_from="+page_from, true);
                  	xhttp.send();
                  	}
                  </script>

                  <script>
                  	function editSection(grade,section,page_from) {
                  	document.getElementById('id02').style.display='block';

                  	var xhttp;
                  	if (grade == "") {
                  		document.getElementById("id02").innerHTML = grade;
                  		return;
                  	}

                  	xhttp = new XMLHttpRequest();
                  	xhttp.onreadystatechange = function() {
                  	if (this.readyState == 4 && this.status == 200) {
                  	  document.getElementById("id02").innerHTML = this.responseText;
                  	}
                  	};

                  	xhttp.open("GET", "editSection.php?grade="+grade+"&section="+section+"&page_from="+page_from, true);
                  	xhttp.send();
                  	}
                  </script>
									<?php
								}
								?>
							</tbody>
						</table>
			</div>
		</div>
	</section>
</div>
  <div id="id03" class="modal">

  </div>

  <div id="id02" class="modal">

  </div>

	<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<form class="modal-content" action="section-action.php" method="POST">
			<div class="container2">
			<h1>Add Section</h1>
			<p>Grade</p>
			<input type="text" name="sec-grade"  required placeholder="Sample: Grade 1">

			<p>Section #</p>
			<input type="text" name="sec-no"  required placeholder="Sample: Section 1">
      <!--Edit 5 Start -->
			<div class="row">
					<div class="col-1">
					<span for="6">Summer Class?</span>
					<br>
					</div>
					<br>
					<div>
					<br>
					<input type="radio" name="summer" value="Yes" required>Yes
					<br>
					<input type="radio" name="summer" value="No" required>No
				</div>
			</div>
			<!--Edit 5 End -->
			<div class="container-table">
						<table class="table-modal">
							<tbody>
                <tr>
                  <div class="tbl-rowtitle">
                      <p>Subjects #1</p>
                  </div>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag1" placeholder="Enter Subject Tag" required value=""></td>
									<td><input type="text" name="sub-name1" placeholder="Enter Subject Name" required value=""></td>
									<td><input type="text" name="sub-start1" placeholder="Enter Starting Time" required value=""></td>
									<td><input type="text" name="sub-end1" placeholder="Enter End Time" required value=""></td>
									<td><input type="text" name="sub-room1" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day1" placeholder="Enter Day" required value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #2</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag2" placeholder="Enter Subject Tag" required value=""></td>
									<td><input type="text" name="sub-name2" placeholder="Enter Subject Name" required value=""></td>
									<td><input type="text" name="sub-start2" placeholder="Enter Starting Time" required value=""></td>
                  <td><input type="text" name="sub-end2" placeholder="Enter End Time" required value=""></td>
									<td><input type="text" name="sub-room2" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day2" placeholder="Enter Day" required value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #3</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag3" placeholder="Enter Subject Tag" required value=""></td>
									<td><input type="text" name="sub-name3" placeholder="Enter Subject Name" required value=""></td>
									<td><input type="text" name="sub-start3" placeholder="Enter Starting Time" required value=""></td>
									<td><input type="text" name="sub-end3" placeholder="Enter End Time" required value=""></td>
									<td><input type="text" name="sub-room3" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day3" placeholder="Enter Day" required value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #4</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag4" placeholder="Enter Subject Tag" required value=""></td>
									<td><input type="text" name="sub-name4" placeholder="Enter Subject Name" required  value=""></td>
									<td><input type="text" name="sub-start4" placeholder="Enter Starting Time"  required  value=""></td>
									<td><input type="text" name="sub-end4" placeholder="Enter End Time" required  value=""></td>
									<td><input type="text" name="sub-room4" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day4" placeholder="Enter Day" required  value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #5</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag5" placeholder="Enter Subject Tag" required  value=""></td>
                  <td><input type="text" name="sub-name5" placeholder="Enter Subject Name" required  value=""></td>
									<td><input type="text" name="sub-start5" placeholder="Enter Starting Time"  required value=""></td>
									<td><input type="text" name="sub-end5" placeholder="Enter End Time" required value=""></td>
									<td><input type="text" name="sub-room5" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day5" placeholder="Enter Day" required  value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #6</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag6" placeholder="Enter Subject Tag" required value=""></td>
									<td><input type="text" name="sub-name6" placeholder="Enter Subject Name" required value=""></td>
									<td><input type="text" name="sub-start6" placeholder="Enter Starting Time" required value=""></td>
									<td><input type="text" name="sub-end6" placeholder="Enter End Time" required  value=""></td>
									<td><input type="text" name="sub-room6" placeholder="Enter Room Number"  required value=""></td>
									<td><input type="text" name="sub-day6" placeholder="Enter Day" required  value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #7</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag7" placeholder="Enter Subject Tag" required  value=""></td>
									<td><input type="text" name="sub-name7" placeholder="Enter Subject Name" required value=""></td>
									<td><input type="text" name="sub-start7" placeholder="Enter Starting Time" required value=""></td>
									<td><input type="text" name="sub-end7" placeholder="Enter End Time" required  value=""></td>
									<td><input type="text" name="sub-room7" placeholder="Enter Room Number" required value=""></td>
									<td><input type="text" name="sub-day7" placeholder="Enter Day" required value=""></td>
								</tr>

                <tr>
                      <td class="tbl-rowtitle" colspan="6"><p>Subjects #8</p></td>
                </tr>

								<tr>
                  <th>Subject Tag</th>
									<th>Subject Name</th>
									<th>Start</th>
									<th>End</th>
									<th>Room</th>
									<th>Day</th>
								</tr>
								<tr>
                  <td><input type="text" name="sub-tag8" placeholder="Enter Subject Tag" value=""></td>
									<td><input type="text" name="sub-name8" placeholder="Enter Subject Name" value=""></td>
									<td><input type="text" name="sub-start8" placeholder="Enter Starting Time" value=""></td>
									<td><input type="text" name="sub-end8" placeholder="Enter End Time" value=""></td>
									<td><input type="text" name="sub-room8" placeholder="Enter Room Number" value=""></td>
									<td><input type="text" name="sub-day8" placeholder="Enter Day" value=""></td>
								</tr>

							</tbody>
						</table>
			</div>

			<input type="submit" class="modalsub" name="sub-add-section" value="Confirm">
		</div>
		</form>
	</div>


</body>
</html>

<script>
function sweetalertdelete(href)
{
	Swal.fire({
			title: 'Are you sure?',
			text: "This will be put in the archives!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove it!'
			}).then((result) => {
					if (result.value) {
							document.location.href = href;
					}
			})
}
</script>

<script>
	var addclass = 'highlight';
	var $cols = $('.selected').click(function(e) {
		$cols.removeClass(addclass);
		$(this).addClass(addclass);
	});
</script>
