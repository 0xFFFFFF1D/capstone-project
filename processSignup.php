<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

session_start();
require("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();
var_dump($_REQUEST);

$first_name = htmlentities($_REQUEST['first_name']);
$last_name = htmlentities($_REQUEST['last_name']);
$email = htmlentities($_REQUEST['email']);
$phone_number = htmlentities($_REQUEST['phone_number']);
$password = htmlentities($_REQUEST['password']);


$api -> registerUser($first_name, $last_name, $email, $phone_number, $password);
$uid = mysqli_insert_id($api->conn);
$_SESSION['uid'] = $uid;
$_SESSION['first_name'] = $first_name;

header("Location: home.php");
exit();



