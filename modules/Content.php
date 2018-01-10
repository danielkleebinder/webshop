<?php

function check_upload_successful($upload) {
    return !$upload['error'] &&
            $upload['size'] > 0 &&
            $upload['tmp_name'] &&
            is_uploaded_file($upload['tmp_name']);
}

include './ajax/ImageUtils.php';

$page = "home";
if (isset($_GET['section'])) {
    $page = $_GET['section'];
}

$upload_directory = './pics/';
$file_handle = opendir($upload_directory);
?>

<section id="body-section" class="container">
    <?php
    switch ($page) {
        case 'cart':
            include './modules/contents/ShoppingCart.php';
            break;
        case 'editproducts':
            include './modules/contents/EditProducts.php';
            break;
        case 'feedreader':
            include './modules/contents/FeedReader.php';
            break;
        case 'change':
            include './modules/contents/ChangeUserData.php';
            break;
        case 'register':
            include './modules/contents/Register.php';
            break;
        case 'products':
            include './modules/contents/Products.php';
            break;
        default:
            include './modules/contents/Home.php';
    }
    ?>
</section>