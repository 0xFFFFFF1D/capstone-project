<?php
session_start();

if(isset($_SESSION['uid'])) {
?>


<?php $title="Home"; include("/template/base_header.php"); ?>
    <div class="container" id="index-banner">
        <div class="section col">


            <h1 class="header center orange-text header-font">Welcome <?php echo $_SESSION['first_name']; var_dump($_SESSION);?></h1>
            <div class="row center">
                <?php include("getEventsTable.php");?>
            </div>
            <div class="row center">
                <a href="schedule_login.html" id="download-button" class="btn-large waves-effect waves-light orange hoverable">Schedule</a>
            </div>


        </div>
    </div>
<?php include("/template/base_footer.php"); ?>



<?php
}
else{
    header("Location: login.php");
    exit();
}
?>