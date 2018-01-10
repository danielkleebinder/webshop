<?php
include '../ajax/ImageUtils.php';

$upload_directory = '../pics/';
$path_directory = './pics/';
if (is_array($_FILES) && isset($_FILES['userfile'])) {
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        $sourcePath = $_FILES['userfile']['tmp_name'];
        $info = getimagesize($sourcePath);
        if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
            $targetPath = $upload_directory . $_FILES['userfile']['name'];
            $thumbnailPath = $upload_directory . 'thumbnails/' . $_FILES['userfile']['name'];
            if (move_uploaded_file($sourcePath, $targetPath)) {
                ?>
                <img src="<?php echo $path_directory . $_FILES['userfile']['name']; ?>" class="uploaded-image">
                <?php
                create_thumbnail($targetPath, $thumbnailPath);
                exit();
            }
        }
    }
}