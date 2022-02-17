<?php $title="Signup"; include("template/base_header.php"); ?>
    
    <div class="container">
        <section>
            <form action="processSignup.php?" method="POST">
                <div class="row">
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="first_name" id="first_name" type="text" class="validate" required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input name="last_name" id="last_name" type="text" class="validate" required>
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="email" id="email" type="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>

                            <!-- take out username-->
                            <div class="input-field col s6">
                                <input name="phone_number" id="phone_number" type="tel" class="validate" required>
                                <label for="phone_number">Phone Number</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input name="password" id="password" type="password" onkeyup="check();" class="validate" required>
                                <meter max="4" id="password-strength-meter"></meter> 
                                <label for="password">Password</label>
                                <span class="helper-text" id="password-strength-text"></p>
                            </div>
                            <div class="input-field col s6">
                                <input name="confirmPassword" id="confirmPassword" type="password" onkeyup="check();" class="validate" required>
                                <label for="confirmPassword">Confirm password</label>
                                <span class="helper-text" id="confirm-password-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" name="action" id="submit_button">
                                Submit<i class="material-icons right">send</i>
                            </button>
                        </div>
                      <div class="row">
                        <div class="center-align">
                          <text style="font-size: 2em; padding: 2em">Or</text>
                        </div>
                      </div>
                      <div class="row">
                        <div class="center-align">
                          <a href="login.php" id="download-button" class="btn-large waves-effect waves-light orange hoverable">
                            Log In
                          </a>
                        </div>
                      </div>
                    </form>
                </div>
            </form>
        </section>
    </div>
    </div>
<?php include("template/base_footer.php"); ?>
<script type="text/javascript" src="js/zxcvbn.js"></script>
<script> 
    var pass = document.getElementById('password');
    var confirm_pass = document.getElementById('confirmPassword');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    var strength = {
        0: "Worst",
        1: "Bad",
        2: "Weak",
        3: "Good",
        4: "Strong"
    }

    var check = function() {
        if (pass.value == confirm_pass.value && pass.value != "") {
            document.getElementById('confirm-password-text').innerHTML = 'Passwords match!'
        } else {
            document.getElementById('confirm-password-text').innerHTML = 'Passwords do not match!'
        }
    }
    function update_button() {
        var val = password.value;
        var result = zxcvbn(val);

        meter.value = result.score;

        if (val !== "") {
            text.innerHTML = "Strength: " + strength[result.score] + ". " + result.feedback.warning + " " + result.feedback.suggestions 
        } else {
            text.innerHTML = "";
        }

        if (result.score >= 3 && pass.value == confirm_pass.value) {
            document.getElementById('submit_button').disabled = false;
        } else {
            document.getElementById('submit_button').disabled = true;
        }
    }
    pass.addEventListener('keyup', update_button);
    confirm_pass.addEventListener('keyup', update_button);
</script>
