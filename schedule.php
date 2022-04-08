<?php session_start(); $title="Schedule"; include("template/base_header.php"); require_once("api.php"); ?>

<div class="container mainContainer" style="padding-top: 0">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h2 class="header-font">Schedule Form: </h2>
            </div>

            <div class="input-field col s6">
                <select name="type" id="type" onchange="changeForm()">
                    <option value="" disabled selected>--What are you scheduling for?--</option>
                    <option value="2">Event</option>
                    <option value="1">Appointment</option>
                </select>
                <label for="type">
                    Are you scheduling an appointment or RSVPing for an event?
                </label>
            </div>
        </div>

    <div class="row" id="appointment_form_div" style="display: none">
        <form class ="col s12" method="POST" action="paymentPage.php">
            <div class="row center">
                <div class="input-field col s4">
                    <select name="scheduled_with" id="scheduled_with">
                        <?php
                            $i = 0;
                            while($row = $_SESSION['admins'][$i]) {
                                ?> <option value='<?php echo $row['uid'];?>'> <?php echo $_SESSION['admins'][$i++]['first_name'] . "</option>";
                            }
                        ?>
                    </select>
                    <label for="scheduled_with">
                        With whom are you scheduling?
                    </label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s4">
                    <input type="text" class="datepicker" name="date" id="date" required>
                    <label for="date">Date</label>
                </div>

                <div class="input-field col s4">
                    <input type="text" class="timepicker" name="time" id="time" required>
                    <label for="time">Time</label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s8">
                    <textarea name="info" id="info" class="materialize-textarea"></textarea>
                    <label for="info">Description</label>
                    <span class="helper-text">(i.e. "Tutoring", "Therapy", etc.)</span>
                </div>
            </div>
            <div class="row center">
                <div class="col s4">
                    <button type="submit" class="btn-large waves-effect waves-light april-blue">
                        Schedule and Pay <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row" id="event_form_div" style="display: none">
        <form class ="col s12" method="POST" action="processSchedule.php?eventType=2">
            <select name="event_id">
                <option value="" selected disabled>--Choose an Event--</option>
                <?php 
                    require_once("api.php");
                    $api = new AprilInstituteScheduler_API(); $api -> connect();
                    $events = mysqli_query($api -> conn, "SELECT * FROM events WHERE type_id = 2 AND date >= CURDATE()");
                    while($row = $events->fetch_assoc()){
                        $numPpl = $api -> getNumUsersInEvent($row['id']);
                        if($numPpl < $row['capacity']) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                $api -> disconnect();?>
            </select>
            <label for="event_id">Event</label>
            <div class="row center">
                <div class="col s4">
                    <button type="submit" class="btn-large waves-effect waves-light april-blue">
                        Schedule and Pay <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("template/base_footer.php") ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, {
            format: 'mm-dd-yyyy',
            autoClose: true
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            defaultTime: 'now', // Set default time: 'now', '1:30AM', '16:30'
            twelveHour: false, //Use AM/PM or 24-hour format
            autoClose: false, // automatic close timepicker
        });
    });
    

    $(document).ready(function(){
        $('select').formSelect();
    });

    var event_form = document.getElementById("event_form_div");
    var schedule_form = document.getElementById("appointment_form_div");


    function changeForm() {
        if (document.getElementById("type").value === "2") {
            schedule_form.style.display = 'none';
            event_form.style.display = 'block';
        }
        else if (document.getElementById("type").value === "1") {
            event_form.style.display = 'none';
            schedule_form.style.display = 'block';
        }
    }
</script>
