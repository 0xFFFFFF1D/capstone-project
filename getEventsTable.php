<?php
session_start();
require_once("../index.php");

$api = new CQ_API();
$api -> connect();
$conn = $api -> conn;

$sql = "SELECT * FROM events WHERE uid = ?";
$statement = $conn -> prepare($sql);

if(!$statement) {
    throw new Exception($statement -> error);
}

$statement -> bind_param("i", $_SESSION['uid']);
$statement -> execute();
$result = $statement -> get_result();

echo "<table class=\"highlight responsive-table\">
                                <tr>
                                <th>Name</th>
                                <th>Date of Last Event</th>
                                </tr>";

while($row = $result -> fetch_assoc())
{
    $sponsor = $row['id'];
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['last_event'] . "</td>";
    echo "<td><a href='events.php?sponsor=$sponsor'>View</a></td>";
    echo "</tr>";
}
echo "</table>";

$api -> disconnect();
exit();
