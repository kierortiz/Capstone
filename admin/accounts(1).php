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
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;
include '../conn.php';
include 'include/accounts-functions.php';
//sweet alert
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
            text : 'Successfully Edited Student Account!'
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
            text : 'Failed Editing Student Account!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success']);
}
if(isset($_SESSION['success1']))
{
  if($_SESSION['success1']==1)
  {
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success!',
            text : 'Successfully Edited Admin Account!'
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
            text : 'Failed Editing Admin Account!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success1']);
}

if(isset($_SESSION['success2']))
{
  if($_SESSION['success2']==1)
  {
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success!',
            text : 'Successfully Removed Student Account!'
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
            text : 'Failed Removing Student Account!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success2']);
}
if(isset($_SESSION['success3']))
{
  if($_SESSION['success3']==1)
  {
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success!',
            text : 'Successfully Removed Admin Account!'
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
            text : 'Failed Removing Admin Account!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success3']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accounts</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/admin_account.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/modal2.css" rel="stylesheet" type="text/css">
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
			<h1>Manage Accounts</h1>
			<div class="container-table" style="border-top: solid #2c3136 5px;">
						<div class="row-title">
								<ul>
									<li class="selected highlight" onclick="changeTableData('Student')"><a href="#" onclick="changeTableData('Student')">Student Accounts</a></li>
									<li class="selected" onclick="changeTableData('Admin')"><a href="#" onclick="changeTableData('Admin')">Admin Accounts</a></li>
									<li class="selected" onclick="changeTableData('Accounting')"><a href="#" onclick="changeTableData('Accounting')">Accounting Accounts</a></li>
									<li class="selected" onclick="changeTableData('Registrar')"><a href="#" onclick="changeTableData('Registrar')">Registrar Accounts</a></li>
								</ul>
						</div>

						<table id="table-account">
						</table>
			</div>
		</div>
	</section>
	</div>
	<div id="id01" class="modal">
	</div>
	<div id="id02" class="modal">
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
	function showModalDocumentButton(uid) {
	document.getElementById('id01').style.display='block';

	var xhttp;
	if (uid == "") {
		document.getElementById("id01").innerHTML = uid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "showModalDocumentButton.php?uid="+uid, true);
	xhttp.send();
	}
</script>

<script>
	function changeTableData(type) {

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

	xhttp.open("GET", "getTableAccount.php?type="+type, true);
	xhttp.send();
	}

	window.addEventListener("load",changeTableData('Student'),false);
</script>

<script>
	function showModalDocumentAdd(type,uid) {
	document.getElementById('id02').style.display='block';

	var xhttp;
	if (uid == "") {
		document.getElementById("id02").innerHTML = uid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id02").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "showModalDocumentAdd.php?uid="+uid+"&type="+type, true);
	xhttp.send();
	}
</script>

<script>
	var addclass = 'highlight';
	var $cols = $('.selected').click(function(e) {
		$cols.removeClass(addclass);
		$(this).addClass(addclass);
	});

</script>

<script>
function showModalEditStudentAccount(uid) {
document.getElementById('id01').style.display='block';

var xhttp;
if (uid == "") {
  document.getElementById("id01").innerHTML = uid;
  return;
}

xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.getElementById("id01").innerHTML = this.responseText;
}
};

xhttp.open("GET", "include/showModalEditStudentAccount.php?uid="+uid, true);
xhttp.send();
}
</script>

<script>
function showModalEditAdminAccount(aid) {
document.getElementById('id01').style.display='block';

var xhttp;
if (aid == "") {
  document.getElementById("id01").innerHTML = aid;
  return;
}

xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.getElementById("id01").innerHTML = this.responseText;
}
};

xhttp.open("GET", "include/showModalEditAdminAccount.php?aid="+aid, true);
xhttp.send();
}
</script>

<script>
	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
		URL.revokeObjectURL(output.src) // free memory
		}
};
</script>
