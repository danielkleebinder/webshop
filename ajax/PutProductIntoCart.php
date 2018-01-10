<?php

session_start();

include_once '../php/Product.class.php';
include_once '../php/WebshopDatabase.class.php';
include_once './Utils.class.php';

$id = $_POST['id'];
if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
}
$_SESSION['cart'][$id] += 1;

$_SESSION['cartcount'] = Utils::cart_total_amount();
$_SESSION['cartprice'] = Utils::cart_total_price();
echo $_SESSION['cartcount'];
