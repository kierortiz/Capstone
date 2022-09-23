<?php
$page = $_GET['page'];
?>
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="include/funcAddTuition.php?page=<?=$page?>" method="POST">
  <div class="container2">
    <h1>Add New Tuition Fee</h1>
    <!-- Edit 6 Start -->
       <div class="col-1">
       <span for="6" title="If picking summer class, specify student number of student giving this tuition breakdown">Summer Class?</span>
       <br>
       </div>
       <br>
       <div>
       <br>
       <input type="radio" name="summer" value="Yes" required>Yes
       <br>
       <input type="radio" name="summer" value="No" required>No
       <br>
     </div>
   <br>
   <p>Student ID: (Fill Student ID only if adding tuition for specific student with Summer Class, or else leave blank)</p>
   <input type="number" placeholder="Enter Student ID" name="sumstudid">
   <p>Grade:</p>
   <!-- Edit 6 End-->
      <input type="number" placeholder="Enter Grade" name="grade" min="0" max="12" required>
      <p>PLAN:</p>
      <input type="text" placeholder="Enter Plan A or B or C" name="plan" required>
      <p>Tuition Fee:</p>
      <input type="number" placeholder="Enter Tuition Fee" name="tf" min="0" required>
      <p>Miscellaneous:</p>
      <input type="number" placeholder="Enter Miscellaneous Fee" name="misc" min="0">
      <p>No. of Book/s:</p>
      <input type="number" placeholder="Enter Number of Book/s" name="noOfBooks" min="0">
      <p>Price of Book/s:</p>
      <input type="number" placeholder="Enter Book's Fee" name="book" min="0">
      <p>Additional Fee:</p>
      <input type="number" placeholder="Enter Additional Fee" name="add" min="0">
      <center><input type="submit" value="Submit" name="sub_add_tuition" class="modalsub"></center>
  </div>
</form>
