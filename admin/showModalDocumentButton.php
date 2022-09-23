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
if(isset($_GET['uid']))
{
  $uid = $_GET['uid'];
}

?>
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="" method="POST" enctype="multipart/form-data">
  <div class="container2">
    <h1>Add Document</h1>
    <button type="button" class="" onclick="showModalDocumentAdd('grade','<?php echo $uid?>')">Grade</button>
    <button type="button" class="" onclick="showModalDocumentAdd('birth','<?php echo $uid?>')">Birth Certificate</button>
    <button type="button" class="" onclick="showModalDocumentAdd('good','<?php echo $uid?>')">Good Moral</button>
    <button type="button" class="" onclick="showModalDocumentAdd('med','<?php echo $uid?>')">Medical Certificate</button>
    <button type="button" class="" onclick="showModalDocumentAdd('payment','<?php echo $uid?>')">Payment</button>

  </div>
</form>
