<?php if ($user && $user->is_admin()) { ?>
    <!-- Upload Dialog -->
    <div id="upload-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-danger">Upload</h3>
                </div>
                <div class="modal-body">
                    <form id="upload-form" method="post" action="index.php?section=products" enctype="multipart/form-data">
                        <?php
                        // Check if any file was uploaded
                        if (isset($_FILES['userfile'])) {
                            $file_upload = $_FILES['userfile'];

                            if (check_upload_successful($file_upload)) {
                                $info = getimagesize($file_upload['tmp_name']);
                                if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
                                    ?>
                                    <div class="alert alert-danger">
                                        <strong>Failure:</strong> The uploaded file must be either a JPEG, GIF or PNG!
                                    </div>
                                    <?php
                                } else {
                                    move_uploaded_file(
                                            $file_upload['tmp_name'], $upload_directory . $file_upload['name']
                                    );
                                    create_thumbnail($upload_directory . $file_upload['name'], $upload_directory . 'thumbnails/' . $file_upload['name']);
                                    ?>
                                    <div class="alert alert-success">
                                        <strong>Success:</strong> Your file was successfully added!
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Failure:</strong> We could not add your file, please try again!
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="form-group">
                            <input id="product-upload" name="userfile" type="file" accept="image/*">
                            <div id="product-upload-dnd">
                                <h3 id="product-upload-dnd-text" class="centered">Drag and Drop Products Here</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-upload btn-success" value="Upload">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<h2><?php echo $page; ?></h2>
<div id="products" class="separator">
    <!-- Delete product confirmation dialog -->
    <div id="delete-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-danger">Delete</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure, you want to delete "<span id="delete-dialog-product" class="text-info"></span>"?</p><br/>
                    <blockquote>
                        <p id="delete-dialog-product-description"></p>
                    </blockquote>
                    <p>This process will delete this product entirely from the list. You have to add it again if you want to get it back!</p>
                </div>
                <div class="modal-footer">
                    <button id="btn-delete-product" type="button" data="" class="btn btn-danger dialog-btn" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-default dialog-btn" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-default dialog-btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit products dialog -->
    <div id="edit-dialog" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-success">Edit Product</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Edit product "<span id="edit-dialog-product" class="text-info"></span>" in this dialog and configure,
                        modify and rename it. All changes will only be applied by clicking on the "Save" button below. If you
                        want to ignore all changes, click the "Discard" or "Cancel" button and close the dialog.
                    </p>
                    <!-- Name -->
                    <div class="form-group">
                        <label for="edit-dialog-product-name">Name</label>
                        <input id="edit-dialog-product-name" class="form-control" type="text"/>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="edit-dialog-product-description">Description</label>
                        <textarea id="edit-dialog-product-description" class="form-control">
                        </textarea>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="edit-dialog-product-price">Price</label>
                        <input id="edit-dialog-product-price" class="form-control" type="number" min="0.01" step="0.01"/>
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        <label for="prod-config-img-select">Image</label>
                        <select id="prod-config-img-select" name="img-select" class="image-picker">
                            <?php
                            while ($file = readdir($file_handle)) {
                                $src = $upload_directory . 'thumbnails/' . $file;
                                $ccc = $upload_directory . $file;
                                if ($file != '.' && $file != '..' && !is_dir($src) && is_file($src)) {
                                    echo "<option id='$ccc' data-img-src='$src' value='$ccc'>$file</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-edit-product" type="button" data="" class="btn btn-success dialog-btn" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-default btn-danger dialog-btn" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-default dialog-btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($user && $user->is_admin()) { ?>
        <div id="product-admin-config">
            <h3>Admin Configurations</h3>
            <button class="btn btn-default" data-toggle="modal" data-target="#upload-dialog">Upload Products</button>
        </div>
    <?php } ?>


    <!-- Products Table -->
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Rating</th>
                <th>Price</th>
                <th>Shopping Cart</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $products = $user_system->get_database()->all_products();

            foreach ($products as $value) {
                $rating = $value->get_rating();

                echo '<tr id="prod-' . $value->get_id() . '">';
                echo '<td>' . $value->get_name() . '</td>';
                echo '<td>' . $value->get_description() . '</td>';
                echo '<td>';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        echo '<span class="glyphicon glyphicon-star text-primary"></span>';
                    } else {
                        echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    }
                }
                echo '</td>';
                echo '<td>€ ' . number_format($value->get_price(), 2) . '</td>';
                echo '<td>';
                if ($user) {
                    echo '<a id="' . $value->get_id() . '" href="#" onclick="return false;" class="lnk-put-into-cart text-info">' . ($user->is_admin() ? 'Add' : 'Add to Cart') . '</a>';
                    if ($user->is_admin()) {
                        echo ' | ';
                        echo '<a id="' . $value->get_id() . '" href="#" onclick="return false;" data="' . $value->get_name() . '" data-desc="' . $value->get_description() . '" data-price="' . $value->get_price() . '" data-image="' . $value->get_imgpath() . '" data-toggle="modal" data-target="#edit-dialog" class="lnk-edit-product text-warning">Edit</a>';
                        echo ' | ';
                        echo '<a id="' . $value->get_id() . '" href="#" onclick="return false;" data="' . $value->get_name() . '" data-desc="' . $value->get_description() . '" data-toggle="modal" data-target="#delete-dialog" class="lnk-delete-product text-danger">Delete</a>';
                    }
                } else {
                    echo '<span class="text-danger">Login Required</span>';
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <div id="add-products-success-alert" class="alert alert-success center-block">
        <strong>Success: </strong><span id="alert-success-data"></span>
    </div>

    <script type="text/javascript" src="./js/add-to-cart.js"></script>
</div>