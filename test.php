<?php
require('api.php');
$api = new AprilInstituteScheduler_API();
$api -> connect();

$result = $api -> addCredits(6, 4);

echo $result;

$api->disconnect();