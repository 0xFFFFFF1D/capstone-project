<?php
if (!isset($_SESSION)) {
    session_start();
}

$is_admin = $_SESSION['isAdmin'];

require_once("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT events.* 
        FROM events, xref_users_events 
        WHERE events.id = xref_users_events.event_id 
        AND xref_users_events.user_id = ?
        AND events.date >= CURDATE()";
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
        <th>Name</th>
        <th>Date & Time</th>
        <th>Type</th>
        <th>Scheduled with</th>
        <th>Location</th>
        <th>Description</th>";
if ($is_admin) {
    echo "<th>Edit</th>";
}
echo "</tr>
    </thead>";

echo "<tbody>";

while($row = $result -> fetch_assoc()) {
    $type = $api -> getTypeFromTypeID($row['type_id']);
    echo "<tr>";
    if($row['type_id'] == 1) {
        echo "<td>Appointment</td>";
    }
    else echo "<td>" . $row['name'] . "</td>";
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

    echo "<td>" . $row['description'] . "</td>";

    if ($is_admin) {
        echo '<td><form method="POST" action="editEvent.php">';
        if ($type['type'] === "Appointment") {
            echo '<input type="hidden" name="scheduled_with_uid" value="' . $scheduled_with['uid'] . '">';
        } else {
            echo '<input type="hidden" name="scheduled_with_uid" value="N/A">'; 
        }
        echo '<input type="hidden" name="date" value="'.$row['date'].'">
            <input type="hidden" name="description" value="'.$row['description'].'">
            <input type="hidden" name="event_id" value="'.$row['id'].'">
            <input type="hidden" name="type" value="'.$type['type'].'">
            <button type="submit" id="adminEdit"class="btn modal-trigger waves-effect waves-light april-orange">
            <i class="material-icons">edit</i>
            </button></form></td>';
            
    }
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

$api -> disconnect();
// exit();
return;

?>