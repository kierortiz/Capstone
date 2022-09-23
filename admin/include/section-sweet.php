<?php
if(isset($_SESSION['s_section']))
{
  if($_SESSION['s_section']==1)
  {
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully added new section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_section']);
  }else if($_SESSION['s_section']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Failed',
            text : 'Error while adding new section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_section']);
  }
}

if(isset($_SESSION['s_remove_subject']))
{
  if($_SESSION['s_remove_subject']==1){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully removed  section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_remove_subject']);
  }else if($_SESSION['s_remove_subject']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Failed',
            text : 'Error while removing section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_remove_subject']);
  }
}

if(isset($_SESSION['s_edit_section']))
{
  if($_SESSION['s_edit_section']==1){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'success',
            title : 'Success',
            text : 'Successfully edited  section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_edit_section']);
  }else if($_SESSION['s_edit_section']==0){
    ?>
    <script>
      window.addEventListener("load",function(){
        swal.fire({
            icon : 'error',
            title : 'Failed',
            text : 'Error while editing section!'
        })
      },false)
      </script>
    <?php
    unset($_SESSION['s_edit_section']);
  }
}
?>
