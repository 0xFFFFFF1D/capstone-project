<?php
    if(!isset($_SESSION['uid'])) {
        header("Location: index.php");
    }
    else {
        include("template/base_header.php");?>

<div class="container">
    <div
</div>

<?php
        include("template/base_footer.php");
    }
