<?php session_start(); ?>
<?php $title="Login"; include("template/base_header.php"); ?>
    <div class="container myElement">
        <div class="row">
            <form class="col s12" action="processLogin.php?" method="post">
                <?php
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                }
                ?>
                <div class="row">
                    <div class="input-field col s3">
                        <input style="font-size: 1em" placeholder="Please enter the email address" name="email" id="email" type="text" class="validate" required>
                        <label style="font-size: 1.3em" for="login">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input style="font-size: 1em" placeholder="Please enter your password" name="password" id="password" type="password" class="validate" required>
                        <label style="font-size: 1.3em" for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <a href="processLogin.php" id="download-button" class="btn-large waves-effect waves-light orange hoverable">
                        Login<i class="material-icons right">send</i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include("template/base_footer.php"); ?>