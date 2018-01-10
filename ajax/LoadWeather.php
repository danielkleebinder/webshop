<?php

include_once '../php/Weather.class.php';

$weather = new Weather($_POST['zipCode']);
echo $weather->response;
