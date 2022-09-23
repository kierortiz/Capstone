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
include "../conn.php";
$subarc=array();
$noOfarc=0;
$listTuition=array();
$totalTuitions=0;

if(isset($_SESSION['success']))
{
  if($_SESSION['success']==1){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully Added New Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Error',
            text : 'Failed To Add New Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success']==2){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully Edited Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success']==3){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Error',
            text : 'Failed To Edit Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success']==4){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'success',
            text : 'Successfully Removed Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success']==5){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Error',
            text : 'Failed To Remove Tuition Fee!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success']);
}

//get tuition Fees
$sql1 = "SELECT * FROM tbl_tuition WHERE status ='ACTIVE' AND SUMMER = 'No' ORDER BY YEARLEVEL,PLAN ASC";
$res1 = $conn->query($sql1);
if($res1->num_rows>0)
{
	while($row1=$res1->fetch_assoc())
	{
    $listTuition[$totalTuitions][0]=$row1['ID'];
    $listTuition[$totalTuitions][1]=$row1['YEARLEVEL'];
    $listTuition[$totalTuitions][2]=$row1['PLAN'];
    $totalTuitions++;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Tuition Fee</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link href="../assets/CSS/menu.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/table.css" rel="stylesheet" type="text/css">
	<link href="../assets/CSS/admin_account.css" rel="stylesheet" type="text/css">
  <link href="../assets/CSS/modal2.css" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/png" href="assets/logo.png">
  <script src="../JS/sweetalert2@10.js">//script for sweet alert</script>
  <script src="../JS/jquery-2.2.4.min.js"></script>
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include('include/header.php');?>
	<div class="body">
	<?php include('include/nav.php');?>
	<section class="section-1">
		<div class="container">
			<h1>Manage Tuition Fees(Regular Class)</h1>

			<div class="container-table">

        <button type="button" class="btn" style=" margin: auto; margin-top: 30px;" onclick="showModalAddTuition()">Add New Tuition Fee</button>

        <table>
          <tr>
            <th>TFID</th>
            <th>GRADE</th>
            <th>PLAN</th>
            <th colspan="2">ACTION</th>
          </tr>
          <?php
          for($i=0;$i<$totalTuitions;$i++)
          {
            ?>
            <tr>
              <td><?=$listTuition[$i][0]?></td>
              <td><?=$listTuition[$i][1]?></td>
              <td><?=$listTuition[$i][2]?></td>
              <td><a href="#" style="color:green;" onclick="showModalTuition('<?=$listTuition[$i][0]?>')"><i class="far fa-edit"></i>Edit Tuition</a></td>
              <td><a href="#" style="color:red;" onclick="showDelete('include/funcDelTuition.php?id=<?=$listTuition[$i][0]?>&page=tuition')"><i class="fas fa-trash-alt"></i>Delete</a></td>
            </tr>
            <?php
          }
          ?>

        </table>
			</div>

      <div class="modal" id="id01">
      </div>
		</div>
	</section>
	</div>



</body>
</html>

<script>
	function showModalAddTuition() {
	document.getElementById('id01').style.display='block';

	var xhttp;

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "include/showModalAddTuition.php?page=tuition", true);
	xhttp.send();
	}
</script>

<script>
	function showModalTuition(tfid) {
	document.getElementById('id01').style.display='block';

	var xhttp;
	if (tfid == "") {
		document.getElementById("id01").innerHTML = tfid;
		return;
	}

	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("id01").innerHTML = this.responseText;
	}
	};

	xhttp.open("GET", "include/showModalTuition.php?tfid="+tfid+"&page=tuition", true);
	xhttp.send();
	}
</script>

<script>
function showDelete(href,page){
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
