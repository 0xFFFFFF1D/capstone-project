<?php
$first_name = htmlentities($_REQUEST['first_name']);
$last_name = htmlentities($_REQUEST['last_name']);
$email = htmlentities($_REQUEST['email']);
$password = htmlentities($_REQUEST['password']);
$phone_number = htmlentities($_REQUEST['phone_number']);
$func = htmlentities($_REQUEST['func']);

require('index.php');

$api = new AprilInstituteScheduler_API();
$api -> connect();

var_dump($_REQUEST);
switch($func) {
    case 'registerUser()':
        $api -> registerUser($first_name, $last_name, $email, $phone_number, $password);
        break;

    default:
        break;
}
$api -> disconnect();

