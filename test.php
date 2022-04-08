<?php
require('api.php');
$api = new AprilInstituteScheduler_API();
$api -> connect();

$result2 = mysqli_query($api->conn, "SELECT x.user_id FROM xref_users_events as x, events as e WHERE x.event_id = e.id AND e.id=33");
$num_attendees = !$result2 ? 0 : $result2->num_rows;


echo $num_attendees;
echo "<br>" . $result2->num_rows;

$api->disconnect();