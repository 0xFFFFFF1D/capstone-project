<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>AprilScheduler</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="https://kit.fontawesome.com/c1a26a6b8a.js" crossorigin="anonymous"></script>
</head>

<body>
<nav class="orange darken-1" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="../index.html" class="brand-logo header-font">AprilScheduler</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="#">Navbar Link</a></li>
    </ul>

    <!-- This is for mobile support -->
    <ul id="nav-mobile" class="sidenav">
      <li><a href="#">Navbar Link</a></li>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
  </div>
</nav>
<main>
    <div class="contianer">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Payment</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="John Doe" name="name" id="name" type="text" class="validate">
                                <label for="name">Name on Card</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="1234 5678 4208 0012" name="ccNumber" id="ccNumber" type="text" class="validate">
                                <label for="name">Card Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="123" name="cvv" id="cvv" type="text" class="validate">
                                <label for="name">CVV</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="01/21" name="expiration" id="expiration" type="text" class="validate">
                                <label for="name">Expiration Date</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 offset-s3 m4 offset-m4">
                                <a href="post_payment.html" class="waves effect waves-light btn-large center-align">
                                    <i class="material-icons left">credit_card</i>SUBMIT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="page-footer orange">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">April Institute</h5>
        <p class="grey-text text-lighten-4">Welcome to April Institute's scheduler!</p>


      </div>
      <div class="col l3 s12">
        <h5 class="white-text">Connect</h5>
        <ul>
          <li><a class="white-text" href="https://twitter.com/aprilinstitute"><i class="fab fa-twitter"></i></a></li>
          <li><a class="white-text" href="https://www.facebook.com/Dr-Ogrenir-April-Institute-1685046748462019/"><i class="fab fa-facebook-f"></i></a></li>
          <li><a class="white-text" href="https://www.instagram.com/aprilinstitute.drburcinogrenir/"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="footer-copyright">
    <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
    </div>
  </div>
</footer>

</body>
<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>


</html>
