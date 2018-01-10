<ul class="nav navbar-nav">
    <?php
    $section = 'home';
    if (isset($_GET['section'])) {
        $section = $_GET['section'];
    }
    $_SESSION['section'] = $section;

    function active_class($request) {
        if ($_SESSION['section'] === $request) {
            echo 'active';
        }
    }
    ?>

    <li class="<?php active_class('home') ?>">
        <a href="index.php?section=home">Home</a>
    </li>
    <li class="<?php active_class('products') ?>">
        <a href="index.php?section=products">Products</a>
    </li>


    <?php if ($user) { ?>
        <li class="<?php active_class('cart') ?>">
            <a href="index.php?section=cart">My Shopping Cart <span id="cart-item-count" class="badge"><?php echo $_SESSION['cartcount']; ?></span></a>
        </li>

        <?php if ($user->is_admin()) { ?>
            <li class="<?php active_class('editproducts') ?>">
                <a href="index.php?section=editproducts">Edit Products</a>
            </li>
            <li class="<?php active_class('feedreader') ?>">
                <a href="index.php?section=feedreader">Feed Reader</a>
            </li>
            <?php
        }
    }
    ?>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span id="weather">Weather</span>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <?php
            include_once './php/Weather.class.php';

            $zipCodes = array(
                20001 => "Washington",
                33132 => "Miami",
                43230 => "Columbus",
                30350 => "Atlanta",
                75082 => "Richardson"
            );

            while ($city = current($zipCodes)) {
                $code = key($zipCodes);
                echo "<li class='weather-zip-code' data='$code'>$city</li>";
                next($zipCodes);
            }
            ?>
        </ul>
    </li>
</ul>

<script type="text/javascript" src="./js/load-weather.js"></script>