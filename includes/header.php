<!-- Izimodal login -->

<div id="modal-custom" data-iziModal-group="grupo1">

    <button data-iziModal-close class="icon-close">x</button>
    <header>
        <a href="" >New Account</a>
        <a href="" id="signin" class="active">Login</a>

    </header>

    <section class="hide">
      <form action="action.php" method="POST" id="signupmodal">
        <input type="email" placeholder="Email" name="user">
        <input type="password" placeholder="Password" name="pass" maxlength="16" minlength="8">
        <input type="password" placeholder="Retype Password" name="rpass">
          <li class="recent-link">
            <p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Terms</p>
            <span class="hovercard">
              <div class="tooltiptext">
                <b style="text-align:center;">Terms and Conditions </b>
                <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
                <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
                <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
                <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
              </div>
            </span>
          </li>
        <footer>
            <button data-iziModal-close>Cancel</button>
            <button type="Submit" class="submit" name="sub-register">Create Account</button>
        </footer>
        </form>
    </section>

    <section>
      <form action="action.php" method="POST">
        <input type="text" placeholder="Email" name="user">
        <input type="password" placeholder="Password" name="pass">

          <center data-iziModal-close data-izimodal-open="#modal-custom2"><p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Forgot your password?</p></center>
            <li class="recent-link">
              <p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Terms</p>
              <span class="hovercard">
                <div class="tooltiptext">
                  <b style="text-align:center;">Terms and Conditions </b>
                  <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
                  <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
                  <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
                  <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
                </div>
              </span>
            </li>

        <footer>
            <button data-iziModal-close>Cancel</button>
            <button type="Submit" class="submit" name="sub-login">Log in</button>
        </footer>
      </form>
    </section>

</div>

<div id="modal-custom2" data-iziModal-group="grupo2">

    <button data-iziModal-close class="icon-close">x</button>

    <section>
      <form action="action.php" method="POST">
        <p style="margin-bottom:26px;">Please enter the email address of the account you wish to recover.</p>
        <input type="text" placeholder="Email" name="email" required>
        <footer>
            <button data-iziModal-close data-izimodal-open="#modal-custom">Cancel</button>
            <button type="Submit" class="submit" name="sub-recover">Recover</button>
        </footer>
      </form>
    </section>
</div>

<div id="modal-custom3" data-iziModal-group="grupo3">

    <button data-iziModal-close class="icon-close">x</button>
    <header>
      <a href="" id="signin">Login</a>
      <a href="" class="active">New Account</a>

    </header>

    <section class="hide">
      <form action="action.php" method="POST">
        <input type="text" placeholder="Email" name="user">
        <input type="password" placeholder="Password" name="pass">

          <center data-iziModal-close data-izimodal-open="#modal-custom2"><p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Forgot your password?</p></center>
            <li class="recent-link">
              <p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Terms</p>
              <span class="hovercard">
                <div class="tooltiptext">
                  <b style="text-align:center;">Terms and Conditions </b>
                  <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
                  <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
                  <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
                  <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
                </div>
              </span>
            </li>
        <footer>
            <button data-iziModal-close>Cancel</button>
            <button type="Submit" class="submit" name="sub-login">Log in</button>
        </footer>
      </form>
    </section>

    <section>
      <form action="action.php" method="POST" id="signupmodal">
        <input type="email" placeholder="Email" name="user">
        <input type="password" placeholder="Password" name="pass" maxlength="16" minlength="8">
        <input type="password" placeholder="Retype Password" name="rpass">
          <li class="recent-link">
            <p style="margin-bottom:26px; text-decoration:underline; cursor:pointer;">Terms</p>
            <span class="hovercard">
              <div class="tooltiptext">
                <b style="text-align:center;">Terms and Conditions </b>
                <p>  1. &nbsp Students must complete all the steps and requirements with the admission form / Fill out form truthfully. </p>
                <p>  2. &nbsp	All required documents should be legal/original (It will not be accepted if the student submitted a fake document). </p>
                <p>  3. &nbsp	We will collect your personal information but will be confidential between the faculty of the school. </p>
                <p>  4. &nbsp	Elementary students Grades 1-6 must be guided by a parent when filling out the required information and sending of documents. </p>
              </div>
            </span>
          </li>
        <footer>
            <button data-iziModal-close>Cancel</button>
            <button type="Submit" class="submit" name="sub-register">Create Account</button>
        </footer>
        </form>
    </section>

</div>

<div class="upper-head">

</div>

<header class="head">
  <div class="logo">
    <img src="assets/logo.png" alt="">
    <div class="title">
      <h1>St. Andrew's Cleverland School</h1>
      <h3>SACS Antipolo</h3>
    </div>
  </div>
  <?php
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

  echo '<div class="btn-enroll">';
      echo '<a href="" data-izimodal-open="#modal-custom3"> <button type="button" name="button">Apply Now</button></a>';
  echo '</div>';
  }else{
  echo '<div class="btn-enroll">';
    echo '<a href="User/progress.php" > <button type="button" name="button">Apply Now</button> </a>';
  echo '</div>';
  }
  ?>
</header>
<!--
<nav id="navbar">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="faqs.php">FAQS</a></li>
    <li><a href="tour.php">Campus tour</a></li>
  </ul>

  <ul>
    <li><a href="" data-izimodal-open="#modal-custom">Login</a></li>
  </ul>
</nav>-->
  <?php
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

  echo '<nav id="navbar">';
    echo '<ul>';
      echo '<li><a href="index.php">Home</a></li>';
      echo '<li><a href="about.php">About</a></li>';
      echo '<li><a href="faqs.php">FAQS</a></li>';
      echo '<li><a href="tour.php">Campus tour</a></li>';
    echo '</ul>';

    echo '<ul>';
      echo '<li><a href="" data-izimodal-open="#modal-custom">Login</a></li>';
      //echo '<li><a href="User/progress.php" >PROFILE / ENROLL</a></li>';
    echo '</ul>';
    echo '</nav>';
  }else{
  echo '<nav id="navbar">';
    echo '<ul>';
      echo '<li><a href="index.php">Home</a></li>';
      echo '<li><a href="about.php">About</a></li>';
      echo '<li><a href="faqs.php">FAQS</a></li>';
      echo '<li><a href="tour.php">Campus tour</a></li>';
    echo '</ul>';

    echo '<ul>';
    echo '<li><a href="User/progress.php" >PROFILE / ENROLL</a></li>';
      //echo '<li><a href="" data-izimodal-open="#modal-custom">Login</a></li>';
    echo '</ul>';
    echo '</nav>';
  }
  ?>
