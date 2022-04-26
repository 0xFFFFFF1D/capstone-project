<?php
session_start();
$uid = $_SESSION['uid'];
$amount = htmlentities($_REQUEST['amountCredits']);

require_once('api.php');

$api = new AprilInstituteScheduler_API();
$api -> connect();

$result = $api -> addCredits($uid, $amount);
$api -> disconnect();

if($result != 1) {
    header("Location: purchaseCredits.php?paid=0");
}
else {
    header("Location: purchaseCredits.php?paid=1");
}