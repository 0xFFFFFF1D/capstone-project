<?php
session_start();
if(isset($_SESSION['uid'])) {
    header("Location: home.php");
}
else {
    $title = "AprilInstitute";
    include("template/base_header.php");
}?>
    <div class="container" id="index-banner">
      <div class="section col">


        <h1 class="header center april-orange-text header-font">AprilScheduler</h1>
        <div class="row center">
          <h5 class="header col s12 light header-font normal italic">An all-in-one stop for scheduling and payment</h5>
        </div>
        
        <!-- Buttons -->
        <div class="row center">
          <a href="login.php" id="download-button" class="btn-large waves-effect waves-light april-orange hoverable">Log In</a>
          <a href="signup.php" id="download-button" class="btn-large waves-effect waves-light april-orange hoverable">Sign Up</a>
          <a href="schedule_guest.php" id="download-button" class="btn-large waves-effect waves-light april-orange hoverable">Schedule as Guest</a>
        </div>


      </div>
    </div>

<?php include("template/base_footer.php");?>
