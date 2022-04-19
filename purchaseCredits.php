<?php
session_start();
    if(!isset($_SESSION['uid'])) {
        header("Location: index.php");
    }
    else {
        include("template/base_header.php");?>

<div class="container">
    <div class="row">
        <a href="paymentPage.php?amount=4&price=700">
            <img src="April_A.png">
        </a>

        <a href="paymentPage.php?amount=6&price=1000">
            <img src="April_A.png">
        </a>

        <a href="paymentPage.php?amount=10&price=1500">
            <img src="April_A.png">
        </a>
    </div>
</div>

<?php
        include("template/base_footer.php");
    }
