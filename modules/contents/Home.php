
<div id="home-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#home-carousel" data-slide-to="1"></li>
        <li data-target="#home-carousel" data-slide-to="2"></li>
        <li data-target="#home-carousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="./img/header_01.png" alt="Los Angeles">
        </div>

        <div class="item">
            <img src="./img/header_02.png" alt="Chicago">
        </div>

        <div class="item">
            <img src="./img/header_03.png" alt="New York">
        </div>

        <div class="item">
            <img src="./img/header_04.png" alt="New York">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#home-carousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#home-carousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="banner-info">
    <?php if ($user) { ?>
        <div class="banner-user-icon"><?php echo substr($user->get_firstname(), 0, 1) . substr($user->get_lastname(), 0, 1); ?></div>
        <span class="banner-info-header">Hello, <?php echo $user->get_firstname(); ?></span>
        <span class="banner-info-text">You have ordered <?php echo '0'; ?> products so far</span>
    <?php } ?>
</div>


<h2><?php echo $page; ?></h2>

<div id="gallery-container" class="separator clearfix">
    <?php include './modules/contents/GenerateGallery.php'; ?>
</div>

<h2>News Feed</h2>
<div class="separator">
    <?php
    $url = 'http://derstandard.at/?page=rss&ressort=Web';
    echo Utils::create_feed($url, 4);
    ?>
</div>