<?php $title="Schedule"; include("template/base_header.php") ?>
    <div class="container mainContainer">
        <form class="col s12">
            <div class="row">
                <div class="col s4">
                     <h1 class="header header-font">Schedule Form: </h1>
                </div>

                <div class="input-field col s6 offset-s2">
                    <select name="type" id="type">
                        <option value="1">Event</option>
                        <option value="2">Appointment</option>
                    </select>
                    <label for="type" style="font-size: 1.3em">
                        Are you scheduling an appointment or RSVPing for an event?
                    </label>
                </div>

            </div>

            <script>if (getElementById("type") === "2") {</script>
                <select name="type" id="type">
                        <option value="1">Event</option>
                        <option value="2">Appointment</option>
                </select
            <script> }</script>
            <script>else if(getElementById("type") === "1") {</script>
            <div class="row center">
                <div class="input-field col s4">
                    <input type="text" class="datepicker" name="date" id="date" placeholder="Please enter the date of the appointment" required>
                    <label style="font-size: 1.3em" for="date">Date</label>
                </div>
            </div>
            <div class="row center">
                <div class="input-field col s4">
                    <input type="text" class="timepicker" name="time" id="time" placeholder="Please enter the time of the appointment" required>
                    <label style="font-size: 1.3em" for="time">Time</label>
                </div>
            </div>
            <script> }</script>
            <div class="row center">
                <div class="col s4">
                    <a class="btn-large waves-effect waves-light april-blue" href="payment.php">
                        Schedule and Pay <i class="material-icons right">send</i>
                    </a>
                </div>
            </div>
        </form>
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
</script>
<?php include("template/base_footer.php") ?>
