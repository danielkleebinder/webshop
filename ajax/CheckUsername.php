<?php

include_once '../php/WebshopDatabase.class.php';

$wdb = new WebshopDatabase();
if (!$wdb->is_username_available($_POST['username'])) {
    echo "true";
} else {
    echo "false";
}
$wdb->disconnect();
