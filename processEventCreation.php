<?php
$isVirtual = htmlentities($_REQUEST['isVirtual']);
$scheduled_date = htmlentities($_REQUEST['scheduled_date']);
$scheduled_time = htmlentities($_REQUEST['scheduled_time']);
$address = htmlentities($_REQUEST['address']);
$description = htmlentities($_REQUEST['description']);
$capacity = htmlentities($_REQUEST['capacity']);
$name = htmlentities($_REQUEST['name']);
$price = htmlentities($_REQUEST['price']);

require_once('api.php');
$api = new AprilInstituteScheduler_API();
$api -> connect();

$date_array = explode('-', $scheduled_date);
$scheduled_date_time = $date_array[2] . '-' . $date_array[0] . '-' . $date_array[1] . 'T' . substr($scheduled_time, 0, 5);

$result = $api -> createEvent($isVirtual, $scheduled_date_time, $address, $description, $capacity, $name, $price);

$api -> disconnect();

if(!empty($result)) {
    header("Location: home.php");
    exit();
}