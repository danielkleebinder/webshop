<?php

include './ImageUtils.php';

if (isset($_GET['img-select']) && isset($_GET['prod-config'])) {
    $filename = $_GET['img-select'];
    $config = $_GET['prod-config'];

    $full_filename = '../pics/' . $filename;
    $undo_filename = '../pics/undo/' . $filename;
    $thum_filename = '../pics/thumbnails/' . $filename;

    if ($config !== 'undo') {
        copy($full_filename, $undo_filename);
    }

    $image = imagecreatefromfile($full_filename);

    $final_image;
    if ($config === 'grayscale') {
        if (imagefilter($image, IMG_FILTER_GRAYSCALE)) {
            $final_image = $image;
        }
    } else if ($config === 'rot_right') {
        $final_image = imagerotate($image, -90, 0);
    } else if ($config === 'rot_left') {
        $final_image = imagerotate($image, 90, 0);
    } else if ($config === 'mirror') {
        imageflip($image, IMG_FLIP_HORIZONTAL);
        $final_image = $image;
    } else if ($config === 'cut') {
        $crop_x = $_GET['crop-x'];
        $crop_y = $_GET['crop-y'];
        $crop_width = $_GET['crop-width'];
        $crop_height = $_GET['crop-height'];

        $final_image = imagecrop($image, ['x' => $crop_x, 'y' => $crop_y, 'width' => $crop_width, 'height' => $crop_height]);
        if (!$final_image) {
            echo 'false';
            exit();
        }
    } else if ($config === 'undo') {
        if (!file_exists($undo_filename)) {
            echo 'false';
            exit();
        }
        $final_image = imagecreatefromfile($undo_filename);
    }

    if (!imagewriteback($final_image, $full_filename)) {
        echo 'false';
        exit();
    }

    create_thumbnail($full_filename, $thum_filename);

    echo 'true';
}