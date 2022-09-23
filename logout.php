<script src="JS/jquery-2.2.4.min.js"></script>
<script src="JS/sweetalert2@10.js">//script for sweet alert</script>
<?php
// Initialize the session
session_start();
$logout = $_SESSION["loggedin"];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    // Redirect to Home page
    ?>
    <script>
    window.location.href = 'index.php';
    </script>
    <?php
    exit;
}
if($logout == true)
{
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
session_start();
$_SESSION['logout']=1;
}
 ?>
    <script>
        window.location.href = 'index.php';
    </script>
 <?php
// Redirect to Home page
//header("refresh:0; Home.php");
?>
