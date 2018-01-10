<?php

include_once './Utils.class.php';
sleep(1);
echo Utils::create_feed($_POST['url'], -1);
