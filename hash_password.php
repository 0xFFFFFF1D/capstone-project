<?php
require_once("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();
$pass = password_hash("Parked_gas_car", PASSWORD_DEFAULT);

$sql = "
        UPDATE users 
        SET password = ?
        WHERE uid = 2
        ";
$statement = $api -> conn -> prepare($sql);

if (!$statement) {
    echo mysqli_errno($api -> conn);
}

$statement -> bind_param("s", $pass);
$statement -> execute();

$api -> disconnect();
