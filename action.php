<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
session_start();
include 'conn.php';

if(isset($_POST['sub-recover'])){
	$email = $_POST['email'];
	$sqlemailchecker="SELECT * FROM tbl_account WHERE EMAILADD = '$email'";
	$resemailchecker=$conn->query($sqlemailchecker);
	if($resemailchecker->num_rows>0){
		$mail = new PHPMailer(true);
		//Server settings
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'standrewcleverlandschool@gmail.com';
		$mail->Password = 'standrew2021';
		$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
		);
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		//Send Email
		$mail->setFrom('standrewcleverlandschool@gmail.com');

		//Recipients
		$mail->addAddress($email);
		$mail->addReplyTo('standrewcleverlandschool@gmail.com');

		//Content
		$mail->isHTML(true);
		$mail->Subject = "Account Recovery! Change Password Link";
		$mail->Body    = "<p>Good Day!<br><t> In order to change your password. Simply click on the link below.<br><a href='sacsantipolo.ddns.net/caps/forgot.php?email=$email'>CHANGE PASSWORD</a>";

		if(!$mail->send()){
			$_SESSION['success_sent']=2;
			header("refresh:0;url=index.php");
		}else{
			$_SESSION['success_sent']=1;
			header("refresh:0;url=index.php");
		}
	}else{
		$_SESSION['success_sent']=0;
		header("refresh:0;url=index.php");
	}

}
if(isset($_POST['sub-register'])){
	//GET NEW UID
	$sql =  "SELECT * FROM tbl_account GROUP BY UID DESC";
	$res = $conn->query($sql);
	if($res->num_rows>0){
		$row=$res->fetch_assoc();
		$RUID = $row['UID']+1;
	}else{
		$RUID = date('Y')."00001";
	}

	$email = $_POST['user'];
	$pass = $_POST['pass'];
	$cpass = $_POST['rpass'];

	$email=stripcslashes($email);
	$pass=stripcslashes($pass);
	$cpass=stripcslashes($cpass);
  $user = mysqli_real_escape_string($conn, $user);
  $pass = mysqli_real_escape_string($conn, $pass);
	$cpass = mysqli_real_escape_string($conn, $cpass);

	$vcode = uniqid();

	//checker if empty fields
	if(empty($email)||empty($pass)||empty($cpass)){
		echo "Empty Field!";
	}else{
		//checeker if email is already taken in admin
		$sqladminemailchecker="SELECT * FROM tbl_admin WHERE ADMIN_EMAIL='$email'";
		$resadminemailchecker=$conn->query($sqladminemailchecker);
		if($resadminemailchecker->num_rows>0)
		{
			$_SESSION['success_register']=3;
			header("refresh:0;url=index.php");
		}else{
			//checeker if email is already taken
			$sqlechecker="SELECT * FROM tbl_account WHERE EMAILADD = '$email'";
			$resechecker= $conn->query($sqlechecker);
			if($resechecker->num_rows>0)
			{
				$_SESSION['success_register']=3;
				header("refresh:0;url=index.php");
			}else{
				if($pass == $cpass)
				{
					//encrypt password
					$pass = password_hash($pass,PASSWORD_DEFAULT);
						$sqlins="INSERT INTO tbl_account(UID,EMAILADD,PASSWORD,TYPE,STATUS,REGISTER,VCODE)values('$RUID','$email','$pass','USER','UNVERIFIED','UNENROLLED','$vcode')";
						$res=$conn->query($sqlins);
						if($res){
							$mail = new PHPMailer(true);
			        //Server settings
			        $mail->isSMTP();
			        $mail->Host = 'smtp.gmail.com';
			        $mail->SMTPAuth = true;
			        $mail->Username = 'standrewcleverlandschool@gmail.com';
			        $mail->Password = 'standrew2021';
			        $mail->SMTPOptions = array(
			            'ssl' => array(
			            'verify_peer' => false,
			            'verify_peer_name' => false,
			            'allow_self_signed' => true
			            )
			        );
			        $mail->SMTPSecure = 'ssl';
			        $mail->Port = 465;

			        //Send Email
			        $mail->setFrom('standrewcleverlandschool@gmail.com');

			        //Recipients
			        $mail->addAddress($email);
			        $mail->addReplyTo('standrewcleverlandschool@gmail.com');

			        //Content
			        $mail->isHTML(true);
			        $mail->Subject = "Account Verification";
			        $mail->Body    = "<p>Good Day!<br><t> In order to complete your account, we need to verify your email address. Simply click on the link below to complete your St. Andrew's Cleverland School Account and start enrolling.<br><a href='localhost/caps/verify.php?v_code=$vcode'>ACTIVATE ACCOUNT</a>";

			        if(!$mail->send()){
								$_SESSION['success_register']=0;
								header("refresh:0;url=index.php");
							}else{
								$_SESSION['success_register']=1;
								header("refresh:0;url=index.php");
							}
						}else{
							$_SESSION['success_register']=0;
							header("refresh:0;url=index.php");
						}

				}else{
					$_SESSION['success_register']=2;
					header("refresh:0;url=index.php");
				}
			}
		}
	}
}

