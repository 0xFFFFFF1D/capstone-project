<?php session_start(); $title="Create"; include("template/base_header.php"); require_once("api.php");
if(!$_SESSION['isAdmin']) {
    echo "Are you being naughty?";
    exit();
}?>
<div class="container">
    <form action="processEventCreation.php?" method="POST">
        <div class="row">
            <div class="input-field col s4">
                <input name="name" id="name" type="text" class="validate" required>
                <label for="name">Event Name</label>
            </div>
            <div class="input-field col s4">
                <select name="isVirtual" id="isVirtual" required>
                    <option value="" disabled selected>--Is it virtual?--</option>
                    <option value=0>No</option>
                    <option value=1>Yes</option>
                </select>
                <label for="isVirtual">Virtual?</label>
            </div>
            <div class="input-field col s4">
                <input id="address" name="address" type="text" class="validate" required>
                <label for="address">Address</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input type="text" class="datepicker validate" name="scheduled_date" id="scheduled_date" required>
                <label for="scheduled_date">Event Date</label>
            </div>
            <div class="input-field col s6">
                <input type="text" class="timepicker validate" name="scheduled_time" id="scheduled_time" required>
                <label for="scheduled_time">Event Time</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s3">
                <input name="capacity" id="capacity" type="number" class="validate" required>
                <label for="capacity">Capacity</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea name="description" id="info" class="materialize-textarea"></textarea>
                <label for="info">Description</label>
            </div>
        </div>
        <div class="row center-align">
            <button type="submit" id="btn_login" class="btn-large waves-effect waves-light april-blue">
                Create and Add
            </button>
        </div>
    </form>
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
</script>
