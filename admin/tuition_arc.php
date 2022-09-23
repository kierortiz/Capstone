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

if(isset($_SESSION['success_recover']))
{
  if($_SESSION['success_recover']==1){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully Recovered  Tuition!'
        })
      },false)
      </script>
    <?php
  }else if($_SESSION['success_recover']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Failed',
            text : 'Error While Recovering Tuition!'
        })
      },false)
      </script>
    <?php
  }
  unset($_SESSION['success_recover']);
}

$subarc=array();
$noOfarc=0;
$sql ="SELECT * FROM tbl_tuition WHERE STATUS='ARCHIVED'";
$res = $conn->query($sql);
if($res->num_rows>0)
{
	while($row=$res->fetch_assoc())
	{
		$subarc[$noOfarc][0]=$row['ID'];
    $subarc[$noOfarc][1]=$row['SUMSTUD'];
		$subarc[$noOfarc][2]=$row['PLAN'];
		$subarc[$noOfarc][3]=$row['YEARLEVEL'];
		$subarc[$noOfarc][4]=$row['SUMMER'];
		$noOfarc++;
	}
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
			<h1>Tuition Archive</h1>
			<div class="container-table">
						<table>
							<tbody>
								<tr>
									<th>ID</th>
                  <th>STUDENT ID</th>
									<th>PLAN</th>
									<th>YEARLEVEL</th>
									<th>TYPE</th>
									<th colspan="2">ACTION</th>
								</tr>
								<?php
								for($i=0;$i<$noOfarc;$i++)
								{
                  $id = $subarc[$i][0];
									?>
									<tr>
										<td><?php echo $subarc[$i][0]?></td>
										<td><?php echo $subarc[$i][1]?></td>
										<td><?php echo $subarc[$i][2]?></td>
										<td><?php echo $subarc[$i][3]?></td>
                    <td><?php echo $subarc[$i][4]?></td>
										<td><a onclick="sweetalertrecover('include/funcRecoverTF.php?id=<?=$id?>')" style="color:green"><i class="far fa-edit"></i>Recover</a></td>
										<td><a href="#" onclick="sweetalertdelete('#')" style="color:red"><i class="fas fa-trash-alt"></i>Permanent Delete</a></td>
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
function sweetalertrecover(href)
{
	Swal.fire({
    title: 'Are you sure?',
    text: "This will be recovered",
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
