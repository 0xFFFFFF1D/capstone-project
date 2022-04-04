<?php
require('api.php');
$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT events.id 
        FROM events, xref_users_events 
        WHERE events.id = xref_users_events.event_id 
        AND xref_users_events.user_id = 1
        AND events.type_id = 1";

$appointments_with_admin = mysqli_query($api->conn, $sql);
foreach($appointments_with_admin as $row) {
    $appts[] = $row['id'];
}

var_dump($appts);
echo "<br><br><br>";

$sql2 = "SELECT x.user_id
        FROM events, xref_users_events as x
        WHERE x.event_id IN 
              (SELECT events.id 
                FROM events, xref_users_events 
                WHERE events.id = xref_users_events.event_id 
                AND xref_users_events.user_id = 1
                AND events.type_id = 1)
        AND x.user_id NOT IN (SELECT * FROM admins)
        ORDER BY x.user_id";


$users_scheduled_with_admin = mysqli_query($api->conn, $sql2);
foreach($users_scheduled_with_admin as $row) {
    $users_scheduled = $row['id'];
}
var_dump($users_scheduled);

$api->disconnect();