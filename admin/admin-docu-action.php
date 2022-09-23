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
include '../conn.php';
$ADMINID=$_SESSION['AID'];
$ADMINNAME=$_SESSION['ANAME'];
$ADMINPOS=$_SESSION['POSITION'];
$APPROVE=$ADMINNAME."-".$ADMINPOS;


if(isset($_POST['sub-docu-summer']))
{
  $uid="";
  if(isset($_GET['uid']))
  {
    $uid = $_GET['uid'];
  }

  $option = $_POST['options0'];

  //get email and yearlvl
  $sqlgrade = "SELECT * FROM tbl_account WHERE UID =$uid";
  $resgrade = $conn->query($sqlgrade);
  if($resgrade->num_rows>0){
    $rowgrade = $resgrade->fetch_assoc();
    $email = $rowgrade['EMAILADD'];
    $yearlvl = $rowgrade['YEARLEVEL'];
  }
  //get student count tbl_subject
  //section 1
    $sqlgrade2 = "SELECT * FROM tbl_subjects WHERE SUB_YEAR ='$yearlvl' AND SUB_SECTION ='Section 1'";
    $resgrade2 = $conn->query($sqlgrade2);
    if($resgrade2->num_rows>0){
      $rowgrade2 = $resgrade2->fetch_assoc();
      $studcount = $rowgrade2['SUB_STUDCOUNT'];
    }
  //section 2
    $sqlgrade3 = "SELECT * FROM tbl_subjects WHERE SUB_YEAR ='$yearlvl' AND SUB_SECTION ='Section 2'";
    $resgrade3 = $conn->query($sqlgrade3);
    if($resgrade3->num_rows>0){
      $rowgrade3 = $resgrade3->fetch_assoc();
      $studcount2 = $rowgrade3['SUB_STUDCOUNT'];
    }

    if($studcount < 40 && $studcount >= 0){
      $sec = "Section 1";
      $studcount += 1;
    }else{
      $sec = "Section 2";
      $studcount = $studcount2 + 1;
    }

  if($option=="Accept"){
    $grade = $_POST['inp-grade'];
    $totalSub = $_POST['totalSub'];
    $subjectList=array();
    for($i=0;$i<$totalSub;$i++)
    {
      $subName = "subject".$i;
      if(isset($_POST[$subName]))
      {
        $subject = $_POST[$subName];
        $subject=stripcslashes($subject);
        $subject = mysqli_real_escape_string($conn, $subject);
        $conn->query("INSERT INTO tbl_summer(SUID,SUBJECT,STATUS)values($uid,'$subject','SUMMER')");

      }
    }

    $sqlupdatedocu="UPDATE tbl_documents SET DOC_APPROVED_BY='$APPROVE',DOC_APPROVED_DATE=NOW(),DOC_STATUS='ACCEPTED' WHERE DOC_TYPE='Grade' AND DOC_STUDID=$uid";
    $sqlupdatesection="UPDATE tbl_subjects SET SUB_STUDCOUNT ='$studcount' WHERE SUB_YEAR = '$yearlvl' AND SUB_SECTION ='$sec'";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Report Card of Student $uid', NOW())");
    $resupdatedocu = $conn->query($sqlupdatedocu);
    $resupdatedocu2 = $conn->query($sqlupdatesection);
    if($resupdatedocu){
      $ressection = $conn->query("UPDATE tbl_account SET GRADE = $grade,SECTION ='$sec' WHERE UID = $uid");
      $header0 = "s_docu_summer=1";
    }else{
      $header0 = "s_docu_summer=3";
    }
    header("refresh:0;url=students1.php?".$header0);
  }else{
    $comment0 = $_POST['comment0'];
    $sqlupdatedocu="UPDATE tbl_documents SET DOC_STATUS='DENIED',DOC_COMMENT='$comment0' WHERE DOC_TYPE='Grade' AND DOC_STUDID=$uid AND DOC_COMMENT =''";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied Report Card of $uid Comment: $comment0', NOW())");
    $resupdatedocu = $conn->query($sqlupdatedocu);
    if($resupdatedocu){
      $header0="s_docu_summer=2";
    }else{
      $header0 ="s_docu_summer=0";
    }
    header("refresh:0;url=students1.php?".$header0);
  }
}

