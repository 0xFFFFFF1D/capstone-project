<?php
if (!isset($_SESSION)) {
    session_start();
}


require('api.php');

$email = htmlentities($_REQUEST['email']);
$password = htmlentities($_REQUEST['password']);

$api = new AprilInstituteScheduler_API();
$api -> connect();
$loggedIn = $api -> verifyLogIn($email, $password);

if($loggedIn != null) {
    $_SESSION['uid'] = $loggedIn['uid'];
    $_SESSION['first_name'] = $loggedIn['first_name'];
    header("Location: home.php");
}
else{
    $_SESSION['error'] = "Incorrect email or password";
    header("Location: login.php");
}

$api -> disconnect();
exit();
