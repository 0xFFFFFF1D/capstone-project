<?php
$date = htmlentities($_POST['date']);
$time = htmlentities($_POST['time']);
$description = htmlentities($_POST['info']);
$event_id = (int)$_POST['event_id'];
$scheduled_with = htmlentities($_POST['scheduled_with']);
$is_virtual = htmlentities($_POST['virtual']) == "on" ? 1 : 0;
$address = htmlentities($_POST['address']);


$date_array = explode('-', $date);
$date = $date_array[2] . '-' . $date_array[0] . '-' . $date_array[1] . 'T' . substr($time, 0, 5);

require("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();
$res = $api -> updateEvent($event_id, $scheduled_with, $date, $description, $is_virtual, $address);
print($res);

header("Location: home.php");
?>