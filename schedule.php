<?php $title="Schedule"; include("template/base_header.php") ?>
<script>
    var form_id = document.getElementById("schedule_form_div");

    function changeForm() {
        if (document.getElementById("type").value === "2") {
            form_id.innerHTML = `
                        <form class ="col s12" method="POST" action="processSchedule.php?">
                            <div class="row center">
                                <div class="input-field col s4">
                                    <input type="text" class="datepicker" name="date" id="date" placeholder="Please enter the date of the appointment" required>
                                    <label for="date">Date</label>
                                </div>
                            </div>
                            <div class="row center">
                                <div class="input-field col s4">
                                    <input type="text" class="timepicker" name="time" id="time" placeholder="Please enter the time of the appointment" required>
                                    <label for="time">Time</label>
                                </div>
                            </div>
                        </form>`;
        } else if (document.getElementById("type").value === "1") {
            form_id.innerHTML = 'WOWWWW';
        }
    }
</script>
    <div class="container mainContainer">
        <div class="row">
            <div class="col s4">
                 <h1 class="header header-font">Schedule Form: </h1>
            </div>

            <div class="input-field col s6 offset-s2">
                <select name="type" id="type" onchange="changeForm()">
                    <option value="1">Event</option>
                    <option value="2">Appointment</option>
                </select>
                <label for="type">
                    Are you scheduling an appointment or RSVPing for an event?
                </label>
            </div>
        </div>

        <div class="row" id="schedule_form_div"></div>

            <div class="row center">
                <div class="col s4">
                    <a class="btn-large waves-effect waves-light april-blue" href="payment.php">
                        Schedule and Pay <i class="material-icons right">send</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
    </div>

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
            twelveHour: true, // Use AM/PM or 24-hour format
            autoClose: false, // automatic close timepicker
        });
    });

    $(document).ready(function(){
        $('select').formSelect();
    });
</script>
<?php include("template/base_footer.php") ?>
