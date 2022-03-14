<?php
session_start();
$type = htmlentities($_REQUEST['type']);
$scheduled_with = htmlentities($_REQUEST['scheduled_with']);
$scheduled_date = htmlentities($_REQUEST['date']);
$scheduled_time = htmlentities($_REQUEST['time']);
$description = htmlentities($_REQUEST['info']);
$event_id = htmlentities($_REQUEST['event_id']);

if(!empty($scheduled_date) && !empty($scheduled_time)) {
    $date_array = explode('-', $scheduled_date);
    $scheduled_date_time = $date_array[2] . '-' . $date_array[0] . '-' . $date_array[1] . 'T' . substr($scheduled_time, 0, 5);
}

require_once("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();
if($type == 1) {
    $result = $api->addAppointment($type, $scheduled_with, 1, $scheduled_date_time, $description, null);
    $api -> addXref($_SESSION['uid'], $result);
    $api -> addXref($scheduled_with, $result);
}
else if($type = 2) {
    $result = $api->addToEvent($event_id, $_SESSION['uid']);
}

$api -> disconnect();
if(!empty($result)) {
    header("Location: home.php");
}
