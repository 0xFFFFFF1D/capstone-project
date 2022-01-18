<?php
session_start();
require_once("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();
$conn = $api -> conn;

$sql = "SELECT events.* FROM events, xref_users_events WHERE events.id = xref.event_id AND xref.user_id = ?";
$statement = $conn -> prepare($sql);

if(!$statement) {
    throw new Exception($statement -> error);
}

$statement -> bind_param("i", $_SESSION['uid']);
$statement -> execute();
$result = $statement -> get_result();

echo "<table class=\"highlight responsive-table\">
                                <tr>
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Scheduled with</th>
                                <th>Location</th>
                                </tr>";

while($row = $result -> fetch_assoc())
{
    $type = $api -> getEventType($row['id']);
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $type['name'] . "</td>";

    if($type['name'] === "Appointment") {
        $scheduled_with = $api -> getScheduledWith($row['id']);
        echo "<td> . $scheduled_with . </td>";
    }
    else {
        echo "<td>N/A</td>";
    }

    if($row['is_virtual']) {
        echo "<td><a href=" . $row['address'] . ">Zoom</a></td>";
    }
    else {
        echo "<td>" . $row['address'] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

$api -> disconnect();
exit();
