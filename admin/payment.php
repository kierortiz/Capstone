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

if(!empty($_GET)&&isset($_GET['s_proof'])){
  if($_GET['s_proof']==1){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success!',
            text : 'Successfully Accepted Payment!'
        })
      },false)
      </script>
    <?php
  }else if($_GET['s_proof']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Error!',
            text : 'Failed to accept payment!'
        })
      },false)
      </script>
    <?php
  }else if($_GET['s_proof']==2){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'warning',
            title : 'Warning!',
            text : 'Down Payment is not enough!'
        })
      },false)
      </script>
    <?php
  }else if($_GET['s_proof']==3){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success!',
            text : 'Proof of payment denied!'
        })
      },false)
      </script>
    <?php
  }
}

if(isset($_SESSION['payment_message'])){
  ?>
  <script>
    window.addEventListener("load",function(){
      swal.fire({
          icon : '<?=$_SESSION['payment_icon']?>',
          title : '<?=$_SESSION['payment_title']?>',
          text : '<?=$_SESSION['payment_message']?>'
      })
    },false)
    </script>
  <?php
  unset($_SESSION['payment_title']);
  unset($_SESSION['payment_message']);
  unset($_SESSION['payment_icon']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
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
			<h1>Payment</h1>

      <div class="container-table" style="border-top: solid #2c3136 5px;">
						<div class="row-title">
								<ul>
									<li class="selected highlight" onclick="changeTableData('PENDING')"><a href="#">Pending</a></li>
									<li class="selected" onclick="changeTableData('ACCEPTED')"><a href="#">Accepted</a></li>
                </ul>
						</div>
            <div class="container-table">
      						<table id="table-account">

      						</table>
      			</div>
			</div>


      <div id="id01" class="modal">

      </div>
		</div>
	</section>
	</div>

</body>
</html>

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

	xhttp.open("GET", "getPaymentAccount.php?type="+type, true);
	xhttp.send();
	}

	window.addEventListener("load",changeTableData('PENDING'),false);
</script>



<script>
	function showModalAddTF(pid) {
	document.getElementById('id01').style.display='block';

	var xhttp;
	if (pid == "") {
		document.getElementById("id01").innerHTML = pid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "include/showModalAddTF.php?pid="+pid, true);
	xhttp.send();
	}
</script>

<script>
	function showModalMinusTF(pid) {
	document.getElementById('id01').style.display='block';

	var xhttp;
	if (pid == "") {
		document.getElementById("id01").innerHTML = pid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "include/showModalMinusTF.php?pid="+pid, true);
	xhttp.send();
	}
</script>

<script>
	function showModal(pid) {
	document.getElementById('id01').style.display='block';

	var xhttp;
	if (pid == "") {
		document.getElementById("id01").innerHTML = pid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "showModal.php?pid="+pid, true);
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
function removeReq()
{
  var inp=document.getElementById('inppay');
  var e = document.getElementById('options');
  var cb = e.options[e.selectedIndex].text;
  console.log(cb);
  if(cb=="Accept"){
    inp.setAttribute('required','required');
    inp.removeAttribute('disabled');
  }else if(cb=="Deny"){
    inp.setAttribute('disabled','disabled');
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
