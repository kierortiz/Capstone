<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

//Load Composer's autoloader
require '../vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
session_start();
$uid = $_SESSION['UID'];
include '../conn.php';

//fuction for picking of subject for summer /**
if(isset($_POST['sub-subject']))
{
  $totalSub = $_POST['totalSub'];
  $newTotalSub = 0;
  $countSuccess=0;
  $subjectList = array();
  for($i=0;$i<$totalSub;$i++)
  {
    $subName = 'subject'.$i;
    if(isset($_POST[$subName]))
    {
      $subjectList[$newTotalSub]=$_POST[$subName];
      $newTotalSub++;
    }
  }

  //insert subject that has been pick to db
  for($i=0;$i<$newTotalSub;$i++)
  {
    $subjectName = $subjectList[$i];
    $sqlInsertSubject = "INSERT INTO tbl_summer(SUID,SUBJECT,STATUS)values('$uid','$subjectName','PENDING')";
    $resInsert = $conn->query($sqlInsertSubject);
    if($resInsert){
      $countSuccess++;
    }
  }

  if($countSuccess==$newTotalSub){
    $_SESSION['s_summer']=1;
    header("refresh:0;url=progress.php?success=1");
  }else{
    $_SESSION['s_summer']=0;
    header("refresh:0;url=progress.php?success=0");
  }

}


