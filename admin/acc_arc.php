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
            text : 'Successfully Recovered Account!'
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
            text : 'Failed While Recovering Account!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Archives</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
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
			<h1>Accounts Archive</h1>
			<div class="container-table" style="border-top: solid #2c3136 5px;">
				<div class="row-title">
						<ul>
							<li class="selected highlight" onclick="changeTableDataArc('Student')"><a href="#" onclick="changeTableData('Student')">Student Accounts</a></li>
							<li class="selected" onclick="changeTableDataArc('Admin')"><a href="#" onclick="changeTableData('Admin')">Admin Accounts</a></li>
							<li class="selected" onclick="changeTableDataArc('Accounting')"><a href="#" onclick="changeTableData('Accounting')">Accounting Accounts</a></li>
							<li class="selected" onclick="changeTableDataArc('Registrar')"><a href="#" onclick="changeTableData('Registrar')">Registrar Accounts</a></li>
						</ul>
				</div>
				<table id="table-account">

				</table>
			</div>
		</div>
	</section>
	</div>

</body>
</html>

<script>
function sweetalertrecover(href)
{
	Swal.fire({
			title: 'Are you sure?',
			text: "This account will be recovered",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, recover it!'
			}).then((result) => {
					if (result.value) {
							document.location.href = href;
					}
			})
}
</script>

<script>
function sweetalertdelete(href)
{
	Swal.fire({
			title: 'Are you sure?',
			text: "This will be deleted permanently!",
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
	function changeTableDataArc(type) {

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

	xhttp.open("GET", "getTableAccountArc.php?type="+type, true);
	xhttp.send();
	}

	window.addEventListener("load",changeTableDataArc('Student'),false);
</script>

<script>
	var addclass = 'highlight';
	var $cols = $('.selected').click(function(e) {
		$cols.removeClass(addclass);
		$(this).addClass(addclass);
	});

</script>
