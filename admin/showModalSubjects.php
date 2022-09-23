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
if(!empty($_GET)){
  if(isset($_GET['grade'])||isset($_GET['section'])){
    $section = $_GET['section'];
    $grade = $_GET['grade'];
    $page_from=$_GET['page_from'];
    if($page_from == "section"){
      $checksummer = "No";
    }else{
      $checksummer = "Yes";
    }
    $subjects = array();
    $totalsub=0;
    $ressub = $conn->query("SELECT * FROM tbl_subjects WHERE SUB_YEAR='$grade' AND SUB_SECTION='$section' AND SUB_STATUS !='ARCHIVED'  AND SUB_SUMMER='$checksummer'");
    if($ressub->num_rows>0){
      while($rowsub = $ressub->fetch_assoc())
      {
        $subjects[$totalsub][0]=$rowsub['SUB_TAG'];
        $subjects[$totalsub][1]=$rowsub['SUB_NAME'];
        $subjects[$totalsub][2]=$rowsub['SUB_DAY'];
        $subjects[$totalsub][3]=$rowsub['SUB_TIME'];
        $subjects[$totalsub][4]=$rowsub['SUB_ROOM'];
        $subjects[$totalsub][5]=$rowsub['SUB_STUDCOUNT'];
        $totalsub++;
      }
    }
    ?>
    <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
    <div class="modal-content">
      <div class="container2">
        <h1>Subjects</h1>
        <input type="text" class="infocus" name="grade" value="<?php if($checksummer=="Yes"){echo "Summer Class";}else{echo "Regular Class";}?>" readonly>
        <input type="text" class="infocus" name="grade" value="<?php echo $grade?>" readonly>
        <input type="text" class="infocus" name="section" value="<?php echo $section?>" readonly>
        <div class="container-table">
          <table style="width:100%;margin: 10px 0;">
            <tbody>
            <tr>
              <th colspan="1">SUBJECT TAG</th>
              <th colspan="1">SUBJECT NAME</th>
              <th colspan="1">SUBJECT DAY</th>
              <th colspan="1">SUBJECT TIME</th>
              <th colspan="1">SUBJECT ROOM</th>
              <th colspan="1">STUDENT COUNT</th>
            </tr>
            <?php
            for($i=0;$i<$totalsub;$i++)
            {
              ?>
              <tr>
                <td><?php echo $subjects[$i][0]?></td>
                <td><?php echo $subjects[$i][1]?></td>
                <td><?php echo $subjects[$i][2]?></td>
                <td><?php echo $subjects[$i][3]?></td>
                <td><?php echo $subjects[$i][4]?></td>
                <td><?php echo $subjects[$i][5]?></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php
  }
}
?>