//function for new
if(isset($_POST['sub-docu']))
{
  $acc="SELECT * FROM tbl_account WHERE UID = '$uid'";
  $acc1= $conn->query($acc);
  if($acc1->num_rows>0)
  {
    $row = $acc1->fetch_assoc();
    $studname = $row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
    $oldornew = $row['OLDORNEW'];
  }

  $directory = "../assets/document/";
	$target_file = $directory . basename($_FILES["insertedImage1"]["name"]);
	$checkerUpload = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["insertedImage1"]["tmp_name"]);

  $target_file2 = $directory . basename($_FILES["insertedImage2"]["name"]);
	$checkerUpload2 = 1;
	$fileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
	$check2 = getimagesize($_FILES["insertedImage2"]["tmp_name"]);

  $target_file3 = $directory . basename($_FILES["insertedImage3"]["name"]);
	$checkerUpload3 = 1;
	$fileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
	$check3 = getimagesize($_FILES["insertedImage3"]["tmp_name"]);

  $target_file4 = $directory . basename($_FILES["insertedImage4"]["name"]);
	$checkerUpload4 = 1;
	$fileType4 = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));
	$check4 = getimagesize($_FILES["insertedImage4"]["tmp_name"]);

  $done=1;
  $done2=1;
  $done3=1;
  $done4=1;

	if($check !== false){
		$checkerUpload = 1;}
	else{
		echo " <br> File is not an image1.";
		$checkerUpload = 0;
	}

  if($check2 !== false){
		$checkerUpload2 = 1;}
	else{
		echo " <br> File is not an image2.";
		$checkerUpload2 = 0;
	}

  if($check3 !== false){
		$checkerUpload3 = 1;}
	else{
		echo " <br> File is not an image3.";
		$checkerUpload3 = 0;
	}

  if($check4 !== false){
		$checkerUpload4 = 1;}
	else{
		echo " <br> File is not an image4.";
		$checkerUpload4 = 0;
	}

	if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
	&&  $fileType != "jpg"){
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload = 0;
	}

  if($fileType2 != "gif" && $fileType2 != "png" && $fileType2 != "jpeg"
	&&  $fileType2 != "jpg"){
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload2 = 0;
	}

  if($fileType3 != "gif" && $fileType3 != "png" && $fileType3 != "jpeg"
	&&  $fileType3 != "jpg"){
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload3 = 0;
	}

  if($fileType4 != "gif" && $fileType4 != "png" && $fileType4 != "jpeg"
	&&  $fileType4 != "jpg"){
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload4 = 0;
	}

	if ($checkerUpload == 0){
    $_SESSION['s_docu']=0;
		header("location:progress.php");
	}else{
		if (move_uploaded_file($_FILES["insertedImage1"]["tmp_name"],$target_file)){
			$iname = $_FILES['insertedImage1']['name'];
      $nname=$uid."-"."grade".".".$fileType;
      rename($directory.$iname,$directory.$nname);
      $StartingYear = date('Y');
      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
			$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE)values('$uid','$docname','Grade',NOW(),'PENDING','$nname')";
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname $uid', NOW())");
      $resdocu = $conn->query($sqldocu);
      if($resdocu){
        $done=1;
        $sqlgrade = "SELECT * FROM tbl_account WHERE UID ='$uid'";
        $resgrade = $conn->query($sqlgrade);
        if($resgrade->num_rows>0){
          $rowgrade = $resgrade->fetch_assoc();
          $email = $rowgrade['EMAILADD'];
          $yearlvl = $rowgrade['YEARLEVEL'];
        }
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'standrewcleverlandschool@gmail.com';
            $mail->Password = 'standrew2021';                       //SMTP password
            $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                           //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('standrewcleverlandschool@gmail.com');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Document Submittion Successful';
            $mail->Body    = 'Good Day! <br>        We received your submitted documents, please wait 3-5 business days for us to process your documents. Thank you for your patience!';
            //
            //$mail->AltBody = strip_tags($email);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }else{
        $done=0;
      }
    }else{
			echo "Error In Uploading File!";
		}
	}

  if ($checkerUpload2 == 0){
    $_SESSION['s_docu']=0;
		header("location:progress.php");
	}else{
		if (move_uploaded_file($_FILES["insertedImage2"]["tmp_name"],$target_file2)){
			$iname2 = $_FILES['insertedImage2']['name'];
      $nname2=$uid."-"."birth".".".$fileType2;
      rename($directory.$iname2,$directory.$nname2);
      $StartingYear = date('Y');
      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
      $docname = 'Birth S.Y. '.date('Y')."-".$oneyear;
			$sqldocu2="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE)values('$uid','$docname','Birth Certificate',NOW(),'PENDING','$nname2')";
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname $uid', NOW())");
      $resdocu2 = $conn->query($sqldocu2);
      if($resdocu2){
        $done2=1;
      }else{
        $done2=0;
      }
    }else{
			echo "Error In Uploading File2!";
		}
	}

  if ($checkerUpload3 == 0){
    $_SESSION['s_docu']=0;
		header("location:progress.php");
	}else{
		if (move_uploaded_file($_FILES["insertedImage3"]["tmp_name"],$target_file3)){
			$iname3 = $_FILES['insertedImage3']['name'];
      $nname3=$uid."-"."goodmoral".".".$fileType3;
      rename($directory.$iname3,$directory.$nname3);
      $StartingYear = date('Y');
      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
      $docname = 'Good Moral S.Y. '.date('Y')."-".$oneyear;
			$sqldocu3="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE)values('$uid','$docname','Good Moral',NOW(),'PENDING','$nname3')";
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname $uid', NOW())");
      $resdocu3 = $conn->query($sqldocu3);
      if($resdocu3){
        $done3=1;
      }else{
        $done3=0;
      }
    }else{
			echo "Error In Uploading File3!";
		}
	}

  if ($checkerUpload4 == 0){
    $_SESSION['s_docu']=0;
		header("location:progress.php");
	}else{
		if (move_uploaded_file($_FILES["insertedImage4"]["tmp_name"],$target_file4)){
			$iname4 = $_FILES['insertedImage4']['name'];
      $nname4=$uid."-"."medical".".".$fileType4;
      rename($directory.$iname4,$directory.$nname4);
      $StartingYear = date('Y');
      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
      $docname = 'Medical S.Y. '.date('Y')."-".$oneyear;
			$sqldocu4="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE)values('$uid','$docname','Medical Certificate',NOW(),'PENDING','$nname4')";
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname $uid', NOW())");
      $resdocu4 = $conn->query($sqldocu4);
      if($resdocu4){
        $done4=1;
      }else{
        $done4=0;
      }
    }else{
			echo "Error In Uploading File!";
		}
	}

  if($done==1&&$done2==1&&$done3==1&&$done4==1)
  {
    $_SESSION['s_docu']=1;
    header("refresh:0;url=progress.php");
  }else{
    $_SESSION['s_docu']=0;
    header("refresh:0;url=progress.php");
  }

}


