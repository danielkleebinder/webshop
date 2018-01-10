<?php

session_start();

include_once '../php/Product.class.php';
include_once '../php/WebshopDatabase.class.php';
include_once './Utils.class.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$imgpath = $_POST['imgpath'];

$wdb = new WebshopDatabase();

$product = $wdb->get_product_by_id($id);
$product->set_name($name);
$product->set_description($description);
$product->set_price($price);
$product->set_imgpath('./pics/' . $imgpath);

if (!$wdb->update_product($product)) {
    echo 'Cannot update product!';
    $wdb->disconnect();
    exit();
}
$wdb->disconnect();

$_SESSION['cartcount'] = Utils::cart_total_amount();
$_SESSION['cartprice'] = Utils::cart_total_price();
echo number_format($product->get_price(), 2);
