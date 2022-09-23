<?php

if(isset($_POST['sub-document']))
{
	$uid = $_POST['uid'];
	$type = $_POST['type'];
	if($type == "Grade")
	{
		$grade = $_POST['inp-admin'];
		$grade=stripcslashes($grade);
		$grade = mysqli_real_escape_string($conn, $grade);
		$sec="";
		$directory = "../assets/document/";
		$target_file = $directory . basename($_FILES["image"]["name"]);
		$checkerUpload = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["image"]["tmp_name"]);

		if($grade >=75 && $grade<=85){
      $sec = "Section 2";
    }else if($grade>=86 && $grade <=100){
      $sec = "Section 1";
    }

		if($check !== false){
			$checkerUpload = 1;}
		else{
			echo " <br> File is not an image1.";
			$checkerUpload = 0;
		}

		if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
		&&  $fileType != "jpg"){
			echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$checkerUpload = 0;
		}

		if ($checkerUpload == 0){
			?>
			<script>
			alert("Image is not accepted!");
			</script>
			<?php
			header("refresh:0;url=accounts.php");
		}else{
			if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file))
			{
				$iname = $_FILES['image']['name'];
	      $nname=$uid."-"."grade".".".$fileType;
	      rename($directory.$iname,$directory.$nname);
	      $StartingYear = date('Y');
	      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
	      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
				$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE,DOC_APPROVED_BY,DOC_APPROVED_DATE)values('$uid','$docname','Grade',NOW(),'ACCEPTED','$nname','$APPROVE',NOW())";
				  $ressection = $conn->query("UPDATE tbl_account SET GRADE = $grade,SECTION ='$sec' WHERE UID = $uid");
				// $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname', NOW())");
	      $resdocu = $conn->query($sqldocu);
	      if($resdocu){
	        ?>
					<script>
					alert("Successfully Added Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }else{
					?>
					<script>
					alert("Error While Adding Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }
	    }else{
				?>
				<script>
				alert("Error While Uploading Document!");
				</script>
				<?php
				header("refresh:0;url=accounts.php");
			}
		}
	}else if($type == "Birth Certificate")
	{
		$directory = "../assets/document/";
		$target_file = $directory . basename($_FILES["image"]["name"]);
		$checkerUpload = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["image"]["tmp_name"]);

		if($check !== false){
			$checkerUpload = 1;}
		else{
			echo " <br> File is not an image1.";
			$checkerUpload = 0;
		}

		if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
		&&  $fileType != "jpg"){
			echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$checkerUpload = 0;
		}

		if ($checkerUpload == 0){
			?>
			<script>
			alert("Image is not accepted!");
			</script>
			<?php
			header("refresh:0;url=accounts.php");
		}else{
			if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file))
			{
				$iname = $_FILES['image']['name'];
	      $nname=$uid."-"."birth".".".$fileType;
	      rename($directory.$iname,$directory.$nname);
	      $StartingYear = date('Y');
	      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
	      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
				$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE,DOC_APPROVED_DATE,DOC_APPROVED_BY)values('$uid','$docname','Birth Certificate',NOW(),'ACCEPTED','$nname',NOW(),'$APPROVE')";

				// $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname', NOW())");
	      $resdocu = $conn->query($sqldocu);
	      if($resdocu){
	        ?>
					<script>
					alert("Successfully Added Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }else{
					?>
					<script>
					alert("Error While Adding Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }
	    }else{
				?>
				<script>
				alert("Error While Uploading Document!");
				</script>
				<?php
				header("refresh:0;url=accounts.php");
			}
		}
	}else if($type == "Good Moral")
	{
		$directory = "../assets/document/";
		$target_file = $directory . basename($_FILES["image"]["name"]);
		$checkerUpload = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["image"]["tmp_name"]);

		if($check !== false){
			$checkerUpload = 1;}
		else{
			echo " <br> File is not an image1.";
			$checkerUpload = 0;
		}

		if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
		&&  $fileType != "jpg"){
			echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$checkerUpload = 0;
		}

		if ($checkerUpload == 0){
			?>
			<script>
			alert("Image is not accepted!");
			</script>
			<?php
			header("refresh:0;url=accounts.php");
		}else{
			if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file))
			{
				$iname = $_FILES['image']['name'];
	      $nname=$uid."-"."goodmoral".".".$fileType;
	      rename($directory.$iname,$directory.$nname);
	      $StartingYear = date('Y');
	      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
	      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
				$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE,DOC_APPROVED_DATE,DOC_APPROVED_BY)values('$uid','$docname','Good Moral',NOW(),'ACCEPTED','$nname',NOW(),'$APPROVE')";

				// $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname', NOW())");
	      $resdocu = $conn->query($sqldocu);
	      if($resdocu){
	        ?>
					<script>
					alert("Successfully Added Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }else{
					?>
					<script>
					alert("Error While Adding Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }
	    }else{
				?>
				<script>
				alert("Error While Uploading Document!");
				</script>
				<?php
				header("refresh:0;url=accounts.php");
			}
		}
	}else if($type == "Medical Certificate")
	{
		$directory = "../assets/document/";
		$target_file = $directory . basename($_FILES["image"]["name"]);
		$checkerUpload = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["image"]["tmp_name"]);

		if($check !== false){
			$checkerUpload = 1;}
		else{
			echo " <br> File is not an image1.";
			$checkerUpload = 0;
		}

		if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
		&&  $fileType != "jpg"){
			echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$checkerUpload = 0;
		}

		if ($checkerUpload == 0){
			?>
			<script>
			alert("Image is not accepted!");
			</script>
			<?php
			header("refresh:0;url=accounts.php");
		}else{
			if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file))
			{
				$iname = $_FILES['image']['name'];
	      $nname=$uid."-"."medical".".".$fileType;
	      rename($directory.$iname,$directory.$nname);
	      $StartingYear = date('Y');
	      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
	      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
				$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE,DOC_APPROVED_DATE,DOC_APPROVED_BY)values('$uid','$docname','Medical Certificate',NOW(),'ACCEPTED','$nname',NOW(),'$APPROVE')";

				// $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname', NOW())");
	      $resdocu = $conn->query($sqldocu);
	      if($resdocu){
	        ?>
					<script>
					alert("Successfully Added Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }else{
					?>
					<script>
					alert("Error While Adding Document!");
					</script>
					<?php
					header("refresh:0;url=accounts.php");
	      }
	    }else{
				?>
				<script>
				alert("Error While Uploading Document!");
				</script>
				<?php
				header("refresh:0;url=accounts.php");
			}
		}
	}
}

?>