//function for old
if(isset($_POST['sub-docu1']))
{
  $acc="SELECT * FROM tbl_account WHERE UID = '$uid'";
  $acc1= $conn->query($acc);
  if($acc1->num_rows>0)
  {
    $row = $acc1->fetch_assoc();
    $studname = $row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
    $oldornew = $row['OLDORNEW'];
  }
  $directory = "../assets/document/";
	$target_file = $directory . basename($_FILES["insertedImage1"]["name"]);
	$checkerUpload = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["insertedImage1"]["tmp_name"]);
	if($check !== false)
	{
		$checkerUpload = 1;
	}
	else
	{
		echo " <br> File is not an image.";
		$checkerUpload = 0;
	}

	if($fileType != "gif" && $fileType != "png" && $fileType
	!= "jpeg"
	&&  $fileType != "jpg")
	{
		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$checkerUpload = 0;
	}

	if ($checkerUpload == 0)
	{
		header("location:progress.php?s_docu=0");
	}
	else
	{
		if (move_uploaded_file($_FILES["insertedImage1"]["tmp_name"],
		$target_file))
		{
			$iname = $_FILES['insertedImage1']['name'];
      $nname=$uid."-"."grade".".".$fileType;
      rename($directory.$iname,$directory.$nname);
      $StartingYear = date('Y');
      $oneyear = date("Y", strtotime($StartingYear."+1 year"));
      $docname = 'Grade S.Y. '.date('Y')."-".$oneyear;
			$sqldocu="INSERT INTO tbl_documents(DOC_STUDID,DOC_NAME,DOC_TYPE,DOC_DATE,DOC_STATUS,DOC_IMAGE)values('$uid','$docname','Grade',NOW(),'PENDING','$nname')";
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Uploaded $docname $uid', NOW())");
      $resdocu = $conn->query($sqldocu);
      if($resdocu){
        header("location:progress.php?s_docu=1");
      }else{
        header("location:progress.php?s_docu=0");
      }
    }else{
			echo "Error In Uploading File!";
		}
	}
}

