<?php
while ($file = readdir($file_handle)) {
    $src = $upload_directory . $file;
    if ($file != '.' && $file != '..' && !is_dir($src) && is_file($src)) {
        $src_thumbnail = $upload_directory . 'thumbnails/' . $file;
        ?>

        <a class="gallery-img col-xs-6 col-sm-4 col-md-3 col-lg-3" rel="gallery" href="<?php echo $src; ?>" title="No Description">
            <div class="gallery-img-container">
                <img class="img-responsive" src="<?php echo $src_thumbnail; ?>" alt="Cannot load image">
            </div>
        </a>
        <?php
    }
}