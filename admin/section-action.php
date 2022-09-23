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
if(isset($_POST['sub-add-section']))
{
  $secgrade=$_POST['sec-grade'];
  $secno=$_POST['sec-no'];
  $summer = $_POST['summer'];

  $secgrade=stripcslashes($secgrade);
  $secgrade = mysqli_real_escape_string($conn, $secgrade);
  $secno=stripcslashes($secno);
  $secno = mysqli_real_escape_string($conn, $secno);
  $summer=stripcslashes($summer);
  $summer = mysqli_real_escape_string($conn, $summer);

  $sectag1=$_POST['sub-tag1'];
  $secname1=$_POST['sub-name1'];
  $secstart1=$_POST['sub-start1'];
  $secend1=$_POST['sub-end1'];
  $secroom1=$_POST['sub-room1'];
  $secday1=$_POST['sub-day1'];

  $sectag1=stripcslashes($sectag1);
  $sectag1 = mysqli_real_escape_string($conn, $sectag1);
  $secname1=stripcslashes($secname1);
  $secname1 = mysqli_real_escape_string($conn, $secname1);
  $secstart1=stripcslashes($secstart1);
  $secstart1 = mysqli_real_escape_string($conn, $secstart1);

  $secend1=stripcslashes($secend1);
  $secend1 = mysqli_real_escape_string($conn, $secend1);
  $secroom1=stripcslashes($secroom1);
  $secroom1 = mysqli_real_escape_string($conn, $secroom1);
  $secday1=stripcslashes($secday1);
  $secday1 = mysqli_real_escape_string($conn, $secday1);

  $sectag2=$_POST['sub-tag2'];
  $secname2=$_POST['sub-name2'];
  $secstart2=$_POST['sub-start2'];
  $secend2=$_POST['sub-end2'];
  $secroom2=$_POST['sub-room2'];
  $secday2=$_POST['sub-day2'];

  $sectag2=stripcslashes($sectag2);
  $sectag2 = mysqli_real_escape_string($conn, $sectag2);
  $secname2=stripcslashes($secname2);
  $secname2 = mysqli_real_escape_string($conn, $secname2);
  $secstart2=stripcslashes($secstart2);
  $secstart2 = mysqli_real_escape_string($conn, $secstart2);

  $secend2=stripcslashes($secend2);
  $secend2 = mysqli_real_escape_string($conn, $secend2);
  $secroom2=stripcslashes($secroom2);
  $secroom2 = mysqli_real_escape_string($conn, $secroom2);
  $secday2=stripcslashes($secday2);
  $secday2 = mysqli_real_escape_string($conn, $secday2);

  $sectag3=$_POST['sub-tag3'];
  $secname3=$_POST['sub-name3'];
  $secstart3=$_POST['sub-start3'];
  $secend3=$_POST['sub-end3'];
  $secroom3=$_POST['sub-room3'];
  $secday3=$_POST['sub-day3'];

  $sectag3=stripcslashes($sectag3);
  $sectag3 = mysqli_real_escape_string($conn, $sectag3);
  $secname3=stripcslashes($secname3);
  $secname3 = mysqli_real_escape_string($conn, $secname3);
  $secstart3=stripcslashes($secstart3);
  $secstart3 = mysqli_real_escape_string($conn, $secstart3);

  $secend3=stripcslashes($secend3);
  $secend3 = mysqli_real_escape_string($conn, $secend3);
  $secroom3=stripcslashes($secroom3);
  $secroom3 = mysqli_real_escape_string($conn, $secroom3);
  $secday3=stripcslashes($secday3);
  $secday3 = mysqli_real_escape_string($conn, $secday3);

  $sectag4=$_POST['sub-tag4'];
  $secname4=$_POST['sub-name4'];
  $secstart4=$_POST['sub-start4'];
  $secend4=$_POST['sub-end4'];
  $secroom4=$_POST['sub-room4'];
  $secday4=$_POST['sub-day4'];

  $sectag4=stripcslashes($sectag4);
  $sectag4 = mysqli_real_escape_string($conn, $sectag4);
  $secname4=stripcslashes($secname4);
  $secname4 = mysqli_real_escape_string($conn, $secname4);
  $secstart4=stripcslashes($secstart4);
  $secstart4 = mysqli_real_escape_string($conn, $secstart4);

  $secend4=stripcslashes($secend4);
  $secend4 = mysqli_real_escape_string($conn, $secend4);
  $secroom4=stripcslashes($secroom4);
  $secroom4 = mysqli_real_escape_string($conn, $secroom4);
  $secday4=stripcslashes($secday4);
  $secday4 = mysqli_real_escape_string($conn, $secday4);

  $sectag5=$_POST['sub-tag5'];
  $secname5=$_POST['sub-name5'];
  $secstart5=$_POST['sub-start5'];
  $secend5=$_POST['sub-end5'];
  $secroom5=$_POST['sub-room5'];
  $secday5=$_POST['sub-day5'];

  $sectag5=stripcslashes($sectag5);
  $sectag5 = mysqli_real_escape_string($conn, $sectag5);
  $secname5=stripcslashes($secname5);
  $secname5 = mysqli_real_escape_string($conn, $secname5);
  $secstart5=stripcslashes($secstart5);
  $secstart5 = mysqli_real_escape_string($conn, $secstart5);

  $secend5=stripcslashes($secend5);
  $secend5 = mysqli_real_escape_string($conn, $secend5);
  $secroom5=stripcslashes($secroom5);
  $secroom5 = mysqli_real_escape_string($conn, $secroom5);
  $secday5=stripcslashes($secday5);
  $secday5 = mysqli_real_escape_string($conn, $secday5);

  $sectag6=$_POST['sub-tag6'];
  $secname6=$_POST['sub-name6'];
  $secstart6=$_POST['sub-start6'];
  $secend6=$_POST['sub-end6'];
  $secroom6=$_POST['sub-room6'];
  $secday6=$_POST['sub-day6'];

  $sectag6=stripcslashes($sectag6);
  $sectag6 = mysqli_real_escape_string($conn, $sectag6);
  $secname6=stripcslashes($secname6);
  $secname6 = mysqli_real_escape_string($conn, $secname6);
  $secstart6=stripcslashes($secstart6);
  $secstart6 = mysqli_real_escape_string($conn, $secstart6);

  $secend6=stripcslashes($secend6);
  $secend6 = mysqli_real_escape_string($conn, $secend6);
  $secroom6=stripcslashes($secroom6);
  $secroom6 = mysqli_real_escape_string($conn, $secroom6);
  $secday6=stripcslashes($secday6);
  $secday6 = mysqli_real_escape_string($conn, $secday6);

  $sectag7=$_POST['sub-tag7'];
  $secname7=$_POST['sub-name7'];
  $secstart7=$_POST['sub-start7'];
  $secend7=$_POST['sub-end7'];
  $secroom7=$_POST['sub-room7'];
  $secday7=$_POST['sub-day7'];

  $sectag7=stripcslashes($sectag7);
  $sectag7 = mysqli_real_escape_string($conn, $sectag7);
  $secname7=stripcslashes($secname7);
  $secname7 = mysqli_real_escape_string($conn, $secname7);
  $secstart7=stripcslashes($secstart7);
  $secstart7 = mysqli_real_escape_string($conn, $secstart7);

  $secend7=stripcslashes($secend7);
  $secend7 = mysqli_real_escape_string($conn, $secend7);
  $secroom7=stripcslashes($secroom7);
  $secroom7 = mysqli_real_escape_string($conn, $secroom7);
  $secday7=stripcslashes($secday7);
  $secday7 = mysqli_real_escape_string($conn, $secday7);

  $sectag8=$_POST['sub-tag8'];
  $secname8=$_POST['sub-name8'];
  $secstart8=$_POST['sub-start8'];
  $secend8=$_POST['sub-end8'];
  $secroom8=$_POST['sub-room8'];
  $secday8=$_POST['sub-day8'];

  $sectag8=stripcslashes($sectag8);
  $sectag8 = mysqli_real_escape_string($conn, $sectag8);
  $secname8=stripcslashes($secname8);
  $secname8 = mysqli_real_escape_string($conn, $secname8);
  $secstart8=stripcslashes($secstart8);
  $secstart8 = mysqli_real_escape_string($conn, $secstart8);

  $secend8=stripcslashes($secend8);
  $secend8 = mysqli_real_escape_string($conn, $secend8);
  $secroom8=stripcslashes($secroom8);
  $secroom8 = mysqli_real_escape_string($conn, $secroom8);
  $secday8=stripcslashes($secday8);
  $secday8 = mysqli_real_escape_string($conn, $secday8);

  $time1 = $secstart1." to ".$secend1;
  $time2 = $secstart2." to ".$secend2;
  $time3 = $secstart3." to ".$secend3;
  $time4 = $secstart4." to ".$secend4;
  $time5 = $secstart5." to ".$secend5;
  $time6 = $secstart6." to ".$secend6;
  $time7 = $secstart7." to ".$secend7;
  $time8 = $secstart8." to ".$secend8;

  if($secgrade == "Grade 1" ||$secgrade == "Grade 2"||$secgrade == "Grade 3"){
    $resadd1 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag1','$secname1','$secday1','$time1','$secgrade','$secno','$secroom1','ACTIVE','$summer')");
    $resadd2 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag2','$secname2','$secday2','$time2','$secgrade','$secno','$secroom2','ACTIVE','$summer')");
    $resadd3 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag3','$secname3','$secday3','$time3','$secgrade','$secno','$secroom3','ACTIVE','$summer')");
    $resadd4 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag4','$secname4','$secday4','$time4','$secgrade','$secno','$secroom4','ACTIVE','$summer')");
    $resadd5 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag5','$secname5','$secday5','$time5','$secgrade','$secno','$secroom5','ACTIVE','$summer')");
    $resadd6 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag6','$secname6','$secday6','$time6','$secgrade','$secno','$secroom6','ACTIVE','$summer')");
    $resadd7 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag7','$secname7','$secday7','$time7','$secgrade','$secno','$secroom7','ACTIVE','$summer')");
  }else{
    $resadd1 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag1','$secname1','$secday1','$time1','$secgrade','$secno','$secroom1','ACTIVE','$summer')");
    $resadd2 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag2','$secname2','$secday2','$time2','$secgrade','$secno','$secroom2','ACTIVE','$summer')");
    $resadd3 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag3','$secname3','$secday3','$time3','$secgrade','$secno','$secroom3','ACTIVE','$summer')");
    $resadd4 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag4','$secname4','$secday4','$time4','$secgrade','$secno','$secroom4','ACTIVE','$summer')");
    $resadd5 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag5','$secname5','$secday5','$time5','$secgrade','$secno','$secroom5','ACTIVE','$summer')");
    $resadd6 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag6','$secname6','$secday6','$time6','$secgrade','$secno','$secroom6','ACTIVE','$summer')");
    $resadd7 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag7','$secname7','$secday7','$time7','$secgrade','$secno','$secroom7','ACTIVE','$summer')");
    $resadd8 = $conn->query("INSERT INTO tbl_subjects(SUB_TAG,SUB_NAME,SUB_DAY,SUB_TIME,SUB_YEAR,SUB_SECTION,SUB_ROOM,SUB_STATUS,SUB_SUMMER)values('$sectag8','$secname8','$secday8','$time8','$secgrade','$secno','$secroom8','ACTIVE','$summer')");
  }
}

if($resadd1&&$resadd2&&$resadd3&&$resadd4&&$resadd5&&$resadd6&&$resadd7||$resadd8){
  $_SESSION['s_section']=1;
  header("location:section.php");
}else{
  $_SESSION['s_section']=0;
  header("location:section.php");
}
?>
