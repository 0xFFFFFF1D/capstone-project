<?php $title="Login"; include("template/base_header.php"); ?>

    <div class="container mainContainer">
        <div class="row">
            <form class="col s12" action="processLogin.php?" id="loginForm" method="POST">
                <?php if(isset($_GET['error'])){?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php }?>
                <div class="row">
                    <div class="input-field col s3">
                        <input style="font-size: 1em" placeholder="Please enter the email address" name="email" id="email" type="text" class="validate" required>
                        <label style="font-size: 1.3em" for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <input style="font-size: 1em" placeholder="Please enter your password" name="password" id="password" type="password" class="validate" required>
                        <label style="font-size: 1.3em" for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light" name="action" type="submit"">
                        Submit<i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php include("template/base_footer.php"); ?>

