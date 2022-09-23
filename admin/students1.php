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
$docu1="";
$icon1="error";
if(isset($_GET['s_docu_summer']))
{
  if($_GET['s_docu_summer']==0)
    $docu1="Failed to Deny Grade!";
  if($_GET['s_docu_summer']==1)
    $docu1="Successfully Accepted Grade!";
  if($_GET['s_docu_summer']==2)
    $docu1="Successfully Denied Grade!";
  if($_GET['s_docu_summer']==3)
    $docu1="Failed to Accept Grade!";
  if($_GET['s_docu_summer']==1||$_GET['s_docu_summer']==2)
    $icon1="success";
}

if(!empty($_GET))
{
  ?>
  <script>
    window.addEventListener("load",function(){
      swal.fire({
          icon : '<?=$icon1?>',
          text : '<?=$docu1?>'
      })
    },false)
    </script>
  <?php
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Students</title>
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
			<h1>Summer Student Documents</h1>

      <div class="container-table" style="border-top: solid #2c3136 5px;">
						<div class="row-title">
								<ul>
									<li class="selected highlight" onclick="changeTableData('PENDING','SUMMER')"><a href="#">Pending</a></li>
									<li class="selected" onclick="changeTableData('ACCEPTED','SUMMER')"><a href="#">Accepted</a></li>
                </ul>
						</div>

						<table id="table-account">

						</table>
			</div>

			<div id="id01" class="modal">

      </div>
		</div>
	</section>
	</div>

</body>
</html>

<script>
	function changeTableData(type,classType) {

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

	xhttp.open("GET", "getDocuAccount.php?type="+type+"&cType="+classType, true);
	xhttp.send();
	}

	window.addEventListener("load",changeTableData('PENDING','SUMMER'),false);
</script>

<script>
function removeReq(cname)
{
  if(cname==0){
		var inp=document.getElementById('comment0');
		var e = document.getElementById('options0');
	}else if(cname==1){
		var inp=document.getElementById('comment1');
		var e = document.getElementById('options1');
	}else if(cname==2){
		var inp=document.getElementById('comment2');
		var e = document.getElementById('options2');
	}else if(cname==3){
		var inp=document.getElementById('comment3');
		var e = document.getElementById('options3');
	}

  var grade = document.getElementById('inp-grade');

	var cb = e.options[e.selectedIndex].text;

	if(cb=="Accept"){
		inp.setAttribute('disabled','disabled');
		inp.removeAttribute('required');
    grade.setAttribute('required','required');
		grade.removeAttribute('disabled');
	}else if(cb=="Deny"){
		inp.setAttribute('required','required');
		inp.removeAttribute('disabled');
    grade.removeAttribute('required');
    grade.setAttribute('disabled','disabled');
	}
}
</script>

<script>
	function showModalDocument1(uid) {
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

	xhttp.open("GET", "showModalDocument1.php?uid="+uid, true);
	xhttp.send();
	}
</script>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
	var addclass = 'highlight';
	var $cols = $('.selected').click(function(e) {
		$cols.removeClass(addclass);
		$(this).addClass(addclass);
	});
</script>
