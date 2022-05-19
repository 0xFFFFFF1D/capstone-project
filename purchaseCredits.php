<?php
session_start();
$title = "Purchase";
    if(!isset($_SESSION['uid'])) {
        header("Location: index.php");
    }
    else {
        include("template/base_header.php");?>

<div class="container">
    <div class="row center">
        <h4>Appointments can be purchased in packages of 4, 6, and 10. Each session is an hour long.</h4>
    </div>
    <div class="section center">
    <div class="row">
        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <a href="paymentPage.php?amount=4&price=700">
                        <img src="img/4 Credits.jpg" width="320" height="240">
                    </a>
                </div>
                <div class="card-action">
                    <form action="paymentPage.php" method="POST">
                        <input type="hidden" value="700" name="price" />
                        <input type="hidden" value="credits" name="type" />
                        <button class="btn april-orange">4 credits, $700</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <a href="paymentPage.php?amount=6&price=1000">
                        <img src="img/6 Credits.jpg" width="320" height="240">
                    </a>
                </div>
                <div class="card-action">
                    <form action="paymentPage.php" method="POST">
                        <input type="hidden" value="1000" name="price" />
                        <input type="hidden" value="credits" name="type" />
                        <button class="btn april-orange">6 credits, $1,000</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <a href="paymentPage.php?amount=10&price=1500">
                        <img src="img/10 Credits.jpg" width="320" height="240">
                    </a>
                </div>
                <div class="card-action">
                    <form action="paymentPage.php" method="POST">
                        <input type="hidden" value="1500" name="price" />
                        <input type="hidden" value="credits" name="type" />
                        <button class="btn april-orange">10 credits, $1,500</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <span>**For an inquiry or refund about any purchase please contact April Institute at (973) 664-7261**</span>
        </div>
</div>
</div>

<?php
        include("template/base_footer.php");
    }