if(isset($_POST['sub-docu-update']))
{
  $acc="SELECT * FROM tbl_account WHERE UID = '$uid'";
  $acc1= $conn->query($acc);
  if($acc1->num_rows>0)
  {
    $row = $acc1->fetch_assoc();
    $studname = $row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
    $oldornew = $row['OLDORNEW'];
  }
  $checkerFile = $_FILES["insertedImage1"]["name"];
  $checkerFile2 = $_FILES["insertedImage2"]["name"];
  $checkerFile3 = $_FILES["insertedImage3"]["name"];
  $checkerFile4 = $_FILES["insertedImage4"]["name"];

  if(!empty($checkerFile))
  {
    $directory = "../assets/document/";
  	$target_file = $directory . basename($_FILES["insertedImage1"]["name"]);
  	$checkerUpload = 1;
  	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  	$check = getimagesize($_FILES["insertedImage1"]["tmp_name"]);

    $done=1;

  	if($check !== false){
  		$checkerUpload = 1;}
  	else{
  		echo " <br> File is not an image.";
  		$checkerUpload = 0;
  	}

  	if($fileType != "gif" && $fileType != "png" && $fileType != "jpeg"
  	&&  $fileType != "jpg"){
  		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  		$checkerUpload = 0;
  	}

  	if ($checkerUpload == 0){
  		header("location:progress.php?s_docu=0");
  	}else{
  		if (move_uploaded_file($_FILES["insertedImage1"]["tmp_name"],$target_file)){
  			$iname = $_FILES['insertedImage1']['name'];
        $nname=$uid."-"."grade".".".$fileType;
        rename($directory.$iname,$directory.$nname);
  			$sqldocu="UPDATE tbl_documents SET DOC_STATUS='PENDING',DOC_IMAGE='$nname',DOC_COMMENT='' WHERE DOC_STUDID='$uid' AND DOC_TYPE='Grade'";
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Update a Document $uid', NOW())");
        $resdocu = $conn->query($sqldocu);
        if($resdocu){
          $done=1;
        }else{
          $done=0;
        }
      }else{
  			echo "Error In Uploading File!";
  		}
  	}
  }

  if(!empty($checkerFile2))
  {
    $directory = "../assets/document/";
  	$target_file2 = $directory . basename($_FILES["insertedImage2"]["name"]);
  	$checkerUpload2 = 1;
  	$fileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
  	$check2 = getimagesize($_FILES["insertedImage2"]["tmp_name"]);

    $done2=1;

  	if($check2 !== false){
  		$checkerUpload2 = 1;}
  	else{
  		echo " <br> File is not an image.";
  		$checkerUpload2 = 0;
  	}

  	if($fileType2 != "gif" && $fileType2 != "png" && $fileType2 != "jpeg"
  	&&  $fileType2 != "jpg"){
  		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  		$checkerUpload2 = 0;
  	}

  	if ($checkerUpload2 == 0){
      $_SESSION['s_docu']=0;
  		header("location:progress.php");
  	}else{
  		if (move_uploaded_file($_FILES["insertedImage2"]["tmp_name"],$target_file2)){
  			$iname2 = $_FILES['insertedImage2']['name'];
        $nname2=$uid."-"."birth".".".$fileType2;
        rename($directory.$iname2,$directory.$nname2);
  			$sqldocu2="UPDATE tbl_documents SET DOC_STATUS='PENDING',DOC_IMAGE='$nname2',DOC_COMMENT='' WHERE DOC_STUDID='$uid' AND DOC_TYPE='Birth Certificate'";
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Update a Document $uid', NOW())");
        $resdocu2 = $conn->query($sqldocu2);
        if($resdocu2){
          $done2=1;
        }else{
          $done2=0;
        }
      }else{
  			echo "Error In Uploading File!";
  		}
  	}
  }

  if(!empty($checkerFile3))
  {
    $directory = "../assets/document/";
  	$target_file3 = $directory . basename($_FILES["insertedImage3"]["name"]);
  	$checkerUpload3 = 1;
  	$fileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
  	$check3 = getimagesize($_FILES["insertedImage3"]["tmp_name"]);

    $done3=1;

  	if($check3 !== false){
  		$checkerUpload3 = 1;}
  	else{
  		echo " <br> File is not an image.";
  		$checkerUpload3 = 0;
  	}

  	if($fileType3 != "gif" && $fileType3 != "png" && $fileType3 != "jpeg"
  	&&  $fileType3 != "jpg"){
  		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  		$checkerUpload3 = 0;
  	}

  	if ($checkerUpload3 == 0){
      $_SESSION['s_docu']=0;
  		header("location:progress.php");
  	}else{
  		if (move_uploaded_file($_FILES["insertedImage3"]["tmp_name"],$target_file3)){
  			$iname3 = $_FILES['insertedImage3']['name'];
        $nname3=$uid."-"."goodmoral".".".$fileType3;
        rename($directory.$iname3,$directory.$nname3);
  			$sqldocu3="UPDATE tbl_documents SET DOC_STATUS='PENDING',DOC_IMAGE='$nname3',DOC_COMMENT='' WHERE DOC_STUDID='$uid' AND DOC_TYPE='Good Moral'";
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Update a Document $uid', NOW())");
        $resdocu3 = $conn->query($sqldocu3);
        if($resdocu3){
          $done3=1;
        }else{
          $done3=0;
        }
      }else{
  			echo "Error In Uploading File!";
  		}
  	}
  }

  if(!empty($checkerFile4))
  {
    $directory = "../assets/document/";
  	$target_file4 = $directory . basename($_FILES["insertedImage4"]["name"]);
  	$checkerUpload4 = 1;
  	$fileType4 = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));
  	$check4 = getimagesize($_FILES["insertedImage4"]["tmp_name"]);

    $done4=1;

  	if($check4 !== false){
  		$checkerUpload4 = 1;}
  	else{
  		echo " <br> File is not an image.";
  		$checkerUpload4 = 0;
  	}

  	if($fileType4 != "gif" && $fileType4 != "png" && $fileType4 != "jpeg"
  	&&  $fileType4 != "jpg"){
  		echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  		$checkerUpload4 = 0;
  	}

  	if ($checkerUpload4 == 0){
      $_SESSION['s_docu']=0;
  		header("location:progress.php");
  	}else{
  		if (move_uploaded_file($_FILES["insertedImage4"]["tmp_name"],$target_file4)){
  			$iname4 = $_FILES['insertedImage4']['name'];
        $nname4=$uid."-"."medical".".".$fileType4;
        rename($directory.$iname4,$directory.$nname4);
  			$sqldocu4="UPDATE tbl_documents SET DOC_STATUS='PENDING',DOC_IMAGE='$nname4',DOC_COMMENT='' WHERE DOC_STUDID='$uid' AND DOC_TYPE='Medical Certificate'";
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname, $oldornew Student, Update a Document $uid', NOW())");
        $resdocu4 = $conn->query($sqldocu4);
        if($resdocu4){
          $done4=1;
        }else{
          $done4=0;
        }
      }else{
  			echo "Error In Uploading File!";
  		}
  	}
  }

  if($done==1||$done2==1||$done3==1||$done4==1)
  {
    $_SESSION['s_docu']=1;
    header("location:progress.php");
  }else{
    $_SESSION['s_docu']=0;
    header("location:progress.php");
  }
}


?>
