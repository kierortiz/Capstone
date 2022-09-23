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

include '../conn.php';
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;

if(!empty($_GET)&&isset($_GET['pid'])){
$pid=$_GET['pid'];
$failed=0;
$sqlgetuser = "SELECT * FROM tbl_payment WHERE PAY_ID='$pid'";
$resgetuser= $conn->query($sqlgetuser);
if($resgetuser->num_rows>0)
{
  $rowgetuser=$resgetuser->fetch_assoc();
  $uid = $rowgetuser['PAY_UID'];
  $paystud = $rowgetuser['PAY_NAME'];
}

$payment = $_POST['payment'];
$payment=stripcslashes($payment);
$payment = mysqli_real_escape_string($conn, $payment);

$options = $_POST['options'];
//get user's grade level and plan
$sqlgrade = "SELECT * FROM tbl_account WHERE UID ='$uid'";
$resgrade = $conn->query($sqlgrade);
if($resgrade->num_rows>0){
  $rowgrade = $resgrade->fetch_assoc();
  $grade = $rowgrade['YEARLEVEL'];
  $plan = $rowgrade['PLAN'];
  $email = $rowgrade['EMAILADD'];
  $summer = $rowgrade['SUMMER'];
}
if ($summer == "Yes")
{
  $sqlplan="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan' AND SUMSTUD = '$uid'";
  $resplan=$conn->query($sqlplan);
}
else{
  $sqlplan="SELECT * FROM tbl_tuition WHERE YEARLEVEL='$grade' AND PLAN = '$plan'";
  $resplan=$conn->query($sqlplan);
}
if($resplan->num_rows>0)
{
  $rowplan = $resplan->fetch_assoc();
  $tf = $rowplan['TUITIONFEE'];
  $misc = $rowplan['MISC'];
  $noOfBooks = $rowplan['NO_OF_BOOKS'];
  $books = $rowplan['BOOKS'];
  $add = $rowplan['ADDITIONAL'];
  $total = $tf + $misc + ($books*$noOfBooks)+$add;
}

//plan changer if payment reach a point
//if($payment>=15000){
  //$sqlchange = "UPDATE tbl_account SET PLAN = 'Plan A' WHERE UID = '$uid'";
  //$reschange = $conn->query($sqlchange);
  //$sqlchange1 = "UPDATE tbl_payment SET PAY_TYPE = 'Plan A' WHERE PAY_UID = '$uid'";
//  $reschange1 = $conn->query($sqlchange1);
//}else if($payment >=5000&&$payment<15000){
  //$sqlchange = "UPDATE tbl_account SET PLAN = 'Plan B' WHERE UID = '$uid'";
  //$reschange = $conn->query($sqlchange);
  //$sqlchange1 = "UPDATE tbl_payment SET PAY_TYPE = 'Plan B' WHERE PAY_UID = '$uid'";
  //$reschange1 = $conn->query($sqlchange1);

//  if($reschange && $reschange1){
  //  echo "Successfully changed plan to plan b";
  //}else{
  //  echo "Failed to change plan to plan b";
  //}
//}else{
  //$failed=1;
//}

//for getting tuition,Miscellaneous,etc
// if($grade == "Grade 1" || $grade == "Grade 2" || $grade == "Grade 3"){
// 	$tf= 12000;
// 	$misc = 3000;
// 	$noOfBooks = 7;
// 	$books = 700;
// }else if($grade == "Grade 4" || $grade == "Grade 5" || $grade == "Grade 6"){
// 	$tf= 12000;
// 	$misc = 3000;
// 	$noOfBooks = 8;
// 	$books = 700;
// }else if($grade == "Grade 7" || $grade == "Grade 8" || $grade == "Grade 9" || $grade == "Grade 10"){
// 	$tf= 13000;
// 	$misc = 3000;
// 	$noOfBooks = 8;
// 	$books = 700;
// }

if($options == "Accept"){
  // if($plan == "Plan A"){
  //   $add = 0;
  // }else if($plan == "Plan B"){
  //   $add = 2000;
  // }

  // $total = ($tf+$misc+($noOfBooks*$books)+$add);
  $remain = $total-$payment;
  if($failed==1)
  {
    header("refresh:0;url=payment.php?s_proof=2");
  }else{

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
        $mail->Subject = 'Proof of Payment Status';
        $mail->Body    = 'Good Day!<br>      We have received your payment of '.$payment.'for'.$plan.' with the remaining balance of'.$remain.' If you have any questions, please contact us. Thank you and have a nice day!';
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
        $mail->Subject = 'Enrollment Status';
        $mail->Body    = 'Good Day! Congratulations on your childs enrollment! You can now view your childs enrolled subjects
        via your PROFILE, simple login and click the View Subjects tab, you can also print your Registration Card
        at the bottom of the Enroll tab, Step 6:Print Registration Card if needed';
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $resenroll=$conn->query("UPDATE tbl_account SET REGISTER = 'ENROLLED' WHERE UID='$uid'");
    if($resenroll){
      echo "success";
    }else{
      echo "failed";
    }

    $sqlinsert = "UPDATE tbl_payment SET PAY_AMOUNT = $payment,PAY_TOTALPAID='$payment', PAY_REMAIN = $remain,PAY_APPROVEBY ='$APPROVE',PAY_STATUS='ACCEPTED' WHERE PAY_ID='$pid' AND PAY_STATUS = 'PENDING'";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Payment for Student ($paystud) or amount ($payment), remaining balance is ($remain)', NOW())");
    $resins = $conn->query($sqlinsert);
    if($resins){
      header("refresh:0;url=payment.php?s_proof=1");
    }else{
      header("refresh:0;url=payment.php?s_proof=0");
    }
  }

}else if($options == "Deny"){

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
          $mail->Subject = 'Proof of Payment Status';
          $mail->Body    = 'Good Day! '.$APPROVE.' Denied your payment';
          //$mail->AltBody = strip_tags($email);

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
  $sqlinsert = "UPDATE tbl_payment SET PAY_STATUS = 'DENIED' WHERE PAY_ID='$pid'";
  $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied the payment of ($paystud)', NOW())");
  $resins = $conn->query($sqlinsert);
  if($resins){
    header("location:payment.php?s_proof=3");
  }else{
    header("location:payment.php?s_proof=0");
  }
}
}
?>
