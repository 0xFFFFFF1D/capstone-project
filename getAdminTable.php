<?php 
if (!isset($_SESSION)) {
    session_start();
}

require_once("api.php");

$current_uid = $_SESSION['uid'];

$api = new AprilInstituteScheduler_API();
$api -> connect();
$assoc_users = $api -> getUsersScheduledWithAdmin($current_uid);
echo '<ul class="collapsible expandable">';

while ($row = $assoc_users -> fetch_assoc()) {
    echo '<li>';
    echo '<div class="collapsible-header">';
    echo $row['last_name'] . ', ' . $row['first_name'];
    echo '<i class="material-icons">arrow_drop_down</i>';
    echo '</div>';
    echo '</li>';
}

echo "</ul>";