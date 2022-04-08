<?php
if (!isset($_SESSION)) {
    session_start();
}

$is_admin = $_SESSION['isAdmin'];
require_once("api.php");

$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT distinct u.*
        FROM events, xref_users_events as x, users as u
        WHERE x.event_id IN 
              (SELECT events.id 
                FROM events, xref_users_events as x
                WHERE events.id = x.event_id 
                AND events.date >= CURDATE()
                AND x.user_id = {$_SESSION['uid']}
                AND events.type_id = 1)
        AND x.user_id NOT IN (SELECT * FROM admins)
        AND x.user_id = u.uid
        ORDER BY u.uid";


$users_scheduled_with_admin = mysqli_query($api->conn, $sql);



echo "<ul class='collapsible expandable'>";

while($row = $users_scheduled_with_admin -> fetch_assoc()) { ?>

        <li>
            <div class="collapsible-header"><i class="material-icons">person</i> <?php echo $row['last_name'] . ", " . $row['first_name'];?> </div>
            <div class="collapsible-body">

                <?php $sql2 = "SELECT distinct events.*
                                FROM events, xref_users_events as x
                                WHERE x.user_id = {$row['uid']}
                                AND x.event_id = events.id
                                AND events.date >= CURDATE()
                                ORDER BY events.id";
                        $appointments_for_user = mysqli_query($api->conn, $sql2);?>

                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while($row2 = $appointments_for_user -> fetch_assoc()) {?>
                        <tr>
                            <td><?php echo $row2['date'];?></td>
                            <?php if($row2['is_virtual']) {?>
                            <td><?php echo "<a href=" . $row2['address'] . ">Zoom</a>";}
                                else echo $row2['address'];?></td>
                            <td><?php echo $row2['description'];?></td>
                            <td>
                                <?php
                                echo '<td><form method="POST" action="editEvent.php">';

                                echo '<input type="hidden" name="scheduled_with_uid" value="' . $row['uid'] . '">
                                <input type="hidden" name="date" value="'.$row['date'].'">
                                <input type="hidden" name="description" value="'.$row['description'].'">
                                <input type="hidden" name="event_id" value="'.$row['id'].'">
                                <input type="hidden" name="type" value="'.$row['type_id'].'">
                                <button type="submit" id="adminEdit"class="btn modal-trigger waves-effect waves-light april-orange">
                                <i class="material-icons">edit</i>
                                </button></form></td>';
                                ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                    </table>
                </div>

        </li>
    <?php
}

    echo "</ul>";


$api -> disconnect();
// exit();
return;

?>