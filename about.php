<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="assets/CSS/design.css" rel="stylesheet" type="text/css">
    <link href="assets/CSS/about.css" rel="stylesheet" type="text/css">
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
    <title>About</title>
  </head>
  <body  id="home">

    <?php
    session_start();

    include('includes/header.php');?>

      <section class="mid-sec">

        <div class="about-container">
          <div class="about-child">
            <h2>About us</h2>
          </div>

          <div class="about-child">
            <p>St. Andrew's Cleverland School was established 27 years ago by its late owner, Rodolfo De Leon.</p>
            <p>The name St. Andrew’s Cleveland School is based from Rodolfo’s old elementary school in Paranaque which is St. Andrew’s School. The school offers nursery, elementary and junior high school.</p>
          </div>
        </div>

        <div class="mv-container">
          <div class="mv-child">
            <h2>Mission</h2>
            <p>WE DEDICATE OURSELVES TO THE HOLISTIC FORMATION OF PERSONS, EMPOWERED TO INSPIRE AND UPHOLD SOCIO-CULTURAL, PSYCHO-SPIRITUAL, MORAL AND ENVIRONMENTAL ORDER IN THE LOCAL AND GLOBAL SCENARIO.</p>
          </div>

          <div class="mv-child">
            <h2>Vision</h2>
            <p>A GOD-CENTERED SCHOOL COMMUNITY GROWING IN CHRISIAN VALUES AND CHARACTER, FOR THE TRANSFORMATION OF SOCIETY IN ACCORDANCE TO THE LIFE AND SPRIRITUALITY OF ST. ANDREW</p>
          </div>

        </div>

      </section>

      <?php include('includes/footer.php');?>

      <script src="js/nav.js"></script>
  </body>
</html>

<script src="js/tawk.js"></script>
<script src="js/izimodal_login.js"></script>
