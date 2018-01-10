<!DOCTYPE html>

<?php
session_start();

// Setup content type
header('Content-type: text/html; charset=utf-8');

// Load classes
include_once './ajax/Utils.class.php';
include_once './php/UserSystem.class.php';

// Initialize Cart
if (!isset($_SESSION['cartcount'])) {
    $_SESSION['cartcount'] = 0;
}
if (!isset($_SESSION['cartprice'])) {
    $_SESSION['cartprice'] = 0;
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>

<html>
    <head>
        <meta charset="UTF-8">

        <title>Webshop</title>

        <script type="text/javascript" src="js/vendor/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/vendor/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="js/vendor/jquery.sidebar.min.js"></script>
        <script type="text/javascript" src="js/vendor/image-picker.min.js"></script>
        <script type="text/javascript" src="js/vendor/cropper.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/validation.js"></script>

        <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
        <link rel="stylesheet" type="text/css" href="css/image-picker.css">
        <link rel="stylesheet" type="text/css" href="css/cropper.min.css">
        <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    </head>
    <body data-spy="scroll" data-offset="60">
        <header>
            <div class="container-fluid banner">
                <?php include './modules/Header.php'; ?>
            </div>
        </header>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <button type="button" class="navbar-toggle responsive-nav-button" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php include './modules/Navigation.php'; ?>
            </div>
        </nav>

        <!-- Scroll to top button -->
        <div id="scrolltop">
            <span id="scrolltop-container" class="glyphicon glyphicon-chevron-up"></span>
        </div>

        <main class="container-fluid">
            <?php include './modules/Content.php'; ?>
        </main>

        <footer>
            <?php include './modules/Footer.php'; ?>
        </footer>
    </body>
</html>