<?php session_start();
if(isset($_SESSION['uid'])) {
$title="Events"; include("template/base_header.php"); require_once("api.php");?>
<div class="container" id="index-banner">
    <div class="section col">
        <h1 class="header center april-orange-text header-font">Events</h1>

        <div class="row center">
            <?php include("getEventsCards.php");?>


        <div class="row center">
            <a class="btn-floating btn-large waves-effect waves-light april-orange" href="schedule.php"><i class="material-icons">add</i></a>
        </div>
    </div>
</div>

<?php include("template/base_footer.php");
}
else {
    header("Location: index.php");
}?>

