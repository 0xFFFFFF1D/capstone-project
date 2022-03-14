<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $title; ?></title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>


    <script src="https://kit.fontawesome.com/c1a26a6b8a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</head>

<body>
<nav class="april-orange" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="home.php" class="brand-logo header-font">AprilScheduler</a>
    <ul class="right hide-on-med-and-down">
        <?php if(isset($_SESSION['uid'])) {
                echo '<li><a href="logout.php">Logout</a></li>';
               }
               if($_SESSION['isAdmin']) {
                   echo '<li><a href="createEvent.php">Create</a></li>';
               }?>
    </ul>

    <!-- This is for mobile support -->
    <ul id="nav-mobile" class="sidenav">
        <li><a id="logo-container" href="index.php">AprilScheduler Home</a></li>
        <?php if(isset($_SESSION['uid'])) {
                echo "<li><div class=\"divider\"></div></li>";
                echo '<li><a href="logout.php">Logout</a></li>';
        }?>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
  </div>
</nav>
<main>