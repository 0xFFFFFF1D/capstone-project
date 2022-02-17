<?php
session_start();

require('api.php');

$email = htmlentities($_REQUEST['email']);
$password = htmlentities($_REQUEST['password']);

if(empty($email)) {
    header ("Location: login.php?error=Username is required");
    exit();
}
else if(empty($password)) {
    header ("Location: login.php?error=Password is required");
    exit();
}

$api = new AprilInstituteScheduler_API();
$api -> connect();
$loggedIn = $api -> verifyLogIn($email, $password);

if($loggedIn) {
    $_SESSION['uid'] = $loggedIn['uid'];
    $_SESSION['first_name'] = $loggedIn['first_name'];

    $admins = mysqli_query($api -> conn, "SELECT u.uid, u.first_name, u.last_name FROM users u, admins a WHERE u.uid = a.uid");
    $_SESSION['admins'] = array();
    while($row = $admins -> fetch_assoc()) {
        $_SESSION['admins'] += $row;
    }

    $api -> disconnect();
    header("Location: home.php");
}
else{
    $api -> disconnect();
    header("Location: login.php?error=Incorrect username or password");
}
exit();
