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
$uid = $_SESSION['UID'];
$summer = $_SESSION['SUMMER'];
$studname = $_SESSION['STUD_NAME'];
include '../conn.php';

if(isset($_POST['sub-proof'])){
  $acc="SELECT * FROM tbl_account WHERE UID = '$uid'";
  $acc1= $conn->query($acc);
  if($acc1->num_rows>0)
  {
    $row = $acc1->fetch_assoc();
    $grade = $row['YEARLEVEL'];
    $plan = $row['PLAN'];
  }
  if($summer == "Yes")
  {
    $sql="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan' AND SUMSTUD ='$uid'";
    $res=$conn->query($sql);
  }
  else{
    $sql="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan'";
    $res=$conn->query($sql);
  }

  if($res->num_rows>0)
  {
    $row = $res->fetch_assoc();
    $tf = $row['TUITIONFEE'];
    $misc = $row['MISC'];
    $noOfBooks = $row['NO_OF_BOOKS'];
    $books = $row['BOOKS'];
    $add = $row['ADDITIONAL'];
    $total = $tf + $misc + ($books*$noOfBooks)+$add;
  }

	$directory = "../assets/proofOfPayment/";
	$target_file = $directory . basename($_FILES["insertedImage"]["name"]);
	$checkerUpload = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	$check = getimagesize($_FILES["insertedImage"]["tmp_name"]);
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
    $_SESSION['s_proof']=0;
		header("location:progress.php");
	}
	else
	{
		if (move_uploaded_file($_FILES["insertedImage"]["tmp_name"],
		$target_file))
		{
      $iname = $_FILES['insertedImage']['name'];
      $extension=end(explode(".", $iname));
      $nname=$uid."-"."payment-".$numpay.".".$extension;
      rename($directory.$iname,$directory.$nname);
			$sqlproof="INSERT INTO tbl_payment(PAY_UID,PAY_NAME,PAY_TYPE,PAY_DATE,PAY_IMAGE,PAY_STATUS,PAY_REMAIN)values('$uid','$studname','$plan',NOW(),'$nname','PENDING',$total)";$conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname-$uid a Student, with $plan has Successfully Uploaded Proof of Payment', NOW())");
      $resproof = $conn->query($sqlproof);
      if($resproof){
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
          $mail->Subject = 'Proof of Payment Submittion Successful';
          $mail->Body    = 'Good Day! <br>        We received your submitted proof of payment, please wait 3-5 business days for us to process your payment. Thank you for your patience!';
          //
          //$mail->AltBody = strip_tags($email);

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname-$uid a Student, with $plan has Successfully Uploaded Proof of Payment', NOW())");
        $_SESSION['s_proof']=1;
        header("location:progress.php");
      }else{
        $_SESSION['s_proof']=0;
        $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$studname','$studname-$uid a Student, with $plan has Failed to Upload Proof of Payment', NOW())");
        header("location:progress.php");
      }
    }else{
			echo "Error In Uploading File!";
		}
	}
}

?>
