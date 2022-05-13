<?php
session_start();
$type = htmlentities($_REQUEST['eventType']);
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

// add time conflict check
if($type == 1) {
    if($api -> validateTime($scheduled_date_time)) {
        $result = $api->addAppointment($type, $scheduled_with, 1, $scheduled_date_time, $description, null, $_SESSION['uid']);
    }
    else {
        header("Location: schedule.php?status=Time unavailable, please reschedule with a different time");
    }
}
else if($type == 2) {
    $result = $api->addToEvent($event_id, $_SESSION['uid']);
}

$api -> disconnect();
if(!empty($result)) {
    header("Location: home.php?paid=1");
    exit();
}
