<?php
if (!isset($_SESSION)) {
    session_start();
}


if(isset($_SESSION['uid'])) {
    $title="Home"; include("template/base_header.php"); ?>
    <div class="container" id="index-banner">
        <div class="section col">
            <h1 class="header center april-orange-text header-font">Welcome <?php echo $_SESSION['first_name'];?></h1>
            <div class="row center">
                <?php include("getEventsTable.php");?>
            </div>
            <div class="row center">
                <a class="btn-floating btn-large waves-effect waves-light april-orange" href="schedule.php"><i class="material-icons">add</i></a>
            </div>


        </div>
    </div>

<?php
include("template/base_footer.php");
}
else{
    header("Location: index.php");
}
?>