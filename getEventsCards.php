<?php
require_once('api.php');

$api = new AprilInstituteScheduler_API();
$api -> connect();

$sql = "SELECT * FROM events WHERE type_id = 2";
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
        <div class='card'>
        <div class='card-image waves-effect waves-block waves-light'>
          <img class='activator' src='img/April A Orange.png'>
        </div>
        <div class='card-content'>
          <span class='card-title activator grey-text text-darken-4'><?php echo $row['name'];?><i class='material-icons right'>more_vert</i></span>
            <?php $address = $row['address'];
            if($row['is_virtual'] == 1) {echo "<p><a href='$address'>Zoom</a></p>";}
                    else{ echo "<p>$address</p>";} ?>
        </div>
        <div class='card-reveal'>
          <span class='card-title grey-text text-darken-4'><?php echo $row['name'];?><i class='material-icons right'>close</i></span>
          <p><?php echo $row['description'];?></p>
        </div>
      </div>
    </div>
<?php } echo "</div>";