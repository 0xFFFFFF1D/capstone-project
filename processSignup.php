<?php
session_start();

require("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();
var_dump($_REQUEST);

$first_name = htmlentities($_REQUEST['first_name']);
$last_name = htmlentities($_REQUEST['last_name']);
$email = htmlentities($_REQUEST['email']);
$phone_number = htmlentities($_REQUEST['phone_number']);
$password = htmlentities(password_hash(($_REQUEST['password']), PASSWORD_DEFAULT));


$uid = $api -> registerUser($first_name, $last_name, $email, $phone_number, $password);

$_SESSION['uid'] = $uid;
$_SESSION['first_name'] = $first_name;

header("Location: home.php");
exit();



