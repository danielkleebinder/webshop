<div id="file-upload">
    <h2>Edit Products</h2>
    <form id="modify-form" method="get" class="separator" action="index.php?section=editproducts">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-9">
                    <select id="product-option-dropdown" class="form-control" onchange="toggleCroppingWindow(this.value)" name="prod-config">
                        <option value="grayscale">Grayscale</option>
                        <option value="rot_right">Rotate 90° Right</option>
                        <option value="rot_left">Rotate 90° Left</option>
                        <option value="mirror">Mirror</option>
                        <option value="cut">Cut</option>
                        <option value="undo">Undo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input id="modify-submit" type="submit" class="btn btn-upload btn-success" value="Modify">
                </div>
            </div>
            <div id="cropping">
                <div class="col-md-8">
                    <img id="image" style="height: 400px;" src="pics/3.jpg" alt="Picture">
                </div>
                <div id="crop-control" class="col-md-4">
                    <h3 style="margin-bottom: 30px;">Information</h3>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="data-x">X</label>
                        <input id="data-x" name="crop-x" type="text" readonly="readonly" class="form-control" placeholder="x">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="data-y">Y</label>
                        <input id="data-y" name="crop-y" type="text" readonly="readonly" class="form-control" placeholder="y">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="data-width">Width</label>
                        <input id="data-width" name="crop-width" type="text" readonly="readonly" class="form-control" placeholder="width">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="data-height">Height</label>
                        <input id="data-height" name="crop-height" type="text" readonly="readonly" class="form-control" placeholder="height">
                        <span class="input-group-addon">px</span>
                    </div>
                    <h3 style="margin-bottom: 30px; margin-top: 50px;">Control</h3>
                    <div class="input-group input-group-sm" role="group" style="margin-top: 30px;">
                        <div class="btn-group btn-group-justified" role="group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="zoom-reset" data-option="0.1" title="Zoom Reset" onclick="cropper.reset()">
                                    <span class="glyphicon glyphicon-resize-full"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="zoom-in" data-option="0.1" title="Zoom In" onclick="cropper.zoom(0.1)">
                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="zoom-out" data-option="0.1" title="Zoom Out" onclick="cropper.zoom(-0.1)">
                                    <span class="glyphicon glyphicon-zoom-out"></span>
                                </button>
                            </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" style="margin-top: 5px;">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="move-left" data-option="0.1" title="Left" onclick="cropper.move(10, 0)">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="move-right" data-option="0.1" title="Right" onclick="cropper.move(-10, 0)">
                                    <span class="glyphicon glyphicon-arrow-right"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="move-up" data-option="0.1" title="Up" onclick="cropper.move(0, 10)">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary" data-method="move-down" data-option="0.1" title="Down" onclick="cropper.move(0, -10)">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="success-alert" class="alert alert-success col-md-12">
                <strong>Success: </strong><span id="alert-success-data"></span>
            </div>
            <div id="error-alert" class="alert alert-danger col-md-12">
                <strong>Error: </strong><span id="alert-error-data"></span>
            </div>
        </div>

        <div id="image-form-group" class="form-group">
            <label for="prod-config-img-select">Select one of the following images to modify:</label>
            <select id="prod-config-img-select" name="img-select" class="image-picker" onchange="changeCropImage(this.value)">
                <?php
                while ($file = readdir($file_handle)) {
                    $src = $upload_directory . 'thumbnails/' . $file;
                    if ($file != '.' && $file != '..' && !is_dir($src) && is_file($src)) {
                        echo "<option id='$file' data-img-src='$src' value='$file'>$file</option>";
                    }
                }
                ?>
            </select>
        </div>
    </form>

    <script type="text/javascript" src="./js/edit-products.js"></script>
</div>