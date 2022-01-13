<?php $title="Schedule"; include("template/base_header.php"); ?>
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
    <div class="container myElement">
        <div class="row">
            <h2>Schedule as guest</h2>
        </div>
        <form class="col s12">
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" class="datepicker no-autoinit" name="date" id="date" placeholder="Please enter the date of the appointment" required>
                    <label style="font-size: 1.3em" for="date">Date</label>
                </div>

                <div class="input-field col s4">
                    <input type="text" class="timepicker no-autoinit" name="time" id="time" placeholder="Please enter the time of the appointment" required>
                    <label style="font-size: 1.3em" for="time">Time</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" class="validate" name="lastName" id="lastName" placeholder="Please enter your last name" required>
                    <label style="font-size: 1.3em" for="lastName">Last Name</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" class="validate" name="firstName" id="firstName" placeholder="Please enter your first name" required>
                    <label style="font-size: 1.3em" for="lastName">First Name</label>
                </div>
                <text style="font-size: 2em; padding: 2em">Or</text>
                <a href="login.html" id="download-button" class="btn-large waves-effect waves-light orange hoverable">Log In</a>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <input type="tel" class="validate" name="phone" id="phone" pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$" required>
                    <label for="phone">Telephone</label>
                </div>
            </div>
            <div class="row">
                <a href="payment_guest.html" id="download-button" class="btn-large waves-effect waves-light hoverable">
                    Schedule and Pay
                    <i class="material-icons right">send</i></a>
            </div>
        </form>
    </div>
<?php include("template/base_footer.php"); ?>