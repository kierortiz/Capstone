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
$totalsub=0;
if(isset($_GET['grade'])&&isset($_GET['section'])&&isset($_GET['page_from'])){
  $section = $_GET['section'];
  $grade = $_GET['grade'];
  $page_from=$_GET['page_from'];
  if($page_from == "section"){
    $checksummer = "No";
  }else{
    $checksummer = "Yes";
  }
  $subjects = array();
  $ressub = $conn->query("SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' AND SUB_SECTION='$section' AND SUB_STATUS !='ARCHIVED' AND SUB_SUMMER='$checksummer'");
  if($ressub->num_rows>0){
    while($rowsub = $ressub->fetch_assoc())
    {
      $summerdb = $rowsub['SUB_SUMMER'];
      $subjects[$totalsub][0]=$rowsub['SUB_TAG'];
      $subjects[$totalsub][1]=$rowsub['SUB_NAME'];
      $subjects[$totalsub][2]=$rowsub['SUB_ROOM'];
      $subjects[$totalsub][3]=$rowsub['SUB_DAY'];
      $subjects[$totalsub][4]=$rowsub['SUB_TIME'];
      $subjects[$totalsub][5]=$rowsub['SUB_ID'];
      $totalsub++;
    }
  }
}else{
  if(isset($_POST['sub-edit-section']))
  {
    $page_from = $_GET['page_from'];
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $totalsub = $_GET['totalsub'];
    $summerinp = $_POST['summer'];
    for($i=0;$i<$totalsub;$i++)
    {
      $subid = "sub-id".$i;
      $subtag="sub-tag".$i;
      $subname = "sub-name".$i;
      $subtime = "sub-time".$i;
      $subroom = "sub-room".$i;
      $subday = "sub-day".$i;

      // echo $subtag.$subname.$subtime.$subroom.$subday."<br>";

      $subid = $_POST[$subid];
      $subtag = $_POST[$subtag];
      $subname = $_POST[$subname];
      $subtime = $_POST[$subtime];
      $subroom = $_POST[$subroom];
      $subday = $_POST[$subday];

      $subid=stripcslashes($subid);
      $subtag=stripcslashes($subtag);
      $subname=stripcslashes($subname);
      $subtime=stripcslashes($subtime);
      $subroom=stripcslashes($subroom);
      $subday=stripcslashes($subday);

      $subid = mysqli_real_escape_string($conn, $subid);
      $subtag = mysqli_real_escape_string($conn, $subtag);
    	$subname = mysqli_real_escape_string($conn, $subname);
      $subtime = mysqli_real_escape_string($conn, $subtime);
      $subroom = mysqli_real_escape_string($conn, $subroom);
    	$subday = mysqli_real_escape_string($conn, $subday);

      // echo $subtag.$subname.$subtime.$subroom.$subday."<br>";

      $sql = "UPDATE tbl_subjects SET SUB_TAG='$subtag',SUB_NAME='$subname',SUB_DAY='$subday',SUB_TIME='$subtime',SUB_ROOM='$subroom', SUB_SUMMER='$summerinp' WHERE SUB_ID = '$subid'";
      $res[$i] = $conn->query($sql);
    }
    if($res[0]){
      $_SESSION['s_edit_section']=1;
      header("location:".$page_from.".php");
    }else{
      $_SESSION['s_edit_section']=0;
      header("location:".$page_from.".php");
    }
  }
}


?>

<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="editSection.php?totalsub=<?=$totalsub?>&page_from=<?=$page_from?>" method="POST">
  <div class="container2">
    <h1>Edit Section</h1>

    <input type="text" class="infocus" name="grade" value="<?php echo $grade?>" readonly>
    <input type="text" class="infocus" name="section" value="<?php echo $section?>" readonly>

    <select name="summer" required>
      <option value="No" <?php if($summerdb=="No"){ echo "selected=selected";}?>>Regular Class</option>
      <option value="Yes" <?php if($summerdb=="Yes"){ echo "selected=selected";}?>>Summer Class</option>
    </select>
    <div class="container-table">
      <div class="tbl-rowtitle">
          <p>Subjects</p>
      </div>
          <table class="table-modal">
            <tbody>
              <tr>
                <th>Subject ID</th>
                <th>Subject Tag</th>
                <th>Subject Name</th>
                <th>Room</th>
                <th>Day</th>
                <th>Time</th>
              </tr>
              <?php
              for($i=0;$i<$totalsub;$i++)
              {
                $subid = "sub-id".$i;
                $subtag = "sub-tag".$i;
                $subname = "sub-name".$i;
                $subtime = "sub-time".$i;
                $subroom = "sub-room".$i;
                $subday = "sub-day".$i;
                ?>
                <tr>
                  <td><input type="text" name="<?php echo $subid?>"  value="<?php echo $subjects[$i][5]?>" readonly></td>
                  <td><input type="text" name="<?php echo $subtag?>"  value="<?php echo $subjects[$i][0]?>"></td>
                  <td><input type="text" name="<?php echo $subname?>"  value="<?php echo $subjects[$i][1]?>"></td>
                  <td><input type="text" name="<?php echo $subroom?>"  value="<?php echo $subjects[$i][2]?>"></td>
                  <td><input type="text" name="<?php echo $subday?>"  value="<?php echo $subjects[$i][3]?>"></td>
                  <td><input type="text" name="<?php echo $subtime?>"  value="<?php echo $subjects[$i][4]?>"></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <center><input type="submit" name="sub-edit-section" value="Submit" class="modalsub"></center>
    </div>
  </div>
</form>
