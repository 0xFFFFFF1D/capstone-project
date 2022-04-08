<?php
require_once('api.php');

$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT * FROM events WHERE type_id = 2 AND date >= CURDATE()";
$statement = $api -> conn -> prepare($sql);

if(!$statement) {
    throw new Exception($statement->error);
}

$statement -> execute();
$result = $statement -> get_result();

$count = 0;
while($row = $result->fetch_assoc()) {
    if ($count++ % 3 == 0) echo "</div> <div class='row center'>";?>
    <div class="col s4">
        <div class='card sticky-action'>
        <div class='card-image waves-effect waves-block waves-light'>
          <img class='activator' src='img/April A Orange.png'>
        </div>
        <div class='card-content'>
          <span class='card-title activator grey-text text-darken-4'><?php echo $row['name'];?><i class='material-icons right'>more_vert</i></span>
        </div>
        <div class="card-action">
            <?php $address = $row['address'];
            if($row['is_virtual'] == 1) {echo "<p><a href='$address'>Zoom</a></p>";}
            else{ echo "<p>$address</p>";} ?>
        </div>
        <div class='card-reveal'>
          <span class='card-title grey-text text-darken-4'><?php echo $row['name'];?><i class='material-icons right'>close</i></span>
            <p><?php echo $row['description'];?></p>
            <p><?php $result2 = mysqli_query($api->conn, "SELECT x.user_id FROM xref_users_events as x, events as e WHERE x.event_id = e.id AND e.id={$row['id']}");
                    !$result2 ? $num_attendees = 0 : $num_attendees = $result2->num_rows;
            echo "Capacity: " . $num_attendees . "/" . $row['capacity'];?></p>
            <p><?php echo "Price: $" . $row['price'] . ".00";?></p>
            <p><?php echo $row['date'];?></p>
        </div>
      </div>
    </div>
<?php } echo "</div>";