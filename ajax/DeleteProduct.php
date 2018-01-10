<?php

session_start();


include_once '../php/Product.class.php';
include_once '../php/WebshopDatabase.class.php';
include_once './Utils.class.php';

$id = $_POST['id'];

$wdb = new WebshopDatabase();
if (!$wdb->delete_product_by_id($id)) {
    echo 'Cannot delete product!';
    $wdb->disconnect();
    exit();
}
$wdb->disconnect();

unset($_SESSION['cart'][$id]);

$_SESSION['cartcount'] = Utils::cart_total_amount();
$_SESSION['cartprice'] = Utils::cart_total_price();
echo $_SESSION['cartcount'];
