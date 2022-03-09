<?php
if (!isset($_SESSION)) {
    session_start();
}

if(in_array($_SESSION['uid'], array_column($_SESSION['admins'], 'uid')))  {
    $is_admin = TRUE;
} else {
    $is_admin = FALSE;
}



require_once("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT events.* 
        FROM events, xref_users_events 
        WHERE events.id = xref_users_events.event_id 
        AND xref_users_events.user_id = ?";
$statement = $api -> conn -> prepare($sql);

if(!$statement) {
    throw new Exception($statement -> error);
}

$statement -> bind_param("i", $_SESSION['uid']);
$statement -> execute();
$result = $statement -> get_result();


echo "<table class=\"highlight responsive-table\">
    <thead>
        <tr>
        <th>Date & Time</th>
        <th>Type</th>
        <th>Scheduled with</th>
        <th>Location</th>
        </tr>
    </thead>";

echo "<tbody>";

while($row = $result -> fetch_assoc()) {
    $type = $api -> getTypeFromTypeID($row['type_id']);
    echo "<tr>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $type['type'] . "</td>";

    if($type['type'] === "Appointment") {
        $scheduled_with = $api -> getScheduledWith($row['id']);

        echo "<td>" . $scheduled_with['last_name'] . ', ' . $scheduled_with['first_name'] . "</td>";
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

    if ($is_admin) {
        echo "<td><button class=\"btn-floating btn waves-effect waves-light april-orange\" type=\"submit\">"
            ."<i class=\"material-icons\">edit</i>"
            ."</button></td>";
    }
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

$api -> disconnect();
// exit();
return;
