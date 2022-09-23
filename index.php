<?php
$page = "index.php";
session_start();
//include functions of sweetalert
include "functions.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="assets/CSS/design.css" rel="stylesheet" type="text/css">
    <link href="assets/CSS/home.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/CSS/icofont.min.css" type="text/css">
    <link rel="stylesheet" href="assets/CSS/icofont.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="JS/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="assets/CSS/iziModal.min.css">
		<script src="JS/iziModal.min.js" type="text/javascript"></script>
		<script src="JS/sweetalert2@10.js">//script for sweet alert</script>
		<link rel="stylesheet" href="assets/CSS/izidesign.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <title>Home</title>
  </head>

  <body  id="home">
    <?php include('includes/header.php');?>

        <div class="slideshow-container">
          <div class="mySlides fade">
            <img src="assets/slide/1.jpg">
          </div>

          <div class="mySlides fade">
            <img src="assets/slide/2.jpg">
          </div>

          <div class="mySlides fade">
            <img src="assets/slide/3.jpg">
          </div>
        </div>
        <br>

        <div style="text-align:center">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>


      <section class="mid-sec">

        <div class="title-container">
          <h1>WE ACCEPT ELEMENTARY AND JUNIOR HIGH SCHOOL.</h1>
        </div>

        <div class="card-container">
          <div class="card">
            <img src="assets/img/elem.jpg" alt="">
            <h3>Elementary</h3>
          </div>

          <div class="card">
            <img src="assets/img/jhs.jpg" alt="">
            <h3>Junior High School</h3>
          </div>
        </div>

        <div class="link-container">
          <div class="link">
            <h3>For Enrollment Procedure</h3>
            <button onclick="window.open('instruction.html')" class="btn-click">Click Here</button>
          </div>
        </div>

      </section>

      <?php include('includes/footer.php');?>

      <script src="js/image.js"></script>
      <script src="js/nav.js"></script>
  </body>
</html>

<script src="js/tawk.js"></script>
<script src="js/izimodal_login.js"></script>

<script>
$(document).ready(function() {
        $('.recent-link').hover(
          function() {
          $('.hovercard').css('display', 'block')
        },

        function() {
        $('.hovercard').css('display', 'none')
      },

    );
});
</script>
