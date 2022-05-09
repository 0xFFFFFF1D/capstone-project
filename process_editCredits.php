<?php
$uid = htmlentities($_REQUEST['uidToUpdate']);
$newCreditAmt = htmlentities($_REQUEST['creditAmt' . $uid ]);
error_log(print_r($_REQUEST, TRUE));

require("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();

$res = $api -> updateUserCredits($uid, $newCreditAmt);

header("Location: editCredits.php?searchQuery=" . htmlentities($_REQUEST['searchQuery']));