if(isset($_POST['sub-docu']))
{
  if(isset($_GET['uid']))
  {
    $uid = $_GET['uid'];
  }


  $status=array();
  $totalDocs=0;
  $sqldocustatusgetter= "SELECT * FROM tbl_documents WHERE DOC_STUDID=$uid AND DOC_STATUS = 'PENDING'";
  $resdocstatus=$conn->query($sqldocustatusgetter);
  if($resdocstatus->num_rows>0)
  {

    while($rowdocstat=$resdocstatus->fetch_assoc())
    {
      $status[$totalDocs]=$rowdocstat['DOC_STATUS'];
      $uid2 = $rowdocstat['DOC_STUDID'];
      $totalDocs++;
    }
  }
  //get dropdown inputs
  $checker0 = $_POST['options0'];
  $checker1 = $_POST['options1'];
  $checker2 = $_POST['options2'];
  $checker3 = $_POST['options3'];

  $accept0 = "";
  $accept1 = "";
  $accept2 = "";
  $accept3 = "";

  //get document name
  $docuname0 = $_POST['document0'];

  $docuname1 = $_POST['document1'];
  $docuname2 = $_POST['document2'];
  $docuname3 = $_POST['document3'];
  $success0 = 4;
  $success1 = 4;
  $success2 = 4;
  $success3 = 4;
  $sec="";

  //
  if($docuname0=="Grade")
  {
    $accept0=$checker0;
  }else if($docuname0=="Birth Certificate"){
    $accept1=$checker0;
  }else if($docuname0=="Good Moral"){
    $accept2=$checker0;
  }else if($docuname0=="Medical Certificate"){
    $accept3=$checker0;
  }

  if($docuname1=="Birth Certificate"){
    $accept1=$checker1;
  }else if($docuname1=="Good Moral"){
    $accept2=$checker1;
  }else if($docuname1=="Medical Certificate"){
    $accept3=$checker1;
  }

  if($docuname2=="Good Moral"){
    $accept2=$checker2;
  }else if($docuname2=="Medical Certificate"){
    $accept3=$checker2;
  }

  if($docuname3=="Medical Certificate"){
    $accept3=$checker3;
  }

  //get email and yearlvl
  $sqlgrade = "SELECT * FROM tbl_account WHERE UID ='$uid2'";
  $resgrade = $conn->query($sqlgrade);
  if($resgrade->num_rows>0){
    $rowgrade = $resgrade->fetch_assoc();
    $email = $rowgrade['EMAILADD'];
    $yearlvl = $rowgrade['YEARLEVEL'];
  }
//get student count tbl_subject
//section 1
  $sqlgrade2 = "SELECT * FROM tbl_subjects WHERE SUB_YEAR ='$yearlvl' AND SUB_SECTION ='Section 1'";
  $resgrade2 = $conn->query($sqlgrade2);
  if($resgrade2->num_rows>0){
    $rowgrade2 = $resgrade2->fetch_assoc();
    $studcount = $rowgrade2['SUB_STUDCOUNT'];
  }
//section 2
  $sqlgrade3 = "SELECT * FROM tbl_subjects WHERE SUB_YEAR ='$yearlvl' AND SUB_SECTION ='Section 2'";
  $resgrade3 = $conn->query($sqlgrade3);
  if($resgrade3->num_rows>0){
    $rowgrade3 = $resgrade3->fetch_assoc();
    $studcount2 = $rowgrade3['SUB_STUDCOUNT'];
  }


  if($accept0=="Accept"){
    $grade = $_POST['inp-grade'];
      if($studcount < 40 && $studcount >= 0){
        $sec = "Section 1";
        $studcount += 1;
      }else{
        $sec = "Section 2";
        $studcount = $studcount2 + 1;
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
            $mail->Subject = 'Accepted Report Card';
            $mail->Body    = 'Good Day!<br>       We have received your childs Report Card with an average grade of '.$grade.' With this, your child will be enrolled in section 1 of '.$yearlvl.' <br>Thank you and have a nice day.';
            //
            //$mail->AltBody = strip_tags($email);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    $sqlupdatedocu="UPDATE tbl_documents SET DOC_APPROVED_BY='$APPROVE',DOC_APPROVED_DATE=NOW(),DOC_STATUS='ACCEPTED' WHERE DOC_TYPE='Grade' AND DOC_STUDID=$uid";
    $sqlupdatesection="UPDATE tbl_subjects SET SUB_STUDCOUNT ='$studcount' WHERE SUB_YEAR = '$yearlvl' AND SUB_SECTION ='$sec'";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Report Card of Student $uid2', NOW())");
    $resupdatedocu = $conn->query($sqlupdatedocu);
    $resupdatedocu2 = $conn->query($sqlupdatesection);
    if($resupdatedocu){
      $ressection = $conn->query("UPDATE tbl_account SET GRADE = $grade,SECTION ='$sec' WHERE UID = $uid");
      $success0 = 1;
    }else{
      $success0 = 0;
    }
  }else if($accept0=="Deny"){
    $comment0 = $_POST['comment0'];
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
        $mail->Subject = 'Denied Report Card';
        $mail->Body    = 'Good Day! '.$APPROVE.' Denied your childs Report Card, Comment: '.$comment0;
        //
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $sqlupdatedocu="UPDATE tbl_documents SET DOC_STATUS='DENIED',DOC_COMMENT='$comment0' WHERE DOC_TYPE='Grade' AND DOC_STUDID=$uid";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied Report Card of $uid2 Comment: $comment0', NOW())");
    $resupdatedocu = $conn->query($sqlupdatedocu);
    if($resupdatedocu){
      $success0 = 2;
    }else{
      $success0 = 3;
    }
  }

  //update birth
  if($accept1=="Accept"){
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
        $mail->Subject = 'Accepted Birth Certificate';
        $mail->Body    = 'Good Day!<br>      Thank you for submitting your childs Birth Certificate. We have received the document and you may continue to enroll your child. <br>Thank you and have a nice day.';
        //
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $sqlupdatedocu1="UPDATE tbl_documents SET DOC_APPROVED_BY='$APPROVE',DOC_APPROVED_DATE=NOW(),DOC_STATUS='ACCEPTED' WHERE DOC_TYPE='Birth Certificate' AND DOC_STUDID=$uid";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Birth Certificate of Student $uid2', NOW())");
    $resupdatedocu1 = $conn->query($sqlupdatedocu1);
    if($resupdatedocu1){
      $success1 = 1;
    }else{
      $success1 = 0;
    }
  }else if($accept1=="Deny"){
    if($status[1]!="ACCEPTED"){
      $comment1 = $_POST['comment1'];
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
          $mail->Subject = 'Denied Birth Certificate';
          $mail->Body    = 'Good Day! '.$APPROVE.' Denied your childs Birth Certificate, Comment: '.$comment1;
          //
          //$mail->AltBody = strip_tags($email);

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied Birth Certificate of $uid2 Comment: $comment1', NOW())");
      $sqlupdatedocu1="UPDATE tbl_documents SET DOC_STATUS='DENIED',DOC_COMMENT='$comment1' WHERE DOC_TYPE='Birth Certificate' AND DOC_STUDID=$uid";

      $resupdatedocu1 = $conn->query($sqlupdatedocu1);
      if($resupdatedocu1){
        $success1 = 2;
      }else{
        $success1 = 3;
      }
    }
  }
  else{
  }
  //update goodmoral
  if($accept2=="Accept"){
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
        $mail->Subject = 'Accepted Good Moral Card';
        $mail->Body    = 'Good Day!<br>      Thank you for submitting your childs Good Moral. We have received the document and you may continue to enroll your child. <br>Thank you and have a nice day.';
        //
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Good Moral of Student $uid2', NOW())");
    $sqlupdatedocu2="UPDATE tbl_documents SET DOC_APPROVED_BY='$APPROVE',DOC_APPROVED_DATE=NOW(),DOC_STATUS='ACCEPTED' WHERE DOC_TYPE='Good Moral' AND DOC_STUDID=$uid";
    $resupdatedocu2 = $conn->query($sqlupdatedocu2);
    if($resupdatedocu2){
      $success2 = 1;
    }else{
      $success2 = 0;
    }
  }else if($accept2=="Deny"){
    if($status[2]!="ACCEPTED"){
      $comment2 = $_POST['comment2'];
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
          $mail->Subject = 'Denied Good Moral Card';
          $mail->Body    = 'Good Day! '.$APPROVE.' Denied your childs Good Moral, Comment: '.$comment2;
          //
          //$mail->AltBody = strip_tags($email);

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied Good Moral of $uid2 Comment: $comment2', NOW())");
      $sqlupdatedocu2="UPDATE tbl_documents SET DOC_STATUS='DENIED',DOC_COMMENT='$comment2' WHERE DOC_TYPE='Good Moral' AND DOC_STUDID=$uid";
      $resupdatedocu2 = $conn->query($sqlupdatedocu2);
      if($resupdatedocu2){
        $success2 = 2;
      }else{
        $success2 = 3;
      }
    }
  }else{

  }
  //update med Certificate
  if($accept3=="Accept"){
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
        $mail->Subject = 'Accepted Medical Certificate';
        $mail->Body    = 'Good Day!<br>      Thank you for submitting your childs Medical Certificate. We have received the document and you may continue to enroll your child. <br>Thank you and have a nice day.';
        //
        //$mail->AltBody = strip_tags($email);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    $sqlupdatedocu3="UPDATE tbl_documents SET DOC_APPROVED_BY='$APPROVE',DOC_APPROVED_DATE=NOW(),DOC_STATUS='ACCEPTED' WHERE DOC_TYPE='Medical Certificate' AND DOC_STUDID=$uid";
    $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Approved a Medical Certificate of Student $uid2', NOW())");
    $resupdatedocu3 = $conn->query($sqlupdatedocu3);
    if($resupdatedocu3){
      $success3 = 1;
    }else{
      $success3 = 0;
    }
  }else if($accept3=="Deny"){
    if($status[3]!="ACCEPTED"){
      $comment3 = $_POST['comment3'];
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
          $mail->Subject = 'Denied Medical Certificate';
          $mail->Body    = 'Good Day! '.$APPROVE.' Denied your childs Medical Certificate, Comment: '.$comment3;
          //
          //$mail->AltBody = strip_tags($email);

          $mail->send();
          echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      $conn->query("INSERT INTO tbl_logs (LOG_NAME,LOG_ACTION,LOG_DATE) VALUES ('$ADMINNAME','$APPROVE Denied Medical Certificate of $uid2 Comment: $comment3', NOW())");
      $sqlupdatedocu3="UPDATE tbl_documents SET DOC_STATUS='DENIED',DOC_COMMENT='$comment3' WHERE DOC_TYPE='Medical Certificate' AND DOC_STUDID=$uid";
      $resupdatedocu3 = $conn->query($sqlupdatedocu3);
      if($resupdatedocu3){
        $success3 = 2;
      }else{
        $success3 = 3;
      }
    }
  }else{

  }

  if($success0==0){
    $header0 = "s_docu0=0";
  }else if($success0==1){
    $header0 = "s_docu0=1";
  }else if($success0==2){
    $header0 = "s_docu0=2";
  }else if($success0==3){
    $header0 = "s_docu0=3";
  }else{
    $header0 = "s_docu0=4";
  }

  if($success1==0){
    $header1 = "s_docu1=0";
  }else if($success1==1){
    $header1 = "s_docu1=1";
  }else if($success1==2){
    $header1 = "s_docu1=2";
  }else if($success1==3){
    $header1 = "s_docu1=3";
  }else{
    $header1 = "s_docu1=4";
  }

  if($success2==0){
    $header2 = "s_docu2=0";
  }else if($success2==1){
    $header2 = "s_docu2=1";
  }else if($success2==2){
    $header2 = "s_docu2=2";
  }else if($success2==3){
    $header2 = "s_docu2=3";
  }else{
    $header2 = "s_docu2=4";
  }

  if($success3==0){
    $header3 = "s_docu3=0";
  }else if($success3==1){
    $header3 = "s_docu3=1";
  }else if($success3==2){
    $header3 = "s_docu3=2";
  }else if($success3==3){
    $header3 = "s_docu3=3";
  }else{
    $header3 = "s_docu3=4";
  }


  header("refresh:0;url=students.php?".$header0."&".$header1."&".$header2."&".$header3);


}
?>
