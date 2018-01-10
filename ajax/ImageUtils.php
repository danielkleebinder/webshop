<?php

function getfiletype($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

function imagecreatefromfile($filename) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "' . $filename . '" not found.');
    }
    switch (getfiletype($filename)) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
        case 'png':
            return imagecreatefrompng($filename);
        case 'gif':
            return imagecreatefromgif($filename);
        default:
            throw new InvalidArgumentException('File "' . $filename . '" is not valid jpg, png or gif image.');
    }
}

function imagewriteback($image, $filename) {
    if (!$image) {
        return false;
    }
    switch (getfiletype($filename)) {
        case 'jpeg':
        case 'jpg':
            return imagejpeg($image, $filename);
        case 'png':
            return imagepng($image, $filename);
        case 'gif':
            return imagegif($image, $filename);
        default:
            return false;
    }
}

function create_thumbnail($src, $dest) {
    $desired_width = 380;


    $source_image = imagecreatefromfile($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    $ratio = $width / $height;
    $desired_height = $desired_width / $ratio;

    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    imagewriteback($virtual_image, $dest);
}