if(isset($_POST['sub-login'])){


	$user=$_POST['user'];
	$pass=$_POST['pass'];

	$user=stripcslashes($user);
	$pass=stripcslashes($pass);
  $user = mysqli_real_escape_string($conn, $user);
  $pass = mysqli_real_escape_string($conn, $pass);

	//baguhin nalang pag naka hash na
	$sqllogin ="SELECT * FROM tbl_account WHERE EMAILADD = '$user'";
	$reslogin = $conn->query($sqllogin);
	if($reslogin->num_rows>0)
	{
		$row = $reslogin->fetch_assoc();
		$upass = $row['PASSWORD'];
		if($row['STATUS']=="UNVERIFIED"){
			$_SESSION['success']=2;
			header("refresh:0;url=index.php");
		}else if($row['STATUS']=="ACTIVE"){
			if(password_verify($pass,$upass)){
				$conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$user','User $user Has Logged in', NOW())");
				// Store data in session variables
				$_SESSION["loggedin"] = true;
				$_SESSION['UID']=$row['UID'];
				$_SESSION['STUD_NAME']=$row['FIRSTNAME']." ".$row['MIDDLENAME']." ".$row['LASTNAME'];
				$_SESSION['success']=1;
				$_SESSION['SUMMER']=$row['SUMMER'];
				header("refresh:0;url=index.php?success=1");
			}else{
				header("location:index.php");
				$_SESSION['success']=0;
			}
		}
	}else{
		$sqllogin1 ="SELECT * FROM tbl_admin WHERE ADMIN_EMAIL = '$user' AND ADMIN_PASSWORD = '$pass'";
		$reslogin1 = $conn->query($sqllogin1);
		if($reslogin1->num_rows>0)
		{
			$row1 = $reslogin1->fetch_assoc();
			$adname = $row1['ADMIN_NAME'];
			$adpos = $row1['ADMIN_POSITION'];
			if($row1['ADMIN_STATUS']=="UNVERIFIED"){
				$_SESSION['success']=2;
				header("refresh:0;url=index.php");
			}else if($row1['ADMIN_STATUS']=="ACTIVE"){
				$_SESSION['success']=1;
				header("refresh:0;url=Admin/dashboard.php");
			 // Store data in session variables
		    $_SESSION["loggedin"] = true;
				$_SESSION['AID']=$row1['ADMIN_ID'];
				$_SESSION['ANAME']=$row1['ADMIN_NAME'];
				$_SESSION['POSITION']=$row1['ADMIN_POSITION'];
				$conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$adname','$adname - $adpos Has Logged in', NOW())");
			}
		}else{
			header("location:index.php");
			$_SESSION['success']=0;
		}

	}
}
?>
