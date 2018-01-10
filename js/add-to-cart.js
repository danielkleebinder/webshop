/*
 Created on : 20.04.2017
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */


/**
 * Initializes put into cart link.
 */
$('.lnk-put-into-cart').click(function (evt) {
    $.ajax({
        type: 'POST',
        url: './ajax/PutProductIntoCart.php',
        data: 'id=' + $(this).attr('id'),
        success: function (data) {
            $('#cart-item-count').html(data);
            $('#alert-success-data').html('Added to shopping cart.');
            $('#add-products-success-alert').fadeIn(250).delay(1000).fadeOut(250);
        }
    });
});

/**
 * Initializes edit link.
 */
$('.lnk-edit-product').click(function (evt) {
    $('#edit-dialog-product').html($(this).attr('data'));
    $('#edit-dialog-product-description').val($(this).attr('data-desc'));
    $('#edit-dialog-product-name').val($(this).attr('data'));
    $('#edit-dialog-product-price').val($(this).attr('data-price'));

    $('#prod-config-img-select').val($(this).attr('data-image'));
    $('#prod-config-img-select').data('picker').sync_picker_with_select();

    $('#btn-edit-product').attr('data', $(this).attr('id'));
});

/**
 * Initializes edit button of the dialog.
 */
$('#btn-edit-product').click(function (evt) {
    var id = $(this).attr('data');

    var name = $('#edit-dialog-product-name').val();
    var description = $('#edit-dialog-product-description').val();
    var price = $('#edit-dialog-product-price').val();
    var imgpath = $('#prod-config-img-select').val();

    $.ajax({
        type: 'POST',
        url: './ajax/EditProduct.php',
        data: 'id=' + id + '&name=' + name + '&description=' + description + '&price=' + price + '&imgpath=' + imgpath,
        success: function (data) {
            $('#prod-' + id).children().eq(0).html(name);
            $('#prod-' + id).children().eq(1).html(description);
            $('#prod-' + id).children().eq(3).html('€ ' + data);

            $('.lnk-edit-product').attr('data', name);
            $('.lnk-edit-product').attr('data-desc', description);
            $('.lnk-edit-product').attr('data-price', data);
        }
    });
});

/**
 * Initializes delete link.
 */
$('.lnk-delete-product').click(function (evt) {
    $('#delete-dialog-product').html($(this).attr('data'));
    $('#delete-dialog-product-description').html($(this).attr('data-desc'));
    $('#btn-delete-product').attr('data', $(this).attr('id'));
});

/**
 * Initializes delete button of the dialog.
 */
$('#btn-delete-product').click(function (evt) {
    var id = $(this).attr('data');
    $.ajax({
        type: 'POST',
        url: './ajax/DeleteProduct.php',
        data: 'id=' + id,
        success: function (data) {
            $('#cart-item-count').html(data);
            $('#prod-' + id).remove();
        }
    });
});