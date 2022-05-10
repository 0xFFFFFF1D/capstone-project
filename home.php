<?php
session_start();

if(isset($_SESSION['uid'])) {
    $title="Home"; include("template/base_header.php");
    if ($_REQUEST['paid'] === 1) {
        echo "<script>M.toast({html: 'Your payment was processed successfully! The credits have been added to your account.'})</script>";
    }
    else if ($_REQUEST['paid'] === 0) {
        echo "<script>M.toast({html: 'Your payment was unable to be processed.'})</script>";
    }
    ?>
    <div class="container" id="index-banner">
        <?php if(!$_SESSION['isAdmin']) {?>
            <div class="row right">
                <a class="btn-floating april-blue center" href="purchaseCredits.php">¤<?php require_once('api.php'); $api = new AprilInstituteScheduler_API(); $api -> connect(); echo $api -> getUserFromUID($_SESSION['uid'])['credits'];?></a>
            </div>
        <?php }?>

        <div class="section col">
            <div class="row center">
                <h1 class="header center april-orange-text header-font">Welcome, <?php echo $_SESSION['first_name'];?></h1>
            </div>


            <div class="row center">
                <?php
                    if($_SESSION['isAdmin']) include("getEventsTable_admin.php");
                    else include("getEventsTable.php"); ?>
            </div>
            <div class="row center">
                <a class="btn-floating btn-large waves-effect waves-light april-orange" href="schedule.php"><i class="material-icons">add</i></a>
            </div>
        </div>
    </div>
    <script>
        var elem = document.querySelector('.collapsible.expandable');
        var instance = M.Collapsible.init(elem, {
            accordion: false
        });

        $(document).ready(function(){
            $('#confirm_modal').modal();
        });

        function setEventId(id) {
            document.getElementById('event_id').value = id;
        }

    </script>
<?php
    if(isset($_POST['confirm_delete'])) {
        $api -> connect();
        $api->deleteEvent(htmlentities($_REQUEST['event_id']));
        $api -> disconnect();
        echo "<script>M.toast({html: 'Successfully deleted event, re-enter page to view'});</script>";
    }
    else if(isset($_POST['cancel_delete'])){
        echo "<script>M.toast({html: 'Successfully cancelled event deletion'});</script>";
    }
include("template/base_footer.php");
}
else{
    header("Location: index.php");
}
?>