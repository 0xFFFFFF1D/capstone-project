<?php
session_start();
require("api.php");
$api = new AprilInstituteScheduler_API();
$api -> connect();

$scheduled_uid = $_POST['scheduled_with_uid'];
$scheduled_event_id = trim($_POST['event_id']);
$date = new DateTime($_POST['date']);
$type = trim($_POST['type']);
$title = "Editing Event";
$description = trim(htmlentities($_POST['description']));
$address = htmlentities($_POST['address']);
$virtual = htmlentities($_POST['virtual']);
include("template/base_header.php");

function roundTime($timestamp, $precision = 15) {
  $timestamp = strtotime($timestamp);
  $precision = 60 * $precision;
  return date('H:i', round($timestamp / $precision) * $precision);
}

$rounded_time = roundTime($date->format("H:i"));
?>

<div class="container mainContainer" style="padding-top: 0">
        <div class="row valign-wrapper">
            <div class="col s6">
                <h2 class="header-font">Editing Event</h2>
            </div>

            <div class="input-field col s6">
                <select name="type" id="type" onchange="changeForm()" disabled>
                    <option value="1" <?php if ($type == "Event") echo "selected"; ?> >Event</option>
                    <option value="2" <?php if ($type == "Appointment") echo "selected"; ?>>Appointment</option>
                </select>
                <label for="type">
                    Are you scheduling an appointment or RSVPing for an event?
                </label>
            </div>
        </div>

    <div class="row" id="event_form_div" style="display: none">
        <form class ="col s12" method="POST" action="process_editEvent.php">
            <input type="hidden" name="event_id" value="<?php echo $scheduled_uid?>">
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
                    <label for="type">
                        With whom are you scheduling?
                    </label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="date" id="date" required>
                    <label for="date">Date</label>
                </div>

                <div class="input-field col s6">
                    <select name="time" id="time" required>
                        <option value="" disabled>Choose a Time</option>
                        <?php 

                            $interval = 15;
                            $start = "8:00";
                            $end = "20:00";
                            $startTime = DateTime::createFromFormat("H:i", $start);
                            $endTime = DateTime::createFromFormat("H:i", $end);
                            $intervalObj = new DateInterval("PT".$interval."M");
                            $dateRange = new DatePeriod($startTime, $intervalObj, $endTime);
                            foreach ($dateRange as $curdate) {
                                if ($rounded_time == $curdate->format("H:i")) {
                                   echo "<option value=".$curdate->format("H:i")." selected>".$curdate->format("H:i")."</option>";
                                } else {
                                    echo "<option value=".$curdate->format("H:i").">".$curdate->format("H:i")."</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="time">Time</label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s12">
                    <textarea name="info" id="info" class="materialize-textarea">
                        <?php echo $description;?>
                    </textarea>
                    <label for="info">Description</label>
                    <span class="helper-text">(i.e. "Tutoring", "Therapy", etc.)</span>
                </div>
            </div>
            <div class="row center">
                    <div class="input-field col s12">
                    <button type="submit" class="btn-large waves-effect waves-light april-orange">
                                Confirm Edits <i class="material-icons right">send</i>
                    </button>
                    <a href="home.php" class="btn-large waves-effect waves-light april-blue">
                                Cancel Edits <i class="material-icons right">cancel</i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="row" id="appointment_form_div" style="display: none">
        <form class ="col s12" method="POST" action="process_editEvent.php">
           <input type="hidden" name="event_id" value="<?php echo $scheduled_event_id?>"> 
           <input type="hidden" name="scheduled_with" value="<?php echo $scheduled_uid?>">
            <div class="row center">
                <div class="col s6">
                    <label for="virtual">
                        <input type="checkbox" class="filled-in" id="virtual" name="virtual"/>
                        <span>Virtual?</span>
                    </label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="validate" name="address" id="address" value="<?php echo $address;?>">
                    <label for="address">Address</label>
                </div>
            </div>

            <div class="row center">
                <div class="input-field col s6">
                    <input type="text" class="datepicker" name="date" id="date" value="<?php echo $date->format("m-d-Y"); ?>" required>
                    <label for="date">Date</label>
                </div>

                <div class="input-field col s6">
                    <select name="time" id="time" required>
                        <option value="" disabled selected>Choose a Time</option>
                        <?php 

                            $interval = 15;
                            $start = "08:00";
                            $end = "20:00";
                            $startTime = DateTime::createFromFormat("H:i", $start);
                            $endTime = DateTime::createFromFormat("H:i", $end);
                            $intervalObj = new DateInterval("PT".$interval."M");
                            $dateRange = new DatePeriod($startTime, $intervalObj, $endTime);
                            foreach ($dateRange as $curdate) {
                                if ($rounded_time == $curdate->format("H:i")) {
                                   echo "<option value=".$curdate->format("H:i")." selected>".$curdate->format("H:i")."</option>";
                                } else {
                                    echo "<option value=".$curdate->format("H:i").">".$curdate->format("H:i")."</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="time">Time</label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s12">
                    <textarea name="info" id="info" class="materialize-textarea">
                        <?php echo $description ?>
                    </textarea>
                    <label for="info">Description</label>
                    <span class="helper-text">(i.e. "Tutoring", "Therapy", etc.)</span>
                </div>
            </div>
            <div class="row center">
                    <div class="input-field col s12">
                    <button type="submit" class="btn-large waves-effect waves-light april-orange">
                                Confirm Edits <i class="material-icons right">send</i>
                    </button>
                    <a href="home.php" class="btn-large waves-effect waves-light april-blue">
                                Cancel Edits <i class="material-icons right">cancel</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>


<?php 
include("template/base_footer.php");
?>


<script>
    function checkVirtual() {
        document.getElementById('virtual').checked = "<?php echo $virtual == 1;?>";
    }

    document.addEventListener('DOMContentLoaded', checkVirtual());

    function printval() {
        console.log(document.getElementById('info').value);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, {
            format: 'mm-dd-yyyy',
            autoClose: true,
            defaultDate: new Date('<?php echo date_format($date, "m-d-Y") ?>'),
            setDefaultDate: true
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            defaultTime: '<?php echo date_format($date, "H:i")?>',// Set default time: 'now', '1:30AM', '16:30'
            twelveHour: false, //Use AM/PM or 24-hour format
            autoClose: true, // automatic close timepicker
            setDefaultTime: true
        });
    });
    
    $(document).ready(function(){
        $('select').formSelect();
        changeForm();
    });
   

    var event_form = document.getElementById("event_form_div");
    var schedule_form = document.getElementById("appointment_form_div");


    function changeForm() {
        if (document.getElementById("type").value === "2") {
            schedule_form.setAttribute('style', 'display:none;');
            event_form.setAttribute('style', 'display:block;');
        }
        else if (document.getElementById("type").value === "1") {
            event_form.setAttribute('style', 'display:none;');
            schedule_form.setAttribute('style', 'display:block;');
        }
    }
</script>
</script>